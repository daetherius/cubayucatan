<?php
class DATABASE_CONFIG {
	var $default = array();
	var $test = array();
	var $dbless = false;
	
	var $local = array(
		'driver' => 'mysql',
		'connect' => 'mysql_connect',
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'toor',
		'database' => 'cubayucatan',
		'prefix' => '',
		'encoding' => 'UTF8'
	);

	var $demo = array(
		'driver' => 'mysql',
		'connect' => 'mysql_connect',
		'host' => '10.33.143.26',
		'login' => 'pulsemmx_standar',	
		'password' => 'JET^e!N@MZ1U',
		'database' => 'pulsemmx_cubayucatan',
		'prefix' => '',
		'encoding' => 'UTF8'
	);

	var $live = array(
		'driver' => 'mysql',
		'connect' => 'mysql_connect',
		'host' => '10.33.143.26',
		'login' => '_USER__standar',
		'password' => '',
		'database' => '_USER__site',
		'prefix' => '',
		'encoding' => 'UTF8'
	);

	#switch between configs
	function __construct() {
		if($this->dbless){
			$this->default = array('driver' => 'nodatabase');
		} else {
			$mode = strpos($_SERVER['SERVER_NAME'],'.')===false ? 'local':(strpos($_SERVER['SERVER_NAME'],'pulsem')===false ? 'live' : 'demo');
			$this->default = $this->{$mode};
		}
	}

	#php 4 compatibility
	function DATABASE_CONFIG() { $this->__construct(); }
}
?>