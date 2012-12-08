<?php
App::import('Controller','_base/Unlisteditems');
class PacksController extends UnlisteditemsController{
	var $name = 'Packs';
	var $uses = array('Pack','Destination','Order');
	var $components = array('Email','Cart');

	/* * * Cart functions * * * * */
	
	function remove(){ $this->Cart->remove(); }
	function add2cart(){ $this->Cart->add2cart(); }
	function checkout(){ $this->Cart->checkout(); }
	function updateqty(){ $this->Cart->updateqty(); }
	function setcheckout(){	$this->Cart->setcheckout();	}

	function finalizado(){ $this->Cart->docheckout();$this->Cart->reset(); }
	function pendiente(){ $this->Cart->reset();$this->render('/packs/finalizado'); }
	function cancelado(){ $this->set('isError',true);$this->Cart->reset();$this->render('/packs/finalizado'); }

	/* * * * * * * * * * * * * * * */

	function reservar($id, $opcion = false){
		$id = $this->_checkid($id,false);
		$item = $this->Pack->find_(array($id,'contain'=>false));
		$this->set(compact('item'));
		$this->set(compact('opcion'));

		if(!empty($this->data)){
			$this->data['Order']['pack_id'] = $id;
			$this->Order->set($this->data);
			if($this->Order->validates()){
				$amt = 0;
				$cuantas = 2; //minimo 2 personas

				switch ($id) {
					case 1: $tour_duration = 19;
					case 2: $tour_duration = 14;
					case 3: $tour_duration = 9;

						$this->data['Order']['retorno'] = date('d-m-Y',strtotime($this->data['Order']['arrival'].' +'.$tour_duration.' days'));
						$opciones = array(1=>array(620,984),array(485,758),array(340,522));
						
						/// Alguien quiere pasarse de listo
						if(!in_array((int)$this->data['Order']['opcion'],$opciones[$id])){
							$this->redirect(array_merge(array('action'=>'reservar'),$this->passedArgs),true);
						} else {
							$opcion = $this->data['Order']['opcion'];
						}

						$amt = $this->data['Order']['hab'] * $opcion;
						$cuantas = $this->data['Order']['hab'] * 2;
					break;
					case 4:
						$total_days = 0;
						foreach ($this->data['Order'] as $field => $value) {
							if(strpos($field, '_days') !== false){
								if((int)$value < 1){
									$ciudad = substr($field,0,strpos($field,'_days'));
									$this->data['Order'][$ciudad.'_arrival'] = '';
								} else {
									$total_days+= (int)$value;
								}
							}
						}

						$servicios = 25 + 8; // Precio base de la habitacion + Desayuno
						if($this->data['Order']['con_cena'])
							$servicios+= 19.2;
						$amt = $this->data['Order']['hab'] * $total_days * $servicios;
						$cuantas = $this->data['Order']['hab'] * 2;
					break;
					case 5:
					case 6:
						$this->data['Order']['retorno'] = date('d-m-Y',strtotime($this->data['Order']['arrival'].' +9 days'));
						$opciones = array(2=>865,675,653,758);
						$extras = array(
							'opc_16'=>array(2=>193,134,104,87),
							'opc_15'=>array(2=>71,65,54,48),
							'opc_13'=>array(2=>75,56,75,56),
							'opc_12'=>array(2=>75,56,48,42),
							'opc_11'=>array(2=>95,95,95,95),
							'opc_10'=>array(2=>111,84,70,86),
							'opc_9'=>array(2=>121,94,80,72)
						);
						$por_persona = (int)$this->data['Order']['num_personas'];
						if(!in_array($por_persona, $opciones)) {
							$this->redirect(array('action'=>'reservar'),true);
						} else {
							$num_personas = array_search($por_persona, $opciones);
						}

						$total_extras = 0;
						foreach($extras as $extra_id => $precios){
							if(!empty($this->data['Order'][$extra_id])){
								$total_extras+= $precios[$num_personas];
							}
						}

						$amt = ($por_persona + $total_extras) * $num_personas;
						$cuantas = $num_personas;
					break;		
				}

				$order['Order'] = array_merge($this->data['Order'],array('status'=>'Pendiente','amt'=>$amt));

				/// Paypal/Tarjeta
				if($this->data['Order']['forma_pago'] == 'online'){
					$item = array(
						'name'=>_dec($item['Pack']['nombre_'.$this->_lang]),
						'desc'=>$cuantas.' '.__('personas',true),
						'amt'=>$amt,
						'qty'=>1
					);

					$this->Session->write('cart.current_order',$order);
					$this->Paypal->setCurrencyCode('EUR');
					$this->Paypal->localecode = $this->_lang == 'ita' ? 'IT':'MX';
					$this->Paypal->additem($id,$item);
		
					if(!$this->Paypal->setExpressCheckout()){
						$this->cancel(__('payment_not_initiated',true));
					}

				/// Depósito Bancario
				} else {
					if($this->Order->save($order)){
						$order['Order']['id'] = $this->Order->id;
						$msg = array(
							__('payment_pending_title',true),
							__('payment_pending',true).' '.__('payment_pending_body',true)
						);
						$this->Cart->_order = $order;
						$this->Cart->notify($this->data['Order']['email'],$msg);
						$this->Session->write('cart.flash',__('payment_pending',true));
						$this->redirect(array('action'=>'pendiente'));
					}
				}
			}
		}


		if($id > 4){ /// Yucatan
			$this->render('/packs/reservar_yucatan');
		} else { /// Cuba
			$this->render('/packs/reservar_cuba_'.$id);
		}
	}

	function ver($id = false){
		$id = $this->_checkid($id,false);

		if($id !== false && $item = $this->m[0]->read(null,$id)){
			parent::ver($id);
			
		} elseif($item = $this->m[0]->find_(array(3))){
			$this->redirect(array('id'=>$item[$this->uses[0]]['slug']));
			exit;

		} else {
			$this->set('items',false);
			$this->detour('_base','index');
		}

		$template = $id < 5 ? 'cuba' : 'yucatan';
		$this->render('/packs/'.$template);
	}

	function info(){
		$this->render('/packs/info_'.$this->_lang);
	}
}
?>