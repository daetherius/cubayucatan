<?php
class Legal extends AppModel {
	var $name = 'Legal';
	var $useTable = 'legal';

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita'));
		return true;
	}
}
?>