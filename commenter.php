<?php
date_default_timezone_set('Europe/Paris');
session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel='stylesheet' href='style3.css'>
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


    <?php
	$sisi = $_GET['idcom'];
	$_SESSION['idcommentaire'] = $sisi;
	$sql = "SELECT * FROM commentaire WHERE commentaire.idcom=" . $sisi . " AND idcom_1 IS NULL";
	$res = mysqli_query($connexion, $sql);
	$nuplet = mysqli_fetch_array($res);
	echo '<h2> ' . $nuplet['contenucom'] . ' : </br></h2> ';

	echo "<form method='GET' action='confirmercom.php'>
			<input type='hidden' name='idcom' value='" . $_SESSION['idmem'] . "'>
			<input type='hidden' name='datecom' value='" . date('Y-m-d H:i:s') . "'>
			<textarea name='contenucom'></textarea></br>
			<button type ='submit' name='repsubmit'>Commenter</button>";
	?>

</body>

</html>