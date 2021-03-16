<?php
date_default_timezone_set('Europe/Copenhagen');
session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();

?>

<!DOCTYPE html>
<html>

<head>
    <title> Publications </title>
</head>

<body>


    <h1>Vos posts </h1>


    <?php

	echo "<form method='POST' action='" . commentaires($connexion) . "'>
<input type='hidden' name='idcom' value='" . $_SESSION['idmem'] . "' >
<input type='hidden' name='datecom' value='" . date('Y-m-d H:i:s') . "' >
<textarea name='contenucom' required></textarea></br>
<button type ='submit' name='commentSubmit'>Comment</button>

</form>";

	getcommentaires($connexion);

	?>


    <a href="profil.php">Retour au profil</a>

</body>


</html>