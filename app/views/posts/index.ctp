<?php
if(!empty($this->params['named']['tipo']))
	$tipo = ' / '.__($this->params['named']['tipo'],true);

echo $this->element('top',array('header'=>__(strtolower($_ts),true).$tipo));
	
	if($items){
		foreach($items as $item)
			echo $this->element('th',array('item'=>$item));
			
		echo $this->element('pages');


	} else 
		echo $html->para('noresults','No hay elementos que mostrar');
?>
</div>
</div><!-- .content -->
<?php echo $this->element('sidebar'); ?>