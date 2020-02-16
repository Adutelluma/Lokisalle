<?php
require "config.php";
require "header.php";

 // Ajouter un nouveau membre
 if($_POST){
    $titre = $_POST['titre'];
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['mdp'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];

     $requete = $bdd->exec("INSERT INTO membre ( titre, pseudo, nom, prenom, mdp, email, admin)
     VALUES ('$titre', '$pseudo','$nom', '$prenom','$mdp', '$email', '$admin')");
     
     echo " <p style='color:red; text-align:center'> un nouvel utilisateur a bien été rajouté ! </p>";
 }  
 ?>

<!-- Formulaire d'ajout de nouveau membre -->
<p style="text-align:center; font-size:40px; color:grey"> Inscription d'un nouveau membre </p>

<form action="" method="post" class="inscription">
    <!-- pseudo -->
    <p>
    <label for="pseudo">Pseudo :</label><br>
    <input type="text" name="pseudo">
    </p>  

    <!--  (MMe / Mr) -->
    <p>
    <label for="titre">titre * :</label><br>
    <input type="radio" name="titre" value="mr"> Monsieur<br>
    <input type="radio" name="titre" value="mme"> Madame<br>
    </p>    

    <!-- Nom -->
    <p>
    <label for="nom">Nom* :</label><br>
    <input type="nom" name="nom">
    </p>  

    <!-- Prenom -->
    <p>
    <label for="prenom">Prenom * :</label><br>
    <input type="text" name="prenom">
    </p>  

    <!-- PW -->
    <p>
    <label for="mdp">Mot de passe :</label><br>
    <input type="text" name="mdp">
    </p>  

    <!-- email -->
    <p>
    <label for="email">email :</label><br>
    <input type="mail" name="email">
    </p>  

    <!-- type de compte (admin / membre) -->
    <p>
    <label for="admin">type de compte :</label><br>
    <input type="radio" name="admin" value="0"> Membre<br>
    <input type="radio" name="admin" value="1"> Admin<br>
    </p>  

    <button type="submit">Envoyer</button>

</form>

<?php 
require "footer.php";
?>