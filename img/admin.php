
<?php include("header.php") ?>
    <?php 
    require("connexionBDD.php");
    $object = $db->query (" SELECT * FROM  Objectd ob, Membre mb WHERE ob.statut_objet = 'attente' and 
    mb.id_membre = ob. ref_id_membre ORDER BY id_object");
    if(isset($_GET['id']))
    {
    $id_object = $_GET['id'];

    }
    
    ?>


   
    <section>
 
  <!-- debut tableau -->
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id demande</th>
      <th scope="col">Nom demandeur</th>
      <th scope="col">Titre </th>
      <th scope="col">Statut </th>
      <th scope="col"> Action </th> 
    </tr>
  </thead>
  <tbody>
  <?php
      while($tobje = $object->fetch())
        {
            ?>
    <tr>
      <th scope="row"><?=$tobje['id_object']?></th>
      <td><?=$tobje['nom']?></td>
      <td><?=$tobje['titre']?></td>
      <td>En <?=$tobje['statut_objet']?> </td>
      <td>

<a href="produit.php?id=<?=$tobje['id_object']?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Voir</a>
<a href="admin.php?id=<?=$tobje['id_object']?>" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Refuser</a>
<a href="admin.php?id=<?=$tobje['id_object']?>" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Valider</a>
<td>
    </tr>
    <?php
        }
        $object->closeCursor();
        ?>
  </tbody>
</table>

    </section>

    <?php include("footer.php") ?>
