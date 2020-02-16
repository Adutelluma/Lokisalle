<?php
require "config.php";
require "header.php";

$reponse = $bdd -> query('SELECT id_salle, titre , capacite, ville
                        FROM salles
                        ');
$produits = $reponse->fetchAll();

if (isset ($_POST['selectIdSalle'])){
    $id_salle=$_POST['selectIdSalle'];
    $date_arrivee = $_POST['date_arrivee'];
    $date_depart = $_POST['date_depart'];
    $prix = $_POST['prix'];
    $etat = $_POST['etat'];

    // INSERT INTO `produit` ( `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES (NULL, '6', '2020-02-13 17:06:42', '2021-01-28 17:06:42', '551', 'libre');
    
    // Remplissage sauvage
    // for ($i=1;$i<27;$i++){
    //     $prix=100*rand(5,22);
    //     $requete = $bdd->exec("INSERT INTO produit (id_salle, date_arrivee, date_depart, prix, etat)
    //     VALUES ('$i','$date_arrivee','$date_depart', '$prix', '$etat')");   
    // }

   $requete = $bdd->exec("INSERT INTO produit (id_salle, date_arrivee, date_depart, prix, etat)
   VALUES ('$id_salle','$date_arrivee','$date_depart', '$prix', '$etat')");
    
    echo "<p style='color:red; text-align:center'> Un nouveau produit a été ajouté ! </p>";
}  
?>
<br>
<br>
<br>
<br>
<br>

<div class="misenform">
<p style="text-align:center; font-size:40px; color:grey;">
  
        Création d'un nouveau produit        


<form  method="post" >
<p>
    <select name="selectIdSalle">
    <option value="">--Veuillez choisir une salle--</option>
    <?php
        foreach($produits as $produit) {
    
    echo "<option value=".$produit['id_salle'].">".$produit['id_salle']." - ".$produit['titre']. " - ".
        $produit['ville']. " - ". $produit['capacite']."</option><br>";
        }
    ?>
    </select>
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
    <select name="etat" for="etat">Etat de la salle <br>
    <option  value="libre"> Libre </option><br>
    <option  value="reservation"> Reservé </option><br>
    </select>
</p>  
    
<button type="submit">Envoyer</button>
 
</form>    


<?php
require "footer.php"
?>