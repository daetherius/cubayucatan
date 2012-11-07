<?php
$titulo = $item[$_m[0]]['nombre_'.$_lang];
$subtitulo = '';
if(strpos($titulo,', ')!==false)
	list($titulo,$subtitulo) = explode(', ',$titulo,2);

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_yucatan'),
		$html->tag('h1',$titulo,array('class'=>'title')),
		($subtitulo ? $html->div('title title2 broken',$subtitulo) : ''),
		
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
				$html->para(null,'*'.__('requerimientos_especiales',true).' '.$util->ofuscar(Configure::read('Site.email'),true)),
			'</div>',
			$html->div('column'),
				$html->link(__('reservar',true),array('controller'=>'packs','action'=>'reservar',$item[$_m[0]]['slug']),array('class'=>'reservar')),
				$html->tag('h3',__('precio',true).' '.__($item[$_m[0]]['id'] == 6 ? 'mayakot':'mayataan',true),'title red'),
				$html->div('desc tmce',$item[$_m[0]]['descripcion2_'.$_lang]),
			'</div>',
		'</div>',
	'</div>';
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>