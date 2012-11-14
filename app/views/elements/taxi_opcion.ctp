<?php
echo $html->div('taxi_opcion clear'.($item['Pack']['id'] > 4 ? ' yucatan':''));

	if($item['Pack']['id'] > 4){
		echo
			$html->div('title title4',__('indique_si_desea_hab_opcional2',true)),
			$form->input('taxi_hab',array(
				'label'=>__('concepto_hab_opcional',true),
				'value'=>0,
				'after'=>$html->tag('span','x 2 x €'.$precio_hab_opcional.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'hab_opcional')),'precio'),'pad')
			)),
			
			$form->input('taxi_arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker','type'=>'text')),
			//$form->input('taxi_retorno',array('label'=>__('retorno',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker')),
			
			/*$form->input('taxi_adicionales',array(
				'label'=>__('hab_opcional_adicionales',true),
				'value'=>0,
				'after'=>$html->tag('span','x €'.$precio_hab_opcional.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'hab_opcional_adicional')),'precio'),'pad')
			)),*/
			$html->para('suitcase',__('proporcione_datos_hotel',true)),
			$html->div('datos_hotel'),
				$form->input('taxi_nombre_hotel',array('label'=>__('nombre_hotel',true))),
				$form->input('taxi_direccion_hotel',array('label'=>__('direccion_hotel',true))),
			'</div>';
	
	} else {
		echo
			$form->input('taxi_arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker','type'=>'text')),
			$form->input('taxi_num_vuelo',array('label'=>__('num_vuelo',true))),
			$form->input('taxi_linea_aerea',array('label'=>__('linea_aerea',true)));
	}

echo '</div>';
?>