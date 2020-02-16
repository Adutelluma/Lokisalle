<?php 
require "config.php";
require "header.php";


$requete = $bdd->query("SELECT * FROM salles");

$content .= "<table border ='5'> <tr>";

for ($i=0; $i < $requete->columnCount() ; $i++) { 
	$colonne = $requete->getColumnMeta($i);
	$content .= "<th>" . $colonne['name'] . '</th>';
}

$content .= "<th>Modifier</th>";
$content .= "<th>Supprimer</th>";

while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	$content .= "<tr>";
	$content .= "<td>" . $ligne['id_salle'] .  "</td>";
	$content .= "<td>" . $ligne['titre'] .  "</td>";
	$content .= "<td>" . $ligne['description'] .  "</td>";
    $content .= "<td>" . "<img src='images/" . $ligne['photo'] ."' alt='' >" .  "</td>";
    
    $content .= "<td>" . $ligne['pays'] .  "</td>";
    $content .= "<td>" . $ligne['ville'] .  "</td>";
    $content .= "<td>" . $ligne['adresse'] .  "</td>";
    $content .= "<td>" . $ligne['cp'] .  "</td>";
    $content .= "<td>" . $ligne['capacite'] .  "</td>";
    $content .= "<td>" . $ligne['categorie'] .  "</td>";
	$content .= "<td>" . "<a href='modifier_salle.php?id_salle=". $ligne['id_salle'] ."'> Modifier</a>" .  "</td>";
	$content .= "<td>" . "<a href='supprimer_salle.php?id_salle=". $ligne['id_salle'] ."'>Supprimer</a>" .  "</td>";
	$content .= "</tr>";
}

?>
<p style="text-align:center; font-size:40px;"> <a href="ajouter_salle.php" style="color:grey">
Ajouter une salle <i class="fas fa-folder-plus"></i></a>
</p>


<?php

$content .= "</table>";
echo $content;

require "footer.php"
?>

