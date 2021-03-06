<?php
class CartComponent extends Object {
	var $components = array('Cookie','Session','Paypal','Email');
	var $out_of_stock = array();
	var $item_model = 'Product';
	var $currency = 'MXN';
	var $success = null;

	function initialize(&$controller) {
		$this->controller =& $controller;
		$this->item_model = $this->controller->uses[0];
		$this->Product = $this->controller->{$this->item_model};
		$this->Order = $this->controller->Order;
		//fb($this->Session->read('cart'),'Session->cart');
	}

	function add2cart(){
		$item_id = $this->controller->data[$this->item_model]['id'];
		$type_id = $this->controller->data[$this->item_model]['type'];

		if(!empty($item_id)){
			$item = $this->Product->find_(array(
				$item_id,
				'contain'=>array($this->item_model.'portada'),
				'fields'=>array('id','nombre','slug','precio',$this->item_model.'portada.src')
			),'first');
			
			if($item){
				$item['Type'] = false;

				if((!empty($type_id)) && $type = $this->Product->Type->find_(array($type_id,'contain'=>false,'fields'=>array('id','nombre','precio')))){
					$item_id.= '_'.$type_id;
					$item['Type'] = $type['Type'];
					if(!empty($type['Type']['precio']))
						$item[$this->item_model]['precio'] = $type['Type']['precio'];
				}

				if($this->Session->check('cart.items.'.$item_id)){ // +1
					$this->Session->write('cart.items.'.$item_id.'.qty',$this->Session->read('cart.items.'.$item_id.'.qty')+1);
					$this->response(__('item_agregacion_adicional',true));
				} else { // New item
					$item['qty'] = 1;
					$this->Session->write('cart.items.'.$item_id,$item);
					$this->response(__('item_agregacion_exitosa',true));
				}
				return;
			}
		}

		$this->response(__('item_agregacion_fallida',true));
	}

