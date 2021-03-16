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

        <?php
        echo "<form method='GET' action='" . Logout() . "'>

    <button type='submit' name='logoutSubmit'> Logout </button>

</form>";

        ?>
      </div>
    </header>
    <?php include 'menu.php' ?>
  </div>
  <div id="content">
    <form action="confupdateniv.php" method="GET">


      <?php


      echo ('<h1> veuillez modifier vos  competences </h1>');


      $query = "SELECT c.nomcomp,c.idcomp   FROM competence c, posseder p  where p.idcomp=c.idcomp and p.idmem='$log';";
      $result = mysqli_query($connexion, $query);
      echo ("<select name ='comp[]'>");
      while ($ligne = mysqli_fetch_array($result)) {
        $codea = $ligne["idcomp"];
        $noma = $ligne["nomcomp"];
        echo ($codea);
        echo ("<option value=\"$codea\">");
        echo utf8_encode($ligne["nomcomp"]);


        echo ("</option>");
      }
      echo ("</select>");
      echo ("</p>");

      echo ("      ");

      $query = "SELECT IDniv,Nomniv FROM niveau  ;";
      echo ("<select name='niv[]'>");
      $curseur1 = mysqli_query($connexion, $query);
      mysqli_error($connexion);
      while ($nuplet = mysqli_fetch_array($curseur1)) {
        $niv = $nuplet['IDniv'];
        $nomniv = $nuplet['Nomniv'];

        echo ("<option value=\"$niv\">");
        echo ($nomniv);
        echo ("</option>");
      }
      echo ("</select>");
      echo ("</p>");


      ?>


      <input type="submit" name="supprimer" value="Valider">
    </form>
    <a href="profil.php"> Retour au profil </a>

</body>

</html>