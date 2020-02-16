<?php 

require "config.php";
require "header.php";

if($_POST)
{
    $titre = $_POST['titre'];
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    
 

	$requete = $bdd->exec("INSERT INTO membre (pseudo, titre, nom, prenom, mdp, email)
    VALUES ('$pseudo','$titre', '$nom', '$prenom','$mdp', '$email')");
    
    echo "nombre d'enregistrement affecté par l'insert : " . $requete . "<br>";
    echo "dernier id généré : " . $bdd->lastInsertId();
    echo "<h1>Bonjour " . $pseudo . " ! Connectez-vous</h1>";

}else {
?>

<p style="text-align:center; font-size:40px; color:grey">Créez votre compte </p>

<!-- formulaire de création de compte -->

<form action="" method="post" class="inscription">

<p>
    <label for="pseudo">Pseudo :</label><br>
    <input type="text" name="pseudo">
</p>  

<p>
    <label for="titre">titre * :</label><br>
    <input type="radio" name="titre" value="mr"> Monsieur<br>
    <input type="radio" name="titre" value="mme"> Madame<br>
</p>    


<p>
    <label for="nom">Nom* :</label><br>
    <input type="nom" name="nom">
</p>  

<p>
    <label for="prenom">Prenom * :</label><br>
    <input type="text" name="prenom">
</p>  

<p>
    <label for="mdp">Mot de passe :</label><br>
    <input type="text" name="mdp">
</p>  

<p>
    <label for="email">email :</label><br>
    <input type="mail" name="email">
</p>  

<button type="submit">Envoyer</button>

</form>

<?php
}

require "footer.php"
?>