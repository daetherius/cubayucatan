<?php
$id = $item['Pack']['id'];
$precios = array(1=>array(620,984),2=>array(485,758),3=>array(350,522));

if($id != 4){
	echo
		$html->div('pack_options'),
			$html->div('column'),
				$html->div('title title3',__('primera_opcion',true)),
				$html->para(null,__('pack'.$id.'_opcion1_desc',true)),
				$html->div('clear'),
					$html->para(null,__('precio_total_por_persona',true)),
					$html->para('precio','€'.$precios[$id][0]),
				'</div>',
				$html->link(__('reservar',true),array('controller'=>'packs','action'=>'reservar',$item['Pack']['slug']),array('class'=>'reservar')),
			'</div>',
			$html->div('column'),
				$html->div('title title3',__('segunda_opcion',true)),
				$html->para(null,__('pack'.$id.'_opcion2_desc',true)),
				$html->div('clear'),
					$html->para(null,__('precio_total_por_persona',true)),
					$html->para('precio','€'.$precios[$id][1]),
				'</div>',
				$html->link(__('reservar',true),array('controller'=>'packs','action'=>'reservar',$item['Pack']['slug']),array('class'=>'reservar')),
			'</div>',
		'</div>';

} else {
	echo
		$html->tag('table',null,'pack_options'),
			$html->tableCells(array(
				array(
					__('precio_hab_doble_por_noche',true),
					$html->tag('span','€25','precio'),
					array(__('cena_con_nosotros_o_donde_te_alojes',true),array('colspan'=>2,'rowspan'=>2))
				),
				array(
					__('precio_desayuno_por_persona',true),
					$html->tag('span','€4','precio'),
				),
				array(
					__('precio_taxi_aeropuerto_a_havana',true),
					$html->tag('span','€20','precio'),
					__('precio_cena_por_persona_sin_bebidas',true),
					$html->tag('span','€9,6','precio'),
				)
			)),
		'</table>';

}

?>
