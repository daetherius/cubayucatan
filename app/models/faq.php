<?php
class Faq extends AppModel{
	var $name = 'Faq';
	var $labels = array(
		'nombre'=>'pregunta',
		'descripcion'=>'respuesta'
	);
	var $validate = array();

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita'));
		return true;
	}
}
?>