<?php
class About extends AppModel {
	var $name = 'About';
	var $useTable = 'about';

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita','intro_ita','intro_esp'));
		return true;
	}
}
?>