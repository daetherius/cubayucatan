<style>
.gcw_main{width:230px;font-family:Trebuchet MS,Tahoma,Verdana,Arial,sans-serif;font-size:11px;border:#A6C9E2 1px solid;text-align:center;color:#000000;background-color:#FCFDFD;margin:0 auto;}
.gcw_header{margin:4px;padding:5px;text-align:center;border:#4297D7 1px solid;background-color:#5C9CCC;}
.gcw_header a{text-decoration:none;color:#FFFFFF;font-size:13px;font-weight:bold;}
.gcw_input{color:#2E6E9E;font-weight:bold;background-color:#FCFDFD;border:#C5DBEC 1px solid;text-align:right;padding:2px 0;margin:1px 0;display:inline;font-size:11px;}
.gcw_select{color:#000;display:inline;}
#gcw_date{font-size:10px;color:#2E6E9E;}
</style>
<?php
echo
	$html->div('gcw_main'),
		$html->div('gcw_header',$html->link('Conversor de divisas','http://www.freecurrencyrates.com/myconverter#cur=EUR-MXN-CUP;amt=EUR1',array('id'=>'ccw_cnhfybwf'))),
		$html->div('','',array('id'=>'gcw_rates')),
		$html->script('http://www.freecurrencyrates.com/converter-widget?width=230&currs=EUR,MXN,CUP&precision=2&language=en&flags=0&currchangable=0',array('inline'=>true)),
	'</div>';
?>