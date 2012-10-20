<?php
$cart_items = $this->Session->read('cart.items');fb($cart_items,'$cart_items');
$cart_total = $qty = 0;

echo
	$html->div('cart_wrapper'),
		$html->div('pad'),
			$html->div('cart'),
				#----
				$html->tag('ul',null,array('id'=>'cart_recent'));

					foreach ($cart_items as $item) {
						$qty+= $item['qty'];
						$cart_total+= $item['qty']*(empty($item['Type']['precio']) ? $item['Product']['precio'] : $item['Type']['precio']);

						echo $this->element('th_cart',compact('item'));
					}

				echo '</ul>',
				$html->div('clear totals'),
					$html->para('cart_amount','$'.$html->tag('span',number_format($cart_total,2),array('id'=>'cart_amount'))),
					$html->para('cart_qty',$html->tag('span',$qty,array('id'=>'cart_qty')).' elementos'),
				'</div>',
				$html->link('Ver Carrito',array('controller'=>'products','action'=>'checkout'),array('class'=>'view_cart')),
				#----
			'</div>',
		'</div>',
	'</div>';
?>