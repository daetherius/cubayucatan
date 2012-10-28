<?php
App::import('Controller','_base/Unlisteditems');
class PacksController extends UnlisteditemsController{
	var $name = 'Packs';
	var $uses = array('Pack','Destination');

	function reservar($id){
		$id = $this->_checkid($id,false);
		$item = $this->Pack->find_(array($id,'contain'=>false));
		$this->set(compact('item'));

		if($id > 4){ /// Yucatan
			$this->render('/packs/reservar_yucatan');
		} else { /// Cuba
			$this->render('/packs/reservar_cuba_'.$id);
		}
	}

	function ver($id = false){
		$id = $this->_checkid($id,false);
		parent::ver($id);

		//if(true || (Cache::read('destination_p'.$id) === false)){
			$find_opts = array('contain'=>false,'fields'=>array('slug','nombre'));

			switch($id){
				case 1:
					$destinations = array(
						array('days'=>4,$this->Destination->find_(array_merge(array(3),$find_opts))), # Havana
						array('days'=>3,$this->Destination->find_(array_merge(array(1),$find_opts))), # Trinidad
						array('days'=>2,$this->Destination->find_(array_merge(array(5),$find_opts))), # Camagüey
						array('days'=>4,$this->Destination->find_(array_merge(array(17),$find_opts))), # Baracoa
						array('days'=>5,$this->Destination->find_(array_merge(array(2),$find_opts)))  # Santiago
					);
				break;
				case 2:
					$destinations = array(
						array('days'=>7,$this->Destination->find_(array_merge(array(3),$find_opts))), # Havana
						array('days'=>3,$this->Destination->find_(array_merge(array(4),$find_opts))), # Cien fuegos
						array('days'=>4,$this->Destination->find_(array_merge(array(1),$find_opts))) # Trinidad
					);
				break;
				case 3:
					$destinations = array(
						array('days'=>4,$this->Destination->find_(array_merge(array(3),$find_opts))), # Havana
						array('days'=>3,$this->Destination->find_(array_merge(array(1),$find_opts))), # Trinidad
						//array('days'=>2,$this->Destination->find_(array_merge(array(),$find_opts))), # Santa Clara
					);
				break;
				case 4:
					$destinations = array(
						array(
							array('Destination'=>array('nombre'=>'Pinar del río')),//$this->Destination->find_(array_merge(array(),$find_opts)), # Pinar del río
							$this->Destination->find_(array_merge(array(5),$find_opts)) # Camagüey
						), 
						array(
							$this->Destination->find_(array_merge(array(3),$find_opts)), #Havana
							$this->Destination->find_(array_merge(array(6),$find_opts)), # Bayamo
						), 
						array(
							$this->Destination->find_(array_merge(array(1),$find_opts)), # Trinidad
							$this->Destination->find_(array_merge(array(17),$find_opts)), # Baracoa
						), 
						array(
							$this->Destination->find_(array_merge(array(4),$find_opts)), # Cien fuegos
							$this->Destination->find_(array_merge(array(2),$find_opts)),  # Santiago
						), 
						array(array('Destination'=>array('nombre'=>'Santa Clara'))),//array($this->Destination->find_(array_merge(),$find_opts))), # Santa Clara
					);
				break;
			}
			fb($destinations,'$destinations');
			Cache::write('destination_p'.$id,$destinations);
		//}

		$template = $id < 5 ? 'cuba' : 'yucatan';

		$this->render('/packs/'.$template);
	}
}
?>