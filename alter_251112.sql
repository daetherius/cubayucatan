ALTER TABLE `orders` ADD `con_cena` TINYINT( 1 ) NULL DEFAULT '0' AFTER `opc_9`;
ALTER TABLE `orders` ADD `opcion_al_llegada` ENUM( 'no', 'si', 'si_independiente' ) NULL DEFAULT NULL AFTER `retorno`;