<?php
require "config.php";
require "header.php";


$reponse = $bdd -> query('SELECT id_salle, titre , capacite, ville
                            from salles
                           
                        ');
$produits = $reponse->fetchAll();

$alias = $bdd -> query('SELECT id_membre, pseudo
                            from membre
                           
                        ');
$aliasAll = $alias->fetchAll();

if($_POST){

    $pseudo = $_POST['pseudo'];
    $produits=$_POST['id_salle'];
    $debut = $_POST['date_arrivee'];
    $fin = $_POST['date_fin'];
    $prix = $_POST['prix'];
    $etat = $_POST['etat'];

    $requete = $bdd->exec("INSERT INTO produit( id_produit, id_salle, debut, fin, prix, etat)
    VALUES ('$pseudo', '$produits','$nom', '$prenom','$mdp', '$email', '$etat')");

    echo "La création de la réservation a bien été effectuée";
}  
?>
<br>
<br>
<br>
<br>
<br>
<div class="misenform">
<p style="text-align:center; font-size:40px; color:grey;">
  
        Création d'une nouvelle réservation        
    
</p>
 <form>

 <?php 

echo "<select name=&quot;aliasAll&quot; id=&quot;alias-select&quot;>";
echo "<option value=&quot;&quot;>--Veuillez choisir un utilisateur--</option>";
foreach($aliasAll as $alia) {
   
   echo "<option value=&quot;".$alia['id_membre']."&quot;>". $alia['id_membre'] . " - ". $alia['pseudo'] . "</option><br>";
}
echo "</select>";
        ?>
    </p>  
    <p>
<?php 

echo "<select name=&quot;produits&quot; id=&quot;produit-select&quot;>";
echo "<option value=&quot;&quot;>--Veuillez choisir une salle--</option>";

foreach($produits as $produit) {
   echo "<option value=&quot;".$produit['id_salle']."&quot;>".$produit['id_salle']." - ".$produit['titre']. " - ".
    $produit['ville']. " - ". $produit['capacite']."</option><br>";
}
echo "</select>";
        ?>
    </p>  

    <p>
        <label for="date_arrivee">Date d'arrivée:</label><br>
        <input type="date" name="date_arrivee">
    </p>  

    <p>
        <label for="date_depart">Date de départ :</label><br>
        <input type="date" name="date_depart">
    </p>  

    <p>
        <label for="prix">Prix :</label><br>
        <input type="text" name="prix"> €
    </p>  
    <p>
        <select for="etat">Etat de la salle <br>
    	<option value="libre"> Libre </option><br>
        <option value="reservation"> Reservé </option><br>
        </select>
    </p>  
    <button type="submit">Envoyer</button>
 
    

</div>



<?php
require "footer.php"
?>