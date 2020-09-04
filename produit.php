<?php 
include("header.php");
require("connexionBDD.php");

$id_object = addslashes($_GET['id']);

//Pour reconnaitre l'objet sur lequel on traite avec le vendeur
$_SESSION['idobjvendu'] = $id_object;
//requette pour acceder a un produit dont l'id est passé en paramettre
$requete = $db->query("SELECT * FROM objectd ob, membre mb where ob.id_object = $id_object  
                        AND mb.id_membre = ob.ref_id_membre");
$object= $requete->fetch(); 
?>

      
<!-- ------------------------------debut page boutique----------------------------- -->
<section>
<link rel="stylesheet" type="text/css" href="css/produit.css">

<section class="container-fluid" style="margin: 0 0 5% 0;">

    <div class="row-haut-page">

      <div class="div-gauche-imgs col-xl-9 col-lg-12">

          <aside class="aside-miniatures"><!--Les miniatures -->
            <a href="#"><img class="img-thumbnail minia " src="<?=$object['photo1']?>"></a>
            <a href="#"><img class="img-thumbnail minia " src="<?=$object['photo2']?>"></a>
            <a href="#"><img class="img-thumbnail minia " src="<?=$object['photo3']?>"></a>
          </aside>


        <aside class="aside-img-main"><!-- L'image Principale -->
          <img class="imgPrincipale img-fluid " src="<?=$object['photo1']?>">
        </aside>
      </div>
      <article class="descriptionCourte"> <!-- Description + Prix a droite de l'image -->
        <h2 class="status"> <?=$object['titre']?> </h2>
        <div>
          <p style="text-decoration: underline; display: inline-block; margin-right: 0.5rem; ">
            Besoins de plus de details ?
          </p>

          <button class="btn btn-primary" style="margin-bottom: 2rem;">
           Prendre rendez-vous
        </button>

        </div>
        <div class="statusTitreReference">
          <h1 class="h1-title"><?=$object['prix']?> € </h1>
        </div>

    </article>

  </div>

  <hr>

  <div class="container-page">
    <article class="partie-gauche">

      <aside class="description">
        <h2> Description </h2>
        <div>
          <p> <?=$object['description_object']?></p>
        </div>
      </aside>

      <hr>
      <aside class="caracteristiques">
        <h2>Caracteristiques</h2>
        <ul>
          <li><?=$object['caracteristiques']?></li>
         </ul>
      </aside>

      <hr>
      <aside class="techniques">
        <div>
        </div>
      </aside>
      <hr>

    </article>

    <section class="partie-droite">

      <aside class="visit-aside">
        <div class="visite-part-up">
          <div class="div-agent_immobilier">
            <img src="img/avatar_vendeur.png" alt="">
          </div>
          <div class="div-visite">
            <h2>Vous êtes intéressé ?</h2>
            <p>Contactez le vendeur </p>
            <div class="div-address">
                <div class="div-icon-map2">
                  <svg height="50" width="50" viewBox="0 0 54.757 54.757"><use xlink:href="/assets/images/icons/map2.svg#map2" /></svg>
                </div>
              <ul class="ul-address">
                <li> 3 rue du vendeur </li>
                <li> <?=rand(77000, 95000)?></li>
                <li> En Ile De France </li>
              </ul>
            </div>
          </div>
        </div>
        <hr>
        <div class="visite-part-down">
          <p class="page-agence">Page Membre  <span class="block-icon icon-next"><svg height="50" width="50" viewBox="0 0 477.175 477.175"><use xlink:href="/assets/images/icons/next.svg#next" /></svg>
              </span></p>
          <p class="numero-tel"><?=$object['email']?></p>
          <?php
          if(isset($_SESSION['id_membre']))
          {
            ?>
        <div class="contact-us">
        <!--essaie Messagerie -->
            <a href="message.php?idvendeur=<?=$object['id_membre']?> &idacheteur=<?=$_SESSION['id_membre'] ?>" class="btn btn-contact" >Contacter</a>
        </div>
         <?php
          }
          ?>

        </div>
      </aside>

    </section>
  </div>

</section>
</section>


<?php include("footer.php") ?>