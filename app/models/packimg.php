<?php
class Packimg extends AppModel {
	var $name = 'Packimg';
	var $actsAs = array('File'=>array('portada'=>'pack_id'));
	var $belongsTo = array(
		'Pack' => array(
			'className'=>'Pack',
			'counterCache' => true
		)
	);
}
?>