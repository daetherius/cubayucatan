<?php
echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_yucatan'),
		$html->tag('h1',$item[$_m[0]]['nombre_'.$_lang],array('class'=>'title')),
		
		$html->div('clear'),
			$html->div('column'),
				$this->element('showcase',array('data'=>$item['Packimg'],'model'=>'Packimg','size'=>'x137','url'=>true)),
			'</div>',
			$html->div('column'),
				$html->link(__('mapa',true),'/'.$item[$_m[0]]['src'],array('class'=>'pulsembox mapa')),
			'</div>',
		'</div>',

		$html->div('clear info'),
			$html->div('column'),
				$html->tag('h3',__('alojamiento_y_transporte_maya',true),'title red'),
				$html->div('desc tmce',$item[$_m[0]]['descripcion_'.$_lang]),
			'</div>',
			$html->div('column'),
				$html->tag('h3',__('precio_mayakot',true),'title red'),
				$html->link(__('reservar',true),array('controller'=>'packs','action'=>'reservar','id'=>$item[$_m[0]]['slug']),array('class'=>'reservar')),
				$html->div('desc tmce',$item[$_m[0]]['descripcion2_'.$_lang]),
			'</div>',
		'</div>',
	'</div>';
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>