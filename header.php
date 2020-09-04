<html lang="fr">
<?php session_start(); ?>

  <head>
    <meta charset="utf-8">
    <title>KaliCora</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    
  </head>

  <body>

<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">KaliCora</h5>
  <nav class="my-2 my-md-0 mr-md-3">
  <?php
  $statut = null;
  if( isset($_SESSION['id_membre']) ){
  $statut = $_SESSION['statut']; ?> 
  <a class="p-2 text-dark" href="accueil.php"><strong>Bienvenu  <?=$_SESSION['nom']?></strong></a> 

  <?php } ?>
  <a class="p-2 text-dark" href="accueil.php">Accueil</a>

  <?php if( $statut == 'membre') { ?>
    <a class="p-2 text-dark" href="messageperso.php">Messages</a> 
  <a style = "color : white" class="mr-2 btn btn-primary" href="profil.php">Mon compte</a> 
  <a class="btn btn-outline-danger" href="deconnexion.php">Deconnexion</a>
  
  <?php } else if ($statut == 'admin') { ?> 
  <a class="p-2 btn btn-primary" href="admin.php">Administration</a>
  <a class="btn btn-outline-danger" href="deconnexion.php">Deconnexion</a>

  <?php } else { ?>
  <a style = "color : white" class="mr-2 btn btn-primary" href="register.php">Créer Compte</a> 
  <a class="btn btn-outline-primary" href="login.php">Connexion</a>

  <?php } ?>
  </nav>
  
</header>