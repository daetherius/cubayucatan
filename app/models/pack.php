<?php
class Pack extends AppModel {
	var $name = 'Pack';
	var $displayField = 'nombre_ita';
	var $labels = array(
		'descripcion2_ita'=>'descripción 2 (Italiano)',
		'descripcion2_esp'=>'descripción 2 (Español)',
		'src'=>'mapa'
	);
	var $actsAs = array('File' => array('portada'=>false));
	var $skipValidation = array('descripcion_ita','descripcion_esp','descripcion2_ita','descripcion2_esp','src');
	var $validate = array();
	var $hasMany = array(
		'Packimg'=>array(
			'className'=>'Packimg',
			'order'=>'Packimg.orden asc',
			'dependent'=>true
		)
	);

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_ita','descripcion_esp','descripcion2_esp','descripcion2_ita'));
		return true;
	}
}
?>