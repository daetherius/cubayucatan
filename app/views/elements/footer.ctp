<?php
$destinations = Cache::read('destination_recent');
$packs = Cache::read('packs_recent');

echo
	$html->div('footer'),
	$html->div('center'),
		$html->div('contacto clear'),
			$html->div('title title3',__('contacto_directo',true)),
			$this->element('social'),
			$html->div('column email'),
				$html->para(null,$util->ofuscar('umberto@'.Configure::read('Site.domain'))),
				$html->para(null,$util->ofuscar('edelis@'.Configure::read('Site.domain'))),
			'</div>',
			$html->div('column phone'),
				$html->para(null,'+52 (999) 285.59.10'),
				$html->para(null,'+52 (999) 958.81.75'),
			'</div>',
		'</div>',
		$html->div('lists'),
			$html->div('column'),
			
/*				$html->div('title title3',__('links',true)),
				$html->tag('ul'),
					$html->tag('li',$html->link('','http://',array('target'=>'_blank','rel'=>'nofollow'))),
					$html->tag('li',$html->link('','http://',array('target'=>'_blank','rel'=>'nofollow'))),
					$html->tag('li',$html->link('','http://',array('target'=>'_blank','rel'=>'nofollow'))),
					$html->tag('li',$html->link('','http://',array('target'=>'_blank','rel'=>'nofollow'))),
				'</ul>',
*/			'</div>';

			if($packs){
				echo $html->div('column');

					if($packs['cuba']){
						echo
							$html->div('title title4','Cuba'),
							$html->tag('ul');

						foreach($packs['cuba'] as $pack)
							echo $html->tag('li',$html->link($pack['Pack']['nombre'],array('controller'=>'packs','action'=>'ver','id'=>$pack['Pack']['slug'])));

						echo '</ul>';
					}

					if($packs['yucatan']){
						echo
							$html->div('title title4','Yucatán'),
							$html->tag('ul');

						foreach($packs['yucatan'] as $pack)
							echo $html->tag('li',$html->link($pack['Pack']['nombre'],array('controller'=>'packs','action'=>'ver','id'=>$pack['Pack']['slug'])));

						echo '</ul>';
					}

				echo '</div>';
			}

			if(!empty($destinations['cuba'])){
				echo
					$html->div('column destinations'),
						$html->div('title title3',__('destinos_cuba',true)),
						$html->tag('ul');

							foreach ($destinations['cuba'] as $slug => $nombre)
								echo $html->tag('li',$html->link($nombre,array('controller'=>'destinations','action'=>'ver','id'=>$slug)));
							
				echo '</ul></div>';
			}

			if(!empty($destinations['yucatan'])){
				echo
					$html->div('column destinations'),
						$html->div('title title3',__('destinos_yucatan',true)),
						$html->tag('ul');

							foreach ($destinations['yucatan'] as $slug => $nombre)
								echo $html->tag('li',$html->link($nombre,array('controller'=>'destinations','action'=>'ver','id'=>$slug)));
							
				echo '</ul></div>';
			}

		echo
			$html->div('column'),
				$html->div('title title3','+Info'),

				$html->div('title title4','Cuba'),
				$html->tag('ul'),
					$html->tag('li',$html->link(__('embajada',true),'http://www.amblavana.esteri.it',array('target'=>'_blank','rel'=>'nofollow'))),
					$html->tag('li',$html->link(__('impuesto_aeropuerto',true),'http://',array('target'=>'_blank','rel'=>'nofollow'))),
					$html->tag('li',$html->link(__('cambio_moneda',true),'http://',array('target'=>'_blank','rel'=>'nofollow'))),
				'</ul>',

				$html->div('title title4','Yucatán'),
				$html->tag('ul'),
					$html->tag('li',$html->link(__('embajada',true),'http://www.ambcittadelmessico.esteri.it',array('target'=>'_blank','rel'=>'nofollow'))),
					$html->tag('li',$html->link(__('cambio_moneda',true),'http://',array('target'=>'_blank','rel'=>'nofollow'))),
				'</ul>',
			'</div>',

			$html->div('column'),
				$html->div('title title3',__('menu',true)),
				$html->tag('ul'),
					$html->tag('li',$html->link(__('noticias',true),array('controller'=>'posts','action'=>'index'))),
					$html->tag('li',$html->link(__('preguntas frecuentes',true),array('controller'=>'faqs','action'=>'index'))),
					$html->tag('li',$html->link(__('testimonios',true),array('controller'=>'testimonials','action'=>'index'))),
					$html->tag('li',$html->link(__('nosotros',true),array('controller'=>'about','action'=>'index'))),
					$html->tag('li',$html->link(__('aviso legal',true),array('controller'=>'legal','action'=>'index'))),
				'</ul>',
			'</div>',
		'</div>',

	/*
		$html->link('PULSEM : Web + Identidad + Consultoría','http://pulsem.mx',array('id'=>'pulsem')),
		$html->para(null,Configure::read('Site.name').' &copy; '.date('Y'),array('id'=>'copyright'));
	*/
	'';
?>
</div><!-- .center -->
</div><!-- .footer -->