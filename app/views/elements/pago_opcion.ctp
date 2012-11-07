<?php
echo
	$form->input('forma_pago',array(
		'options'=>array(
			'deposito'=>__('deposito_bancario',true),
			// 'pago_online'=>__('pago_online',true),
			// 'paypal'=>'Pay pal'
		),
		'label'=>__('forma_pago',true),
		'div'=>'forma_pago'
	)),
	$html->div('voucher_note'),
		$html->div('title title4',__('voucher',true)),
		$html->para(null,__('voucher_note',true)),
	'</div>',
	$form->end(__('enviar',true));
?>