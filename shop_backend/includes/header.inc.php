<?php 

  $model = new model_category();
  $data = $model->GetAll();
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo(PUBLIC_URL) ?>vendor/bootstrap/css/bootstrap.min.css">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="<?php echo(PUBLIC_URL) ?>vendor/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PUBLIC_URL) ?>vendor/slick/slick-theme.css"/>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="<?php echo(PUBLIC_URL) ?>vendor/animatecss/animate.css">

    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo(PUBLIC_URL) ?>css/custom.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo(PUBLIC_URL) ?>vendor/jquery/jquery.slim.min.js"></script>
    <script src="<?php echo(PUBLIC_URL) ?>vendor/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?php echo(PUBLIC_URL) ?>vendor/bootstrap/js/bootstrap.min.js"></script>

    <title>BoxDZ | Shop</title>
  </head>
  <body class="d-flex flex-column bg-secondary">
    <?php if(isset($_SESSION['user'])): ?>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow">
      <a class="navbar-brand" href="listprod.html">Admin</a>
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
            <a class="nav-link" href="<?php echo(PUBLIC_URL.'settings') ?>">Settings</a>
          </li>
          <li class="nav-item">
            <a href="index.html" class="btn btn-secondary">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <?php else: ?>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow">
        <a class="navbar-brand" href="index.html">BoxDz-Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>">Home</a>
            </li>
            <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'product/search/0'); ?>">Tout</a>
                      <?php if($data): ?>
                        <?php foreach($data as $categ): ?>
                      <a class="dropdown-item" href="<?php echo(PUBLIC_URL.'product/search/'.$categ->id_category); ?>"><?php echo $categ->nom_category; ?></a>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo(PUBLIC_URL.'login') ?>" class="btn btn-secondary">Login</a>
            </li>
          </ul>
        </div>
      </nav>
    <?php endif; ?>
    <div class="container p-0 search">
      <div class="container-fluid" style="background: linear-gradient(rgba(0,0,0,.2), rgba(0,0,0,.8));">
        <div class="container">
          <div class="row">
            <div class="col-md-4 text-center animated fadeInLeft">
              <img src="<?php echo(PUBLIC_URL) ?>img/boxdzlogo.png" class="img-fluid">
            </div>
            <div class="col-md-8 animated fadeInRight">
              <form class="w-100 h-100 d-flex align-items-center justify-content-center" method="GET">
                <div class="form-group">
                  <div class="input-group input-group-lg" style="max-width: 900px;">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="keyword" placeholder="Exemple: something">
                    <div class="input-group-append">
                      <span class="input-group-text fas fa-search" id="inputGroup-sizing-lg"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group mx-2">
                  <select name="categ" class="form-control form-control-lg">
                    <option value="0" selected>Tout</option>
                    <?php if($data): ?>
                      <?php foreach($data as $categ): ?>
                    <option value="<?php echo($categ->id_category) ?>"><?php echo $categ->nom_category; ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-lg">Search</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>


    <div class="container shadow bg-light py-2" id="page-content">