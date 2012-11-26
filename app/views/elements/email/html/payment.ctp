<?php
echo
	$html->div('',null,array('style'=>'padding:15px;border:#CCC solid 1px;margin:0;margin-top:10px;')),
		$html->tag('h1',__($msg[0],true),array('style'=>'font-weight:normal;font-size:24px;margin:0;margin-bottom:18px;color:#444')),
		$html->para(null,__($msg[1],true)),
		$html->para(null,__('info_reservacion',true)),
		$html->div('',null,array('style'=>'padding:15px;border:#CCC solid 1px;margin:0;margin-top:10px;'));
		
		if($failure){
			echo $html->para(null,'FAILURE:');
			$i = 0;
			do {
				echo $html->para(null,$pay_details['L_ERRORCODE'.$i].': '.urldecode($pay_details['L_LONGMESSAGE'.$i]));
				$i++;
			} while(!empty($pay_details['L_ERRORCODE'.$i]));
		} else {
			/*
			if(!empty($pay_details)){
				foreach ($pay_details as $key => $value) {
					echo $html->para(null,$key.':'.urldecode($value));
				}
			}
			*/
			echo $this->element('order_detail',array('data'=>$pay_details['Order'],'email'=>true));
		}

		echo '</div>',
	'</div>';
?>