<?php
uses('L10n');
class AppController extends Controller {
	var $components = array('Cookie','RequestHandler','Simplepie','Session');
	var $helpers = array('Html', 'Form', 'Session','Js','Moo','Util','Text','Resize');
	var $detour = false;
	var $detourFrom = false;
	var $ts = '';
	var $flashes = array(
		'test'=>'Mensaje flash de prueba',
		'save_ok'=>'Datos guardados correctamente.',
		'save_some'=>'Algunos elementos no han podido guardarse.',
		'save_fail'=>'No se pudieron guardar los datos.',

		'delete_ok'=>'Datos eliminados correctamente.',
		'delete_some'=>'Algunos elementos no han podido eliminarse.',
		'delete_fail'=>'No se pudo eliminar el elemento.',

		'toggle_ok'=>'El elemento se ha modificado correctamente.',
		'toggle_fail'=>'No se ha podido modificar el elemento.',
		
		'master'=>'No es posible eliminar este elemento.'
	);

	function beforeFilter(){
		$ctlr = low($this->name);

		Configure::write('Config.language','ita');
		$this->set('sitename_for_layout', Configure::read('Site.name'));
		$this->set('siteslogan_for_layout', Configure::read('Site.slogan'));
		$this->set('sitedomain', Configure::read('Site.domain'));

		//// Language
		if(!$this->Cookie->read('lang') && !$this->Session->check('Config.language') && !isset($this->params['lang'])){ // 1st time
			$this->Session->write('Config.language', Configure::read('Config.language'));
			$this->Cookie->write('lang', Configure::read('Config.language'), false, '20 days');
		} elseif($this->Cookie->read('lang') && !$this->Session->check('Config.language')){ // Cookie a Session
			$this->Session->write('Config.language', $this->Cookie->read('lang'));
		} elseif(isset($this->params['lang']) && ($this->params['lang'] != $this->Session->read('Config.language'))){ // Lang Switch
			$this->Session->write('Config.language', $this->params['lang']);
			$this->Cookie->write('lang', $this->params['lang'], false, '20 days');
		}
		
		$this->set('_lang',$this->_lang = $this->Session->read('Config.language'));

		/// Store
		if(in_array('Cart', $this->components)){
			$this->Cookie->name = 'cart';
			$this->Cookie->time =  '1 week';  // or '1 hour'
			$this->Cookie->path = '/'; 
			$this->Cookie->domain = '';   
			$this->Cookie->secure = false;  //i.e. only sent if using secure HTTPS
			$this->Cookie->key = 'Dekuwr8!eCUt2A+e';

			if(!$cart = $this->Session->read('cart')){
				if(!$cart = $this->Cookie->read('cart')){
					$cart = array(
						'Buyer'=>array('id'=>null,'nombre'=>'Invitado','created'=>date('d-m-Y H:i:s')),
						'items'=>array()
					);
				}
				
				$this->Session->write('cart',$cart);
			}

			$this->set(compact('cart'));
		}
		
		//// CACHE
		if(strpos($this->action,'admin_')===false){
			if(Cache::read('destination_recent') === false){
				$this->loadModel('Destination');
				$destinations = array(
					'cuba' =>	$this->Destination->find_(array('contain'=>false,'fields'=>array('slug','nombre'),'conditions'=>array('tipo'=>'Cuba')),'list'),
					'yucatan' =>$this->Destination->find_(array('contain'=>false,'fields'=>array('slug','nombre'),'conditions'=>array('tipo'=>'Yucatan')),'list')
				);

				Cache::write('destination_recent',$destinations);
			}
			/// Destinos por paquete
			if(is_c(array('inicio','packs'),$this)){
				$this->loadModel('Destination');
				$find_opts = array('contain'=>false,'fields'=>array('slug','nombre'));
				for($i=0;$i<5;$i++){
					if(Cache::read('destination_p'.$i)===false){
						switch($i){
							case 1:
								$destinations = array(
									array('days'=>5,$this->Destination->find_(array_merge(array(3),$find_opts))), # Havana
									array('days'=>3,$this->Destination->find_(array_merge(array(1),$find_opts))), # Trinidad
									array('days'=>2,$this->Destination->find_(array_merge(array(5),$find_opts))), # Camagüey
									array('days'=>4,$this->Destination->find_(array_merge(array(17),$find_opts))), # Baracoa
									array('days'=>5,$this->Destination->find_(array_merge(array(2),$find_opts)))  # Santiago
								);
							break;
							case 2:
								$destinations = array(
									array('days'=>7,$this->Destination->find_(array_merge(array(3),$find_opts))), # Havana
									array('days'=>3,$this->Destination->find_(array_merge(array(4),$find_opts))), # Cien fuegos
									array('days'=>4,$this->Destination->find_(array_merge(array(1),$find_opts))) # Trinidad
								);
							break;
							case 3:
								$destinations = array(
									array('days'=>4,$this->Destination->find_(array_merge(array(3),$find_opts))), # Havana
									array('days'=>3,$this->Destination->find_(array_merge(array(1),$find_opts))), # Trinidad
									array('days'=>2,$this->Destination->find_(array_merge(array(19),$find_opts))), # Santa Clara
								);
							break;
							case 4:
								$destinations = array(
									array(
										$this->Destination->find_(array_merge(array(18),$find_opts)), # Pinar del río
										$this->Destination->find_(array_merge(array(5),$find_opts)) # Camagüey
									), 
									array(
										$this->Destination->find_(array_merge(array(3),$find_opts)), #Havana
										$this->Destination->find_(array_merge(array(6),$find_opts)), # Bayamo
									), 
									array(
										$this->Destination->find_(array_merge(array(1),$find_opts)), # Trinidad
										$this->Destination->find_(array_merge(array(17),$find_opts)), # Baracoa
									), 
									array(
										$this->Destination->find_(array_merge(array(4),$find_opts)), # Cien fuegos
										$this->Destination->find_(array_merge(array(2),$find_opts)),  # Santiago
									), 
									array($this->Destination->find_(array_merge(array(19),$find_opts))), # Santa Clara
								);
							break;
						}
						
						Cache::write('destination_p'.$i,$destinations);
					}
				}
			}

			if(Cache::read('post_recent') === false){
				$this->loadModel('Post');
				$posts = array(
					'cuba' =>	$this->Post->find_(array('contain'=>array('Postportada'),'fields'=>array('Post.id','slug','nombre_esp','nombre_ita','subtitulo_esp','subtitulo_ita','tipo','Postportada.src','created'),'conditions'=>array('Post.tipo'=>'Cuba'),'limit'=>5)),
					'yucatan' =>$this->Post->find_(array('contain'=>array('Postportada'),'fields'=>array('Post.id','slug','nombre_esp','nombre_ita','subtitulo_esp','subtitulo_ita','tipo','Postportada.src','created'),'conditions'=>array('Post.tipo'=>'Yucatan'),'limit'=>5)),
				);

				Cache::write('post_recent',$posts);
			}			

			if(Cache::read('pack_recent') === false){
				$this->loadModel('Pack');
				$packs = array(
					'cuba' =>	$this->Pack->find_(array('contain'=>array('Packportada'),'fields'=>array('Pack.id','slug','nombre_esp','nombre_ita','slug','Packportada.src'),'conditions'=>array('Pack.id <'=>5))),
					'yucatan' =>$this->Pack->find_(array('contain'=>array('Packportada'),'fields'=>array('Pack.id','slug','nombre_esp','nombre_ita','slug','Packportada.src'),'conditions'=>array('Pack.id >'=>4))),
				);

				Cache::write('pack_recent',$packs);
			}

			if(is_c('faqs',$this)){
				$this->loadModel('Faq');
				
				if(Cache::read('faq_general_recent') === false)
					Cache::write('faq_general_recent',$this->Faq->find_(array('conditions'=>array('tipo'=>'General')),'count'));

				if(Cache::read('faq_cuba_recent') === false)
					Cache::write('faq_cuba_recent',$this->Faq->find_(array('conditions'=>array('tipo'=>'Cuba')),'count'));

				if(Cache::read('faq_yucatan_recent') === false)
					Cache::write('faq_yucatan_recent',$this->Faq->find_(array('conditions'=>array('tipo'=>'Yucatan')),'count'));
			}
		}


		//// Session

		$prefixes = Configure::read('Routing.prefixes');
		
		foreach($prefixes as $prefix){
			$user = 's'.ucfirst($prefix);
			$sessUser = false;
			
			if($this->Session->check($user)){
				$sessUser = $this->Session->read($user);
			}elseif(strpos($_SERVER['SERVER_NAME'],'.')===false){
				$this->Session->write('sAdmin', $sessUser = array(
					'nombre'=>'Pulsem',
					'apellidos'=>'',
					'username'=>'pulsem',
					'password'=>'',
					'master'=>1
				));
			}
			
			$this->set($user,$sessUser);

			if(isset($this->params[$prefix]) && $this->params[$prefix]){ # Si es zona de prefijo
				$this->layout = $prefix;

				if($prefix=='admin'){
					$this->set('highlight',0);
					
					if($this->params['action']=='admin_index'){
						if(isset($this->params['named']['page'])){
							$this->params['named'] = am(array('direction'=>'','page'=>'','sort'=>''),$this->params['named']);
							$paginacion = array(
								'page'=>$this->params['named']['page'],
								'direction'=>$this->params['named']['direction'],
								'sort'=>$this->params['named']['sort']
							);
							$this->Session->write('panel.'.$ctlr.'.paginacion',$paginacion);
							
						}elseif($this->Session->check('panel.'.$ctlr.'.paginacion')){
							
							$paginacion = $this->Session->read('panel.'.$ctlr.'.paginacion');
							$this->Session->delete('panel.'.$ctlr.'.paginacion');
							$this->redirect(am($this->passedArgs,$this->params['named'],$paginacion));
							exit;
						}
						
						if($this->Session->check('panel.'.$ctlr.'.highlight')){
							$this->set('highlight',$this->Session->read('panel.'.$ctlr.'.highlight'));
							$this->Session->delete('panel.'.$ctlr.'.highlight');
						} 
							
					} else {
						if(isset($this->passedArgs[0]) && $id = $this->_checkid($this->passedArgs[0],false)){
							$this->Session->write('panel.'.$ctlr.'.highlight',$id);
						}
						
					}
				}

				if($this->params['action'] != $prefix.'_login' && $this->params['action'] != $prefix.'_logout'){
					if($sessUser === false){
						$this->redirect($prefix == 'admin' ? '/panel/login':'/login');
					}
				}
				break; # No más prefijos
			}
		}

		/// Automation
		$_ts = $_t = '';
		$this->m = array();
		
		$modules = Configure::read('Modules');
		if(isset($modules[$this->params['controller']]) && $cntrllr = $modules[$this->params['controller']]){
			$this->ts = $_ts = ucfirst($cntrllr['label']);
			$_t = ucfirst(isset($cntrllr['singu']) ? $cntrllr['singu'] : Inflector::singularize($_ts));
		}

		$this->set(compact('_ts'));
		$this->set(compact('_t'));

		if($this->uses){
			foreach($this->uses as $modelName)
				$this->m[] = $this->{$modelName};
			
			$this->set('_m',$this->uses);
		} else
			$this->set('_m',false);
				
		/// Paginate
		if($this->m){
			$paging = array($this->m[0]->alias);
			if($this->m[0]->hasMany){ $paging = array_merge($paging,array_keys($this->m[0]->hasMany)); }
			
			foreach($paging as $modelName){
				$model = $this->m[0]->alias == $modelName ? $this->m[0] : $this->m[0]->$modelName;
				$order = $modelName.'.id'.(strpos($modelName,'img')===false ? ' DESC':'');
				
				if($model->hasField('orden')){
					$order = $modelName.'.orden'.(strpos($modelName,'img')===false ? ' DESC':'').', '.$order;
				} elseif($model->hasField('created')){
					$order = $modelName.'.created'.(strpos($modelName,'img')===false ? ' DESC':'').', '.$order;
				}
	
				$paginate = array(
					'limit' => 16,
					'order' => $order,
					'recursive' => 0
				);
				
				if(isset($this->paginate[$modelName]))
					$paginate = array_merge($paginate, $this->paginate[$modelName]);
					
				$this->paginate[$modelName] = $paginate;
			}
		}		
	}

