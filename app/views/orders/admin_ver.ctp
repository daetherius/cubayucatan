<?php
echo
	$this->element('adminhdr',array('links'=>array('back'))),
	$this->element('order_detail',array('data'=>$item['Order']));
?>