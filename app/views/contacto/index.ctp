<?php
echo
	$this->element('top'),
	$html->div('clear'),
		$html->div('title title2 note',__('ponte_contacto',true)),
		$html->div('form'),
			//$html->para('note',''),
	
			$form->create('Contact',array('id'=>'ContactForm','url'=>'/contacto/enviar')),
			$form->input('mail',array('div'=>'hide')),
			$html->div('subform'),
				$this->element('inputs',array(
					'formtag'=>false,
					'end'=>__('enviar',true),
					'after'=>$this->Captcha->input().$html->para('leydatos',__('sus_datos',true).' '.$html->link(__('ley_datos',true),'http://dof.gob.mx/nota_detalle.php?codigo=5150631&fecha=05/07/2010',array('target'=>'_blank','rel'=>'nofollow'))),
					'schema'=>array(
						'nombre'=>array('label'=>__('nombre',true)),
						'email'=>array('label'=>__('email',true)),
						'empresa'=>'skip',
						'mensaje'=>array('label'=>__('mensaje',true)),
					)
				)),
			'</div>',
		'</div>',
	'</div>',

	$moo->ajaxform('ContactForm');
?>
</div>
</div>
<?php echo $this->element('sidebar'); ?>