RENAME TABLE `reservations` to `orders`;
ALTER TABLE `orders`
CHANGE `forma_pago` `forma_pago` enum('deposito','online') COLLATE 'utf8_general_ci' NOT NULL AFTER `email`,
COMMENT='';