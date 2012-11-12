<?php
$precio_hab = 25;
$precio_desayuno = 4;
$precio_cena = 9.6;

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_cuba'),
		$html->tag('h1',$item[$_m[0]]['nombre_'.$_lang],array('class'=>'title')),
		$html->tag('h2','La Havana, Pinar del Río, Cienfuegos, Trinidad, Santa Clara, Camaguey, Bayamo, Baracoa, Santiago','title red'),
		$html->para(null,__('nota_antes_reservar',true)),

		$form->create('Order',array('url'=>$this->here,'id'=>'reservar','inputDefaults'=>array('label'=>false))),
			$html->div('basic_info block'),
				$form->input('id',array('value'=>4)),
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

			$html->div('custom_dates block'),
				$html->div('title title3 red',__('arma_tu_plan',true)),
				$html->para('',__('fechas_de_ocupacion',true)),
				$html->tag('table'),
					$html->tableHeaders(array('',__('llegada',true).' '.__('formato_fecha_dmy',true),__('dias_estancia',true))),
					$html->tableCells(array(
						array($html->tag('span','Havana ('.__('inicio',true).')'),	$form->input('havana_arrival',array('class'=>'datepicker','type'=>'text')),			array($form->input('havana_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Pinar del Río'),					$form->input('pinar_del_rio_arrival',array('class'=>'datepicker','type'=>'text')),		array($form->input('pinar_del_rio_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Cienfuegos'),						$form->input('cienfuegos_arrival',array('class'=>'datepicker','type'=>'text')),		array($form->input('cienfuegos_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Trinidad'),						$form->input('trinidad_arrival',array('class'=>'datepicker','type'=>'text')),			array($form->input('trinidad_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Santa Clara'),						$form->input('santa_clara_arrival',array('class'=>'datepicker','type'=>'text')),		array($form->input('santa_clara_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Camagüey'),						$form->input('camaguey_arrival',array('class'=>'datepicker','type'=>'text')),			array($form->input('camaguey_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Baracoa'),							$form->input('baracoa_arrival',array('class'=>'datepicker','type'=>'text')),			array($form->input('baracoa_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Bayamo'),							$form->input('bayamo_arrival',array('class'=>'datepicker','type'=>'text')),			array($form->input('bayamo_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Santiago de Cuba'),				$form->input('santiago_de_cuba_arrival',array('class'=>'datepicker','type'=>'text')),	array($form->input('santiago_de_cuba_days',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
						array($html->tag('span','Havana ('.__('retorno',true).')'),	$form->input('havana_arrival2',array('class'=>'datepicker','type'=>'text')),			array($form->input('havana_days2',array('maxlength'=>3,'value'=>0,'class'=>'days_input')),array('class'=>'days'))),
					)),
				'</table>',
				$html->tag('table'),
					$html->tableCells(array(
						array($html->tag('span',__('estancia',true)),				array($html->tag('span','',array('class'=>'total_days')).' '.__('dias',true).' '.$html->tag('span','','num_hab').' '.__('num_hab',true).' x €'.$precio_hab.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'costo_total_hab')),'precio'),array('colspan'=>2,'class'=>'subtotales'))),
						array($html->tag('span',__('desayuno',true)),				array($html->tag('span','',array('class'=>'total_days')).' '.__('dias',true).' '.$html->tag('span','','num_hab').' '.__('num_hab',true).' x 2 '.__('personas',true).' x €'.$precio_desayuno.' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'costo_total_desayuno','class'=>'precio')),'precio'),array('colspan'=>2,'class'=>'subtotales'))),
						
						array($form->input('con_cena',array('type'=>'checkbox','div'=>array('tag'=>'span'))).$html->tag('span',__('cena',true).' ('.__('opcional',true).')','pad'), array($html->tag('span','',array('class'=>'total_days')).' '.__('dias',true).' '.$html->tag('span','','num_hab').' '.__('num_hab',true).' x 2 '.__('personas',true).' x €'.(number_format($precio_cena,1,',','.')).' = '.$html->tag('span','€'.$html->tag('span','',array('id'=>'costo_total_cena','class'=>'precio')),'precio'),array('colspan'=>2,'class'=>'subtotales'))),
					)),
				'</table>',
				//$html->div('big_total precio',$html->tag('span',__('subtotal',true),'total_label').),
				$html->div('big_total precio multiple'),
					$html->tag('span',__('total',true),'total_label pad'),
					$html->tag('span',' €','pad precio'),
					$html->tag('span','',array('id'=>'big_total','class'=>'precio')),
				'</div>',
			'</div>',

			$html->para('suitcase',__('indique_si_desea_taxi',true)),
			$this->element('taxi_opcion'),
			$this->element('pago_opcion'),
	'</div>';

	$updateSubtotal = 'var inted = $("OrderHab").get("value").toInt(); if(!isNaN(inted)){ $("num_personas").set("html",inted * 2); $("total_hab").set("html",inted *'.$precio_hab.');$$(".num_hab").set("html",inted); } ';
	$updateSubtotal.= 'var total_number_days = 0; $$(".days_input").each(function(el){ var inted = el.value.toInt(); if(!isNaN(inted)) total_number_days = total_number_days + inted; }); $$(".total_days").each(function(el){ el.set("html",total_number_days); });';
	$updateSubtotal.= 'var costo_total_hab = total_number_days * '.$precio_hab.' * inted; $("costo_total_hab").set("html",costo_total_hab);';
	$updateSubtotal.= 'var costo_total_desayuno = total_number_days * 2 * '.$precio_desayuno.' * inted; $("costo_total_desayuno").set("html",costo_total_desayuno);';
	$updateSubtotal.= 'var costo_total_cena = $("OrderConCena").checked ? total_number_days * 2 * '.$precio_cena.' * inted : 0; $("costo_total_cena").set("html",costo_total_cena.toFixed(2));';
	$updateSubtotal.= 'var big_total = costo_total_hab + costo_total_desayuno + costo_total_cena; $("big_total").set("html",big_total.toFixed(2));';
	
	$moo->addEvent('OrderHab','keyup',$updateSubtotal);
	$moo->addEvent('.days_input','keyup',$updateSubtotal,array('css'=>1));
	$moo->addEvent('OrderConCena','click',$updateSubtotal);
	$moo->buffer($updateSubtotal);

	$lang = $_lang == 'ita' ? 'it-IT':'es-ES';
	$moo->datepicker(compact('lang'));
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>