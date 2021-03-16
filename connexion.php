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

	echo "<div id='content'>";
	if (!isset($_SESSION['idmem'])) {

		echo "<div id='content'><form action='" . Login($connexion) . "' method='GET'>

		<label>Identifiant :</label>
			<input type='text' name='txt_id'/> <br>
		 <label>Mot de passe :</label>
      		<input type='password' name='txt_passe'/>
<br>
<button type='submit' name='loginSubmit'> Se connecter </button>

</form> ";


		echo "Veuillez vous connecter !";
		echo "</br>";
	} else {
		echo "Vous êtes connecté ! <br><br>";

		echo "<a href='profil.php'><strong> Mon profil</strong></a><br><br>";
		echo "<form method='GET' action='" . Logout() . "'>

		<button type='submit' name='logoutSubmit'> Se déconnecter </button>

		</form>";
	}

	echo "</div>";
	?>


</body>

</html>