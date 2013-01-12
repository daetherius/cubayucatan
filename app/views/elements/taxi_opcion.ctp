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

			/// Ida directa a Ek Balam
			$html->div('opcion_al_llegar_block',null,array('id'=>'opcion_llegada_no')),
				$form->input('taxi_arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker','type'=>'text')),
				$form->input('taxi_hora',array('label'=>__('hora_llegada',true),'type'=>'time','timeFormat'=>24)),
				$form->input('taxi_num_vuelo',array('label'=>__('num_vuelo',true))),
				$form->input('taxi_linea_aerea',array('label'=>__('linea_aerea',true))),
			'</div>',

			/// Estancia la noche de llegada
			$html->div('opcion_al_llegar_block',null,array('id'=>'opcion_llegada_si')),
				$form->input('taxi_hab',array(
					'label'=>__('concepto_hab_opcional',true),
					'value'=>0,
					'after'=>$html->tag('span','x '.$html->tag('small',__('EUR',true).'&nbsp;').$precio_hab_opcional.' = '.$html->tag('span',$html->tag('small',__('EUR',true).'&nbsp;').$html->tag('span','',array('id'=>'hab_opcional')),'precio'),'pad')
				)),
				$form->input('taxi_hab_arribo_inicio',array('disabled'=>'disabled','label'=>__('inicio_ocupacion_opcional',true).' '.__('formato_fecha_dmy',true),'type'=>'text')),
				$form->input('taxi_hab_arribo_fin',array('disabled'=>'disabled','label'=>__('fin_ocupacion_opcional',true).' '.__('formato_fecha_dmy',true),'type'=>'text')),
				$html->para('suitcase',__('hora_entrega_carro',true)),
			'</div>',

			/// Estancia la noche de llegada por su cuenta
			$html->div('opcion_al_llegar_block',null,array('id'=>'opcion_llegada_si_independiente')),
				$form->input('taxi_nombre_hotel',array('label'=>__('nombre_hotel',true))),
				$form->input('taxi_direccion_hotel',array('label'=>__('direccion_hotel',true))),
				$html->para('suitcase',__('hora_entrega_carro',true)),
			'</div>';

			$opcion_al_llegar_check = '$$(".opcion_al_llegar_block").setStyle("display","none"); $("opcion_llegada_"+$("OrderOpcionAlLlegar").get("value")).setStyle("display","block"); $$(".opcion_al_llegar_block input,.opcion_al_llegar_block select").each(function(el){ el.set("disabled","disabled"); }); $("opcion_llegada_"+$("OrderOpcionAlLlegar").get("value")).getElements("input,select").each(function(el){ el.set("disabled",""); });';
			$moo->addEvent('OrderOpcionAlLlegar','click',$opcion_al_llegar_check);
			$moo->buffer($opcion_al_llegar_check);
	
	} else {
		echo
			$form->input('taxi_arribo',array('label'=>__('llegada',true).' '.__('formato_fecha_dmy',true),'class'=>'datepicker','type'=>'text')),
			$form->input('taxi_hora',array('label'=>__('hora_llegada',true),'type'=>'time','timeFormat'=>24)),
			$form->input('taxi_num_vuelo',array('label'=>__('num_vuelo',true))),
			$form->input('taxi_linea_aerea',array('label'=>__('linea_aerea',true)));
	}

echo '</div>';
?>