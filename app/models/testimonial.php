<?php
class Testimonial extends AppModel {
	var $name = 'Testimonial';
	var $labels = array();
	var $skipValidation = array();
	var $validate = array();
	var $actsAs = array('File' => array('portada'=>false));


	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita'));
		return true;
	}
}
?>