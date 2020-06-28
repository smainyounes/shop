<?php 

	/**
	 * 
	 */
	class view_navbar
	{
		private $data;
		private $text;
		function __construct()
		{
			$model = new model_category();
			$this->data = $model->GetAll();

			$this->text = $this->Text();

			if(isset($_SESSION['user'])) {
				$this->Admin();
			}else{
				$this->Guest();
			}

		}

		private function Text()
		{
			switch ($_SESSION['lang']) {
				case 'fr':
					return array('home' => "Accueil",
					 "categories" => "Catégories",
					 "contact" => "Contact",
					 "login" => "Identifier",
					 "all" => "Tout",
					 "lang" => "Langue",
					 "search" => "Chercher");
					break;
				
				case 'ar':
					return array('home' => "الصفحة الرئيسية",
					 "categories" => "اصناف",
					 "contact" => "اتصل",
					 "login" => "دخول",
					 "all" => "الكل",
					 "lang" => "لغة",
					 "search" => "بحث");
					break;

			}
		}

		private function Head()
		{
			?>

			<!doctype html>
			<html lang="<?php echo($_SESSION['lang']) ?>">
			  <head>
			    <!-- Required meta tags -->
			    <meta charset="utf-8">
			    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

			    <!-- logo icon -->
			    <link rel="icon" type="image/png" href="<?php echo(PUBLIC_URL.'img/boxdzlogo.png') ?>" />

			    <!-- Bootstrap CSS -->
			    <link rel="stylesheet" href="<?php echo(PUBLIC_URL) ?>vendor/bootstrap/css/bootstrap.min.css">

			    <!-- slick css -->
			    <link rel="stylesheet" type="text/css" href="<?php echo(PUBLIC_URL) ?>vendor/slick/slick.css">
			    <link rel="stylesheet" type="text/css" href="<?php echo(PUBLIC_URL) ?>vendor/slick/slick-theme.css"/>

			    <!-- font awesome -->
			    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

			    <!-- flag icon -->
			    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

			    <!-- animate css -->
			    <link rel="stylesheet" type="text/css" href="<?php echo(PUBLIC_URL) ?>vendor/animatecss/animate.css">

			    <!-- custom css -->
			    <link rel="stylesheet" href="<?php echo(PUBLIC_URL) ?>css/custom.css">
			    
			    <!-- Wilaya / commune js -->
			    <script src="<?php echo(PUBLIC_URL) ?>vendor/dzayer/dz2.js"></script>

			    <!-- Optional JavaScript -->
			    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
			    <script src="<?php echo(PUBLIC_URL) ?>vendor/jquery/jquery.min.js"></script>
			    <script src="<?php echo(PUBLIC_URL) ?>vendor/slick/slick.min.js"></script>
			    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
			    <script src="<?php echo(PUBLIC_URL) ?>vendor/bootstrap/js/bootstrap.min.js"></script>

			    <title>BoxDZ | Shop</title>
			  </head>
			  <body class="d-flex flex-column bg-light">

			<?php
		}

		private function Search()
		{
			?>

			<div class="container my-4 p-0">
			  <div class="container-fluid">
			    <div class="container">
			      <div class="row">
			        <div class="col-md-4 text-center animated fadeInLeft">
			          <img src="<?php echo(PUBLIC_URL) ?>img/boxdzlogo.png" class="img-fluid">
			        </div>
			        <div class="col-md-8 animated fadeInRight">
			          <form class="w-100 h-100 mt-5" method="GET">
			            
			          	<div class="form-group">
			          	   <div class="input-group input-group-lg" style="max-width: 900px;">
			          	      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="keyword" placeholder="Exemple: something" style="         	         border-radius: 50px 0 0 50px;">
			          	      <div class="input-group-append">
			          	         <button class="input-group-text fas fa-search btn-purp" id="inputGroup-sizing-lg" style="border-radius: 0 50px 50px 0;"></button>
			          	      </div>
			          	   </div>
			          	</div>

			          	<input type="text" name="categ" value="0" hidden>

			          </form>
			        </div>
			      </div>
			    </div>

			  </div>
			</div>


			<div class="container bg-light py-2" id="page-content">

			<?php
		}

		public function Admin()
		{
			$this->Head();

			?>

			<nav class="navbar navbar-expand-md navbar-dark bg-purp shadow fixed-top">
			  <a class="navbar-brand" href="<?php echo(PUBLIC_URL.'product/list') ?>">Admin</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo(PUBLIC_URL.'product/list') ?>">Product List</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo(PUBLIC_URL.'category') ?>">Category List</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo(PUBLIC_URL.'emailsub') ?>">Email List</a>
			      </li>
			      <li class="nav-item dropdown">
			              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                Commande
			              </a>
			              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			                <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'commande') ?>">Tout</a>
			                <div class="dropdown-divider"></div>
			                <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'commande/list/encours') ?>">En Cours</a>
			                <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'commande/list/encharge') ?>">Pris En charge</a>
			                <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'commande/list/delivrer') ?>">Delivrer</a>
			                <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'commande/list/annuler') ?>">Annuler</a>
			              </div>
			            </li>
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo(PUBLIC_URL.'settings') ?>">Settings</a>
			      </li>
			      <li class="nav-item">
			        <a href="<?php echo(PUBLIC_URL.'dc') ?>" class="btn btn-secondary">Logout</a>
			      </li>
			    </ul>
			  </div>
			</nav>

			<?php

			$this->Search();
		}

		public function Guest()
		{
			$basket = new view_basket();
			$this->Head();

			$data = $this->data;
			?>

			<nav class="navbar navbar-expand-md navbar-dark bg-purp shadow fixed-top">
			  <div >
			  	<div class="nav-item dropdown ml-auto mob" id="cart">
			  		<?php $basket->Basket(); ?>
			  	</div>
			  </div>
			  <a class="navbar-brand" href="<?php echo(PUBLIC_URL) ?>">BoxDz-Shop</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item">
			        <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>"><?php echo $this->text['home']; ?></a>
			      </li>
			      <li class="nav-item dropdown ">
			              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                <?php echo $this->text['categories']; ?>
			              </a>
			              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			                <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'product/search/1/0'); ?>"><?php echo $this->text['all']; ?></a>
			                <?php if($data): ?>
			                  <?php foreach($data as $categ): ?>
			                <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'product/search/1/'.$categ->id_category); ?>"><?php echo $categ->nom_category; ?></a>
			                  <?php endforeach; ?>
			                <?php endif; ?>
			              </div>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#contact"><?php echo $this->text['contact']; ?></a>
			      </li>
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo $this->text['lang']; ?></a>
			        <div class="dropdown-menu text-center dropdown-menu-right" aria-labelledby="dropdown09">
			            <a class="dropdown-item" href="?lang=ar"><span class="flag-icon flag-icon-dz"> </span>  عربية</a>
			            <a class="dropdown-item" href="?lang=fr"><span class="flag-icon flag-icon-fr"> </span> Français</a>
			            
			        </div>
			      </li>
			      <li class="nav-item dropdown desk" id="cart">
			      	<?php $basket->Basket(); ?>
			      </li>
			      <li class="nav-item">
			        <a href="<?php echo(PUBLIC_URL.'login') ?>" class="btn btn-outline-secondary"><?php echo $this->text['login']; ?> <i class="fas fa-sign-in-alt"></i></a>
			      </li>
			    </ul>
			  </div>
			</nav>

			<?php
			$basket->BasketModal();
			$this->Search();
		}

	}

 ?>