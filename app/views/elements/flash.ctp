<?php
$pop = empty($pop) ? true : $pop;
if($this->Session->check('Message.flash')){
	echo $this->Session->flash();
	if($pop) $moo->pop();
}
?>