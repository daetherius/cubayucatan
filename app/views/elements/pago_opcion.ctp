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
	$html->div('datos_bancarios'),
		$html->tag('table'),
		$html->tableCells(array(
			array(array('Dati Bancari',array('colspan'=>2))),
			array(__('titular',true).':','Umberto Fioroni'),
			array(__('banco',true).':','Scotiabank'),
			array(__('sucursal',true).':','001, Plaza 170, Mérida, Yucatán, México.'),
			array(__('cuenta',true).':','17001027751'),
			array('Swift:','MBCOMXMM'),
		)),
		'</table>',
	'</div>',
	$html->div('voucher_note'),
		$html->div('title title4',__('voucher',true)),
		$html->para(null,__('voucher_note',true).($item['Pack']['id'] > 4  ? ', '.__('entrega_voucher_carro',true):'').'.'),
	'</div>',
	$form->end(__('enviar',true));
?>