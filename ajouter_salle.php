<?php
require "config.php";
require "header.php";

if($_POST)
{
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $photo = $_POST['photo'];
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $adresse = $_POST['adresse'];
    $cp = $_POST['cp'];
    $capacite = $_POST['capacite'];
    $categorie = $_POST['categorie'];

$requete = $bdd->exec("INSERT INTO salles (titre, description, photo, pays, ville, adresse, cp, capacite, categorie)
VALUES ('$titre', '$description','$photo', '$pays','$ville', '$adresse', '$cp', '$capacite', '$categorie')");

echo "<p style='color:red; text-align:center'> Une nouvelle salle a été ajouté ! </p>";
}

?>

<p style="text-align:center; font-size:40px; color:grey;">Ajout d'une nouvelle salle <br></p>

<!-- Formulaire d'ajout de salle -->

<form action="" method="post"  >

   
<p style="text-align:center";>
    <label for="titre">Titre *</label><br>
</p>
<p>
    <input type="text" name="titre">
</p> 

<p style="text-align:center";>
    <label for="description">Description</label><br>
    <textarea name="description" rows="8" cols="50"></textarea>
</p>  


<p style="text-align:center";>
    <label> Photo </label>
</p>

<p style="margin-left:45%;">
<input type="file" name="photo" required>
</p> 

<p>
    <label for="pays">Pays</label><br>
    <input type="text" name="pays">
</p>  

<p>
    <label for="ville">Ville</label><br>
    <input type="name" name="ville">
</p>  

<p>
    <label for="adresse">Adresse</label><br>
    <textarea type="text" name="adresse" rows="4" cols="50"> </textarea>
</p> 

<p>
    <label for="cp">Code postal</label><br>
    <input type="number" name="cp">
</p>  

<p>
    <label for="capacite">Capacité maximale</label><br>
    <input type="number" name="capacite">
</p>  

<p>
    <label for="categorie">Catégorie</label><br>
        <input type="radio" name="categorie" value="réunion">Salle de réunion</option>
        <input type="radio" name="categorie"  value="bureau">Bureau</option>
        <input type="radio" name="categorie"  value="formation">Salle de formation</option>
</p>

<button type="submit">Envoyer</button>

</form>
<?php 
require "footer.php";
?>
