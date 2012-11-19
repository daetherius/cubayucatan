<?php
$packs = Cache::read('pack_recent');
echo
	$this->element('showcase',array('data'=>$carrusel)),
	$html->div('contentwide'),
	$html->div('pad'),
		$html->div('cuba_travel'),
			$html->div('clear info'),
				$html->tag('h2','Cuba','title'),
				$html->para('inline_sub',__('alojese_casas_particulares',true)),
			'</div>',
			$html->div('clear desc'),
				$html->div('column'),
					$html->para(null,__('laboramos_desde_2004',true)),
					$html->para(null,__('aqui_caracteristicas_hab',true)),
				'</div>',
				$html->div('column'),
					$html->para(null,__('trato_duenios_casas_en_cuba',true)),
				'</div>',
			'</div>',

			$html->para('suitcase',__('caracteristicas_hab_cuba',true));

			foreach($packs['cuba'] as $pack)
				echo $this->element('th',array('item'=>$pack,'model'=>'Pack'));
	echo
		'</div>',

		$html->div('yucatan_travel'),
			$html->tag('h2','Yucatán '/*.$html->tag('span',': Tour '.__('jaguar_negro',true),'jaguar_negro')*/,'title'),
			$html->para('suitcase',__('villa_maya_y_coches',true));

			foreach($packs['yucatan'] as $pack)
				echo $this->element('th',array('item'=>$pack,'model'=>'Pack'));

		'</div>';

		if($posts = Cache::read('post_recent')){
			echo $html->div('posts');

				if($posts['cuba']) echo $this->element('th',array('item'=>$posts['cuba'][0],'model'=>'Post'));
				if($posts['yucatan']) echo $this->element('th',array('item'=>$posts['yucatan'][0],'model'=>'Post'));

			echo '</div>';

		}
?>
</div>
</div>