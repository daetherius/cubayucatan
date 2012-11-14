<?php
$precio_opcion1 = 620;
$precio_opcion2 = 984;

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_cuba'),
		$html->tag('h1',$item[$_m[0]]['nombre_'.$_lang],array('class'=>'title')),
		$html->tag('h2','La Havana, Trinidad, Camagüey, Baracoa, Santiago, La Havana','title red'),
		$html->para(null,__('nota_antes_reservar',true)),

		$form->create('Order',array('url'=>$this->here,'id'=>'reservar','inputDefaults'=>array('label'=>false))),
			$html->div('basic_info block'),
				$form->input('opcion',array(
					'label'=>__('opcion',true),
					'selected'=>$opcion,
					'options'=>array(
						$precio_opcion1 => __('primera_opcion',true).' €'.$precio_opcion1,
						$precio_opcion2 => __('segunda_opcion',true).' €'.$precio_opcion2
					)
				)),
				$form->input('nombre',array('label'=>__('nombre',true))),
				$form->input('apellidos',array('label'=>__('apellidos',true))),
				$form->input('email',array('label'=>__('email',true))),
				$form->input('confirma_email',array('label'=>__('confirma_email',true))),
				$form->input('hab',array(
					'label'=>__('num_habitacion_doble',true),
					'maxlength'=>3,
					'value'=>1,
					'after'=>$html->tag('span','x '.$html->tag('span','€'.$html->tag('span','',array('id'=>'total_hab')),'precio').$html->tag('span','('.$html->tag('span','2',array('id'=>'num_personas')).' '.__('personas',true).')','pad'),'pad')
				)),
			'</div>',
			
			$html->div('big_total precio',$html->tag('span',__('total',true),'total_label').$html->tag('span',' €','pad').$html->tag('span','',array('id'=>'big_total'))),
			
			$html->div('arrival_date block'),
				$form->input('arrival',array(
					'class'=>'datepicker',
					'type'=>'text',
					'label'=>__('inicio_ocupacion',true),
					'after'=>$html->tag('span',__('fin_ocupacion',true).' '.$html->tag('strong','+9').$form->input('retorno',array('div'=>false,'type'=>'text','disabled'=>'disabled')))
				)),
			'</div>',

			$html->para('suitcase',__('indique_si_desea_taxi',true)),
			$this->element('taxi_opcion'),
			$this->element('pago_opcion'),
	'</div>';

	$updateRoomTotal = 'var inted = $("OrderHab").get("value").toInt(); if(!isNaN(inted)){ $("num_personas").set("html",inted * 2); $("total_hab").set("html",inted * $("OrderOpcion").get("value")); $("big_total").set("html",inted * $("OrderOpcion").get("value")); } ';

	$moo->addEvent('OrderHab','keyup',$updateRoomTotal);
	$moo->addEvent('OrderOpcion','click',$updateRoomTotal);
	$moo->buffer($updateRoomTotal);
	
	$lang = $_lang == 'ita' ? 'it-IT':'es-ES';
	$moo->datepicker(array('lang'=>$lang,'onSelect'=>'function(date){ date.setDate(date.getDate() + 9); $("OrderRetorno").set("value",date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()); }'));
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>