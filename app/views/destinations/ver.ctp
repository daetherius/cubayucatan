<?php
$w = 320;$class = '';

if(isset($item[$_m[0]]['layout']) && $item[$_m[0]]['layout']){
	if($item[$_m[0]]['layout'] == 'Centro'){
		$w = 640;	
	}
	$class.= 'pulsembox portada '.$item[$_m[0]]['layout'];
}
	
echo
	$this->element('top',array('header'=>'')),
	$html->div('detail'),
		$html->tag('h1',$item[$_m[0]]['nombre'],array('class'=>'title')),
		
		$html->div('clear'),
			$html->div('column'),
				$html->div('desc tmce subtitulo',$item[$_m[0]]['subtitulo_'.$_lang].''),
				$html->div('desc tmce',$item[$_m[0]]['descripcion_'.$_lang].''),
				$this->element('share'),
			'</div>',

			$html->div('column gallery');
				foreach ($item[$_m[0].'img'] as $img) {
					echo $util->th($img,false,array('url'=>true,'w'=>144,'h'=>90,'fill'=>true));
				}

		echo
			'</div>',
		'</div>',
	
		$this->element('comments'),
	'</div>';
?>
</div>
</div><!-- content -->
<?php echo $this->element('sidebar'); ?>