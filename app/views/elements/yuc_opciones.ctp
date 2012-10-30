<?php
if($opciones = Cache::read('destination_recent')){
	echo $html->div('yuc_opciones');
		foreach ($opciones['yucatan'] as $slug => $nombre ) {
			//if(in_array($item['Destination']['id'], array(9,10,11,12,13,15,16))
				echo $form->input('opc_'.((int)$slug),array('label'=>$nombre.$html->link(__('ver_detalles',true),array('controller'=>'destinations','action'=>'ver','id'=>$slug),array('target'=>'_blank','rel'=>'nofollow')),'type'=>'checkbox'));
		}
	echo '</div>';
}
?>