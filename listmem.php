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
	<title> Membres </title>
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
	<h1>La liste des membres</h1>


	<form method="GET" action="profilmem.php">
		<select name=lstmem>

			<?php

			$reqmem = "SELECT * FROM membre WHERE idmem!=" . $_SESSION['idmem'] . " ";
			$res = mysqli_query($connexion, $reqmem);
			while ($nunu = mysqli_fetch_array($res)) {
				$_SESSION['pseudo'] = $nunu['pseudo'];
				echo '<OPTION value="' . $nunu['idmem'] . '">' . $nunu['pseudo'] . '</OPTION>';
			}

			?>





		</select>
		<input type="submit" name="btngo" value="Accéder au profil !">

	</form>





	<!-- <?php
			$sql = "SELECT * FROM membre WHERE idmem!=" . $_SESSION['idmem'] . " ";
			$res = mysqli_query($connexion, $sql);

			while ($nuplet = mysqli_fetch_array($res)) {


				echo "<p><a href='profilmem.php'> " . $nuplet['pseudo'] . " </a></p>";
				$_SESSION['pseudo'] = $nuplet['pseudo'];
			}



			?> -->

</body>

</html>