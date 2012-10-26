<?php
echo $this->element('top');
if($item)
	echo
		$html->div('desc tmce subtitulo',$item[$_m[0]]['intro_'.$_lang]),
		$util->th($item,$_m[0],array('w'=>960)),
		$html->div('desc tmce',$item[$_m[0]]['descripcion_'.$_lang]);
?>
</div>
</div>
<?php echo $this->element('sidebar'); ?>