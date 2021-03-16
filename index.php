<?php

session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Espace Membre</title>
    <link rel='stylesheet' href='style1.css'>
</head>

<body>

    <?php
  echo "<div id='content'>";
  echo "<h1> Espace Membre ! </h1>";
  if (!isset($_SESSION['idmem'])) {
    echo " <p> Pas encore inscrit ? Veuillez <a href='inscription.php'> cliquer ici ! </a> </p><br>";

    echo " <p> Déjà membre ? <a href='connexion.php'> Connectez vous ! </a> </p>";
  } else {
    echo "Bonjour <b>";

    $log = $_SESSION['idmem'];
    $reqnom = "SELECT membre.pseudo FROM membre WHERE membre.idmem='$log'";
    $resnom = mysqli_query($connexion, $reqnom);
    $nom = mysqli_fetch_array($resnom);
    echo '' . $nom['pseudo'] . '';

    echo " </b> , Vous êtes connecté ! <br><br>";

    echo "<a href='profil.php'> Mon profil </a><br><br>";
    echo "<form method='GET' action='" . Logout() . "'>

        <button type='submit' name='logoutSubmit'> Se déconnecter </button>

        </form>";
  }

  echo "</div>";
  ?>