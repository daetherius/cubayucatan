<?php
echo
	$form->input('forma_pago',array(
		'options'=>array(
			'deposito'=>__('deposito_bancario',true),
			'pago_online'=>__('pago_online',true),
			'paypal'=>'Pay pal'
		),
		'label'=>__('forma_pago',true),
		'div'=>'forma_pago'
	)),
	$html->para('voucher_note',__('voucher_note',true)),
	$form->end(__('enviar',true));
?>