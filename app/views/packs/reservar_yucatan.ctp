<?php
$conceptos_html = '';
$conceptos = array(
	865=>array('1 '.__('bungalow_doble',true),__('media_pension',true),__('vehiculo_dos_puertas',true)),
	675=>array('1 '.__('bungalow_triple',true),__('media_pension',true),__('vehiculo_cuatro_puertas',true)),
	653=>array('2 '.__('bungalow_doble',true),__('media_pension',true),__('vehiculo_cuatro_puertas',true)),
	758=>array('1 '.__('bungalow_triple',true).' '.__('y',true).' 1 '.__('bungalow_doble',true),__('media_pension',true),__('vehiculo_offroad',true))
);
$precio_hab_opcional = 75;

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
					'options'=>array(
						865=>'2 (€865 '.__('por_persona',true).')',
						675=>'3 (€675 '.__('por_persona',true).')',
						653=>'4 (€653 '.__('por_persona',true).')',
						758=>'5 (€758 '.__('por_persona',true).')',
					),
				)),
				$html->div('input text',$html->tag('label',__('incluye',true)).$conceptos_html),
			'</div>',
			
			$this->element('yuc_opciones'),

			$html->div('big_total precio',$html->tag('span',__('total',true),'total_label').$html->tag('span',' €','pad').$html->tag('span','',array('id'=>'big_total'))),
			
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

			$html->div('big_total precio',$html->tag('span',__('total',true),'total_label').$html->tag('span',' €','pad').$html->tag('span','',array('id'=>'big_total_adicional'))),

			$this->element('pago_opcion'),
	'</div>';

	$updateOptionalRooms = '
		var inted = $("OrderNumPersonas").get("value").toInt();
		var numper2precio = $H({2:865,3:675,4:653,5:758});
		var totales = {865:1730,675:2025,653:2612,758:3790};
		var precios_opciones = {
			opc_16:{2:193,3:134,4:104,5:87},
			opc_15:{2:71,3:65,4:54,5:48},
			opc_13:{2:75,3:56,4:75,5:56},
			opc_12:{2:75,3:56,4:48,5:42},
			opc_11:{2:95,3:95,4:95,5:95},
			opc_10:{2:111,3:84,4:70,5:86},
			opc_9:{2:121,3:94,4:80,5:72}
		};

		if(!isNaN(inted)){
			var total_hab = totales[inted];
			$$("#conceptos_opciones > div").addClass("hide");
			$("opcion_"+inted).removeClass("hide");
			$$(".precio_opcion").each(function(el){ el.set("html",precios_opciones[el.get("rel")][numper2precio.keyOf(inted)]); });
		}

		var hab_opcional = 0;
		if($("OrderOpcionAlLlegar").get("value") == "si")
			hab_opcional = $("OrderTaxiHab").get("value").toInt() *'.$precio_hab_opcional.';

		if(isNaN(hab_opcional)) hab_opcional = 0;

		var total_opciones = 0;
		$$(".yuc_opcion").each(function(el){
			console.log(el.get("checked"));
			console.log(el.checked);
			if(el.get("checked")){
				console.log((precios_opciones[el.get("rel")][numper2precio.keyOf(inted)]).toInt());
				total_opciones+= ((precios_opciones[el.get("rel")][numper2precio.keyOf(inted)]).toInt() * numper2precio.keyOf(inted).toInt());
			}
		});


		$("big_total").set("html",totales[inted]+total_opciones);
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