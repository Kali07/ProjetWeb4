<?php 
include("header.php") ;

require("connexionBDD.php");


if(isset($_POST['email']) and isset($_POST['mdp']))
{
  echo'<h3> je suis en php  </h3>';
  $log = $_POST['email'];
  $mdp = hash('sha256',$_POST['mdp']); 
  //hash('sha256',$_POST['mdp']));

  echo $log;
  
  if(!empty($log) and !empty($mdp))
  {
    $req = $db->prepare("SELECT * FROM Membre WHERE email=:email AND mdp =:mdp");
    $req->execute(array(':email'=>$log,
                        ':mdp'=>$mdp));
    $find = $req->fetch();
    if($find)
    {
      echo'<h1> correct </h1>';
     // session_start();
      $_SESSION['id_membre'] = $find['id_membre'];
      $_SESSION['nom'] = $find['prenom'];
      $_SESSION['statut'] = $find['statut'];
      header('Location: accueil.php');
    }
    else
    {
      echo '<h4> Identifiant ou mot de passe incorrect </h4>';
    }
  }

}



?>
<section class="container">
<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="mb-3">Connection</h4>
      <form method = "POST"  action ="login.php" >
        <div class="row">

        <div class="mb-3">
          <label for="email">Votre mail</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="email" name="email" class="form-control" id="email" placeholder="votremail@exemple.com" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="mdp">Mot de passe</label>
          <input type="password" name="mdp" class="form-control" id="mdp" placeholder="*********" required>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Se connecter</button>
      </form>

    </div>
  </div>

</section>

  <?php include("footer.php") ?>