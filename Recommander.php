<?php
session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();
$pseud = $_SESSION['mem'];
$pseudo = $_SESSION["pseudo"];
$log = $_SESSION['idmem']


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
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

                <?php
                echo "<form method='GET' action='" . Logout() . "'>

    <button type='submit' name='logoutSubmit'> Logout </button>

</form>";

                ?>
            </div>
        </header>

        <?php include 'menu.php' ?>
    </div>


    <?php
    echo ('<h3> Ses competences obtenues par recommandations  </h3>');
    $sql  = "SELECT c.Nomcomp From recommander r ,competence c WHERE c.idcomp=r.idcomp and 	idmem_membre='$pseud'";
    $resultat = mysqli_query($connexion, $sql);
    echo mysqli_error($connexion);
    if ($resultat != "") {
        while ($ligne = mysqli_fetch_array($resultat)) {

            echo ($ligne["Nomcomp"]);
            echo ("</p>");
        }
    } else {
        echo (mysqli_error($session));
        echo ("requete avec erreur(s)");
    }


    ?>

    <h3> Recommander des competences </h3>
    <div id="contenu">
        <form action="confrecommander.php">
            <?php

            echo ("<p>");

            $query = "SELECT c.nomcomp,c.idcomp   FROM competence c where c.idcomp not in (select r.idcomp from recommander r ,membre m where m.idmem=r.idmem and r.idmem_membre='$pseud');";
            $result = mysqli_query($connexion, $query);

            while ($ligne = mysqli_fetch_array($result)) {
                $codea = $ligne["idcomp"];
                $noma = $ligne["nomcomp"];
                echo '<TABLE border=0>';
                echo ('<TR><TD><input type ="checkbox" name="comp[]" value=' . $ligne["idcomp"] . '></TD><TD>' . utf8_encode($ligne['nomcomp']) . '</p></TD></TR></TABLE>');
            }

            ?>
            <p><label for="recommander"></label> <input type="submit" name="recommander" value="recommander"></p>

        </form>




</body>

</html>