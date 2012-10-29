<?php
$opciones = array(
	865=>array('1 '.__('bungalow_doble',true),__('vehiculo_dos_puertas',true)),
	675=>array('1 '.__('bungalow_triple',true),__('vehiculo_cuatro_puertas',true)),
	653=>array('2 '.__('bungalow_doble',true),__('vehiculo_cuatro_puertas',true)),
	758=>array('1 '.__('bungalow_triple').' '.__('y',true).' 1 '.__('bungalow_doble',true),__('vehiculo_offroad',true))
);

$titulo = $item[$_m[0]]['nombre_'.$_lang];
$subtitulo = '';
if(strpos($titulo,', ')!==false)
	list($titulo,$subtitulo) = explode(', ',$titulo,2);

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_yucatan'),
		$html->tag('h1',$titulo,array('class'=>'title')),
		($subtitulo ? $html->div('title title2 broken',$subtitulo) : ''),
		$html->tag('h2','La Havana, Trinidad, Camagüey, Baracoa, Santiago, La Havana','title red'),
		//$html->para(null,__('nota_antes_reservar',true)),

		$form->create('Reservation',array('url'=>$this->here,'id'=>'reservar','inputDefaults'=>array('label'=>false))),
			$html->div('basic_info block'),
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
				$html->tag('label','').$html->div('conceptos','Conceptos'),
			'</div>',
			
			$html->div('big_total precio',$html->tag('span',__('total',true),'total_label').$html->tag('span',' €','pad').$html->tag('span','',array('id'=>'big_total'))),
			
			$html->div('arrival_date block'),
				$form->input('arrival',array(
					'class'=>'datepicker',
					'label'=>__('llegada',true),
					'after'=>$html->tag('span',__('fecha_termino',true).' '.$html->tag('strong','+9').$form->input('retorno',array('div'=>false,'disabled'=>'disabled')))
				)),
			'</div>',

			$html->para('suitcase',__('indique_si_desea_taxi',true)),
			$this->element('taxi_opcion'),
			$this->element('pago_opcion'),
	'</div>';

	$updateRoomTotal = 'var inted = $("ReservationHabDoble").get("value").toInt(); if(!isNaN(inted)){ $("num_personas").set("html",inted * 2); $("total_hab").set("html",inted * $("ReservationOpcion").get("value")); $("big_total").set("html",inted * $("ReservationOpcion").get("value")); } ';

	$moo->addEvent('ReservationHabDoble','keyup',$updateRoomTotal);
	$moo->buffer($updateRoomTotal);
	
	$lang = $_lang == 'ita' ? 'it-IT':'es-ES';
	$moo->datepicker(array('lang'=>$lang,'onSelect'=>'function(date){ date.setDate(date.getDate() + 9); $("ReservationRetorno").set("value",date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear()); }'));
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>