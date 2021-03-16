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
	<title>Rechercher un membre</title>

</head>

<body>
	<div id="content">
		<header>
			<div class="header">
				Bonjour <?php

						$log = $_SESSION['idmem'];
						$reqnom = "SELECT membre.prenommem FROM membre WHERE membre.idmem='$log'";
						$resnom = mysqli_query($connexion, $reqnom);
						$nom = mysqli_fetch_array($resnom);
						echo '' . $nom['prenommem'] . '';

						?>
			</div>
		</header>

		<?php include 'menu.php' ?>
	</div>
	<h1>Rechercher un membre par compétence</h1>

	Veuillez choisir une compétence </br>

	<form method="GET" action="listerech.php">
		<select name=lstcomp>

			<?php

			$reqcomp = "SELECT competence.Nomcomp, competence.idcomp FROM competence";
			$res = mysqli_query($connexion, $reqcomp);
			while ($nunu = mysqli_fetch_array($res)) {

				echo '<OPTION value="' . $nunu['idcomp'] . '">' . $nunu['Nomcomp'] . '</OPTION>';
				$_SESSION['Nomcomp'] = $nunu['Nomcomp'];
			}

			?>





		</select>
		<input type="submit" name="btngo" value="Rechercher !">

	</form>


</body>

</html>