<?php
echo $this->element('top');
	
	if($items){
		foreach($items as $item){
			echo
				$html->div('faq'),
					$html->tag('h3',$item['Faq']['nombre_'.$_lang],'pregunta title'),
					$html->div('respuesta desc tmce',$item['Faq']['descripcion_'.$_lang].''),
				'</div>';
		}
	} else 
		echo $html->para('noresults','No hay elementos que mostrar');
?>
</div>
</div><!-- end of content -->
<?php echo $this->element('sidebar'); ?>