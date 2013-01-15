<?php
class Contact extends AppModel {
	var $name = 'Contact';
	var $_schema = array(
		'nombre' =>array('type'=>'string', 'length'=>100),
		'email' =>array('type'=>'string', 'length'=>255),
		'empresa' =>array('type'=>'string', 'length'=>255),
		'mensaje' =>array('type'=>'text')
	);
	var $actsAs = array('Captcha');
	var $useTable = false;
	var $validate = array(
		'nombre' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Este campo no puede quedar vacío.'
		),
		'mail' => array(
			'rule'=>'blank',
			'required' => true,
			'allowEmpty' => true,
			'message' => 'Non-Human.'
		),
		'email' => array(
			'format'=>array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Ingrese una dirección web válida.'
			),
			'vacio' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Este campo no puede quedar vacío.'
			)		
		),
		'mensaje' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Este campo no puede quedar vacío.'
		)
	);
}
?>