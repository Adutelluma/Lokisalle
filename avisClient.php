<?php
require "config.php";
require "header.php";

//SELECT commentaire FROM avis WHERE id_membre=17

$id= $_SESSION['membre']['id_membre'];
$requete = $bdd -> query(
    "SELECT commentaire, note
    FROM avis
    JOIN salles s ON a.id_salle=s.id_salle
    JOIN produit prd ON s.id_salle = prd.id_salle
    JOIN commande cmd ON cmd.id_produit=prd.id_produit
    WHERE $id = cmd.id_membre"
);

$resultat = $requete->fetch(PDO::FETCH_ASSOC);
$commentaire=$requete['commentaire'];
$note=$requete['note']

?>


<p> 
Mes avis
</p>

<?php $checkAvis = $bdd->query(
"SELECT 
a.commentaire, 
a.note
FROM avis a
WHERE a.id_membre =". $id . " 
AND a.id_salle=" . $id_salle
);
$avis = $checkAvis->fetchAll();

if (empty($avis) ){
echo "
    <form method='post'>

    <p>
        <label for='commentaire'>Commentaire :</label><br>
        <textarea name='commentaire' value='votre commentaire' cols='30' rows='10'></textarea>
    </p> 

    <p>
        <select name='note'>
        <option value=''>--Votre note--</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        </select>
    </p> 

    <p>
    <button type='submit'>Envoyer</button>
    </p>

    </form>
";
} else {
    echo " <p  style='padding-top:150px;text-align:center; font-size:40px; color:grey;'> Vous avez mis la note de  : " . $avis[0]['note'] . "/5" . "<br>"; 
    echo "Vous avez mis comme commentaire : " .  $avis[0]['commentaire'] . "<br> </p> ";
    }

require "footer.php";
?>