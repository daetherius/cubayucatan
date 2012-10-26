<?php
class Post extends AppModel {
	var $name = 'Post';
	var $displayField = 'nombre_ita';
	var $labels = array(
		'comment_count'=>'comentarios',
		'postimg_count'=>'Imágenes'
	);
	var $hasMany = array(
		'Comment'=>array(
			'className'=>'Comment',
			'foreignKey'=>'parent_id',
			'conditions'=>array('parent'=>'Post'),
			'dependent'=>true
		),
		'Postimg'=>array(
			'className'=>'Postimg',
			'order'=>'Postimg.orden asc',
			'dependent'=>true
		)
	);
	var $hasOne = array(
		'Postportada'=>array(
			'className'=>'Postimg',
			'foreignKey'=>'post_id',
			'conditions'=>'Postportada.portada = 1'
		)
	);
	var $validate = array();

	function beforeValidate(){
		$this->clean($this->data,false,array('descripcion_esp','descripcion_ita','subtitulo_ita','subtitulo_esp'));
		return true;
	}
}
?>