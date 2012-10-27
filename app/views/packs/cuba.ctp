<?php
echo
	$this->element('top',array('header'=>'')),
	$html->div('detail det_cuba'),
		$html->tag('h1',$item[$_m[0]]['nombre_'.$_lang],array('class'=>'title')),
		
		$html->div('clear'),
			$html->div('column'),
				$this->element('showcase',array('data'=>$item['Packimg'],'model'=>'Packimg','size'=>'x137','url'=>true)),
				$this->element('pack_destinations',array('pack'=>$item)),
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