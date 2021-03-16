<?php

session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion=connexionMYSQL();

$sisi=$_GET['idcom'];
$sql="SELECT * FROM commentaire WHERE commentaire.idcom=".$sisi." AND idcom_1 IS NULL";
$res=mysqli_query($connexion,$sql);
$nuplet=mysqli_fetch_array($res);
echo'Le commentaire que vous avez LIKE : </br>';
echo '<h2> '.$nuplet['contenucom'].'  </br></h2> ';

$memco=$_SESSION['idmem'];
$idcom=$_GET['idcom'];

$reqcom="INSERT INTO apprecier (idmem, idcom) VALUES ('$memco','$idcom')";
$stmt = mysqli_prepare($connexion,$reqcom);
mysqli_stmt_execute($stmt);
echo '<a href="profil.php"> Retour au profil</a> </br>';
echo'<a href="listmem.php"> Retour sur la liste des membres </a>'; 
 header("location: listmem.php");
        exit();
