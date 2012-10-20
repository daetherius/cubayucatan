<?php
class CartComponent extends Object {
	var $msg = array(
		'add_one'=>'+1',
		'add_win'=>'Agregado al carrito.',
		'add_fail'=>'No se pudo agregar al carrito.',
		'remove'=>'Elemento eliminado.',
	);
	var $components = array('Cookie','Session','Paypal');
	var $out_of_stock = array();

	function initialize(&$controller) {
		$this->controller =& $controller;
		$this->Product = $this->controller->Product;
		$this->Order = $this->controller->Order;
		//fb($this->Session->read('cart'),'Session->cart');
	}

	function add2cart(){
		$item_id = $this->controller->data['Product']['id'];
		$type_id = $this->controller->data['Product']['type'];

		if(!empty($item_id)){
			$item = $this->Product->find_(array(
				$item_id,
				'contain'=>array('Productportada'),
				'fields'=>array('id','nombre','slug','precio','Productportada.src')
			),'first');
			
			if($item){
				$item['Type'] = false;

				if((!empty($type_id)) && $type = $this->Product->Type->find_(array($type_id,'contain'=>false,'fields'=>array('id','nombre','precio')))){
					$item_id.= '_'.$type_id;
					$item['Type'] = $type['Type'];
					if(!empty($type['Type']['precio']))
						$item['Product']['precio'] = $type['Type']['precio'];
				}

				if($this->Session->check('cart.items.'.$item_id)){ // +1
					$this->Session->write('cart.items.'.$item_id.'.qty',$this->Session->read('cart.items.'.$item_id.'.qty')+1);
					$this->response($this->msg['add_one']); return;

				} else { // New item
					$item['qty'] = 1;
					$this->Session->write('cart.items.'.$item_id,$item);
					$this->response($this->msg['add_win']); return;
				}
			}
		}

		$this->response($this->msg['add_fail']);
	}

	function updateqty($auto_response = true){
		if(!empty($this->controller->data['Product'])){
			$response = '';
			$total = 0;
			foreach($this->controller->data['Product'] as $item_key => $item){
				if($this->Session->check('cart.items.'.$item_key)){
					$item_precio = $this->Session->read('cart.items.'.$item_key.'.Product.precio');
					$total+= $item['qty']*$item_precio;
					$this->Session->write('cart.items.'.$item_key.'.qty',(int)$item['qty']);
					$response.='$("precio_'.$item_key.'").set("html","'.(number_format($item['qty']*$item_precio,2)).'");';
				}
			}
			
			$response.= '$("cart_total").set("html","'.number_format($total,2).'");';

			if($auto_response) $this->response($response,true);
		}
	}

	function remove(){
		if(!empty($this->controller->data['remove'])){
			$response = '';

			foreach ($this->controller->data['remove'] as $item_id => $value) {
				$this->Session->delete('cart.items.'.$item_id);
			}
		}
	}

	function checkout(){
		if(empty($this->controller->data['checkout'])){
			/** NO JS **/ if(!empty($this->controller->data['Product'])){ $this->remove();$this->updateqty(false); }
		} else {
			$this->setcheckout();
		}

		$this->controller->set('items',$this->Session->read('cart.items'));
	}

	function setcheckout(){
		$this->items = array();
		$items = $this->Session->read('cart.items');
		$this->Session->delete('cart.current_order');
		$find_opts = array('contain'=>false,'fields'=>array('id','nombre','precio','stock'));
		$order = array('Order'=>array('status'=>'Pendiente','total'=>0,'buyer_id'=>null));

		if($this->Session->check('cart.Buyer.id'))
			$order['Order']['buyer_id'] = $this->Session->read('cart.Buyer.id');

		foreach ($items as $item_id => $item) {
			if(!$item['qty']){
				$this->Session->delete('cart.items.'.$item_id);
				continue;
			}

			$product = $this->Product->find_(array_merge(array($item['Product']['id']),$find_opts));
			$product['Product']['nombre'] = ucfirst($product['Product']['nombre']); # Prettifier
			$type = false;

			if($product && (!empty($item['Type']['id']))){
				$type = $this->Product->Type->find_(array_merge(array($item['Type']['id']),$find_opts));
				$product['Product']['stock'] = $type['Type']['stock'];
				
				if(!empty($type['Type']['precio']))
					$product['Product']['precio'] = $type['Type']['precio'];
			}
			
			if($product['Product']['stock'] < $item['qty']){ // Out of Stock!
				$this->Session->write('cart.items.'.$item_id.'.qty',$product['Product']['stock'] ? $product['Product']['stock'] : 0);
				$this->out_of_stock[$item_id] = $product['Product']['stock'];
			
			} else {
				$this->items[$item_id] = array(
					'name'=>$product['Product']['nombre'],
					'desc'=>$type ? $type['Type']['nombre'] : null,
					'amt'=>$product['Product']['precio'],
					'qty'=>$item['qty'],
				);

				$order['Orderdetail'][] = array(
					'product_id'=>$product['Product']['id'],
					'type_id'=>$type ? $type['Type']['id'] : null,
					'cantidad'=>$item['qty']
				);

				$order['Order']['total']+= $product['Product']['precio']*$item['qty'];

				$this->Paypal->additem($item_id,$this->items[$item_id]);
			}
		}

		if($this->out_of_stock){ // Stock problems
			$this->flash('Algunos elementos han sido vendidos durante el proceso de compra.');
			$this->Session->write('cart.out_of_stock',$this->out_of_stock);
			return false;

		} else { // Everything went better than expected :)
			// Save Order to Session
			$this->Session->write('cart.current_order',$order);

			$this->Paypal->setCurrencyCode('MXN');
			if(!$this->Paypal->setExpressCheckout()){
				$this->cancel('failed setExpress');
			}
		}

		$this->controller->set(compact('items'));
	}	

