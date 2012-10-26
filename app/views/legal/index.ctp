<?php
echo $this->element('top');
if($item) echo $html->div('desc tmce',$item[$_m[0]]['descripcion_'.$_lang].'');
?>
</div>
</div>
<?php echo $this->element('sidebar'); ?>