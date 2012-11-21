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
		'nombre'=>array('rule'=>array('between', 1,255), 'allowEmpty'=>false, 'message'=>'Este campo no puede quedar vacío.'),
		'apellidos'=>array('rule'=>array('between', 1,255), 'allowEmpty'=>false, 'message'=>'Este campo no puede quedar vacío.'),
		'email'=>array('rule'=>'email', 'allowEmpty'=>false, 'message'=>'Ingrese una dirección de correo electrónico válida.'),
		'confirma_email'=>array(
			'indentical'=>array('rule'=>'confirma_email','message'=>'Escriba de nuevo su correo electrónico.'),
			'notEmpty'=>array('rule'=>'notEmpty', 'allowEmpty'=>false, 'message'=>'Este campo no puede quedar vacío.')
		),

		'hab'=>array('rule'=>'notEmpty','allowEmpty'=>false,'message'=>'Indique el número de habitaciones.'),
		'num_personas'=>array('rule'=>'notEmpty','allowEmpty'=>false,'message'=>'Indique el número de personas.'),
		'arrival'=>array('rule'=>'check_arrival','message'=>'Indique su fecha de llegada (dd-mm-aa).'),
		'havana_days'=>array('rule'=>'total_days','allowEmpty'=>false,'message'=>'Indique el número de días.'),

		'taxi_arribo'=>array('rule'=>'taxi_arribo','message'=>'Ingrese una fecha con el formato (dd-mm-aa).'),
		'taxi_num_vuelo'=>array('rule'=>'notEmpty', 'allowEmpty'=>false, 'message'=>'Este campo no puede quedar vacío.'),
		'taxi_linea_aerea'=>array('rule'=>'notEmpty', 'allowEmpty'=>false, 'message'=>'Este campo no puede quedar vacío.'),
	);

	function confirma_email(){ return (!empty($this->data['Order']['confirma_email'])) && $this->data['Order']['confirma_email'] == $this->data['Order']['email']; }
	function check_arrival(){
		if($this->data['Order']['pack_id'] == 4){
			unset($this->data['Order']['arrival']);

			$arrival = strtotime($this->data['Order']['havana_arrival']);
			$leaving = strtotime($this->data['Order']['havana_arrival2']);

			if(!$arrival){
				$this->invalidate('havana_arrival','Indique una fecha de llegada.');
			}

			if(!$leaving){
				$this->invalidate('havana_arrival2','Indique una fecha de partida.');
			}

			if($arrival >= $leaving){
				$msg = 'La fecha de llegada y de partida no son válidas.';
				$this->invalidate('havana_arrival',$msg);
				$this->invalidate('havana_arrival2',$msg);
			}

			foreach ($this->data['Order'] as $key => $value) {
				if((!empty($value)) && strpos($key, '_arrival') !== false){ //Fecha especificada
					$date2time = strtotime($value);
					if($date2time !== false){

						if($date2time < $arrival)
							$this->invalidate($key,'La fecha no puede ser anterior a la fecha de llegada.');

						if($date2time > $leaving)
							$this->invalidate($key,'La fecha no puede ser posterior a la fecha de partida.');
					}
				}
			}
			return true;

		} else {
			return (!empty($this->data['Order']['arrival'])) && strtotime($this->data['Order']['arrival']);
		}
	}

	function total_days(){
		$total_days = 0;
		$days_fields = array();
		if($this->data['Order']['havana_days'] < 1) return false;

		foreach ($this->data['Order'] as $key => $value) {
			if(strpos($key, '_days') !== false){
				$days_fields[] = $key;
				if($value !== '')
					$total_days+= (int)$value;
			}
		}

		return true;
	}
	
	function taxi_arribo(){
		if($this->data['Order']['pack_id'] < 5 && empty($this->data['Order']['taxi_arribo']))
			return false;

		return true;
	}
}
?>