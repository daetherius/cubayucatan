<?php
$packs = Cache::read('pack_recent');
$packs_precios = array(1=>620,485,340,38);

echo
	$this->element('showcase',array('data'=>$carrusel)),
	$html->div('contentwide'),
	$html->div('pad'),
		$html->div('cuba_travel'),
			$html->tag('h2','Cuba','title'),
			$html->para(null,'A Cuba vi alloggiamo in case private, splendida alternativa agli Hotels, e anche meno cara'),
			$html->div('clear desc'),
				$html->div('column'),
					$html->para(null,'Lavoriamo con Cuba dal 2004, e con i nostri incaricati sull´Isola  garantiamo  le vostre prenotazioni nelle Cittá e nelle date che avrete scelto.'),
					$html->para(null,'Qui di seguito, caratteristiche delle stanze, prezzi, modalitá di prenotazione e pagamento. '),
				'</div>',
				$html->div('column'),
					$html->para(null,'Conosciamo bene e lavoriamo da anni con i gerenti delle nostre case e di loro garantiamo l´assoluta onestá. Rispettano scrupolosamente la privacy degli ospiti, e curano particolarmente pulizia e igiene.'),
				'</div>',
			'</div>',

			$html->para('suitcase','Tutte le stanze del nostro programma hanno bagno privato con doccia, acqua calda e fredda, e aria condizionata.');

			foreach($packs['cuba'] as $pack){
				$url = array('controller'=>'packs','action'=>'ver','id'=>$pack['Pack']['slug']);
				$mode = 'h';
				$title = _dec($pack['Pack']['nombre_'.$_lang]);
				$num_personas = $pack['Pack']['id'] != 4 ? 'por_dos_personas':'por_dia_por_persona';

				echo
					$html->div('thumb v pack'),
						$html->tag('h2',$html->link($pack['Pack']['nombre_'.$_lang],array('controller'=>'packs','action'=>'ver','id'=>$pack[$_m[0]]['slug'])),'title'),
						$html->div('wrapper'),
							$util->th($pack,'Pack',array('w'=>164,'h'=>128,'fill'=>true,'class'=>'floated')),
							$html->div('pack_destinations  clear');
								if($pack['Pack']['id'] < 4){
									echo $this->element('pack_destinations',array('item'=>$pack));
								} else {
									echo
										$html->tag('h3',__('itinerario_propuesto',true),'title'),
										$html->para(null,__('propuesta_personalizada_desc_corta',true));
								}
	
							echo
								$html->para('ppp',$html->tag('span',__($num_personas,true),'num_personas').$html->tag('span','€'.$packs_precios[$pack['Pack']['id']],'precio')),
							'</div>',
						'</div>',
						$html->div('share'),
							$this->element('facebook',compact('mode','url')),
							$this->element('twitter',compact('mode','url','title')),
							$this->element('gplus',compact('mode','url')),
						'</div>',
					'</div>';
			}
			/*
			echo
				$html->div('thumb pack v','Proposta personalizzata'),
				$html->div('thumb pack v','Cuba, 3 Cittá in 10 giorni'),
				$html->div('thumb pack v','Cuba, 3 Cittá in 15 giorni'),
				$html->div('thumb pack v','Cuba, 5 Cittá in 20 giorni'),
			*/
	echo
		'</div>',

		$html->div('yucatan_travel'),
			$html->tag('h2','Yucatán','title'),
			$html->para('suitcase','alloggio in mezza pensione nei Bungalows del Villaggio Maya e noleggio auto.');

			/*
			foreach($packs['yucatan'] as $pack){
				echo $this->element('th',array('item'=>$pack,'model'=>'Pack'));
			}
			*/
			echo
				$html->div('thumb pack v','Tour Giaguaro Nero Mayakot Basico'),
				$html->div('thumb pack v','Tour Giaguaro Nero Mayataan, Basico + Opzioni'),

		'</div>';

		if($posts = Cache::read('post_recent')){
			echo $html->div('posts');

				if($posts['cuba']) echo $this->element('th',array('item'=>$posts['cuba'][0],'model'=>'Post'));
				if($posts['yucatan']) echo $this->element('th',array('item'=>$posts['yucatan'][0],'model'=>'Post'));

			echo '</div>';

		}
	'';
?>
</div>
</div>