-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `forma_pago` varchar(255) NOT NULL,
  `hab` int(11) DEFAULT NULL,
  `num_personas` int(11) DEFAULT NULL,
  `opcion` varchar(255) DEFAULT NULL,
  `arrival` date DEFAULT NULL,
  `retorno` date DEFAULT NULL,
  `taxi_arribo` date DEFAULT NULL,
  `taxi_num_vuelo` varchar(255) DEFAULT NULL,
  `taxi_linea_aerea` varchar(255) DEFAULT NULL,
  `taxi_hab` int(11) DEFAULT NULL,
  `taxi_adicionales` int(11) DEFAULT NULL,
  `taxi_nombre_hotel` varchar(255) DEFAULT NULL,
  `taxi_direccion_hotel` varchar(255) DEFAULT NULL,
  `opc_16` tinyint(1) DEFAULT NULL,
  `opc_15` tinyint(1) DEFAULT NULL,
  `opc_13` tinyint(1) DEFAULT NULL,
  `opc_12` tinyint(1) DEFAULT NULL,
  `opc_11` tinyint(1) DEFAULT NULL,
  `opc_10` tinyint(1) DEFAULT NULL,
  `opc_9` tinyint(1) DEFAULT NULL,
  `havana_arrival` date DEFAULT NULL,
  `havana_days` int(11) DEFAULT NULL,
  `pinar_del_rio_arrival` date DEFAULT NULL,
  `pinar_del_rio_days` int(11) DEFAULT NULL,
  `cienfuegos_arrival` date DEFAULT NULL,
  `cienfuegos_days` int(11) DEFAULT NULL,
  `trinidad_arrival` date DEFAULT NULL,
  `trinidad_days` int(11) DEFAULT NULL,
  `santa_clara_arrival` date DEFAULT NULL,
  `santa_clara_days` int(11) DEFAULT NULL,
  `camaguey_arrival` date DEFAULT NULL,
  `camaguey_days` int(11) DEFAULT NULL,
  `baracoa_arrival` date DEFAULT NULL,
  `baracoa_days` int(11) DEFAULT NULL,
  `bayamo_arrival` date DEFAULT NULL,
  `bayamo_days` int(11) DEFAULT NULL,
  `santiago_de_cuba_arrival` date DEFAULT NULL,
  `santiago_de_cuba_days` int(11) DEFAULT NULL,
  `havana_arrival2` date DEFAULT NULL,
  `havana_days2` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2012-11-07 16:20:27
