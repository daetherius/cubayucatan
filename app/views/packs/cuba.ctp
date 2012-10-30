<?php
$titulo = $item[$_m[0]]['nombre_'.$_lang];
$subtitulo = '';
if(strpos($titulo,', ')!==false)
	list($titulo,$subtitulo) = explode(', ',$titulo,2);

echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_cuba'),
		$html->tag('h1',$titulo,array('class'=>'title')),
		($subtitulo ? $html->div('title title2 broken',$subtitulo) : ''),
		
		$html->div('clear'),
			$html->div('column'),
				$this->element('showcase',array('data'=>$item['Packimg'],'model'=>'Packimg','size'=>'x137','url'=>true)),
				$this->element('pack_destinations',compact('item')),
			'</div>',
			$html->div('column'),
				$html->link(__('mapa',true),'/'.$item[$_m[0]]['src'],array('class'=>'pulsembox mapa')),
				$html->div('desc tmce',$item[$_m[0]]['descripcion_'.$_lang].''),
			'</div>',
		'</div>',

		$html->para('suitcase',__('notas_de_viaje_cuba',true)),
	
		$this->element('pack_options'),
	'</div>';
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>