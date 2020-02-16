<?php

require "config.php";

$id_membre = $_GET['id_membre'];

$requete = $bdd->exec("DELETE FROM membre WHERE id_membre = '$id_membre'");

$content .= "L'utilisateur ayant pour id  = " . $id_membre . " a bien été supprimée et vous serez redirigé dans 3 secondes";


echo $content;
header("Refresh:3; URL=afficher_membre.php");
?>