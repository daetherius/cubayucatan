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
			$html->tag('h3',__('conozca',true).' '.__('cuba',true),'title'),
			$html->link(__('ver_todas',true),array('controller'=>'posts','action'=>'index','tipo'=>'Cuba'),array('class'=>'filtro')),
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
			$html->tag('h3',__('conozca',true).' '.__('yucatan',true),'title'),
			$html->link(__('ver_todas',true),array('controller'=>'posts','action'=>'index','tipo'=>'Yucatan'),array('class'=>'filtro')),
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

if(is_c('packs',$this)){
	if($item['Pack']['id'] < 5){
		echo
			$html->tag('ul'),
				$html->tag('li',$html->link(__('alojamiento_casas_particulares',true),array('controller'=>'packs','action'=>'alloggio'))),
				$html->tag('li',$html->link(__('desayuno_cena',true),array('controller'=>'packs','action'=>'colazione_cena'))),
				$html->tag('li',$html->link(__('servicios',true),array('controller'=>'packs','action'=>'servizi'))),
				$html->tag('li',$html->link(__('moneda_cambio',true),array('controller'=>'packs','action'=>'moneta'))),
			'</ul>';
	}
}

echo
	$html->div('banners',$this->element('banners'),array('id'=>'banners')), $moo->showcase('banners',array('nav'=>'out')),
	$html->link(__('convertidor_divisas',true),'/inicio/convertidor#PboxIframe?width=254&height=168',array('class'=>'convertidor pulsembox'));
?>
</div>
</div>