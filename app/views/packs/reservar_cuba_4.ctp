<?php
$hab_doble = 25;

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_cuba'),
		$html->tag('h1',$item[$_m[0]]['nombre_'.$_lang],array('class'=>'title')),
		$html->tag('h2','Pinar del Río, La Havana, Cienfuegos, Trinidad, Santa Clara, Camaguey, Bayamo, Baracoa, Santiago'),
		$html->para(null,__('nota_antes_reservar',true)),

		$form->create('Reservation',array('url'=>$this->here,'id'=>'reservar')),
			$html->div('basic_info'),
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

			$html->div('custom_dates'),
			'</div>',
		$form->end(__('enviar',true)),
	'</div>';

	$validInt = 'var inted = $("ReservationHabDoble").get("value").toInt(); if(!isNaN(inted)) ';
	$updatePeopleQty = $validInt.'$("num_personas").set("html",inted * 2);';
	$updateRoomTotal = $validInt.'$("total_hab").set("html",inted *'.$hab_doble.');';

	$moo->addEvent('ReservationHabDoble','keyup',$updateRoomTotal.$updatePeopleQty);
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>