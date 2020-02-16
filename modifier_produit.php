<?php 

require "config.php";
require "header.php";

$reponse = $bdd -> query('SELECT id_salle, titre , capacite, ville
                            from salles
                           
                        ');
$produits = $reponse->fetchAll();


if(isset($_GET['id_produit'])) $id_produit= $_GET['id_produit'];
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requete = $bdd->query("SELECT * FROM produit WHERE id_produit = '$id_produit'");

$resultat = $requete->fetch(PDO::FETCH_ASSOC);



$id_salle = $resultat['id_salle'];
$date_arrivee = $resultat['date_arrivee'];
$date_arriveeF=substr($date_arrivee,0,10);
$date_depart = $resultat['date_depart'];
$date_departF=substr($date_depart,0,10);
$prix = $resultat['prix'];
$etat = $resultat['etat'];

if($_POST)
{
	$requete = $bdd->prepare("UPDATE produit SET id_salle = :id_salle, date_arrivee = :date_arrivee,  date_depart= :date_depart, prix = :prix
     WHERE id_produit = '$id_produit'");

	$requete->execute(array(
        "id_salle" => $_POST['id_salle'],
		"date_arrivee" => $_POST['date_arrivee'],
        "date_depart" => $_POST['date_depart'],
        "prix" =>$_POST['prix'],
       
	));

	echo "Modification réussie !";

  

}


?>

<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<p style="text-align:center; font-size:40px; color:grey">
    
        Modification d'un produit
 
</p>


<form action="" method="post">

<p style="text-align:center; padding-top:50px;">
<select name="id_salle">
<option value="">--Veuillez choisir une salle--</option>
<?php


    foreach($produits as $produit) {
        if($produit['id_salle']== $id_salle){

            echo "<option value=".$produit['id_salle']." selected='selected'>".$produit['id_salle']." - ".$produit['titre']. " - ".
            $produit['ville']. " - ". $produit['capacite']."</option><br>";
        }else {
   
            echo "<option value=".$produit['id_salle'].">".$produit['id_salle']." - ".$produit['titre']. " - ".
            $produit['ville']. " - ". $produit['capacite']."</option><br>";
        }
    }
 ?>

</select> 
</p>
    <p style="text-align:center; padding-top:20px;">
        <label for="date_arrivee">Date d'arrivée  : <br></label>
    </p>
    <p>
        <input type="date" name="date_arrivee" value="<?php echo $date_arriveeF ?>"> 
    </p>  

 
    <p>
    <label for="date_depart">Date de départ  : <br> </label>
    </p>
    <p>
        <input type="date" name="date_depart" value="<?php echo $date_departF ?>"> 
    </p>  

    <p>
    <label for="etat">Etat de la salle</label><br>
           <input type="radio" name="etat"  value="libre">Libre <br>
           <input type="radio" name="etat"  value="reservation">Réservation
    </p>  

    <p>
        <label for="prix">Prix</label><br>
        <input type="text" name="prix" value="<?php echo $prix ?> €" >

      

    <button type="submit">Envoyer</button>

    </form>


    <?php 
        require "footer.php";

    ?>



