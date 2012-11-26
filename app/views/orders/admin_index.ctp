<?php
$hasimgs = in_array(strtolower($_m[0]).'imgs',array_keys(Configure::read('Modules')));
echo
	$this->element('adminhdr',array('links'=>array('add'))),
	$this->element('pages');
	
	if($items){
	echo
		$form->create('todelete',array('url'=>$this->here,'id'=>'todeleteForm')),
		$form->submit('Eliminar marcados',array('div'=>'deleteSubmit')),
		$html->tag('table',null,array('class'=>'datagrid')),
			$html->tableHeaders(array(
				$paginator->sort('#', 'id'),
				$paginator->sort('Nombre', 'nombre'),
				$paginator->sort('Apellidos', 'apellidos'),
				$paginator->sort('E-mail', 'email'),
				$paginator->sort('Paquete', 'pack_id'),
				$paginator->sort('Estado', 'status'),
				$paginator->sort('Monto', 'amt'),
				$paginator->sort('Creado', 'created'),
				'Acciones'
			));

			$packs = array(
				1=>'Cuba - 20 días',
				'Cuba - 15 días',
				'Cuba - 10 días',
				'Cuba - Personalizado',
				'Yucatán c/Opciones',
				'Yucatán'
			);

			foreach($items as $it){
				$id = $it[$_m[0]]['id'];
				$pid = $it[$_m[0]]['pack_id'];
				$tipo = $pid < 5 ? 'cuba':'yucatan';
				
				echo $html->tableCells(array(array(
					$form->input($id,array('type'=>'checkbox','div'=>'hide','class'=>'delete')).$html->link($id,'javascript:;',array('class'=>'id','id'=>'it'.$id)),
					$it[$_m[0]]['nombre'],
					$it[$_m[0]]['apellidos'],
					$it[$_m[0]]['email'],
					$packs[$it[$_m[0]]['pack_id']],
					$it[$_m[0]]['status'],
					$it[$_m[0]]['amt'],
					$util->fdate('s',$it[$_m[0]]['created']),
					array(
						$html->link('Ver',array('action'=>'ver','admin'=>1,$id)).
						$html->link('Eliminar',array('action'=>'eliminar','admin'=>1,$id),null,'¿Seguro que quiere eliminar este elemento?')
					,array('class'=>'actions'))
				)),array('class'=>'odd'));
			}

	echo
		'</table>',
		$form->submit('Eliminar marcados',array('div'=>'deleteSubmit'));
			
	} else echo $html->para('noresults','No hay elementos para mostrar');
	
	if($items)
		$moo->addEvent('todeleteForm','submit','e.stop(); if(confirm("Se eliminarán los elementos seleccionados. ¿Desea continuar?")){ this.submit(); } ');
	$moo->addEvent('.datagrid tr','click','this.removeProperty("style"); this.toggleClass("selected"); this.getElement(".delete").set("checked",!this.getElement(".delete").get("checked"));',array('css'=>1));
	$moo->addEvent('.datagrid a:not(.id)','click','e.stopPropagation();',array('css'=>1));
?>