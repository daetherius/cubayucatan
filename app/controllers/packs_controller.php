<?php
App::import('Controller','_base/Unlisteditems');
class PacksController extends UnlisteditemsController{
	var $name = 'Packs';
	var $uses = array('Pack','Destination','Order');
	var $components = array('Email');

	/** Cart functions **/
	
	function remove(){ $this->Cart->remove(); }
	function add2cart(){ $this->Cart->add2cart(); }
	function checkout(){ $this->Cart->checkout(); }
	function updateqty(){ $this->Cart->updateqty(); }
	function setcheckout(){
		if(!empty($this->data['Order'])){
			fb($this->data['Order'],'$this->data[Order]');exit;
		}

		$this->Cart->setcheckout();
	}
	function finalizado(){ $this->Cart->docheckout();$this->Cart->reset(); }
	function cancelado(){ $this->Cart->reset();$this->render('/productos/finalizado'); }

	/********************/

	function reservar($id, $opcion = false){
		$id = $this->_checkid($id,false);

		if(!empty($this->data)){
			$this->Order->set($this->data);
			if($this->Order->validates()){

				if($this->data['Order']['forma_pago'] == 'online'){
					$amt = 0;
					switch ($this->data['Order']['id']) {
						case 1:
						case 2:
						case 3:
							$opciones = array(1=>array(620,984),	array(485,758),array(350,522));
							/// Alguien quiere pasarse de listo
							if(!in_array((int)$this->data['Order']['opcion'],$opciones[$this->data['Order']['id']])){
								$this->redirect(array('action'=>'reservar'),true);
							} else {
								$opcion = $this->data['Order']['opcion'];
							}

							$amt = $this->data['Order']['hab'] + $opcion;
						break;
					}

				} else {
					if($this->Order->save($this->data)){
						$this->Session->write('cart.flash',__('pago_registrado_pendiente',true));
						$this->redirect(array('action'=>'cancelado'));
					}
				}
			}
		}

		$item = $this->Pack->find_(array($id,'contain'=>false));
		$this->set(compact('item'));
		$this->set(compact('opcion'));

		if($id > 4){ /// Yucatan
			$this->render('/packs/reservar_yucatan');
		} else { /// Cuba
			$this->render('/packs/reservar_cuba_'.$id);
		}
	}

	function ver($id = false){
		$id = $this->_checkid($id,false);
		parent::ver($id);
		$template = $id < 5 ? 'cuba' : 'yucatan';

		$this->render('/packs/'.$template);
	}
}
?>