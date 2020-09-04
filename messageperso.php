<?php
include("header.php");
require("connexionBDD.php");


$proprio = $_SESSION['id_membre'];


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
            <td><?= $mymessages['date_message']?></td>
            <td><?=$mymessages['message_']?></td>
            <td>
            <a href="chat.php?id=<?=$mymessages['id_envoyeur']?>" class="btn btn-primary">Voir</a>
            <td>
            </tr>
            <?php
                }
                $voirmessages->closeCursor();
                ?>
        </tbody>
        </table>
    </aside>
    </div>   
   
</section>

<?php include("footer.php"); ?>

