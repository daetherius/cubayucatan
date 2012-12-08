<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" itemscope itemtype="http://schema.org/<?=ucfirst($og_for_layout['itemtype'])?>">
<head>
<title><?=$sitename_for_layout.($title_for_layout ? ' | '.$title_for_layout : '')?></title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="description" content="<?=$description_for_layout?>" />
<meta name="keywords" content="<?=$keywords_for_layout?>" />
<meta name="Title" content="<?=$sitename_for_layout?>" />
<meta name="Author" content="Pulsem" />
<meta name="Generator" content="daetherius" />
<meta name="Language" content="Spanish" /> 
<meta name="Robots" content="Index" />
<meta name="google-site-verification" content="j6k-fp2Lh4h7-I8dBMJiu-nUii-izLzPrA4bH9DdseA" />

<meta property="og:title" content="<?=$og_for_layout['title']?>" />
<meta property="og:description" content="<?=$og_for_layout['description']?>" />
<meta property="og:type" content="<?=$og_for_layout['type']?>" />
<meta property="og:url" content="<?=$og_for_layout['url']?>" />
<meta property="og:image" content="<?=$og_for_layout['image']?>" />
<meta property="og:site_name" content="<?=$og_for_layout['site_name']?>" />

<meta itemprop="name" content="<?=$og_for_layout['title']?>" />
<meta itemprop="description" content="<?=$og_for_layout['description']?>" />
<meta itemprop="image" content="<?=$og_for_layout['image']?>" />

<?=$html->css(array('generic','main','pulsembox','cart','http://fonts.googleapis.com/css?family=Merienda+One'))?> 
</head>
<?php
echo
	$html->tag('body',null,'c_'.$this->params['controller'].' a_'.$this->params['action']),
		$html->div(null,null,array('id'=>'nofooter')),
			$html->div(null,null,array('id'=>'header')),
				$html->div('clear'),
					$html->tag('h1',$html->link($sitename_for_layout,'/',array('title'=>$sitename_for_layout)),array('id'=>'logo')),
					$html->div('language '.$_lang,$html->link(__('toggle_lang',true),array_merge(array('lang'=>$_lang == 'esp' ? 'ita':'esp'),$this->passedArgs))),
					$this->element('social'),
				'</div>',
			'</div>',
			$this->element('menu'),
			$html->div(null,$content_for_layout.'',array('id'=>'body')),
			$html->div(null,'',array('id'=>'cleaner')),
		'</div><!-- #nofooter -->',

		$this->element('footer');
?>
  <script src="//ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js"></script>
  <script>window.MooTools || document.write('<script src="/js/moo13.js"><\/script>')</script>
<?php
	echo
		$html->script(array('moo13m','utils','pulsembox')),
		$moo->addEvent('.add2cart input[type=submit]','click',array(
			'css'=>true,
			'prevent'=>true,
			'url'=>'/products/add2cart',
			'data'=>'this.getParent("form")',
			'spinner'=>'this.getParent(".add2cart")'
		)),
		$scripts_for_layout,
		$moo->writeBuffer(array('onDomReady'=>false)),
		//$this->element('gfont',array('fonts'=>array('Cantarell','Droid+Serif'))),
	'';
?>
<script type="text/javascript">
/* G+ */ window.___gcfg = {lang: "es-419"};(function(){var po=document.createElement("script");po.type="text/javascript";po.async=true;po.src="https://apis.google.com/js/plusone.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(po,s);})();
/* Analytics */ var _gaq=[["_setAccount","UA-36641637-1"],["_trackPageview"]];(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";s.parentNode.insertBefore(g,s)}(document,"script"));
</script>
</body></html>