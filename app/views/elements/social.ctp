<?php
echo
	$html->div('social clear'),
		$html->link('twitter',Configure::read('Site.tw'),array('target'=>'_blank','rel'=>'nofollow')),
		$html->link('facebook',Configure::read('Site.fb'),array('target'=>'_blank','rel'=>'nofollow','class'=>'facebook')),
		$html->link('youtube',Configure::read('Site.yt'),array('target'=>'_blank','rel'=>'nofollow')),
		$html->link('skype',Configure::read('Site.sk'),array('target'=>'_blank','rel'=>'nofollow')),
	'</div>';
?>