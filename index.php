<?php
	require_once('config.php');
	require('interfaces/page.interface.php');
	
	set_include_path('classes/'.PATH_SEPARATOR.'interfaces/'.PATH_SEPARATOR.'modules/');
	spl_autoload_extensions('.class.php,.interface.class.php');
	spl_autoload_register();
	
	$site = new webschool;
	echo $site->invoke();
?>