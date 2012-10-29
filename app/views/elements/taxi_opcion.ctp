<?php
echo
	$html->div('taxi_opcion clear'),
		$form->input('taxi.arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker')),
		$form->input('taxi.num_vuelo',array('label'=>__('num_vuelo',true))),
		$form->input('taxi.linea_aerea',array('label'=>__('linea_aerea',true))),
	'</div>';
?>