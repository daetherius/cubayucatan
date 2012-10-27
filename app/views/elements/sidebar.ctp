<div class="sidebar">
<div class="pad">
<?php
if(is_c('destinations',$this) && $items = Cache::read('destination_recent')){
	if($items['cuba']){
		echo
			$html->tag('h3',__('cuba',true),'title'),
			$html->tag('ul');

		foreach($items['cuba'] as $slug => $nombre){
			$selected = (!empty($this->passedArgs[0])) && $slug == $this->passedArgs[0] ? 'selected' : '';
			echo $html->tag('li',$html->link($nombre,array('controller'=>'destinations','action'=>'ver','id'=>$slug)),$selected);
		}

		echo '</ul>';
	}

	if($items['yucatan']){
		echo
			$html->tag('h3',__('yucatan',true),'title'),
			$html->tag('ul');

		foreach($items['yucatan'] as $slug => $nombre){
			$selected = (!empty($this->passedArgs[0])) && $slug == $this->passedArgs[0] ? 'selected' : '';
			echo $html->tag('li',$html->link($nombre,array('controller'=>'destinations','action'=>'ver','id'=>$slug)),$selected);
		}

		echo '</ul>';
	}
}

if(is_c('posts',$this) && $items = Cache::read('post_recent')){
	if($items['cuba']){
		echo
			$html->tag('h3',__('conosci',true).' '.__('cuba',true),'title'),
			$html->link('Ver todas',array('controller'=>'posts','action'=>'index','tipo'=>'Cuba'),array('class'=>'filtro')),
			$html->tag('ul');

		foreach($items['cuba'] as $it){
			$nombre = $it['Post']['nombre_'.$_lang];
			$slug = $it['Post']['slug'];
			$selected = (!empty($this->passedArgs[0])) && $slug == $this->passedArgs[0] ? 'selected' : '';
			echo $html->tag('li',$html->link($nombre,array('controller'=>'posts','action'=>'ver','id'=>$slug)),$selected);
		}

		echo '</ul>';
	}

	if($items['yucatan']){
		echo
			$html->tag('h3',__('conosci',true).' '.__('yucatan',true),'title'),
			$html->link('Ver todas',array('controller'=>'posts','action'=>'index','tipo'=>'Yucatan'),array('class'=>'filtro')),
			$html->tag('ul');

		foreach($items['yucatan'] as $it){
			$nombre = $it['Post']['nombre_'.$_lang];
			$slug = $it['Post']['slug'];
			$selected = (!empty($this->passedArgs[0])) && $slug == $this->passedArgs[0] ? 'selected' : '';
			echo $html->tag('li',$html->link($nombre,array('controller'=>'posts','action'=>'ver','id'=>$slug)),$selected);
		}

		echo '</ul>';
	}
}

if((!in_array($this->params['controller'],array('destinations','posts'))) && $items = Cache::read('pack_recent')){
	if($items['cuba']){
		echo
			$html->tag('h3',__('cuba',true),'title'),
			$html->tag('ul');

		foreach($items['cuba'] as $it){
			$nombre = $it['Pack']['nombre_'.$_lang];
			$slug = $it['Pack']['slug'];
			$selected = (!empty($this->passedArgs[0])) && $slug == $this->passedArgs[0] ? 'selected' : '';
			echo $html->tag('li',$html->link($nombre,array('controller'=>'packs','action'=>'ver','id'=>$slug)),$selected);
		}

		echo '</ul>';
	}

	if($items['yucatan']){
		echo
			$html->tag('h3',__('yucatan',true),'title'),
			$html->tag('ul');

		foreach($items['yucatan'] as $it){
			$nombre = $it['Pack']['nombre_'.$_lang];
			$slug = $it['Pack']['slug'];
			$selected = (!empty($this->passedArgs[0])) && $slug == $this->passedArgs[0] ? 'selected' : '';
			echo $html->tag('li',$html->link($nombre,array('controller'=>'packs','action'=>'ver','id'=>$slug)),$selected);
		}

		echo '</ul>';
	}
}

if(is_c('products',$this) && isset($item) && $item){
	echo $this->element('add2cart',array('data'=>$item));
}

echo
	$html->div('banners',$this->element('banners'),array('id'=>'banners')), $moo->showcase('banners',array('nav'=>'out')),
	$html->link('Convertidor de Divisas','#',array('class'=>'convertidor'));
?>
</div>
</div>