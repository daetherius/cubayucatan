<?php
$email = empty($email) ? false : $email;

$fields = array('id','nombre','apellidos','email','forma_pago','amt','status');
$field_labels = array(
	'id'=>'num_orden',
	'hab'=>'num_habitacion_doble',
	'con_cena'=>'cena_incluida',

	'arrival'=>'inicio_ocupacion',
	'retorno'=>'fin_ocupacion',

	'taxi_arribo'=>'llegada',
	'taxi_hora'=>'hora_llegada',
	'taxi_num_vuelo'=>'num_vuelo',
	'taxi_linea_aerea'=>'linea_aerea',

	'havana_arrival'=>'Havana',
	'pinar_del_rio_arrival'=>'Pinar del Río',
	'cienfuegos_arrival'=>'Cienfuegos',
	'trinidad_arrival'=>'Trinidad',
	'santa_clara_arrival'=>'Santa Clara',
	'camaguey_arrival'=>'Camagüey',
	'baracoa_arrival'=>'Baracoa',
	'bayamo_arrival'=>'Bayamo',
	'santiago_de_cuba_arrival'=>'Santiago de Cuba',
	'havana_arrival2'=>'Havana',

	'opcion_al_llegar'=>'concepto_hab_opcional_corto'
);
$value_labels = array(
	'con_cena'=>array(__('no',true),__('si',true)),
	'num_personas'=>array(865=>2,675=>3,653=>4,758=>5),
	'opcion_al_llegar'=>array(
		'no'=>__('no',true),
		'si'=>__('si',true),
		'si_independiente'=>__('no',true)
	),
	'opc_16'=>array(1=>__('comunidad_ek_balam',true)),
	'opc_15'=>array(1=>'Ek Balam - Xcanché'),
	'opc_13'=>array(1=>'Chichen Itzá'),
	'opc_12'=>array(1=>'Izamal'),
	'opc_11'=>array(1=>'Solferino'),
	'opc_10'=>array(1=>'Mérida'),
	'opc_9'=>array(1=>'Coba - Tulúm')
);
$conceptos = array(
	865=>array('1 '.__('bungalow_doble',true),__('vehiculo_dos_puertas',true),__('media_pension',true)),
	675=>array('1 '.__('bungalow_triple',true),__('vehiculo_cuatro_puertas',true),__('media_pension',true)),
	653=>array('2 '.__('bungalow_doble',true),__('vehiculo_cuatro_puertas',true),__('media_pension',true)),
	758=>array('1 '.__('bungalow_triple',true).' '.__('y',true).' 1 '.__('bungalow_doble',true),__('vehiculo_offroad',true),__('media_pension',true))
);
$extras = array(
	'opc_16'=>array(2=>193,134,104,87),
	'opc_15'=>array(2=>71,65,54,48),
	'opc_13'=>array(2=>75,56,75,56),
	'opc_12'=>array(2=>75,56,48,42),
	'opc_11'=>array(2=>95,95,95,95),
	'opc_10'=>array(2=>111,84,70,86),
	'opc_9'=>array(2=>121,94,80,72)
);

switch($data['pack_id']){
	case 1:
	case 2:
	case 3:
		$fields = array_merge($fields,array(
			'hab',
			'opcion',
			'arrival',
			'retorno',
			'taxi_arribo',
			'taxi_hora',
			'taxi_num_vuelo',
			'taxi_linea_aerea'
		));
	break;
	//------------
	case 4:
		$fields = array_merge($fields,array(
			'hab','con_cena',
			'havana_arrival',
			'pinar_del_rio_arrival',
			'cienfuegos_arrival',
			'trinidad_arrival',
			'santa_clara_arrival',
			'camaguey_arrival',
			'baracoa_arrival',
			'bayamo_arrival',
			'santiago_de_cuba_arrival',
			'havana_arrival2',
			'taxi_arribo','taxi_hora','taxi_num_vuelo', 'taxi_linea_aerea'
		));
	break;
	//------------
	case 5:
	case 6:
		$fields = array_merge($fields,array(
			'num_personas','opcion_al_llegar','arrival','retorno',
			'opc_16','opc_15','opc_13','opc_12','opc_11','opc_10','opc_9'
		));
	break;
}
$ul_atts = $li_atts = $h3_atts = $h2_atts = $label_atts = $p_atts = array();
$total_days = 0;
if($email){
	$p_atts = array('style'=>'');
	$label_atts = array('style'=>'');
	$h2_atts = array('style'=>'');
	$h3_atts = array('style'=>'');
	$ul_atts = array('style'=>'');
	$li_atts = array('style'=>'');
}

echo
	$html->tag('h2',__('basico_detalles_titulo',true),$h2_atts);

