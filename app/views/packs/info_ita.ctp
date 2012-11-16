<?php
echo
	$this->element('top',array('header'=>'Información sobre el Paquete')),
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

		$html->link('','',array('name'=>'moneda_cambio','id'=>'moneda_cambio')),
		$html->tag('h2','Monete, Valute e Cambi','title'),
		$html->para(null,'A Cuba esistono due monete, e ce n’erano addirittura tre prima che il dollaro statunitense fosse tolto dalla circolazione come moneta d’uso corrente.'),
		$html->para(null,'Peso Nacional, sigla CUP, usato dai cubani.'),
		$html->para(null,'Peso Convertible Cubano, detto *CUC (pronuncia seusé), pensato per i turisti, detto anche "chavito" (pronuncia ciavito), oppure "dólar".'),
		$html->para(null,'1 CUC vale 24 Pesos Nacionales, lo diciamo solo per informazione perché quando cambierete vi daranno seusé, anche se l’uso del "peso nacional" é ovviamente ammesso per tutti. Quando pagherete in seusé, cioé quasi sempre, attenti a non farvi dare il resto in "pesos nacionales", e per questo sarebbe meglio osservare le rispettive foto, che troverete nel sito:'),
		$html->para(null,$html->link('www.cubacurrency.com','http://www.cubacurrency.com',array('target'=>'_blank','rel'=>'nofollow')).' e poi cliccate: '.$html->tag('strong','Cuban Pesos (CUP)').' e '.$html->tag('strong','Cuban Convertible Pesos (CUC)').'.'),
		$html->para(null,'Comunque, sui due lati della banconota CUC c’é la scritta: "Pesos Convertibles". Esiste anche la moneta metallica da 1 CUC, con centesimi.'),
		$html->para(null,'Nessuna delle due monete ha corso legale né si puó acquistare fuori da Cuba.'),
		$html->para(null,'Si cambia nelle sedi della BANCA DE CRÉDITO Y COMERCIO, e nelle CADECA, Casas de Cambio, valide queste per ogni valuta, e si trovano dappertutto. Nelle CADECA potete prelevare con carte di credito nominali, ma con un costo dell’11%. Con le prepagate non é possible.'),
		$html->para(null,'Per cambio valuta, stesso sito: '.$html->link('www.cubacurrency.com/exchanges_rates','http://www.cubacurrency.com/exchanges_rates',array('target'=>'_blank','rel'=>'nofollow'))),
		$html->para(null,'I valori riportati sono quelli interbancari, e quindi non sono mai esattamente gli stessi che verranno applicati.'),
		$html->para(null,'Attenti, gli sportelli Bancomat sono rarissimi.'),
		$html->para(null,'Non portate dollari statunitensi, sono penalizzati del 10%, né carte di credito della stessa provenienza, come American Express, non sono accettate. Le altre sí, come la Visa, per esempio, o Mastercard.'),
		$html->para(null,'Non cambiate soldi per strada, sottolineato, non accettate inviti di questo tipo. Mai, in nessun caso, sono trappole. Per di piú é del tutto illegale, rischiate problemi seri.'),


	'</div>';
?>
</div>
</div>
<?php echo $this->element('sidebar'); ?>