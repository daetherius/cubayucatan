<?php
if(!empty($item[$_m[0]]['id'])){
	$pid = $item[$_m[0]]['id'];
	if(($destinations = Cache::read('destination_p'.$pid))!== false){
		$link_atts = array('target'=>'_blank','rel'=>'nofollow');

		foreach ($destinations as $dest) {
			$rowcells = array();
			$url = array('controller'=>'destinations','action'=>'ver');

			if($pid != 4){ // Paquete fijo
				$it = $dest[0]['Destination'];
				$url['id'] = $it['slug'];
				$rowcells[0] = $html->link($it['nombre'],$url,$link_atts);
				$rowcells[1] = $dest['days'].' '.__('dias',true);

			} else { // Paquete personalizado
				foreach($dest as $it){
					$it = $it['Destination'];
					$url['id'] = $it['slug'];
					$rowcells[] = $html->link($it['nombre'],$url,$link_atts);
				}
			}

			$tablecells[] = $rowcells;
		}

		if($pid != 4){ // Día final en La Havana
			$havana = $destinations[0][0]['Destination'];	
			$tablecells[] = array(
				$html->link($havana['nombre'],$url,$link_atts),
				'1 '.__('dia',true)
			);
		}
	}
}

/// Output

echo
	$html->div('pack_destinations clear'),
		$html->tag('h3',__('itinerario propuesto',true),'title'),
		$html->tag('table'),
			$html->tableCells($tablecells),
		'</table>',
	'</div>';
?>