<?php
App::import('Controller','_base/Unlisteditems');
class PacksController extends UnlisteditemsController{
	var $name = 'Packs';
	var $uses = array('Pack','Destination','Reservation');
	var $components = array('Email');

	/** Cart functions **/
	
	function remove(){ $this->Cart->remove(); }
	function add2cart(){ $this->Cart->add2cart(); }
	function checkout(){ $this->Cart->checkout(); }
	function finalizado(){ $this->Cart->docheckout(); }
	function updateqty(){ $this->Cart->updateqty(); }
	function cancelado(){ $this->render('/productos/finalizado'); }
	function setcheckout(){ $this->Cart->setcheckout(); }

	/********************/

	function reservar($id, $opcion = false){
		$id = $this->_checkid($id,false);

		if(!empty($this->data)){
			$this->Reservation->set($this->data);
			if($this->Reservation->save()){

				$site = Configure::read('Site');
				$data = $this->data['Reservation'];

				$this->Reservation->clean($data,false,false);
				$fields = array();

				foreach ($this->Reservation->_schema as $field => $fdata) {
					$fields[$field] = $fdata['label'];
				}

				$this->set(compact('data','fields'));
				
				$this->Email->to = $site['email'];
				$this->Email->from = $site['name'].' <noreply@'.$site['domain'].'>';
				$this->Email->subject = 'Reservación desde '.ucfirst($site['domain']);
				$this->Email->delivery = 'mail';
				$this->Email->sendAs = 'html';
				$this->Email->template = 'reservation';

				if(Configure::read('debug')===0){
					if($this->Email->send()){
						$msg = 'reservacion_enviada_correctamente';
					}
					else
						$msg = 'problema_al_enviar_reservacion';
				} else {
					$this->Email->delivery = 'debug';
					$this->Email->send();
					$msg = 'El Formulario ha sido desactivado porque está en modo Demo.';
				}
				$this->_flash(__($msg,true));
				$this->redirect(array('controller'=>'packs','action'=>'complete'));
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