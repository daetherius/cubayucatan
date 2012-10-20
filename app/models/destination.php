<?php
class Destination extends AppModel {
	var $name = 'Destination';
	var $labels = array(
		'comment_count'=>'comentarios',
		'destinationimg_count'=>'Imágenes'
	);
	var $hasMany = array(
		'Comment'=>array(
			'className'=>'Comment',
			'foreignKey'=>'parent_id',
			'conditions'=>array('parent'=>'Destination'),
			'dependent'=>true
		),
		'Destinationimg'=>array(
			'className'=>'Destinationimg',
			'order'=>'Destinationimg.orden asc',
			'dependent'=>true
		)
	);
	var $hasOne = array(
		'Destinationportada'=>array(
			'className'=>'Destinationimg',
			'foreignKey'=>'destination_id',
			'conditions'=>'Destinationportada.portada = 1'
		)
	);
	var $validate = array();
	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita','subtitulo_ita','subtitulo_esp'));
		return true;
	}
}
?>