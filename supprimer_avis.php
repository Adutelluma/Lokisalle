<?php
require "config.php";


$id_avis = $_GET['id_avis'];

$requete = $bdd->exec("DELETE FROM avis WHERE id_avis = '$id_avis'");

$content .= "L'avis ayant pour id  = " . $id_avis . " a bien été supprimé et vous serez redirigé dans 3 secondes";


echo $content;
header("Refresh:3; URL=afficher_reservation.php");
?>