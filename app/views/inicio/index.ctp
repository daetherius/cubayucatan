<?php
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

			/*
			foreach($packs['cuba'] as $pck){
				echo $this->element('th',array('item'=>$pck,'model'=>'Pack'));
			}
			*/
			echo
				$html->div('thumb pack v','Proposta personalizzata'),
				$html->div('thumb pack v','Cuba, 3 Cittá in 10 giorni'),
				$html->div('thumb pack v','Cuba, 3 Cittá in 15 giorni'),
				$html->div('thumb pack v','Cuba, 5 Cittá in 20 giorni'),

		'</div>',

		$html->div('yucatan_travel'),
			$html->tag('h2','Yucatán','title'),
			$html->para('suitcase','alloggio in mezza pensione nei Bungalows del Villaggio Maya e noleggio auto.');

			/*
			foreach($packs['yucatan'] as $pck){
				echo $this->element('th',array('item'=>$pck,'model'=>'Pack'));
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