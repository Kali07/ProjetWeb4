<?php 
include("header.php");
require("connexionBDD.php");
$member_id =  $_GET['membre'];
if($member_id == $_SESSION['id_membre'] || $_SESSION['statut'] == 'admin' ) {
    //echo 'ENTRER';
    $id_object = addslashes($_GET['id']);
    $requete = $db->query("DELETE FROM objectd where id_object = $id_object");
}
else{
    echo 'VOUS NAVEZ PAS LES DROITS';
}

?>