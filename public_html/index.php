<?php 
	
	// include autoloader
	include '../shop_backend/includes/autoloader.inc.php';

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['keyword']) || isset($_GET['categ'])) {
			header("Location: ".PUBLIC_URL."product/search/".urlencode($_GET['categ'])."/".urlencode($_GET['keyword']));
		}
	}

	// init core class
	new lib_core;

 ?>