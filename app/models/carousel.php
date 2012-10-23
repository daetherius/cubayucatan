<?php
class Carousel extends AppModel {
	var $name = 'Carousel';
	var $labels = array();
	var $actsAs = array(
		'File'=>array(
			'portada'=>false,
			'fields'=>array('src'=>array('maxsize'=>512000,'strict'=>'960px (Recomendado) x 312px (Recomendado)'))
		)
	);

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita'));
		return true;
	}
}
?>