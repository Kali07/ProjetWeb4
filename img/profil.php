<?php 
include("header.php") ; ?>

<?php 
require("connexionBDD.php");
$id_membre = $_SESSION['id_membre'];
$requete = $db->query("SELECT * FROM objectd where ref_id_membre = $id_membre ORDER BY id_object ");

if(isset($_FILES['photo1']) and !empty($_POST['titre']) and !empty($_POST['prix']) and !empty($_POST['description_object']) 
and !empty($_POST['caracteristiques']) ){
    //echo 'rentrer';

    //initialisation de l'erreur liée au telechargement du fichier	
    $erreur=$_FILES['photo1']['error'];


    //$erreur2=$_FILES['photo2']['error'];
    //$erreur3=$_FILES['photo3']['error'];

    //on recupere le nom original du fichier en lui meme
    $image1= $_FILES['photo1']['name'];
    //dossier temporaire dans lequel on va mettre notre fichier pendant le traitement
    $tmp=$_FILES['photo1']['tmp_name'];

    //dossier dans lequel on va stoquer l'image
    $chemin='/img ';
    //pour aller verifier s'il existe deja dans le dossier de destination 
    $retour =  'img/'.$image1;


    /*$retour2 = 'img/'.$_FILES['photo1']['name'];
    $retour3 = 'img/'.$_FILES['photo1']['name'];*/

    $titre= addslashes($_POST['titre']);
    $prix = addslashes($_POST['prix']);
    $description = addslashes($_POST['description_object']);
    $caracteristiques = addslashes($_POST['caracteristiques']);


    if($erreur == UPLOAD_ERR_OK) //pas d'erreur lors du chargement
    {
        //le file est initialement dans tmp le temps de faire les verifications etc ... 
	move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'].'/Workshop3/'.$chemin.'/'.$image1);
	$verif=$db->query('SELECT photo1 FROM Objectd WHERE photo1 ="'.$retour.'"');
	    if($verif->fetch())
	    {
		    $msg="Ce fichier que vous voulez charger existe deja dans la base";
		    echo $msg;
	    }
	    elseif(!$verif->fetch())
	    {

            $client= $db->query(" INSERT INTO objectd(titre,prix,description_object,caracteristiques,ref_id_membre,photo1) 
                            VALUES ('$titre','$prix','$description','$caracteristiques',$id_membre,'$retour')  ") ;

	        $msg="Votre enregistrement a bien été effectué";
	        echo $msg;
	
        }

    }
    header("Refresh:0");
}
?>

<section class="container-fluid p-5">
    <div class="row">
    <aside class="col-6">
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Titre </th>
            <th scope="col">Prix </th>
            <th scope="col">Statut </th>
            <th scope="col"> Action </th> 
            </tr>
        </thead>
        <tbody>
        <?php while($objet = $requete->fetch()){  ?>
            <tr>
            <td><?=$objet['titre']?></td>
            <td><?=$objet['prix']?> € </td>
            <td><?=$objet['statut_objet']?> </td>
            <td>
                <a href="produit.php?id=<?=$objet['id_object']?>" class="btn btn-primary">Voir</a>
                <!-- BOUTON SUPPRIMER AJAX -->
                <script src="deleteAjax.js" async></script>
                <?php 
                $url = "http://". $_SERVER['HTTP_HOST'] ."/workshop3"."/deleteObject.php?id=".$objet['id_object']."&membre=".$objet['ref_id_membre'];
                echo "<a onclick='goTo(`$url`)' class='btn btn-danger'>Supprimer</a>";
                ?>
            <td>
            </tr>
            <?php
                }
                $requete->closeCursor();
                ?>
        </tbody>
        </table>
    </aside>

    <aside class="col-6">
        <div class="row">
            <div class="col-md-10 order-md-2 mb-4">
            <h4 class="mb-3">Ajouter un Objet</h4>
            <form method = "POST"  action ="profil.php" enctype="multipart/form-data" >
                <div class="row">
                    <div class="mb-3 col-6">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" placeholder="Guitare électrique" required>
                </div>

                <div class="mb-3 col-6">
                    <label for="prix">Prix en €</label>
                    <input type="number" class="form-control" id="prix" name="prix" placeholder="85" required>
                </div>
                
                </div>

                <div class="mb-3 ">
                    <label for="caract">Caracteristiques</label>
                    <input type="text" class="form-control" id="caract" name="caracteristiques" placeholder="rouge,bois,5 cordes,3 kilos" required>
                </div>

                <div class="mb-3">
                    <label for="desc">Description</label>
                    <textarea class="form-control" id="desc"  placeholder="Description de votre produit" name="description_object" rows="4"></textarea>
                </div>
                <div class="mb-3">
                <label for="desc">Images</label>
                <div class="custom-file">
                    <input type="file" name="photo1" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choisir l'image 1 *</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
             </div>
                </div>
                <div class="mb-3">
             <div class="custom-file">
                    <input type="file" name="photo2" class="custom-file-input" id="validatedCustomFile" >
                    <label class="custom-file-label" for="validatedCustomFile">Choisir l'image 2</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
             </div>
                </div>
             <div class="custom-file">
                    <input type="file" name="photo3" class="custom-file-input" id="validatedCustomFile" >
                    <label class="custom-file-label" for="validatedCustomFile">Choisir l'image 3</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
             </div>

                <hr class="mb-4">
                <button class="btn btn-success btn-lg btn-block" type="submit">Ajouter</button>
            </form>
            </div>
        </div>
    </aside>
    </div>   
   
</section>

<?php include("footer.php"); ?>