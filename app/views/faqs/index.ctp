<?php
echo
	$this->element('top'),
	$html->div('selector'),
		(Cache::read('faq_general_recent') ? $html->link('Generales',array('controller'=>'faqs','action'=>'index','General'),array('class'=>$tipo == 'Generales' ? 'selected':'')):''),
		(Cache::read('faq_cuba_recent') ? $html->link('Cuba',array('controller'=>'faqs','action'=>'index','Cuba'),array('class'=>$tipo == 'Cuba' ? 'selected':'')):''),
		(Cache::read('faq_yucatan_recent') ? $html->link('Yucatán',array('controller'=>'faqs','action'=>'index','Yucatan'),array('class'=>$tipo == 'Yucatan' ? 'selected':'')):''),
	'</div>';

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