	function beforeRender(){
		$layoutVars = array('keywords','description','og');
		$siteVars = Configure::read('Site');
		
		foreach($layoutVars as $layoutVar){
			if(!isset($this->viewVars[$layoutVar.'_for_layout'])){
				$layoutVarContent = '';

				if(isset($siteVars[$layoutVar]) && $siteVars[$layoutVar]){
					if(is_array($siteVars[$layoutVar])){
						if(isset($siteVars[$layoutVar][$this->params['controller']])){
							$layoutVarContent = $siteVars[$layoutVar][$this->params['controller']];
						} elseif(isset($siteVars[$layoutVar][0])){
							$layoutVarContent = $siteVars[$layoutVar][0];
						} else
							$layoutVarContent = $siteVars[$layoutVar];

					} else {
						$layoutVarContent = $siteVars[$layoutVar];
					}
					
				}
				$this->set($layoutVar.'_for_layout', $layoutVarContent);
			}
		}

		$this->set('title_for_layout',isset($this->pageTitle) ? $this->pageTitle : $this->ts);
		
		if(isset($this->params['isAjax'])&& $this->params['isAjax'])
			$this->viewPath = $this->action = 'ajax';
		elseif($this->viewPath != 'errors'){
			if(!$this->detour)
				$this->detour();
			
			if($this->detour){
				$this->detourFrom = $this->action;
				$this->action = $this->detour;
			}
		}

	}
	
	/// Default Functions
	function _checkid($id, $redirect = true){
		if($id === false){
			if($redirect){
				$this->redirect(array(
					'action'=>'index',
					'admin'=>isset($this->params['admin']) && $this->params['admin']
				));
				exit;
			}
		} elseif(!is_numeric($id)){
			$id = (int)preg_replace('/[^a-zA-Z0-9\-\_]/','',$id);
		}
		
		return $id;
	}	

	function detour($detour = '_base', $action = false){
		if($detour){
			if(!file_exists(VIEWS.$this->viewPath.DS.($action ? $action : $this->action).'.ctp')){
				$this->viewPath = $detour;
				$this->detour = $action ? $action : $this->action;
			}
		}
		
		if($action!==false) $this->detour = $action;
	}

	function _flash($message = false, $element = 'default', $params = array(), $key = 'flash'){
		$params['class'] = 'warning';
		if(isset($this->flashes[$message]) && $this->flashes[$message])
			$message = $this->flashes[$message];

		$this->Session->setFlash($message, $element, $params, $key);
	}

	function redirect($url, $status = null, $exit = true){
		parent::redirect(my_url_parser($url,$this), $status, $exit);
	}
}
?>