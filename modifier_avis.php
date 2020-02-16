<?php

require "config.php";
require "header.php";

if(isset($_GET['id_avis'])) $id_avis= $_GET['id_avis'];
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete = $bdd->query("SELECT * FROM avis WHERE id_avis = '$id_avis'");

$resultat = $requete->fetch(PDO::FETCH_ASSOC);

$id_avis = $resultat['id_avis'];
$id_membre = $resultat['id_membre'];
$note = $resultat['note'];
$commentaire = $resultat['commentaire'];

if($_POST)
{
	$requete = $bdd->prepare("UPDATE avis SET commentaire = :commentaire  WHERE id_avis = '$id_avis'");
	$requete->execute(array(
        "commentaire" => $_POST['commentaire'],
	));
	echo "Modification réussi !";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Répondre à un avis
	</title>
</head>
<body>
<p style="text-align:center; font-size:40px; color:grey"> Répondre à un avis </p>

<!-- Formulaire de réponse avis -->

<form action="" method="post" class="inscription">

<p>
    <label for="id_avis">ID de l'avis :</label><br>
    <?php echo $id_avis; ?>
</p> 

<p>
    <label for="id_membre">ID du membre</label><br>
    <?php echo $id_membre; ?>
</p>  

<p>
    <label for="note">Note</label><br>
    <?php echo $note; ?>
</p>    

<p>
    <label for="commentaire">Commentaire </label><br>
    <textarea name="commentaire" rows="4" cols="50"><?php echo $commentaire . "Réponse du responsable :" ?>
    </textarea>
</p>  

<button type="submit">Modifier</button>

</form>

<?php 
require "footer.php"
?>
