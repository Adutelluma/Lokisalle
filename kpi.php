<?php
require "config.php";
require "header.php";

// moyenne des notes
$requete = $bdd->prepare("SELECT FORMAT (AVG(note), 2) 
AS note_moyenne, s.titre
FROM avis a 
JOIN salles s 
ON a.id_salle = s.id_salle 
GROUP BY a.id_salle ORDER BY note_moyenne DESC LIMIT 5");

$requete->execute();
$bestRate = $requete->fetchAll();

// salles les plus commandées
$requete = $bdd->prepare("SELECT c.id_produit, p.id_salle, s.titre, COUNT(c.id_produit) AS nombre 
FROM commande c
JOIN produit p ON c.id_produit = p.id_produit 
JOIN salles s ON p.id_salle = s.id_salle
GROUP BY id_produit 
ORDER BY nombre DESC LIMIT 5");

$requete->execute();
$top_commandes = $requete->fetchAll();

// membres qui commandent le plus

$requete = $bdd->prepare("SELECT c.id_membre, c.id_produit, m.pseudo, COUNT(c.id_membre) AS nombre 
FROM commande c 
JOIN membre m ON c.id_membre = m.id_membre 
GROUP BY id_membre 
ORDER BY nombre DESC LIMIT 5");

$requete->execute();
$members_top = $requete->fetchAll();

// Membres qui dépensent le plus

$requete = $bdd->prepare("SELECT c.id_membre, c.id_produit, m.pseudo, p.prix, SUM(prix) AS prix_total 
FROM commande c 
JOIN membre m ON c.id_membre = m.id_membre 
JOIN produit p ON c.id_produit = p.id_produit GROUP BY id_membre DESC LIMIT 5");
$requete->execute();
$mbrAchat = $requete->fetchAll();
 ?>

<!-- Affichage des informations -->

<h3 style="text-align:center; color:grey ;padding-top:130px ; padding-bottom:30px ; margin-right:300px;">
<i class="glyphicon glyphicon-stats"></i> Salles les mieux notées</h3>
                           
<?php foreach($bestRate as $bestR){
    echo "<div style='text-align:center'> <i class='glyphicon glyphicon-thumbs-up'> </i>". 
    " ".  $bestR['titre'] . " avec une note moyenne de : ".  $bestR['note_moyenne'];
    }
 
?>

<hr>

<h3 style="text-align:center; color:grey ;padding-bottom:30px">
<i class="glyphicon glyphicon-stats"> </i> Salles les plus commandées</h3>

<?php foreach($top_commandes as $top_commande){
echo "<div style='text-align:center';><i class='glyphicon glyphicon-home'></i>". " " . $top_commande['titre'] . " a été commandée "
 .  $top_commande['nombre'] ."<br> </div>";
}
?>

<hr>       
           
<h3 style="text-align:center; color:grey ;padding-bottom:30px">
<i class="glyphicon glyphicon-stats"></i> Membres qui réservent le plus de salles</h3>
<?php foreach($members_top as $member_top){
    if($member_top['pseudo'] != ''){
     echo "<i class='glyphicon glyphicon-thumbs-up'></i>" . " " . $member_top['pseudo'] . " a réservé" . " " .
     $member_top['nombre'] . " " . "salles <br>" ;
      }
}
?>

<hr>

<h3 style="text-align:center; color:grey ;padding-bottom:30px">
<i class="glyphicon glyphicon-stats"></i> Membres qui réservent pour la plus grande somme</h3>
</div>
<div class="panel-body">
<?php foreach($mbrAchat as $mbrsAchat){ 
echo "<i class='glyphicon glyphicon-thumbs-up'></i> " . $mbrsAchat['pseudo'] . " " 
. " a réservé des salles pour un total de  " . " " . $mbrsAchat['prix_total'] . "€ <br>";
}
?>
<hr>

<?php
require "footer.php";
?>
