<?php 
include("header.php") ; ?>

<?php 
require("connexionBDD.php");
$id_membre = $_SESSION['id_membre'];
$requete = $db->query("SELECT * FROM objectd where ref_id_membre = $id_membre ORDER BY id_object ");

function registerFiles ($photos){
    $tableau = ['',''];
    foreach ($photos as $photo) {
        $tableau[0] .=  ",$photo" ;
        if(isset($_FILES[$photo]) && $_FILES[$photo]["error"] == 0){
          $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png"];
          $filename = $_FILES[$photo]["name"]; //Nom original + temps en milliseconde
          $filetype = $_FILES[$photo]["type"];
      
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");
      
             // Vérifie le type MIME du fichier
             if(in_array($filetype, $allowed)){
                 $new_name = round(microtime(true)) . $_FILES[$photo]["name"];
                 move_uploaded_file($_FILES[$photo]["tmp_name"], "img/$new_name" );
                 $tableau[1] .= ",'img/$new_name'" ;
             }
        }else{
            $tableau[1] .= ",''" ;
        }
    }
    return $tableau ;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $photos = ['photo1','photo2','photo3'];
    $tableau = registerFiles($photos);


    if(!empty($_POST['titre']) and !empty($_POST['prix']) and !empty($_POST['description_object']) 
    and !empty($_POST['caracteristiques']) ){
        echo 'rentrer';
        $titre= addslashes($_POST['titre']);
        $prix = addslashes($_POST['prix']);
        $description = addslashes($_POST['description_object']);
        $caracteristiques = addslashes($_POST['caracteristiques']);
        $client= $db->query(" INSERT INTO objectd(titre,prix,description_object,caracteristiques,ref_id_membre $tableau[0]) 
                                VALUES ('$titre','$prix','$description','$caracteristiques',$id_membre $tableau[1])  ") ;
        
        header("Refresh:0");
    }
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