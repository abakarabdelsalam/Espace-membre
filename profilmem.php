<?php
date_default_timezone_set('Europe/Paris');
session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();
$_SESSION['mem'] = $_GET['lstmem'];
?>

<!DOCTYPE html>
<html>

<head>

    <title> Profil Membre </title>
    <link rel='stylesheet' href='style4.css'>

</head>

<body>
    <div>
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

    $pseud = $_SESSION['pseudo'];
    $sql = "SELECT * FROM membre WHERE membre.idmem=" . $_SESSION['mem'] . " ";
    $res = mysqli_query($connexion, $sql);
    $profil = mysqli_fetch_array($res);

    echo '<h1> Profil de : ' . $profil['pseudo'] . ' </h1>';

    echo ' Nom : ' . $profil['nommem'] . ' <br><br>';
    echo ' Prénom : ' . $profil['prenommem'] . ' <br><br>';
    echo ' Email : ' . $profil['email'] . ' <br><br>';

    $reqfollow = "SELECT * FROM s_abonner WHERE idmem=" . $_SESSION['idmem'] . " AND idmem_membre=" . $_SESSION['mem'] . "";
    $resfollow = mysqli_query($connexion, $reqfollow);
    $nb_follow = mysqli_num_rows($resfollow);
    if ($nb_follow > 0) {
      echo '<b> Vous suivez cet abonné ! </b> <br><br>';
    } else {
      echo "<form method='GET' action = '" . follow($connexion) . "'>
			  <input type='hidden' name='id' value='" . $_SESSION['mem'] . "'>
			  <button type='submit' name='followSubmit'> Suivre ! </button>
			  </form> <br><br>";
    }

    ?>
    </div>
    </div>
    <div id="contenu">
        <table id="table">
            <TR>
                <TD>
                    <h2>Compétences</h2>
                </TD>
                <TD>
                    <div class="blank">************************</div>
                </TD>
                <TD>
                    <h2>Ses posts</h2>
                </TD>
            </TR>

            <TR>
                <TD>
                    <h4> Possédées </h4>
        </table>
        <?php
    $reqcompetence = "SELECT competence.Nomcomp, niveau.Nomniv FROM competence, posseder, membre, niveau WHERE membre.idmem=" . $_SESSION['mem'] . " AND competence.idcomp=posseder.idcomp AND membre.idmem=posseder.idmem AND posseder.IDniv=niveau.IDniv";
    $rescompetence = mysqli_query($connexion, $reqcompetence);
    if (mysqli_num_rows($rescompetence) == 0) {
      echo 'Aucune compétence';
    } else {

      echo '<p>';

      while ($nunu = mysqli_fetch_array($rescompetence)) {

        echo utf8_encode(' ' . $nunu['Nomcomp'] . ' - Niveau : ' . $nunu['Nomniv'] . ' </br></br>');
      }
    }
    echo '</p>';

    echo '<h4> Recommandées par les membres </h4>';

    $reqrec = "SELECT competence.Nomcomp,membre.pseudo FROM competence, recommander, membre WHERE recommander.idmem_membre=" . $_SESSION['mem'] . " AND competence.idcomp=recommander.idcomp AND membre.idmem=recommander.idmem ";
    $resrec = mysqli_query($connexion, $reqrec);
    if (mysqli_num_rows($resrec) == 0) {
      echo 'Pas encore de compétences recommandées...</br><a href="Recommander.php">Recommander des compétences ?</a>';
    } else {

      echo '<p>';

      while ($nurec = mysqli_fetch_array($resrec)) {

        echo '' . $nurec['Nomcomp'] . ' par <b>' . $nurec['pseudo'] . '</b><br> </br>';
      }
      echo '</p>';
      echo '</br><a href="Recommander.php">Recommander des compétences ?</a>';
    }
    ?>
        </TD>
        <TD>
            <div class="blank">************************</div>
        </TD>
        <TD>

            <?php
      if ($nb_follow < 1) {
        echo '<b> Pour voir les post de ce membre, vous devez le Suivre </b></br>';
      } else {
        $reqpost = "SELECT * FROM commentaire, membre WHERE membre.idmem=" . $_SESSION['mem'] . " AND commentaire.idmem=membre.idmem AND idcom_1 IS NULL ORDER BY datecom DESC";
        $respost = mysqli_query($connexion, $reqpost);
        $nb = mysqli_num_rows($respost);
        echo '<UL>';

        while ($post = mysqli_fetch_array($respost)) {

          $_SESSION['cocom'] = $post['idcom'];
          echo utf8_encode('<li> <b> Post du : ' . $post['datecom'] . ' </b> </br> ' . $post['contenucom'] . ' </br>');


          echo "<form method='GET' action='commenter.php'>
<input type='hidden' name='idcom' value='" . $post['idcom'] . "'>
<button type ='submit' name='reponseSubmit'>Commenter</button>
</form>";

          $reqlike = "SELECT * FROM apprecier WHERE idmem=" . $_SESSION['idmem'] . " AND idcom=" . $post['idcom'] . "";
          $reslike = mysqli_query($connexion, $reqlike);
          $nbligne = mysqli_num_rows($reslike);
          if ($nbligne == 0) {

            echo "<form method='GET' action='likecom.php'>
 <input type='hidden' name='idcom' value='" . $post['idcom'] . "'>
 <button type='submit' name='like_submit'> Like </button> 
</form>

 ";
          }

          $reqnblike = "SELECT count(idcom) as nblike FROM apprecier  WHERE idcom=" . $post['idcom'] . "";
          $resnblike = mysqli_query($connexion, $reqnblike);
          if ($resnblike <> NULL) {
            while ($nblike = mysqli_fetch_array($resnblike)) {

              echo 'Commentaire liké ' . $nblike["nblike"] . ' fois';
            }
          }

          echo '</li></br>';


          $sous_comm = "SELECT * FROM commentaire WHERE idcom_1='" . $post['idcom'] . "'";
          $rescom = mysqli_query($connexion, $sous_comm);

          while ($reponse = mysqli_fetch_array($rescom)) {


            $reqauteur = "SELECT * FROM membre WHERE membre.idmem='" . $reponse['idmem'] . "'";
            $resreqauteur = mysqli_query($connexion, $reqauteur);
            $auteur = mysqli_fetch_array($resreqauteur);
            echo '<UL>';
            echo '<div class="rep">';
            echo utf8_encode(' <li> <b> Reponse de ' . $auteur['pseudo'] . ' le ' . $reponse['datecom'] . '</b> : </div> ' . $reponse['contenucom'] . '');
            $reqlike2 = "SELECT * FROM apprecier WHERE idmem=" . $_SESSION['idmem'] . " AND idcom=" . $reponse['idcom'] . "";

            $reslike2 = mysqli_query($connexion, $reqlike2);
            $nbligne2 = mysqli_num_rows($reslike2);
            if ($nbligne2 == 0) {

              echo "<form method='GET' action='likecom2.php'>
                                      <input type='hidden' name='idcom' value='" . $reponse['idcom'] . "'>
                                      <input type='hidden' name='contenucom2' value='" . $reponse['contenucom'] . "'>
                                      <button type='submit' name='like_submit2'> Like </button> 
                                      </form>

                                         ";
            }

            $reqnblike2 = "SELECT count(idcom) as nblike2 FROM apprecier  WHERE idcom=" . $reponse['idcom'] . "";
            $resnblike2 = mysqli_query($connexion, $reqnblike2);
            if ($resnblike2 <> NULL) {
              while ($nblike2 = mysqli_fetch_array($resnblike2)) {
                echo '</br>';

                echo 'Commentaire liké ' . $nblike2["nblike2"] . ' fois';
              }

              echo '</li>';
            }
            echo '</UL>';
            echo '</br>';
          }
        }
        echo '</UL>';
      }
      ?>
        </TD>
        </TR>
    </div>
</body>

</html>