<?php
App::import('Controller','_base/Unlisteditems');
class PacksController extends UnlisteditemsController{
	var $name = 'Packs';
	var $uses = array('Pack','Destination');

	function reservar($id, $opcion = false){
		$id = $this->_checkid($id,false);
		$item = $this->Pack->find_(array($id,'contain'=>false));
		$this->set(compact('item'));
		$opciones = array(1=>array(620,984),2=>array(485,758),3=>array(350,522));

		if(empty($opcion) && (!empty($opciones[$id]))){
			$this->set('opcion',$opciones[$id][0]);
		}

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