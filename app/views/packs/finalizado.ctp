<?php
if(empty($cart_flash)) $cart_flash = __('payment_interrupted',true);
$cart_flash = (array)$cart_flash;
$isError = empty($isError) ? false : $isError;

echo
	$this->element('top',array('header'=>__('info_de_su_pago',true)));

	if($isError)
		echo $html->para('cancelled_msg',__('payment_problems',true));

	foreach($cart_flash as $fl){
		echo $html->para($isError ? 'warning':'win',$fl);
	}
	
	echo $html->para('buy_exit','Haga '.$html->link('click aquí',array('controller'=>'packs','action'=>'index')).' para regresar a la página de Inicio.');
?>
</div>
</div><!-- .content -->
<?php echo $this->element('sidebar'); ?>