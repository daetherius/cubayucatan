<?php
$id = $item['Pack']['id'];
$precios = array(
	'ita'=>array(1=>array(620,984),2=>array(485,758),3=>array(340,522)),
	'esp'=>array(1=>array(781,1240),2=>array(611,955),3=>array(428,657))
);
$precios_personalizado = array(
	'ita'=>array('hab'=>38,'taxi'=>20,'cena'=>'9,6'),
	'esp'=>array('hab'=>48,'taxi'=>'25.2','cena'=>'12.10')
);

if($id != 4){
	echo
		$html->div('pack_options'),
			$html->div('column'),
				$html->div('title title3',__('primera_opcion',true)),
				$html->para(null,__('pack'.$id.'_opcion1_desc',true)),
				$html->div('clear'),
					$html->para(null,__('precio_total_por_persona',true)),
					$html->para('precio',$html->tag('small',__('EUR',true).'&nbsp;').$precios[$_lang][$id][0]),
				'</div>',
				$html->link(__('reservar',true),array('controller'=>'packs','action'=>'reservar',$item['Pack']['slug'],$precios[$_lang][$id][0]),array('class'=>'reservar')),
			'</div>',
			$html->div('column'),
				$html->div('title title3',__('segunda_opcion',true)),
				$html->para(null,__('pack'.$id.'_opcion2_desc',true)),
				$html->div('clear'),
					$html->para(null,__('precio_total_por_persona',true).'<br/>*'.__('bebidas_no_incluidas',true)),
					$html->para('precio',$html->tag('small',__('EUR',true).'&nbsp;').$precios[$_lang][$id][1]),
				'</div>',
				$html->link(__('reservar',true),array('controller'=>'packs','action'=>'reservar',$item['Pack']['slug'],$precios[$_lang][$id][1]),array('class'=>'reservar')),
			'</div>',
		'</div>';

} else {
	echo
		$html->div('pack_options unicolumn'),
		$html->tag('table'),
			$html->tableCells(array(
				array(
					__('precio_hab_doble_por_noche_con_desayuno',true),
					$html->tag('span',$html->tag('small',__('EUR',true).'&nbsp;').$precios_personalizado[$_lang]['hab'],'precio'),
					array($html->tag('span',__('opcional2',true),'title'),array('colspan'=>2,'class'=>'bottomt'))
				),
				array(
					__('precio_taxi_aeropuerto_a_havana',true),
					$html->tag('span',$html->tag('small',__('EUR',true).'&nbsp;').$precios_personalizado[$_lang]['taxi'],'precio'),
					__('precio_cena_por_persona_sin_bebidas',true),
					$html->tag('span',$html->tag('small',__('EUR',true).'&nbsp;').$precios_personalizado[$_lang]['cena'],'precio'),
				)
			)),
		'</table>',
		$html->link(__('reservar',true),array('controller'=>'packs','action'=>'reservar',$item[$_m[0]]['slug']),array('class'=>'reservar')),
	'</div>';

}

?>
