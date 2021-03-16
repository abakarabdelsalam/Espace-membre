<?php
session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();
$log = $_SESSION['idmem'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style3.css'>

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

    <div id="contenu">
        <?php

        mysqli_error($connexion);
        if (!isset($_GET['comp']));
        elseif (isset($_GET['modif'])) {
            $idcomp = $_GET['comp'];
            $idniv = $_GET['niv'];
            //foreach ($idcomp as $id){
            //  echo($id);
            ///for($i=0;$log<$i;$i++ );

            // $sql2 = "Delete From membre where idmem='$log'";
            // $resultat2 = mysqli_query($connexion, $sql2);
            for ($i = 0; $i < count($idcomp); $i++) {
                for ($j = $i; $j < $idcomp[$i]; $j++) {
                    $idd = $idniv[$j & $i];
                }

                echo "</br>";

                $sql1 = "INSERT INTO posseder(`idmem`, `idcomp`,`IDniv`) VALUES ('$log','$idcomp[$i]','$idd')";
                $resultat = mysqli_query($connexion, $sql1);
                echo mysqli_error($connexion);
                if ($resultat <> NULL) {

                    echo ("<h3>Compétence ajoutée !</h3>");
                } else {

                    echo "Aucune competence n'a été enregistrée";
                }
            }
        }
        ?>

</body>

</html>