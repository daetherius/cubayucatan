<?php
App::import('Controller','_base/Imgs');
class PackimgsController extends ImgsController{
	var $name = 'Packimgs';
	var $uses = array('Packimg','Pack');
}
?>