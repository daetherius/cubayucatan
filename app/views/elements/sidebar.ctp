<div class="sidebar">
<div class="pad">
<?php
if(is_c('destinations',$this) && $items = Cache::read('destination_recent')){
	if($items['cuba']){
		echo
			$html->tag('h3','Cuba','title'),
			$html->tag('ul');

		foreach($items['cuba'] as $slug => $nombre){
			$selected = (!empty($this->passedArgs[0])) && $slug == $this->passedArgs[0] ? 'selected' : '';
			echo $html->tag('li',$html->link($nombre,array('controller'=>'destinations','action'=>'ver','id'=>$slug)),$selected);
		}

		echo '</ul>';
	}

	if($items['yucatan']){
		echo
			$html->tag('h3','Yucatán','title'),
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
			$html->tag('h3','Conosci Cuba','title'),
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
			$html->tag('h3','Conosci Yucatán','title'),
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

if(is_c('products',$this) && isset($item) && $item){
	echo $this->element('add2cart',array('data'=>$item));
}

echo
	$html->div('banners',$this->element('banners'),array('id'=>'banners')), $moo->showcase('banners',array('nav'=>'out')),
	$html->link('Convertidor de Divisas','#',array('class'=>'convertidor'));
?>
</div>
</div>