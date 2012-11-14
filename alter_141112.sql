ALTER TABLE `orders`
ADD `amt` decimal(10,2) NOT NULL AFTER `forma_pago`,
COMMENT='';