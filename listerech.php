<?php

session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();
$_SESSION['comp'] = $_GET['lstcomp'];

?>

<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='style4.css'>

    <title>Membres</title>
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
    <h1> Résultats de la recherche </h1>
    <?php
    $reqcomp = "SELECT competence.Nomcomp FROM competence WHERE idcomp=" . $_SESSION['comp'] . "";
    $res = mysqli_query($connexion, $reqcomp);
    $nomcomp = mysqli_fetch_array($res);
    ?>
    Compétence recherchée : <?php echo '<b>' . $nomcomp['Nomcomp'] . '</b>'; ?>
    <br><br>


    Liste des membres possédant cette compétence : <br><br>
    <?php

    $req = "SELECT membre.pseudo, niveau.Nomniv FROM niveau, membre, posseder WHERE membre.idmem=posseder.idmem AND membre.idmem!=" . $_SESSION['idmem'] . " AND niveau.IDniv=posseder.IDniv AND posseder.idcomp= " . $_SESSION['comp'] . " ";
    $res = mysqli_query($connexion, $req);
    if (mysqli_num_rows($res) == 0) {
        echo '<b>Aucun membre ne possède cette compétence</b></br></br>';
    } else {
        echo '<p>';
        while ($nunu = mysqli_fetch_array($res)) {
            $_SESSION['pseudo'] = $nunu['pseudo'];
            echo utf8_encode(' <b> ' . $nunu['pseudo'] . '  - Niveau : ' . $nunu['Nomniv'] . ' </b><br><br>');
        }

        echo '</p>';
    }
    ?>
    Membres dont la compétence est recommandée : <br><br>
    <?php

    $req1 = "SELECT membre.pseudo FROM membre, recommander WHERE membre.idmem=recommander.idmem_membre  AND recommander.idcomp= " . $_SESSION['comp'] . " ";
    $res1 = mysqli_query($connexion, $req1);
    if (mysqli_num_rows($res1) == 0) {
        echo '<b>Aucun membre est recommandé sur cette compétence</b></br></br>';
    } else {
        echo '<p>';
        while ($nunu1 = mysqli_fetch_array($res1)) {
            $_SESSION['pseudo'] = $nunu1['pseudo'];
            echo '<b> ' . $nunu1['pseudo'] . '</b> <br><br>';
        }

        echo '</p>';
    }
    ?>

</body>

</html>