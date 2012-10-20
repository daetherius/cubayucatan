<?php
App::import('Controller','_base/Imgs');
class DestinationimgsController extends ImgsController{
	var $name = 'Destinationimgs';
	var $uses = array('Destinationimg','Destination');
}
?>