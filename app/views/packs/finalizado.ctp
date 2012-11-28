<?php
if(empty($cart_flash)) $cart_flash = __('payment_interrupted',true);
$cart_flash = (array)$cart_flash;
$isError = empty($isError) ? false : $isError;

echo
	$this->element('top',array('header'=>__('info_de_su_pago',true)));

	if($isError)
		echo $html->para('cancelled_msg',__('payment_failed',true).' '.__('info_errores',true));

	foreach($cart_flash as $fl){
		echo $html->para($isError ? 'warning':'win',$fl);
	}
	
	echo $html->para('buy_exit',$html->link(__('clic_aqui_link',true),array('controller'=>'packs','action'=>'index')).' '.__('clic_aqui_txt',true));
?>
</div>
</div><!-- .content -->
<?php echo $this->element('sidebar'); ?>