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

    <title> Mon profil </title>
    <link rel='stylesheet' href='style.css'>

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

    <TABLE border=1>
        <TR>
            <TD>
                <div id="contenu">
                    <h1>Vos informations</h1>
            </TD>
            <TD>
                <h1>Vos posts </h1>
            </TD>
        </TR>
        <TR>
            <TD>
                <?php
        $reqprofil = "SELECT * FROM membre WHERE membre.idmem='$log'";
        $resprofil = mysqli_query($connexion, $reqprofil);
        $profil = mysqli_fetch_array($resprofil);
        echo ' Nom : ' . $profil['nommem'] . ' <br><br>';
        echo ' Prénom : ' . $profil['prenommem'] . ' <br><br>';
        echo ' Pseudo : ' . $profil['pseudo'] . ' <br><br>';
        echo ' Email : ' . $profil['email'] . ' <br><br>';
        ?>

                <h3>Vos compétences</h3>
                <?php
        $reqcompetence = "SELECT competence.Nomcomp, niveau.Nomniv FROM competence, posseder, membre, niveau WHERE membre.idmem='$log' AND competence.idcomp=posseder.idcomp AND membre.idmem=posseder.idmem AND posseder.IDniv=niveau.IDniv";
        $rescompetence = mysqli_query($connexion, $reqcompetence);

        if (mysqli_num_rows($rescompetence) == 0) {
          echo 'Aucune compétence';
        } else {
          echo '<p>';

          while ($nunu = mysqli_fetch_array($rescompetence)) {

            echo utf8_encode(' ' . $nunu['Nomcomp'] . ' - Niveau : ' . $nunu['Nomniv'] . ' <br><br>');
          }
          echo '</p>';
        }

        echo '<h3> Compétences recommandées par les membres </h3>';

        $reqrec = "SELECT competence.Nomcomp, membre.pseudo FROM competence, recommander, membre WHERE recommander.idmem_membre=" . $_SESSION['idmem'] . " AND competence.idcomp=recommander.idcomp AND membre.idmem=recommander.idmem ";
        $resrec = mysqli_query($connexion, $reqrec);
        if (mysqli_num_rows($resrec) == 0) {
          echo 'Pas encore de compétences recommandées...';
        } else {

          echo '<p>';

          while ($nurec = mysqli_fetch_array($resrec)) {

            echo ' ' . $nurec['Nomcomp'] . ' par<b> ' . $nurec['pseudo'] . ' </b><br><br>';
          }
          echo '</p>';
        }

        ?>
            </TD>
            <TD>

                <?php







        echo "<form method='GET' action='" . commentaires($connexion) . "'>
<input type='hidden' name='idcom' value='" . $_SESSION['idmem'] . "'>
<input type='hidden' name='datecom' value='" . date('Y-m-d H:i:s') . "'>
<textarea name='contenucom'></textarea></br>
<button type ='submit' name='commentSubmit'>Publier</button>

</form>";

        getcommentaires($connexion);

        ?>
            </TD>
        </TR>
    </TABLE>

</body>

</html>