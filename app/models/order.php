<?php
class Order extends AppModel {
	var $name = 'Order';
	var $labels = array(
		'forma_pago'=>'Forma de pago',
		'hab'=>'Habitaciones Dobles',
		'num_personas'=>'Número de personas',
		'opcion'=>'Opción de paquete',
		'arrival'=>'Fecha inicio de ocupación',
		'retorno'=>'Fecha fin de ocupación',
		'taxi_arribo'=>'',
		'taxi_num_vuelo'=>'',
		'taxi_linea_aerea'=>'',
		'taxi_hab'=>'',
		'taxi_adicionales'=>'',
		'taxi_nombre_hotel'=>'',
		'taxi_direccion_hotel'=>'',
		'opc_16'=>'Comunidad Maya Ek Balam',
		'opc_15'=>'Ek Balam',
		'opc_13'=>'Chichen Itzá',
		'opc_12'=>'Izamal',
		'opc_11'=>'Solferino',
		'opc_10'=>'Mérida',
		'opc_9'=>'Coba',
		'havana_arrival'=>'Llegada a La Havana',
		'havana_days'=>'Duración',
		'pinar_del_rio_arrival'=>'Llegada a Pinar del Río',
		'pinar_del_rio_days'=>'Duración',
		'cienfuegos_arrival'=>'Llegada a Cienfuegos',
		'cienfuegos_days'=>'Duración',
		'trinidad_arrival'=>'Llegada a Trinidad',
		'trinidad_days'=>'Duración',
		'santa_clara_arrival'=>'Llegada a Santa Clara',
		'santa_clara_days'=>'Duración',
		'camaguey_arrival'=>'Llegada a Camaguey',
		'camaguey_days'=>'Duración',
		'baracoa_arrival'=>'Llegada a Baracoa',
		'baracoa_days'=>'Duración',
		'bayamo_arrival'=>'Llegada a Bayamo',
		'bayamo_days'=>'Duración',
		'santiago_de_cuba_arrival'=>'Llegada a Santiago de Cuba',
		'santiago_de_cuba_days'=>'Duración',
		'havana_arrival2'=>'Llegada a La Havana (regreso)',
		'havana_days2'=>'Duración',
		''=>'',
	);
	var $skipValidation = array();
	var $validate = array(
		//'arrival'=>arrival || *_arrival
		//'hab'=>hab || num_personas
		//'total_num_days'=>
		'email'=>array('rule'=>'email', 'allowEmpty'=>false, 'message'=>'Ingrese una dirección de correo electrónico válida.'),
		'nombre'=>array('rule'=>array('between', 1,255), 'allowEmpty'=>false, 'message'=>'Ingrese un texto entre 1 y 255 caracteres de longitud.'),
		'apellidos'=>array('rule'=>array('between', 1,255), 'allowEmpty'=>false, 'message'=>'Ingrese un texto entre 1 y 255 caracteres de longitud.'),
	);
}
?>