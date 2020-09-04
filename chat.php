<?php 
include("header.php"); 
require("connexionBDD.php");


if (isset($_GET['id']))
{
    //pour ne pas tuer la variable a chaque rechargement (je la stocke dans une variable de session)
    $_SESSION['idreponse'] = $_GET['id']; //id de la personne à qui je vais repondre

}
//echo $_SESSION['idreponse'];
$idreponse = $_SESSION['idreponse'];
$proprio = $_SESSION['id_membre'];


//requete pour recuperer les donnees du chat coté vendeur (voir uniquement les messages des gens qui m'ont ecrit)
$chatvendeur = $db->query("SELECT * FROM messages where id_receveur = $proprio  
                        AND id_envoyeur = $idreponse OR id_envoyeur = $proprio AND id_receveur = $idreponse ORDER BY date_message ASC "); // pour voir tes messages et ses messages


if (isset($_POST['reponse']) AND !empty($_POST['reponse']))
{

    $reponse = addslashes($_POST['reponse']) ;
    $rep = $db->query("INSERT INTO messages (id_envoyeur,id_receveur,message_,date_message) VALUES ('$proprio','$idreponse','$reponse', NOW() )") ;
    //echo'Message reçu';
    header("Refresh:0");
   

} 

?>
<html>
<section class="container-fluid p-5">
<aside class="col-5">
<?php while($chatrecu = $chatvendeur->fetch()){  
    //var_dump($chatrecu);
    ?>
<?php
    if($chatrecu['id_envoyeur'] == $proprio)
    {
    ?>
<div class="alert alert-secondary" role="alert">
<?=$chatrecu['message_']?>
<?php
    }
    else
    {
        ?>
        <div class="alert alert-primary" role="alert">
  <?=$chatrecu['message_']?>
</div>
<?php
    }
    ?>
</div>
<?php
    }
    $chatvendeur->closeCursor();
    ?>
<form method = "POST"  action ="chat.php">
<div class="mb-1">
    <textarea class="form-control" id="desc"  placeholder="Tapez ..." name="reponse" rows="2"></textarea>
</div>
<button class="btn btn-success btn-lg btn-block" type="submit">Envoyer</button>
</form>
</aside>
</section>
</html>