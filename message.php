<?php
include("header.php");
require("connexionBDD.php");




if (isset($_GET['idacheteur']) AND !empty($_GET['idvendeur']))
{
    //pour ne pas perdre les variables en cas de rechargement de la page, car on aura plus les parms recuperés depuis produit
$_SESSION['envoyeur']  = $_GET['idacheteur'];
$_SESSION['receveur'] = $_GET['idvendeur'];
}
$envoyeur = $_SESSION['envoyeur'];
$receveur = $_SESSION['receveur'];
$objevendu = $_SESSION['idobjvendu'];

$proprio = $_SESSION['id_membre'];


//requete pour recuperer les donnees du vendeur
$vendeur = $db->query("SELECT * FROM objectd ob, membre mb where ob.ref_id_membre = $receveur  
                        AND mb.id_membre = ob.ref_id_membre AND mb.id_membre = $receveur AND ob.id_object = $objevendu");
$infovendeur= $vendeur->fetch();

if (isset($_POST['message']) AND !empty($_POST['message']))
{

    $message = addslashes($_POST['message']);
    $msg = $db->query("INSERT INTO messages (id_envoyeur,id_receveur,message_,date_message) VALUES ('$envoyeur','$receveur','$message',NOW()) ") ;
    echo'Message reçu';
   

}
//traitement de la liste de ses messages on ne voit que les messages que les autres nous ont envoyer pas les notres (dernier conditions)
$voirmessages = $db->query("SELECT * FROM messages m, membre mb WHERE m.id_receveur = $proprio
                            AND mb.id_membre = m.id_envoyeur  AND mb.id_membre != $proprio "); 


?>

<section class="container-fluid p-5">
    <div class="row">
    <aside class="col-6">
    <h4 class="mb-3">Vos discussions</h4>
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Nom</th>
            <th scope="col">Date</th>
            <th scope="col"> Message </th> 
            <th scope="col"> Action </th> 
            </tr>
        </thead>
        <tbody>
        <?php while($mymessages = $voirmessages->fetch()){  ?>
            <tr>
            <td><?=$mymessages['nom']?></td>
            <td><?= date(DATE_RFC2822)?></td>
            <td><?=$mymessages['message_']?></td>
            <td>
            element
            <td>
            </tr>
            <?php
                }
                $voirmessages->closeCursor();
                ?>
        </tbody>
        </table>
    </aside>

    <aside class="col-6">
        <div class="row">
            <div class="col-md-10 order-md-2 mb-4">
            <h4 class="mb-3">Contacter Le Vendeur</h4>
            <form method = "POST"  action ="message.php"  >
                <div class="row">
                    <div class="mb-3 col-6">
                    <label for="titre">Nom</label>
                    <input type="text" class="form-control" id="titre" name="titre" placeholder="<?=$infovendeur['nom']?>" disabled="disabled">
                </div>

                <div class="mb-3 col-6">
                    <label for="prix">Prix en €</label>
                    <input type="number" class="form-control" id="prix" name="prix" placeholder="<?=$infovendeur['prix']?> €" disabled="disabled">
                </div>
                
                </div>

                <div class="mb-3">
                    <label for="desc">Votre Message</label>
                    <textarea class="form-control" id="desc"  placeholder="Saisissez votre message" name="message" rows="4" required></textarea>
                </div>
                
                <hr class="mb-4">
                <button class="btn btn-success btn-lg btn-block" type="submit">Envoyer</button>
            </form>
            </div>
        </div>
    </aside>
    </div>   
   
</section>

<?php include("footer.php"); ?>

