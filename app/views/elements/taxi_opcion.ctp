<?php
echo $html->div('taxi_opcion clear'.($item['Pack']['id'] > 4 ? ' yucatan':''));

	if($item['Pack']['id'] > 4){
		echo
			$html->div('title title3',__('seleccione_estancia_opcional_al_arribo',true)),
			$form->input('opcion_al_llegar',array(
				//'type'=>'radio',
				'options'=>array(
					'no'=>__('opcion_llegada_no',true),
					'si'=>__('opcion_llegada_si',true),
					'si_independiente'=>__('opcion_llegada_si_independiente',true),
				)
			)),

			$html->div('opcion_al_llegar_block',null,array('id'=>'opcion_llegada_no')),
				$form->input('taxi_arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker','type'=>'text')),
				$form->input('taxi_hora',array('label'=>__('hora_llegada',true),'type'=>'text')),
				$form->input('taxi_num_vuelo',array('label'=>__('num_vuelo',true))),
				$form->input('taxi_linea_aerea',array('label'=>__('linea_aerea',true))),
			'</div>',

			//$html->para('title',__('indique_si_desea_hab_opcional2',true)),
			$html->div('opcion_al_llegar_block',null,array('id'=>'opcion_llegada_si')),
				$form->input('taxi_hab',array(
					'label'=>__('concepto_hab_opcional',true),
					'value'=>0,
					'after'=>$html->tag('span','x 2 x €'.$precio_hab_opcional.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'hab_opcional')),'precio'),'pad')
				)),
				
				$form->input('taxi_arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker','type'=>'text')),
				$html->para('suitcase',__('hora_entrega_carro',true)),
			'</div>',
			//$form->input('taxi_retorno',array('label'=>__('retorno',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker')),
			
			/*$form->input('taxi_adicionales',array(
				'label'=>__('hab_opcional_adicionales',true),
				'value'=>0,
				'after'=>$html->tag('span','x €'.$precio_hab_opcional.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'hab_opcional_adicional')),'precio'),'pad')
			)),*/
			//$html->para('suitcase',__('proporcione_datos_hotel',true)),
			$html->div('opcion_al_llegar_block',null,array('id'=>'opcion_llegada_si_independiente')),
				$form->input('taxi_nombre_hotel',array('label'=>__('nombre_hotel',true))),
				$form->input('taxi_direccion_hotel',array('label'=>__('direccion_hotel',true))),
				$html->para('suitcase',__('hora_entrega_carro',true)),
			'</div>';

			$opcion_al_llegar_check = '$$(".opcion_al_llegar_block").setStyle("display","none"); $("opcion_llegada_"+$("OrderOpcionAlLlegar").get("value")).setStyle("display","block");';
			$moo->addEvent('OrderOpcionAlLlegar','click',$opcion_al_llegar_check);
			$moo->buffer($opcion_al_llegar_check);
	
	} else {
		echo
			$form->input('taxi_arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker','type'=>'text')),
			$form->input('taxi_num_vuelo',array('label'=>__('num_vuelo',true))),
			$form->input('taxi_linea_aerea',array('label'=>__('linea_aerea',true)));
	}

echo '</div>';
?>