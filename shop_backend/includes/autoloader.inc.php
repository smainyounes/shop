<?php 

	// public link (after hosting remove the /voyage/public_html)
	define("PUBLIC_URL", "http://$_SERVER[HTTP_HOST]/shop/public_html/");

	// backend link
	define("BACKEND_URL", dirname(dirname(dirname(__FILE__)))."/shop_backend/");

	// include helpers.php
	include BACKEND_URL."/helpers/helpers.php";

	// starting session
	session_start();

	// defining autoloader function
	spl_autoload_register("myloader");

	function myloader($class_name) 
	{
	    $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.class.php';

	    $file = BACKEND_URL.$filename;

	    if ( ! file_exists($file))
	    {
	        return FALSE;
	    }
	    include $file;
	}
?>