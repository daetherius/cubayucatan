<?php
echo
	$html->div('',null,array('style'=>'padding:15px;border:#CCC solid 1px;margin:0;margin-top:10px;')),
		$html->tag('h1',__($msg[0],true),array('style'=>'font-weight:normal;font-size:24px;margin:0;margin-bottom:18px;color:#444')),
		$html->para(null,__($msg[1],true)),
		$html->para(null,__('detalles_de_su_pago',true)),
		$html->div('',null,array('style'=>'padding:15px;border:#CCC solid 1px;margin:0;margin-top:10px;'));
			/// Detalles del Pago
		echo '</div>',
	'</div>';
?>