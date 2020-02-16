<?php

require "config.php";
require "header.php";

$requete = $bdd->query("SELECT
a.id_avis,
a.id_membre,
m.pseudo,
a.id_salle,
s.titre,
s.photo,
s.capacite,
a.commentaire,
a.note,
a.date_enregistrement
FROM
avis a
JOIN membre m ON
a.id_membre = m.id_membre
JOIN salles s ON
s.id_salle = a.id_salle
ORDER BY a.date_enregistrement DESC");

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
	$content .= "<td>" . $ligne['id_avis'] .  "</td>";
	$content .= "<td>" . $ligne['id_membre'] .  "</td>";
    $content .= "<td>" . $ligne['pseudo'] .  "</td>";
    $content .= "<td>" . $ligne['id_salle'] .  "</td>";
    $content .= "<td>" . $ligne['titre'] .  "</td>";
    $content .= "<td>" . "<img src='images/" . $ligne['photo'] ."' alt='' >" .  "</td>";
    $content .= "<td>" . $ligne['capacite'] .  "</td>";
    $content .= "<td>" . $ligne['commentaire'] .  "</td>";
    $content .= "<td>" . $ligne['note'] .  "</td>";
    $content .= "<td>" . $ligne['date_enregistrement'] .  "</td>";
	$content .= "<td>" . "<a href='modifier_avis.php?id_avis=". $ligne['id_avis'] ."'> Modifier</a>" .  "</td>";
	$content .= "<td>" . "<a href='supprimer_avis.php?id_avis=". $ligne['id_avis'] ."'>Supprimer</a>" .  "</td>";
	$content .= "</tr>";
}

?>
<p style="text-align:center; font-size:40px;color:grey;"> Avis clients</p>

<?php
$content .= "</table>";
echo $content;

require "footer.php";
?>
