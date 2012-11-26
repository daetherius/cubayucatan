<?php
App::import('Controller','_base/Items');
class OrdersController extends ItemsController{
	var $name = 'Orders';
	var $uses = array('Order','Pack','Destination');

	function admin_ver($id){
		$id = $this->_checkid($id);
		$item = $this->Order->find_(array($id,'contain'=>false));
		$this->set(compact('item'));
	}
}
?>