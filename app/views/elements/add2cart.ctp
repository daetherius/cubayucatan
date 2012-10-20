<?php
echo
	$form->create('Product',array(
		'url'=>array('controller'=>'products','action'=>'add2cart'),
		'id'=>'Add2Cart_'.$data[$_m[0]]['id'],
		'class'=>'add2cart',
		'inputDefaults'=>array('label'=>false)
	)),
	$form->input('id',array('value'=>$data[$_m[0]]['id']));

	if(isset($data['Type']) && $data['Type']){
		$options = array();
		foreach ($data['Type'] as $item_type)
			$options[$item_type['id']] = $item_type['nombre'];

		echo $form->input('type',array('options'=>$options));
	}

	echo $form->end('Agregar al Carrito');
	
?>