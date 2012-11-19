<?php
echo
	$form->input('forma_pago',array(
		'options'=>array(
			'deposito'=>__('deposito_bancario',true),
			'online'=>__('pago_online',true).' / Paypal'
		),
		'label'=>__('forma_pago',true),
		'div'=>'forma_pago'
	)),
	$html->div('voucher_note'),
		$html->div('title title4',__('voucher',true)),
		$html->para(null,__('voucher_note',true).($item['Pack']['id'] > 4  ? ', '.__('entrega_voucher_carro',true):'').'.'),
	'</div>',
	$form->end(__('enviar',true));
?>