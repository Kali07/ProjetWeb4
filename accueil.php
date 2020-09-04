 
    <?php include("header.php") ?>
    <?php 
    require("connexionBDD.php");
    $object = $db->query ('SELECT * FROM  Objectd WHERE statut_objet = "valide" ORDER BY id_object');   
    ?>


   
    <section>
    <link rel="stylesheet" type="text/css" href="css/accueil.css">
      <h2>Tout les articles </h2>
    <div class="container">
      <div class="row">
      <?php
      while($tobje = $object->fetch())
        {
            ?>
        <article class="col-4">
       
 
        
          <div class="card mb-4 shadow-sm">
            <div class="img-fluid card-image">
              <img src="<?=$tobje['photo1']?>" alt="">
            </div>
            <div class="card-header">
              <h4 class="my-0 font-weight-normal"><?=$tobje['titre']?></h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title"><?=$tobje['prix']?> €</h1>
              <p>Description</p>
              <p> </p>
              <a href="produit.php?id=<?=$tobje['id_object']?>" class="btn btn-lg btn-block btn-outline-primary">
              Voir
              </a>
            </div>
          </div>

        </article>
        <?php
        }
        $object->closeCursor();
        ?>
      </div>
  </div>
    </section>

    <?php include("footer.php") ?>
