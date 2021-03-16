<?php

session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion=connexionMYSQL();



$memco=$_SESSION['idmem'];
$idcom=$_GET['idcom'];

$reqcom="INSERT INTO apprecier (idmem, idcom) VALUES ('$memco','$idcom')";
$stmt = mysqli_prepare($connexion,$reqcom);
mysqli_stmt_execute($stmt);
header("location: profil.php");
        exit();
