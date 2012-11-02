<?php
App::import('Controller','_base/Items');
class FaqsController extends ItemsController {
	var $name = 'Faqs';
	var $uses = array('Faq');

	function index($tipo = false) {
		if(!$tipo){
			$tipo = 'General';
			
			if(Cache::read('faq_general_recent')) $tipo = 'General';
			if(Cache::read('faq_cuba_recent')) $tipo = 'Cuba';
			if(Cache::read('faq_yucatan_recent')) $tipo = 'Yucatan';
			
			$this->redirect(array($tipo),true);
		} else {
			$this->set(compact('tipo'));
			$conds = array('tipo'=>$tipo);
		}

		$items = $this->paginate($this->uses[0],$this->m[0]->find_($conds,'paginate'));
		$this->set(compact('items'));
	}
}
?>