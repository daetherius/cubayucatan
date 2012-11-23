ALTER TABLE `orders` ADD `taxi_hora` time NULL AFTER `taxi_arribo`;
ALTER TABLE `orders` CHANGE `taxi_adicionales` `taxi_hab_arribo` date NULL AFTER `taxi_hab`;