	function updateqty($auto_response = true){
		if(!empty($this->controller->data[$this->item_model])){
			$response = '';
			$total = 0;
			foreach($this->controller->data[$this->item_model] as $item_key => $item){
				if($this->Session->check('cart.items.'.$item_key)){
					$item_precio = $this->Session->read('cart.items.'.$item_key.'.'.$this->item_model.'.precio');
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
			foreach ($this->controller->data['remove'] as $item_id => $value) {
				$this->Session->delete('cart.items.'.$item_id);
			}
		}
	}

	function checkout(){
		if(empty($this->controller->data['checkout'])){
			/** NO JS **/ if(!empty($this->controller->data[$this->item_model])){ $this->remove();$this->updateqty(false); }
		} else {
			$this->setcheckout();
		}

		$this->controller->set('items',$this->Session->read('cart.items'));
	}

	function setcheckout(){
		$this->items = array();
		$items = $this->Session->read('cart.items');
		$find_opts = array('contain'=>false,'fields'=>array('id','nombre','precio','stock'));
		$order = array('Order'=>array('status'=>'Pendiente','total'=>0,'buyer_id'=>null));

		if($this->Session->check('cart.Buyer.id'))
			$order['Order']['buyer_id'] = $this->Session->read('cart.Buyer.id');

		foreach ($items as $item_id => $item) {
			if(!$item['qty']){
				$this->Session->delete('cart.items.'.$item_id);
				continue;
			}

			$product = $this->Product->find_(array_merge(array($item[$this->item_model]['id']),$find_opts));
			$product[$this->item_model]['nombre'] = ucfirst($product[$this->item_model]['nombre']); # Prettifier
			$type = false;

			if($product && (!empty($item['Type']['id']))){
				$type = $this->Product->Type->find_(array_merge(array($item['Type']['id']),$find_opts));
				$product[$this->item_model]['stock'] = $type['Type']['stock'];
				
				if(!empty($type['Type']['precio']))
					$product[$this->item_model]['precio'] = $type['Type']['precio'];
			}
			
			if(isset($product[$this->item_model]['stock']) && $product[$this->item_model]['stock'] < $item['qty']){ // Out of Stock!
				$this->Session->write('cart.items.'.$item_id.'.qty',$product[$this->item_model]['stock'] ? $product[$this->item_model]['stock'] : 0);
				$this->out_of_stock[$item_id] = $product[$this->item_model]['stock'];
			
			} else {
				$this->items[$item_id] = array(
					'name'=>$product[$this->item_model]['nombre'],
					'desc'=>$type ? $type['Type']['nombre'] : null,
					'amt'=>$product[$this->item_model]['precio'],
					'qty'=>$item['qty'],
				);

				$order['Orderdetail'][] = array(
					strtolower($this->item_model).'_id'=>$product[$this->item_model]['id'],
					'type_id'=>$type ? $type['Type']['id'] : null,
					'cantidad'=>$item['qty']
				);

				$order['Order']['total']+= $product[$this->item_model]['precio']*$item['qty'];

				$this->Paypal->additem($item_id,$this->items[$item_id]);
			}
		}

		if($this->out_of_stock){ // Stock problems
			$this->flash(__('item_vendido_durante_compra',true));
			$this->Session->write('cart.out_of_stock',$this->out_of_stock);
			return false;

		} else { // Everything went better than expected :)
			// Save Order to Session
			$this->Session->write('cart.current_order',$order);

			$this->Paypal->setCurrencyCode($this->currency);
			if(!$this->Paypal->setExpressCheckout()){
				$this->cancel(__('pago_no_iniciado',true));
			}
		}

		$this->controller->set(compact('items'));
	}

	function docheckout($notify = true){
		if($this->Session->check('cart.current_order')){
			$order = $this->Session->read('cart.current_order');
		} else {
			$this->cancel(__('pago_interrumpido',true));
		}

		// Recheck for Stock
		$this->out_of_stock = array();
		$find_opts = array('contain'=>false,'fields'=>array('id','stock'));

		if(!empty($order['Orderdetail'])){
			foreach($order['Orderdetail'] as $detail){
				if(!empty($detail['type_id'])){
					$model = $this->Product->Type;
					$item_id = $detail[strtolower($this->item_model).'_id'].'_'.$detail['type_id'];
				} else {
					$model = $this->Product;
					$item_id = $detail[strtolower($this->item_model).'_id'];
				}
				
				$item = $model->find_(array_merge(array($detail[strtolower($model->alias).'_id']),$find_opts));
				if((!empty($item)) && $item[$model->alias]['stock'] < $detail['cantidad']){ // Out of stock!
					$this->out_of_stock[$item_id] = $item[$model->alias]['stock'];
					$this->Session->write('cart.items.'.$item_id.'.qty',$item[$model->alias]['stock']);
				}
			}
		}
		
		if(!empty($this->out_of_stock)){
			$this->flash(__('item_vendido_durante_compra',true));
			$this->Session->write('cart.out_of_stock',$this->out_of_stock);
			$this->controller->redirect(array('action'=>'checkout'),true);
		}

		// Save order prospect
		if(!$this->Order->saveAll($order,array('validate'=>true))){
			$this->cancel(__('pago_no_guardado',true));
		}

		$this->pay_details = $pay_details = $this->Paypal->doExpressCheckoutPayment();
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
		
		$notify_ = array();
		if(!empty($notify)){
			$notify_ = array($request['EMAIL']);
			
			if(is_array($notify))
				$notify_ = array_merge($notify_,$notify);
		}

		if($pay_details === false){
			$this->success = false;
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

			$this->notify($notify_);
			$this->cancel($errors);

		} else {
			$this->success = true;
			if(!empty($order['Orderdetail'])){
				// Stock decrease
				foreach($order['Orderdetail'] as $detail){
					if(!empty($detail['type_id']))
						$this->Product->Type->updateAll(array('Type.stock'=>'Type.stock-'.$detail['cantidad']),array('Type.id'=>$detail['type_id']));
					else
						$this->Product->updateAll(array($this->item_model.'.stock'=>$this->item_model.'.stock-'.$detail['cantidad']),array($this->item_model.'.id'=>$detail[strtolower($this->item_model).'_id']));
				}
			}			

			// Mark order as paid
			$this->Order->save(array_merge($payer_data,	array('status'=>'Pagada')));

			$this->controller->set('cart_flash',__('pago_exitoso',true));
			$this->Session->write('cart.items',array());
			$this->Session->delete('cart.current_order');

			$this->notify($notify_);
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
	function reset(){ $this->success = null;$this->pay_details = null;$this->Session->delete('cart.current_order'); }
	function notify($emails, $msg = null){
		if(is_null($msg)) $msg = $this->success;

		if($msg === true){
				$msg = array(
					__('payment_success_1',true),
					__('payment_success_2',true)
				);
		} elseif($msg === false){
				$msg = array(
					__('payment_failure_1',true),
					__('payment_failure_2',true)
				);
		} elseif(!is_array($msg)){
			$msg = (array)$msg;
		}

		$site_domain = Configure::read('Site.domain');
		$site_name = Configure::read('Site.name');
		$payer_email = array_shift($emails);
		$pay_details = $this->pay_details;

		$this->controller->set(compact('site_domain','site_name','msg','pay_details'));

		$this->Email->to = $payer_email;
		$this->Email->cc = $emails;
		$this->Email->from = $site_name.' <noreply@'.$site_domain.'>';
		$this->Email->subject = '';
		$this->Email->sendAs = 'html';
		$this->Email->template = 'payment';
		
		$this->Email->delivery = Configure::read('debug') ? 'debug':'mail';
		$this->Email->send();
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