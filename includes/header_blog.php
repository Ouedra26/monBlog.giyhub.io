<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
  <!-- Logo du site -->
  <link rel="shortcut icon" href="../modelisationBDD/img/logo.jpg">
  
  <!-- Ma feuille de styles -->
  <link rel="stylesheet" href="../modelisationBDD/css/blog.css">

  <title><?=$titre;?></title>
    
  </head>
  <body id="accueil">

  <!-- HEADER -->
  <header>
   <div class="row col-12">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <!-- NAV -->
        <nav class="navbar navbar-expand-lg p-5">
        <div class="container-fluid ">
          <a class="navbar-brand blog" href="#">Modelisation de la BDD</a>
          <button class="navbar-toggler text-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
              <li class="nav-item <?php if ($nav === 'accueil'): ?>active<?php endif; ?>">
                <a class="nav-link" href="accueil.php">Accueil</a>
              </li>
              <li class="nav-item <?php if ($nav === 'articles'): ?>active<?php endif; ?>">
                <a class="nav-link" href="articles.php">Les articles</a>
              </li>
              <li class="nav-item <?php if ($nav === 'article'): ?>active<?php endif; ?>">
                <a class="nav-link" href="article.php">Article</a>
              </li>
              <li class="nav-item <?php if ($nav === 'contact'): ?>active<?php endif; ?>">
                <a class="nav-link" href="#contact">Contact</a>
              </li>
            </ul>
          </div>
        </div>
        </nav>
        <!-- FIN NAV --> 
      </div>
      <!-- FIN COL -->
   </div>
    <!--FIN ROW  -->
</header>
<!-- FIN HEADER -->