	function docheckout(){
		if($this->Session->check('cart.current_order')){
			$order = $this->Session->read('cart.current_order');
		} else {
			$this->cancel('El proceso de compra se ha interrumpido.');
		}

		// Recheck for Stock
		$this->out_of_stock = array();
		$find_opts = array('contain'=>false,'fields'=>array('id','stock'));

		foreach($order['Orderdetail'] as $detail){
			if(!empty($detail['type_id'])){
				$model = $this->Product->Type;
				$item_id = $detail['product_id'].'_'.$detail['type_id'];
			} else {
				$model = $this->Product;
				$item_id = $detail['product_id'];
			}
			
			$item = $model->find_(array_merge(array($detail[strtolower($model->alias).'_id']),$find_opts));
			if((!empty($item)) && $item[$model->alias]['stock'] < $detail['cantidad']){ // Out of stock!
				$this->out_of_stock[$item_id] = $item[$model->alias]['stock'];
				$this->Session->write('cart.items.'.$item_id.'.qty',$item[$model->alias]['stock']);
			}
		}
		
		if(!empty($this->out_of_stock)){
			$this->flash('El proceso ha sido cancelado porque algunos elementos han sido vendidos durante el proceso de compra.');
			$this->Session->write('cart.out_of_stock',$this->out_of_stock);
			$this->controller->redirect(array('action'=>'checkout'),true);
		}

		// Save order prospect
		if(!$this->Order->saveAll($order,array('validate'=>true))){
			$this->cancel('Ha ocurrido un error al registrar el pago.');
		}

		$pay_details = $this->Paypal->doExpressCheckoutPayment();
		$request = $this->Paypal->processOutput($this->Paypal->request);
		$response = $this->Paypal->response;
		$payer_data = array(
			'id'=>$this->Order->id,
			'total'=>$response['PAYMENTINFO_0_AMT'],
			'currency'=>$response['PAYMENTINFO_0_CURRENCYCODE'],
			'correlation'=>$response['CORRELATIONID'],
			'payer_id'=>$request['PAYERID'],
			'payer_email'=>$request['EMAIL'],
			'payer_firstname'=>$request['FIRSTNAME'],
			'payer_lastname'=>$request['LASTNAME']
		);

		if($pay_details === false){
			$i = 0;
			$errors = array();
			do {
				$errors[] = '['.$response['L_ERRORCODE'.$i].'] '.urldecode($response['L_LONGMESSAGE'.$i]);
				$i++;
			} while(!empty($response['L_ERRORCODE'.$i]));
			
			$this->Order->save(array_merge($payer_data,	array(
				'status'=>'Fallida',
				'errors'=>implode("\n",$errors)
			)));

			$this->cancel($errors);

		} else {
			// Stock decrease
			foreach($order['Orderdetail'] as $detail){
				if(!empty($detail['type_id']))
					$this->Product->Type->updateAll(array('Type.stock'=>'Type.stock-'.$detail['cantidad']),array('Type.id'=>$detail['type_id']));
				else
					$this->Product->updateAll(array('Product.stock'=>'Product.stock-'.$detail['cantidad']),array('Product.id'=>$detail['product_id']));
			}			

			// Mark order as paid
			$this->Order->save(array_merge($payer_data,	array('status'=>'Pagada')));

			$this->controller->set('cart_flash','El proceso de compra ha finalizado satisfactoriamente');
			$this->Session->write('cart.items',array());
			$this->Session->delete('cart.current_order');
		}
	}

	function response($msg,$js = false){
		if(isset($this->controller->params['isAjax']) && $this->controller->params['isAjax']){
			if(!$js) $msg = 'alert("'.$msg.'");';
			$ajax = $msg;
			$this->controller->set(compact('ajax'));
			$this->controller->render('js');
		} else {
			$this->controller->redirect($this->controller->referer(),true);
		}		
	}

	function flash($msg){ $this->Session->write('cart.flash',$msg); }
	function cancel($error, $cancel_url = array('action'=>'cancelado')){
		$this->flash($error);
		$this->controller->redirect($cancel_url,true);
	}
	function beforeRender(&$controller){
		if($this->Session->check('cart.flash')){
			$controller->set('cart_flash',$this->Session->read('cart.flash'));
			$this->Session->delete('cart.flash');
		}
		if($this->Session->check('cart.out_of_stock')){
			$controller->set('out_of_stock',$this->Session->read('cart.out_of_stock'));
			$this->Session->delete('cart.out_of_stock');
		}
		//if($this->guest){ $this->Cookie->write('cart',$this->Session->read('cart')); }
	}
}
?>