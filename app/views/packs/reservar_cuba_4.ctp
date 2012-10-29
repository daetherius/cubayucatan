<?php
$precio_hab = 25;
$precio_desayuno = 4;
$precio_cena = 9.6;

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_cuba'),
		$html->tag('h1',$item[$_m[0]]['nombre_'.$_lang],array('class'=>'title')),
		$html->tag('h2','Pinar del Río, La Havana, Cienfuegos, Trinidad, Santa Clara, Camaguey, Bayamo, Baracoa, Santiago','title red'),
		$html->para(null,__('nota_antes_reservar',true)),

		$form->create('Reservation',array('url'=>$this->here,'id'=>'reservar','inputDefaults'=>array('label'=>false))),
			$html->div('basic_info block'),
				$form->input('nombre',array('label'=>__('nombre',true))),
				$form->input('apellidos',array('label'=>__('apellidos',true))),
				$form->input('email',array('label'=>__('email',true))),
				$form->input('confirma_email',array('label'=>__('confirma_email',true))),
				$form->input('hab_doble',array(
					'label'=>__('num_habitacion_doble',true),
					'maxlength'=>3,
					'value'=>1,
					'after'=>$html->tag('span','x '.$html->tag('span','€'.$html->tag('span','',array('id'=>'total_hab')),'precio').$html->tag('span','('.$html->tag('span','2',array('id'=>'num_personas')).' personas)','pad'),'pad')
				)),
			'</div>',

			$html->div('custom_dates block'),
				$html->div('title title3 red',__('arma_tu_plan',true)),
				$html->para('',__('fechas_de_ocupacion',true)),
				$html->tag('table'),
					$html->tableHeaders(array('',__('fecha_arribo',true).' '.__('formato_fecha_dmy',true),__('dias_estancia',true))),
					$html->tableCells(array(
						array($html->tag('span','Havana ('.__('llegada',true).')'),	$form->input('havana.arrival',array('class'=>'datepicker')),			array($form->input('havana.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Pinar del Río'),					$form->input('pinar_del_rio.arrival',array('class'=>'datepicker')),		array($form->input('pinar_del_rio.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Cienfuegos'),						$form->input('cienfuegos.arrival',array('class'=>'datepicker')),		array($form->input('cienfuegos.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Trinidad'),						$form->input('trinidad.arrival',array('class'=>'datepicker')),			array($form->input('trinidad.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Santa Clara'),						$form->input('santa_clara.arrival',array('class'=>'datepicker')),		array($form->input('santa_clara.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Camagüey'),						$form->input('camaguey.arrival',array('class'=>'datepicker')),			array($form->input('camaguey.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Baracoa'),							$form->input('baracoa.arrival',array('class'=>'datepicker')),			array($form->input('baracoa.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Bayamo'),							$form->input('bayamo.arrival',array('class'=>'datepicker')),			array($form->input('bayamo.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Santiago de Cuba'),				$form->input('santiago_de_cuba.arrival',array('class'=>'datepicker')),	array($form->input('santiago_de_cuba.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Havana ('.__('retorno',true).')'),	$form->input('havana.arrival',array('class'=>'datepicker')),			array($form->input('havana.days',array('maxlength'=>3,'value'=>1,'class'=>'days_input')),array('class'=>'days'))),
					)),
				'</table>',
				$html->tag('table'),
					$html->tableCells(array(
						array($html->tag('span',__('numero_total_de_dias',true)),	array($html->tag('span','',array('class'=>'total_days')).' x €'.$precio_hab.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'costo_total_hab')),'precio'),array('colspan'=>2,'class'=>'subtotales'))),
						array($html->tag('span',__('desayuno',true)),				array($html->tag('span','',array('class'=>'total_days')).' x 2 x €'.$precio_desayuno.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'costo_total_desayuno','class'=>'precio')),'precio'),array('colspan'=>2,'class'=>'subtotales'))),
						
						array($form->input('con_cena',array('type'=>'checkbox','div'=>array('tag'=>'span'))).$html->tag('span',__('cena',true),'pad'), array($html->tag('span','',array('class'=>'total_days')).' x 2 x €'.(number_format($precio_cena,1,',','.')).' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'costo_total_cena','class'=>'precio')),'precio'),array('colspan'=>2,'class'=>'subtotales'))),
					)),
				'</table>',
				$html->div('big_total precio',$html->tag('span',__('total',true),'total_label').$html->tag('span',' €','pad').$html->tag('span','',array('id'=>'big_total'))),
			'</div>',

			$html->para('suitcase',__('indique_si_desea_taxi',true)),
			$this->element('taxi_opcion'),
			$this->element('pago_opcion'),
	'</div>';

	$updateRoomTotal = 'var inted = $("ReservationHabDoble").get("value").toInt(); if(!isNaN(inted)){ $("num_personas").set("html",inted * 2); $("total_hab").set("html",inted *'.$precio_hab.'); } ';

	$moo->addEvent('ReservationHabDoble','keyup',$updateRoomTotal);
	$moo->buffer($updateRoomTotal);
	
	$updateSubtotal = 'var total_number_days = 0; $$(".days_input").each(function(el){ var inted = el.value.toInt(); if(!isNaN(inted)) total_number_days = total_number_days + inted; }); $$(".total_days").each(function(el){ el.set("html",total_number_days); });';
	$updateSubtotal.= 'var costo_total_hab = total_number_days * '.$precio_hab.'; $("costo_total_hab").set("html",costo_total_hab);';
	$updateSubtotal.= 'var costo_total_desayuno = total_number_days * '.$precio_desayuno.'; $("costo_total_desayuno").set("html",costo_total_desayuno);';
	$updateSubtotal.= 'var costo_total_cena = $("ReservationConCena").checked ? total_number_days * '.$precio_cena.' : 0; $("costo_total_cena").set("html",costo_total_cena);';
	$updateSubtotal.= 'var big_total = costo_total_hab + costo_total_desayuno + costo_total_cena; $("big_total").set("html",big_total);';
	
	$moo->addEvent('.days_input','keyup',$updateSubtotal,array('css'=>1));
	$moo->addEvent('ReservationConCena','click',$updateSubtotal);
	$moo->buffer($updateSubtotal);

	$lang = $_lang == 'ita' ? 'it-IT':'es-ES';
	$moo->datepicker(compact('lang'));
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>