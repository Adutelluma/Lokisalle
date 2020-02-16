<?php

//DELETE FROM `contacts` WHERE `contacts`.`id_contact` = 19

require "config.php";

$id_salle = $_GET['id_salle'];

$requete = $bdd->exec("DELETE FROM salle WHERE id_salle = '$id_salle'");

$content .= "La salle ayant pour id  = " . $id_salle . " a bien été supprimée et vous serez redirigé dans 3 secondes";

echo $content;

header("Refresh:3; URL=salles.php");
?>