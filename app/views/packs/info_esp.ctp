<?php
echo
	$this->element('top',array('header'=>'')),
	$html->div('tmce desc'),
		$html->link('','',array('name'=>'alloggio','id'=>'alloggio')),
		$html->tag('h2',__('alojamiento_casas_particulares',true),'title'),
		$html->para(null,'A Cuba, proponiamo l’alloggio in Case private, bellissima alternativa agli Hotels e a prezzi molto  migliori. Sono luoghi sicuri e hanno tutti i servizi necessari per una splendida vacanza.'),
		$html->para(null,'Lavoriamo con loro dal 2004, e con i nostri incaricati sull´Isola  garantiamo  le prenotazioni nelle Cittá e nelle date che avrete scelto, sia nella formula personalizzata che per quanto riguarda i pacchetti.'),
		$html->para(null,'Tutte le stanze del nostro programma hanno bagno privato e aria condizionata, acqua calda e fredda.'),
		$html->para(null,'Conosciamo bene i gerenti delle nostre Case e di loro garantiamo l´assoluta onestá, la cortesia e disponibilitá. Rispettano scrupolosamente la privacy degli ospiti, e curano particolarmente pulizia e igiene. '),
		$html->para(null,'Le Case con cui lavoriamo hanno tutte regolare autorizzazione governativa.'),


		$html->link('','',array('name'=>'colazione_cena','id'=>'colazione_cena')),
		$html->tag('h2',__('desayuno_cena',true).' nelle case','title'),
		$html->para(null,'Prima colazione: Caffé, latte, frutta fresca o succo di frutta, in macedonia o frullato, uova fritte o frittata, pane.'),
		$html->para(null,'Cena: coperto, pane. A scelta, pollo, riso "congris", riso e fagioli, carne di maiale, o altri cibi disponibili. Comunque, prendere accordi con i proprietari.'),


		$html->link('','',array('name'=>'servizi','id'=>'servizi')),
		$html->tag('h2',__('servicios',true),'title'),
		$html->para(null,'Servizi compresi nei prezzi:'),
		$html->tag('ul'),
			$html->tag('li','Biancheria da bagno e da letto, con cambio ogni due giorni.'),
			$html->tag('li','Pulizia giornaliera di camera e bagno.'),
			$html->tag('li','Uso gratuito del telefono per chiamate locali.'),
		'</ul>',
		$html->para(null,'Servizio non compreso nei prezzi:'),
		$html->tag('ul'),
			$html->tag('li','Servizio di lavanderia. Prendete accordi sul posto, i prezzi sono molto bassi.'),
		'</ul>',

		$html->link('','',array('name'=>'servizi','id'=>'servizi')),
		$html->tag('h2',__('servicios',true),'title'),
		$html->para(null,''),

	'</div>';
?>
</div>
</div>
<?php echo $this->element('sidebar'); ?>