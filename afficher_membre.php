<?php 
require "config.php";
require "header.php";

$requete = $bdd->query("SELECT * FROM membre");

// Afficher le tableau de membres

$content="";
$content .= "<table border ='5'>";

for ($i=0; $i < $requete->columnCount() ; $i++) { 

	$colonne = $requete->getColumnMeta($i);
	$content .= "<th>" . $colonne['name'] . '</th>';
}

while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	$content .= "<tr>";
	$content .= "<td>" . $ligne['id_membre'] .  "</td>";
	$content .= "<td>" . $ligne['pseudo'] .  "</td>";
    $content .= "<td>" . $ligne['titre'] .  "</td>";
    $content .= "<td>" . $ligne['nom'] .  "</td>";
	$content .= "<td>" . $ligne['prenom'] .  "</td>";
    $content .= "<td>" . $ligne['mdp'] .  "</td>";
	$content .= "<td>" . $ligne['email'] .  "</td>";
	$content .= "<td>" . $ligne['admin'] .  "</td>";
    $content .= "<td>" . $ligne['date_enregistrement'] .  "</td>";
    $content .= "<td>" . "<a href='modifier_membre.php?id_membre=". $ligne['id_membre'] ."'>Modifier</a>" .  "</td>";
	$content .= "<td>" . "<a href='supprimer_membre.php?id_membre=". $ligne['id_membre'] ."'> Supprimer </a>" .  "</td>";
    $content .= "</tr>";

}
?>

<p style="text-align:center; font-size:40px;"> <a href="ajouter_membre.php" style="color:grey">Ajouter un membre <i class="fas fa-user-plus"></i></a> </p>

<?php
$content .= "</table>";


echo $content;
require "footer.php"
?>