<?php

session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifications du profil</title>
    <link rel='stylesheet' href='style4.css'>
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
    <div id="content">
        <h1> Ajouter des compétences ?</h1>

    </div>

    <form action="update.php">
        <?php

        $log = $_SESSION['idmem'];
        $nom = $_GET['nommodif'];
        $prenom = $_GET['prenommodif'];
        $pseudo = $_GET['pseudomodif'];
        $pwd = $_GET['passwordmodif'];
        $mail = $_GET['mailmodif'];

        $reqmodif = "UPDATE membre SET nommem='$nom', prenommem='$prenom', pseudo='$pseudo', email='$mail', mot_de_passe='$pwd' WHERE membre.idmem ='$log'  ";
        $stmt = mysqli_prepare($connexion, $reqmodif);
        mysqli_stmt_execute($stmt);

        ?>

        <form action="update.php">
            <?php
            $query = "SELECT c.nomcomp,c.idcomp   FROM competence c where c.idcomp not in (select p.idcomp from posseder p ,competence c where p.idcomp=c.idcomp and p.idmem='$log');";
            $result = mysqli_query($connexion, $query);
            echo ("<p><select name ='comp[]'>");
            while ($ligne = mysqli_fetch_array($result)) {
                $codea = $ligne["idcomp"];
                $noma = $ligne["nomcomp"];
                echo ($codea);
                echo ("<option value=\"$codea\">");
                echo utf8_encode($ligne["nomcomp"]);

                echo ("</option>");
            }
            echo ("</select>");

            echo ("      ");
            $query1 = "select IDniv, Nomniv "
                . "from niveau ";
            echo ("<select name ='niv[]'>");
            $curseur1 = mysqli_query($connexion, $query1);
            while ($nuplet = mysqli_fetch_array($curseur1)) {
                $niv = $nuplet["IDniv"];
                $libniv = $nuplet["Nomniv"];
                echo ($niv);
                echo ("<option value=\"$niv\">");
                echo ($libniv);

                echo ("</option>");
            }
            echo ("</select>");
            echo ("</p>");


            ?>

            <p> <label for="btn"> </label> <input type="submit" name="modif" value="Ajouter" /> </p>

        </form>

        <p><a href='updateniv.php'> Modifier une de vos compétences ?</a></p>
        <p><a href='supprimercompet.php'> Supprimer des competences</a></p>
        </div>

</body>

</html>