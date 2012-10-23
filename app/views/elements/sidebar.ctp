<div class="sidebar">
<div class="pad">
<?php
if($items = Cache::read('destination_recent')){
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

if(is_c('products',$this) && isset($item) && $item){
	echo $this->element('add2cart',array('data'=>$item));
}

echo $html->div('banners',$this->element('banners'),array('id'=>'banners')), $moo->showcase('banners',array('nav'=>'out'));
?>
</div>
</div>