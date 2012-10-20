<?php
App::import('Controller','_base/Items');
class TestimonialsController extends ItemsController{
	var $name = 'Testimonials';
	var $uses = array('Testimonial');
}
?>