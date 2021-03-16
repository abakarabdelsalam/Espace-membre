<?php

session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();

?>

<!DOCTYPE html>
<html>

<head>
	<link rel='stylesheet' href='style1.css'>
	<title> Page de connexion </title>

</head>

<body>
	<?php

	echo "<div id='content'>;
<h1>!!! ERREUR D'AUTHENTIFICATION !!!</h1>
<a href='connexion.php'> Réessayer </a> </br>
<a href='inscription.php'> Pas encore inscrit ? Cliquez ici </a>"
	?>

</body>

</html>