<?php
class Destinationimg extends AppModel {
	var $name = 'Destinationimg';
	var $actsAs = array('File' => array('portada'=>'destination_id'));
	var $belongsTo = array(
		'Destination' => array(
			'className'=>'Destination',
			'counterCache' => true
		)
	);

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_ita','descripcion_esp'));
		return true;
	}
	
}
?>