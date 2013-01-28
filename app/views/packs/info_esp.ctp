<?php
echo
	$this->element('top',array('header'=>'')),
	$html->div('tmce desc'),
		$html->link('','',array('name'=>'alloggio','id'=>'alloggio')),
		$html->tag('h2',__('alojamiento_casas_particulares',true),'title'),
		$html->para(null,'En Cuba, le ofrecemos alojamiento en Casas Particulares, alternativa hermosa  y a precios mucho mejores que en los Hoteles. Son lugares seguros y tienen todas las comodidades necesarias para unas vacaciones maravillosas.'),
		$html->para(null,'Trabajamos con estas Casas desde el año 2004, y con nuestro personal en la Isla nos encargamos de sus reservaciones en las Ciudades y en las fechas que usted ha elegido, sea en la fórmula personalizada que para los paquetes.'),
		$html->para(null,'Todas las habitaciones de nuestro programa cuentan con baño privado y aire acondicionado, agua caliente y fría.'),
		$html->para(null,'Conocemos bien los directivos de nuestras Casas y garantizamos su honestidad absoluta, cortesía y disponibilidad. Respetan escrupulosamente la intimidad de las personas y cuidan en particular  limpieza e higiene.'),
		$html->para(null,'Todas las Casas con las que trabajamos tienen la necesaria autorización del Gobierno.'),


		$html->link('','',array('name'=>'colazione_cena','id'=>'colazione_cena')),
		$html->tag('h2',__('desayuno_cena',true).' en la Casa','title'),
		$html->para(null,'Desayuno: Café, leche, fruta fresca o jugo de fruta, en ensalada o en batido, huevos fritos o tortillas, pan.'),
		$html->para(null,'Cena: Elección entre pollo, Arroz "Congris", arroz y frijoles, carne de cerdo, o otros alimentos disponibles. Y en este sentido, hay que tomar acuerdos con los propietarios.'),


		$html->link('','',array('name'=>'servizi','id'=>'servizi')),
		$html->tag('h2',__('servicios',true),'title'),
		$html->para(null,'Servicios incluídos:'),
		$html->tag('ul'),
			$html->tag('li','Lencería y toallas, con cambio cada dos días.'),
			$html->tag('li','Limpieza diaria de la habitación y cuarto de baño.'),
			$html->tag('li','Uso gratuito del teléfono para llamadas locales.'),
		'</ul>',
		$html->para(null,'Servicios No incluídos:'),
		$html->tag('ul'),
			$html->tag('li','Servicio de lavandería. Tomen los arreglos necesarios en la Casa, los precios son muy bajos.'),
		'</ul>',

		$html->link('','',array('name'=>'moneda_cambio','id'=>'moneda_cambio')),
		$html->tag('h2','Moneda y Divisas','title'),
		$html->para(null,'En Cuba hay dos monedas, e incluso hubo tres antes de que el dólar de EE.UU. se quitó de la circulación.'),
		$html->para(null,'Peso Nacional, CUP inicial, utilizado por los cubanos.'),
		$html->para(null,'Peso Cubano Convertible, CUC, diseñado para los turistas.'),
		$html->para(null,'1 Peso CUC vale 24 Pesos Nacionales. Cuando usted paga en CUC, es decir casi siempre, tenga cuidado que no le den el vuelto en "Pesos Nacionales ", por lo que sería mejor observar sus fotos, que usted encontrará en este sitio:'),
		$html->para(null,$html->link('www.cubacurrency.com','http://www.cubacurrency.com',array('target'=>'_blank','rel'=>'nofollow')).' y  haga clic en: '.$html->tag('strong','Pesos Cubanos (CUP)').' y '.$html->tag('strong','Pesos Cubanos Convertibles (CUC)').'.'),
		$html->para(null,'Sin embargo, en los dos lados del billete CUC  está escrito:'),
		$html->para(null,'"Pesos convertibles"'),
		$html->para(null,'Hay también una moneda de 1 CUC, con centavos.'),
		$html->para(null,'Ninguna de las dos monedas tiene curso legal ni se puede comprar fuera de Cuba.'),
		$html->para(null,'Cambio divisas en el BANCO de Crédito y Comercio, y CADECA (Casas de Cambio) que se encuentran en todas partes. En CADECA pueden retirar con tarjetas de crédito nominales, pero con un costo del 11%. Con las prepagadas no es posible.'),
		$html->para(null,'Por el cambio de divisas, verifiquen las cotizaciones en el mismo sitio: '),
		$html->para(null,$html->link('www.cubacurrency.com/exchanges_rates','http://www.cubacurrency.com/exchanges_rates',array('target'=>'_blank','rel'=>'nofollow'))),
		$html->para(null,'Los valores reportados son los interbancarios, y por lo tanto nunca son exactamente lo mismo que se les aplicará.'),
		$html->para(null,'Tengan cuidado, los cajeros automáticos son muy raros.'),
		$html->para(null,'No traigan dólares de Estados Unidos, son penalizados en un 10%, o tarjetas de crédito de la misma fuente, como American Express, no son aceptadas. Otras sí, como Visa, por ejemplo, o Mastercard.'),
		$html->para(null,'No cambien dinero en la calle, no acepten invitaciones de este tipo. Nunca, bajo ninguna circunstancia, son trampas. Además es totalmente ilegal, se arriesgan a graves problemas.'),

	'</div>';
?>
</div>
</div>
<?php echo $this->element('sidebar'); ?>