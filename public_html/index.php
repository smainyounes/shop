<?php 
	
	// include autoloader
	include '../shop_backend/includes/autoloader.inc.php';

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['keyword']) || isset($_GET['categ'])) {
			header("Location: ".PUBLIC_URL."product/search/1/".urlencode($_GET['categ'])."/".urlencode($_GET['keyword']));
		}
	}

	// init lang
	new lib_lang();

	// checking language
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['lang'])) {
			new lib_lang($_GET['lang']);
		}
	}

	// init core class
	new lib_core;

 ?>