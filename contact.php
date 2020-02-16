<?php 
require "config.php";
require "header.php";
?>

<div class="centrer">
<h1>Contactez-nous</h1>

<p>
Une question, une remarque, une modification à faire sur votre profil où sur une de nos salles? Contactez-nous !
</p>

</div>
<form method="post">
    <p>
    <label>Nom</label><br>
    <input type="text" name="nom" required>
    </p>
    <p>
    <label>Email</label><br>
    <input type="email" name="email" required>
    </p>
    <p>
    <label>Message</label> <br>
    <textarea name="message" rows="15" cols="40" required></textarea>
    </p>
    <input type="submit">
</form>

<?php
if(isset($_POST['message'])){
    $entete  = 'MIME-Version: 1.0' . "\r\n";
    $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $entete .= 'From: ' . $_POST['email'] . "\r\n";

    $message = '<h1>Message envoyé depuis la page Contact de lokisalle.php</h1>
    <p><b>Nom : </b>' . $_POST['nom'] . '<br>
    <b>Email : </b>' . $_POST['email'] . '<br>
    <b>Message : </b>' . $_POST['message'] . '</p>';

    $retour = mail('adutelluma@gmail.com', 'Envoi depuis page Contact', $message, $entete);
    if($retour) {
        echo '<p>Votre message a bien été envoyé.</p>';
    }
}

require "footer.php";
?>
