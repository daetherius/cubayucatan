<?php
if($_lang == 'ita'){
	$precio_hab_opcional = 75;
	$numper2precio = array(2=>865,675,653,758);
	$precios_opciones = array(
		'opc_16'=>array(2=>193,134,104,87),
		'opc_15'=>array(2=>71,65,54,48),
		'opc_13'=>array(2=>75,56,75,56),
		'opc_12'=>array(2=>95,69,56,60),
		'opc_11'=>array(2=>95,95,95,95),
		'opc_10'=>array(2=>111,84,70,86),
		'opc_9'=>array(2=>121,94,80,72)
	);
	
} else {
	$precio_hab_opcional = 0;
	$numper2precio = array(2=>1090,850,822,955);
	$precios_opciones = array(
		'opc_16'=>array(2=>243,168,131,109),
		'opc_15'=>array(2=>89,82,68,60),
		'opc_13'=>array(2=>94,70,60,53),
		'opc_12'=>array(2=>119,87,70,75),
		'opc_11'=>array(2=>119,119,119,119),
		'opc_10'=>array(2=>139,105,88,108),
		'opc_9'=>array(2=>150,118,100,90)
	);
}


$conceptos_html = '';
$conceptos = array(
	array('1 '.__('bungalow_doble',true),__('media_pension',true),__('vehiculo_dos_puertas',true)),
	array('1 '.__('bungalow_triple',true),__('media_pension',true),__('vehiculo_cuatro_puertas',true)),
	array('2 '.__('bungalows_dobles',true),__('media_pension',true),__('vehiculo_cuatro_puertas',true)),
	array('1 '.__('bungalow_triple',true).' '.__('y',true).' 1 '.__('bungalow_doble',true),__('media_pension',true),__('vehiculo_offroad',true))
);
$conceptos = array_combine($numper2precio, $conceptos);

foreach ($conceptos as $opcion => $conc) {
	$row = '';
	foreach ($conc as $conc_) $row.= $html->para(null,$conc_);
	$conceptos_html.= $html->div('hide',$row,array('id'=>'opcion_'.$opcion));
}
$conceptos_html = $html->div(null,$conceptos_html,array('id'=>'conceptos_opciones'));

$titulo = $item[$_m[0]]['nombre_'.$_lang];
$subtitulo = '';
if(strpos($titulo,', ')!==false)
	list($titulo,$subtitulo) = explode(', ',$titulo,2);

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_yucatan'),
		$html->tag('h1',$titulo,array('class'=>'title')),
		($subtitulo ? $html->div('title title2 broken',$subtitulo) : ''),
		//$html->para(null,__('nota_antes_reservar',true)),

		$form->create('Order',array('url'=>$this->here,'id'=>'reservar','inputDefaults'=>array('label'=>false))),
			$html->div('basic_info block'),
				$html->para('error todos_obligatorios',__('todos_obligatorios',true)),
				$form->input('nombre',array('label'=>__('nombre',true))),
				$form->input('apellidos',array('label'=>__('apellidos',true))),
				$form->input('email',array('label'=>__('email',true))),
				$form->input('confirma_email',array('label'=>__('confirma_email',true))),
				$form->input('num_personas',array(
					'label'=>__('num_personas',true),
					'options'=>array_combine(
						$numper2precio,
						array(
							'2 ('.strip_tags(__d('precios','EUR 865',true)).' '.__('por_persona',true).')',
							'3 ('.strip_tags(__d('precios','EUR 675',true)).' '.__('por_persona',true).')',
							'4 ('.strip_tags(__d('precios','EUR 653',true)).' '.__('por_persona',true).')',
							'5 ('.strip_tags(__d('precios','EUR 758',true)).' '.__('por_persona',true).')',
						)
					),
				)),
				$html->div('input text',$html->tag('label',__('incluye',true)).$conceptos_html),
			'</div>',
			
			$this->element('yuc_opciones'),

			$html->div('big_total precio',$html->tag('span',__('total',true),'total_label').$html->tag('small',__('EUR',true).'&nbsp;','pad').$html->tag('span','',array('id'=>'big_total'))),
			
			$html->div('arrival_date block'),
				$form->input('arrival',array(
					'class'=>'datepicker',
					'type'=>'text',
					'label'=>__('inicio_ocupacion_bungalow',true),
					'after'=>$html->tag('span',__('fin_ocupacion_bungalow',true).' '.$html->tag('strong','+9').$form->input('retorno',array('div'=>false,'disabled'=>'disabled','type'=>'text')))
				)),
			'</div>',

			//$html->para('suitcase',__('indique_si_desea_hab_opcional',true)),
			$this->element('taxi_opcion',compact('precio_hab_opcional')),

			$html->div('big_total precio',$html->tag('span',__('total',true),'total_label').$html->tag('small',__('EUR',true).'&nbsp;','pad').$html->tag('span','',array('id'=>'big_total_adicional'))),

			$this->element('pago_opcion'),
	'</div>';

	$updateOptionalRooms = '
		var inted = $("OrderNumPersonas").get("value").toInt();
		var numper2precio = $H('.json_encode($numper2precio).');
		var num_personas = numper2precio.keyOf(inted);
		var precios_opciones = '.json_encode($precios_opciones).';

		if(!isNaN(inted)){
			var total_hab = inted * num_personas;
			$$("#conceptos_opciones > div").addClass("hide");
			$("opcion_"+inted).removeClass("hide");
			$$(".precio_opcion").each(function(el){ el.set("html",precios_opciones[el.get("rel")][num_personas]); });
		}

		var hab_opcional = 0;
		if($("OrderOpcionAlLlegar").get("value") == "si")
			hab_opcional = $("OrderTaxiHab").get("value").toInt() * '.$precio_hab_opcional.';

		if(isNaN(hab_opcional)) hab_opcional = 0;

		var total_opciones = 0;
		$$(".yuc_opcion").each(function(el){
			if(el.get("checked")){
				total_opciones+= ((precios_opciones[el.get("rel")][num_personas]).toInt() * num_personas.toInt());
			}
		});

		console.log(total_hab);
		console.log(total_opciones);
		$("big_total").set("html",total_hab + total_opciones);
		$("hab_opcional").set("html",hab_opcional);
		$("big_total_adicional").set("html",total_hab + hab_opcional + total_opciones);
	';
	
	$moo->addEvent('.yuc_opcion','click',$updateOptionalRooms,array('css'=>1));
	$moo->addEvent('OrderOpcionAlLlegar','click',$updateOptionalRooms);
	$moo->addEvent('OrderNumPersonas','click',$updateOptionalRooms);
	$moo->addEvent('OrderTaxiHab','keyup',$updateOptionalRooms);
	//$moo->addEvent('OrderTaxiAdicionales','keyup',$updateOptionalRooms);
	$moo->buffer($updateOptionalRooms);
/*
*/

	$moo->datepicker(array('lang'=>($_lang == 'ita' ? 'it-IT':'es-ES'),'onSelect'=>'function(date){ date.setDate(date.getDate() - 1); var fecha_llegada = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear(); date.setDate(date.getDate() + 10); var fecha_regreso = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear(); $("OrderRetorno").set("value",fecha_regreso);$("OrderTaxiHabArriboFin").set("value",fecha_regreso); $("OrderTaxiHabArriboInicio").set("value",fecha_llegada);  }'));
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>