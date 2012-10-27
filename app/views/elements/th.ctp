<?php
if($item){
	$shop = isset($shop) ? $shop : false;
	$v = (isset($v) && $v) || $shop ? 'v' : '';
	$model = isset($model) ? $model : $_m[0];
	$comments = isset($comments) ? $comments : false;
	$mini = isset($mini) ? $mini : false;
	$layout = isset($layout) ? $layout : array();
	$class = isset($class) && $class ? $class : '';
	$thopts = isset($thopts) && $thopts ? $thopts : array('w'=>164,'h'=>128,'fill'=>true);
	
	$th = array(
		'img'=>false,
		'nombre'=>false,
		'fecha'=>false,
		'desc'=>false,
		'comments'=>false,
		'mas'=>false
	);
	
	if($layout){
		$fill = array_fill(0,sizeof($layout),false);
		$th = array_combine($layout,$fill);
	}

	$url = array(
		'controller'=>Inflector::tableize($model),
		'action'=>'ver',
		'id'=>empty($item[$model]['slug']) ? $item[$model]['id'] : $item[$model]['slug']
	);

	switch($model){
		
		case 'Album':
			$th['mas'] = 'Ver Fotos';
		break;

		//////////
		case 'Testimonial':
			$url = false;
			$thopts = array('w'=>210,'h'=>128,'fill'=>true);
			$th = array(
				'img'=>false,
				'desc'=>$html->div('desc tmce',''.$item[$model]['descripcion_'.$_lang]),
				'nombre'=>$html->tag('h2','— '.$item[$model]['nombre'],'title')
			);
		break;
		//////////
		case 'Post':
			fb($url,'$url');
			$alias = array('Cuba'=>'Cuba','Yucatan'=>'Yucatán');
			if(is_c('inicio',$this)){
				$th = array_merge(array($html->div('title title3','Conosci '.$alias[$item[$model]['tipo']])),$th);	
			}

			$th['desc'] = $html->div('desc tmce',''.strip_tags($util->trim($item[$model]['subtitulo_'.$_lang]),'<b><i><strong><em>'));
			$th['mas'] = '+ Leer más';
		default:
		break;
	}

	if($mini) $th = array('nombre'=>$th['nombre']);
	
	foreach($th as $key => $value){
		if($value === false){
			switch($key){
				case 'img':
					if(!isset($thopts['url'])) $thopts['url'] = $url;
					$th[$key] = $util->th($item,$model,$thopts);
				break;

				case 'nombre':
					$nombre = empty($item[$model]['nombre']) ? $item[$model]['nombre_'.$_lang] : $item[$model]['nombre'];
					$th[$key] = $html->tag('h2',$html->link($nombre,$url),'title');
				break;
				
				case 'fecha':
					$th[$key] = $html->para('date',$util->fdate('s',$item[$model]['created']));
				break;
				
				case 'desc':
					$desc = empty($item[$model]['descripcion']) ? $item[$model]['descripcion_'.$_lang] : $item[$model]['descripcion'];
					$th[$key] = $html->div('desc tmce',''.strip_tags($util->trim($desc),'<b><i><strong><em>'));

				break;
				
				case 'comments':
					if($comments && isset($item[$model]['comment_count']))
						$th[$key] = $html->link($item[$model]['comment_count'],$url,array('class'=>'comments'));
				break;
			}
		} elseif($value && $key === 'mas')
			$th['mas'] = $html->div('more',$html->link($th['mas'],$url));
	}
	
	echo $html->div('thumb '.$class.' '.$v.' '.low($model), implode('',$th));

} else
	echo $html->para('noresults','No hay elemento para mostrar');
?>