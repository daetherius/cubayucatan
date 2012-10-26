<?php
class About extends AppModel {
	var $name = 'About';
	var $useTable = 'about';
	var $actsAs = array('File' => array('portada'=>false,'fields'=>array('src'=>array('strict'=>'960px (ancho)'))));
	var $skipValidation = array('src');

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita','intro_ita','intro_esp'));
		return true;
	}
}
?>