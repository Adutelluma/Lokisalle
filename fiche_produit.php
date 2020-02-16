<?php 
require "config.php";
require "header.php";
?>


<!-- Affichage en div -->

<p style="padding-top: 150px;">

<?php 
$requete = $bdd->query("SELECT 
p.id_produit,
p.prix,
s.id_salle,
s.titre,
s.photo,
s.capacite,
s.cp,
s.adresse,
s.ville,
s.description
FROM produit p
JOIN salles s ON p.id_salle=s.id_salle
WHERE p.id_produit=" . $_GET['id_produit']
);

$resultat = $requete->fetch(PDO::FETCH_ASSOC);
$id_salle=$resultat['id_salle'];
$produit=$resultat['id_produit'];
$titre=$resultat['titre'];
$photo=$resultat['photo'];
$description=$resultat['description'];
$capacite=$resultat['capacite'];
$cp=$resultat['cp'];
$adresse=$resultat['adresse'];
$ville=$resultat['ville'];
$prix=$resultat['prix'];

if(isset($_POST['reserver']))
{
    $requete = $bdd->prepare("UPDATE produit SET etat = 'reservation' WHERE id_produit =" . $produit);
    $requete->execute();
    $requete = $bdd->exec("INSERT INTO commande (id_membre, id_produit, date_enregistrement)
    VALUES (" . $_SESSION['membre']['id_membre'] .", " .  $produit. ", NOW() ) ");
    
    echo "<p style='color:red; text-align:center'> Une nouvelle réservation a été ajouté ! </p>";
}




$requete = $bdd->prepare("SELECT FORMAT(AVG(note),2)
AS note_moyenne, s.titre, a.commentaire, a.id_membre, m.pseudo
FROM avis a 
JOIN salles s 
ON a.id_salle = s.id_salle
JOIN membre m ON a.id_membre=m.id_membre
WHERE a.id_salle=" . $id_salle
);

$requete->execute();
$rating = $requete->fetchAll();

if(internauteEstConnecte()){
    $requete= $bdd->query("SELECT id_produit FROM commande c WHERE c.id_produit =" . $_GET['id_produit'] 
    . " AND c.id_membre=" . $_SESSION['membre']['id_membre']);
    $resul=$requete->fetch(PDO::FETCH_ASSOC);
    if ($resul==false){
?>

<form action="" method="post"> <button type="submit" name="reserver"> Réservation</button> </form>
    <?php
        } else {
            $requete= $bdd->query("SELECT a.note, a.commentaire FROM avis a WHERE a.id_salle =" . $id_salle
        . " AND a.id_membre=" . $_SESSION['membre']['id_membre']);
        $resul=$requete->fetch(PDO::FETCH_ASSOC);
       
        }
    }
    else { ?>
        Merci de vous connecter ici : <a href="connexion.php"></a>
    <?php  } 
    ?>  



<div>
<?php 
    echo  "<p style='text-align:center; font-size:55px; color:grey'> " .$titre . "</p>";
?>

<!-- // Affichage \\ -->

</div>
<div style=" font-size:15px; text-align:center">
    <?php echo "<br> <img class='prod' src='images/" . $photo . "' alt='' >"."<br> note moyenne de la salle : "
. $rating[0][0] . " /5";  ?></div>


<h3 style="margin-left:50px; text-decoration: underline"> Descriptif :</h3>
<div>
<?php 
echo "<p style='text-align:center; font-size:45px'>" . $description . "</p>";
?>
</div>
<h3 style="margin-left:50px; text-decoration: underline"> Informations pratiques: :</h3>

<div class="container mt-3">

<div class="d-flex justify-content-around bg-secondary mb-3">
    <div class="p-2 bg-info" style="font-size:30px; padding-top:10px; padding-bottom:10px">Capacité maximale de la salle :
        <?php echo $capacite . " personnes";
        ?>
    </div>

    <div class="p-2 bg-warning" style="font-size:30px">Adresse :
        <?php echo "<br>" .$adresse . "<br>" . $cp . " " .$ville;

        ?>
    </div>

    <div class="p-2 bg-primary" style='text-align:right;font-size:30px'>Prix :
        <?php echo $prix . " € TTC";
        ?>
    </div>

</div>
<?php
    if(internauteEstConnecte()){
        $requete= $bdd->query("SELECT id_produit FROM commande c WHERE c.id_produit =" . $_GET['id_produit'] 
        . " AND c.id_membre=" . $_SESSION['membre']['id_membre']);
        $resul=$requete->fetch(PDO::FETCH_ASSOC);
        if ($resul==false){
    ?>
    <form action="" method="post"> <button type="submit" name="reserver"> Réservation</button> </form>
    <?php
        } else {
            $requete= $bdd->query("SELECT a.note, a.commentaire FROM avis a WHERE a.id_salle =" . $id_salle
        . " AND a.id_membre=" . $_SESSION['membre']['id_membre']);
        $resul=$requete->fetch(PDO::FETCH_ASSOC);
            if ($resul==false){
                echo "<a href='avis.php?id_produit=". $_GET['id_produit'] ."'> Votre avis nous interesse </a>" ;
            } else {
                echo "<br>Vous avez attribué la note de " . $resul['note']." /5 <br> " . "Et vous avez mis le commentaire suivant :"
                .$resul['commentaire'];
            }
        }
    }


    
    else { ?>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="inscription.php">Créer un compte</a></li>
    <?php  } 

$requete = $bdd->query("SELECT

m.pseudo,
a.commentaire,
a.note,
a.date_enregistrement
FROM
avis a
JOIN membre m ON
a.id_membre = m.id_membre
JOIN salles s ON
s.id_salle = a.id_salle
WHERE a.id_salle=" . $id_salle.
" ORDER BY a.date_enregistrement DESC
");

$content .= "<table border ='5'> <tr>";

for ($i=0; $i < $requete->columnCount() ; $i++) { 
	$colonne = $requete->getColumnMeta($i);
	$content .= "<th>" . $colonne['name'] . '</th>';
}



while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	$content .= "<tr>";
    $content .= "<td>" . $ligne['pseudo'] .  "</td>";
    $content .= "<td>" . $ligne['commentaire'] .  "</td>";
    $content .= "<td>" . $ligne['note'] .  "</td>";
    $content .= "<td>" . $ligne['date_enregistrement'] .  "</td>";
	$content .= "</tr>";
}

?>
<p style="text-align:center; font-size:40px;color:grey;"> Avis clients</p>

<?php
$content .= "</table>";
echo $content;
  


    ?>  
</p>

<?php
require "footer.php"
?>