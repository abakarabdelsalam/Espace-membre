<?php
session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='style4.css'>
    <title></title>
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

    echo '<h2> Commentaire envoyé avec succès ! </h2>';


    $memco = $_SESSION['idmem'];
    $date = $_GET['datecom'];
    $idcom = $_GET['idcom'];
    $coco = $_SESSION['idcommentaire'];
    $text = utf8_decode(addslashes($_GET['contenucom']));

    $reqcom = "INSERT INTO commentaire (idmem, datecom, idcom, contenucom, idcom_1) VALUES ('$memco', '$date', '', '$text', $coco) ";
    $stmt = mysqli_prepare($connexion, $reqcom);
    mysqli_stmt_execute($stmt);

    ?>

</body>

</html>