foreach ($fields as $field_label => $field) {
	/// Field Labels
	if(!is_string($field_label)){
		if(array_key_exists($field, $field_labels))
			$field_label = $field_labels[$field];
		else
			$field_label = $field;
	}

	/// Value Labels
	$value = $data[$field];
	if(array_key_exists($field, $value_labels)){
		$value = $value_labels[$field][$data[$field]];
	}

	if(is_array($value)){
		$sep = ',';
		if(strpos($field, '_arrival')!==false) $sep = '-';
		if(strpos($field, '_hora')!==false){ $sep = ':'; }
		
		$value = implode($sep,$value);

		if(strpos($field, '_hora')!==false){ $value.= ' hrs'; }
	}

	if($field == 'taxi_arribo')
		echo $html->tag('h2',__('taxi_detalles_titulo',true),$h2_atts);

	
	/// Fechas de Llegada
	if(strpos($field,'_arrival') !== false){
		$ciudad = substr($key,0,strpos($key,'_arrival'));

		if($field == 'havana_arrival')
			echo $html->tag('h3',__('fechas_de_ocupacion',true),$h2_atts);

		if(!empty($data[$ciudad.'_days'])){
			$total_days+= $data[$ciudad.'_days'];
			echo
				$html->para(null,null,$p_atts),
					$html->tag('span',__($field_label,true).':',$label_atts),
					$html->tag('span',date('d-m-Y',strtotime($value)).' al '.date('d-m-Y',strtotime($value.' +'.((int)$data[$ciudad.'_days']).' days')).' ('.$data[$ciudad.'_days'].' '.__('dias',true).')'),
				'</p>';
		}

		if($field == 'havana_arrival2')
			echo $html->para(null,$html->tag('span',__('numero_total_de_dias',true).':',$label_atts).$html->tag('span',$total_days),$p_atts);

	/// Opciones Yucatan
	} elseif(strpos($field, 'opc_') === 0){
		if($field == 'opc_16')
			echo
				$html->tag('h3',__('opciones',true),$h3_atts),
				$html->tag('ul',null,$ul_atts);

		if($data[$field]){
			$num_personas = $value_labels['num_personas'][$data['num_personas']];
			echo $html->tag('li',$html->tag('span',__($value,true).' (+€'.($extras[$field][$num_personas] * $num_personas).')'),$li_atts);
		}

		if($field == 'opc_9') echo '</ul>';

	/// Otros
	} else {
		$extra = '';
		if($field == 'num_personas')
			$extra = ' (€'.$data['num_personas'].' '.__('por_persona',true).')';

		//-------------------------------
		echo $html->para(null,$html->tag('span',__($field_label,true).':',$label_atts).$html->tag('span',$value.$extra),$p_atts);
		//-------------------------------
		
		if($field == 'num_personas')
			echo $html->para(null,$html->tag('span',__('include',true).':',$label_atts).$html->tag('span',implode(', ',$conceptos[$data['num_personas']]).'.'),$p_atts);

		if($field == 'opcion_al_llegar'){
			switch ($data[$field]) {
				case 'no':
					if(is_array($data['taxi_hora']))
						$data['taxi_hora'] = implode(':',$data['taxi_hora']).' hrs.';
					echo
						$html->tag('h2',__('taxi_detalles_titulo',true),$h2_atts),
						$html->para(null,$html->tag('span',__('llegada',true).':',$label_atts).$html->tag('span',$data['taxi_arribo']),$p_atts),
						$html->para(null,$html->tag('span',__('hora_llegada',true).':',$label_atts).$html->tag('span',$data['taxi_hora']),$p_atts),
						$html->para(null,$html->tag('span',__('num_vuelo',true).':',$label_atts).$html->tag('span',$data['taxi_num_vuelo']),$p_atts),
						$html->para(null,$html->tag('span',__('linea_aerea',true).':',$label_atts).$html->tag('span',$data['taxi_linea_aerea']),$p_atts);
				break;
				case 'si':
					echo
						$html->para(null,$html->tag('span',__('num_habitacion_doble',true).':',$label_atts).$html->tag('span',$data['taxi_hab']),$p_atts),
						$html->para(null,$html->tag('span',__('inicio_ocupacion_opcional',true).':',$label_atts).$html->tag('span',date('d-m-Y',strtotime($data['arrival'].' -1 days'))),$p_atts),
						$html->para(null,$html->tag('span',__('fin_ocupacion_opcional',true).':',$label_atts).$html->tag('span',date('d-m-Y',strtotime($data['arrival'].' +9 days'))),$p_atts);
				break;
				case 'si_independiente':
					echo
						$html->para(null,$html->tag('span',__('nombre_hotel',true).':',$label_atts).$html->tag('span',$data['taxi_nombre_hotel']),$p_atts),
						$html->para(null,$html->tag('span',__('direccion_hotel',true).':',$label_atts).$html->tag('span',$data['taxi_direccion_hotel']),$p_atts);
				break;
			}
		}
	}

	if($field == 'status')
		echo $html->tag('h2',__('viaje_detalles_titulo',true),$h2_atts);
}
?>