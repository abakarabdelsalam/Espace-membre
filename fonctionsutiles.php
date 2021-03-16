<?php

//paramètres de connexion 

define("MACHINE_MYSQL", "localhost");
define("ID_MYSQL", "root");
define("PASSE_MYSQL", "");
define("BASE_MYSQL", "db_projet");


function connexionMYSQL()
{
    $connexion = mysqli_connect(MACHINE_MYSQL, ID_MYSQL, PASSE_MYSQL, BASE_MYSQL);
    if ($connexion == NULL) //echec

    {
        echo ("erreur cnx");
        die("Connexion impossible");
    }
    //retour correct
    return $connexion;
}

function Login($connexion)
{
    //Fonction qui permet à un membre de se connecter

    if (isset($_GET['loginSubmit'])) {
        $id = $_GET['txt_id'];
        $mdp = $_GET['txt_passe'];
        $sql = "SELECT * FROM membre where pseudo='$id' AND mot_de_passe='$mdp'";
        $res = mysqli_query($connexion, $sql);
        if (mysqli_num_rows($res) > 0) {

            if ($row = mysqli_fetch_assoc($res)) {

                $_SESSION['idmem'] = $row['idmem'];
                header("location: connexion.php?loginsuccess");
                exit();
            }
        } else {

            header("location: connexionfailed.php?loginfailed");
            exit();
        }
    }
}

function Logout()
{

    if (isset($_GET['logoutSubmit'])) {
        session_start();
        session_destroy();
        header("location: index.php");
        exit();
    }
}


function commentaires($connexion)
{
    if (isset($_GET['commentSubmit'])) {
        $log = $_SESSION['idmem'];
        $date = $_GET['datecom'];
        $contenu = utf8_encode(utf8_decode(addslashes($_GET['contenucom'])));


        $sql = "INSERT INTO commentaire (idmem, datecom, contenucom) VALUES ('$log','$date','$contenu') ";
        $res = mysqli_query($connexion, $sql);
    }
}

function getcommentaires($connexion)
{
    $log = $_SESSION['idmem'];
    $sql = "SELECT * FROM commentaire WHERE idmem=" . $_SESSION['idmem'] . " AND idcom_1 IS NULL ORDER BY datecom DESC";
    $result = mysqli_query($connexion, $sql);
    while ($nuplet = mysqli_fetch_array($result)) {
        $log = $nuplet['idmem'];
        $sql2 = "SELECT * FROM membre WHERE membre.idmem='$log'";
        $res2 = mysqli_query($connexion, $sql2);

        if ($nuplet2 = mysqli_fetch_array($res2)) {


            echo '<b> Le ' . $nuplet['datecom'] . ' : </b></br> ';
            echo $nuplet['contenucom'] . "</br>";

            $sous_comm = "SELECT * FROM commentaire WHERE idcom_1='" . $nuplet['idcom'] . "' ORDER BY datecom DESC";
            $rescom = mysqli_query($connexion, $sous_comm);
            while ($reponse = mysqli_fetch_array($rescom)) {

                $reqauteur = "SELECT * FROM membre WHERE membre.idmem='" . $reponse['idmem'] . "'";
                $resreqauteur = mysqli_query($connexion, $reqauteur);
                $auteur = mysqli_fetch_array($resreqauteur);
                echo '<p></br>';
                echo utf8_encode(' <div class="rep"> <b> Reponse de ' . $auteur['pseudo'] . ' le ' . $reponse['datecom'] . '</b></div>  ' . $reponse['contenucom'] . '</br>');

                $reqlike2 = "SELECT * FROM apprecier WHERE idmem=" . $_SESSION['idmem'] . " AND idcom=" . $reponse['idcom'] . "";
                $reslike2 = mysqli_query($connexion, $reqlike2);
                $nbligne2 = mysqli_num_rows($reslike2);
                if ($nbligne2 == 0) {

                    echo "<form method='GET' action='likecom3.php'>
                    <input type='hidden' name='idcom' value='" . $reponse['idcom'] . "'>

                    <button type='submit' name='like_submit3'> Like </button> 
                    </form>

                    ";
                }

                $reqnblike3 = "SELECT count(idcom) as nblike3 FROM apprecier  WHERE idcom=" . $reponse['idcom'] . "";
                $resnblike3 = mysqli_query($connexion, $reqnblike3);
                if ($resnblike3 <> NULL) {
                    while ($nblike3 = mysqli_fetch_array($resnblike3)) {
                        echo '</br>';

                        echo 'Commentaire liké ' . $nblike3["nblike3"] . ' fois';
                    }
                }
                echo '<br><br>';
                echo '</p>';
                echo '</br>';
            }
        }
    }
}

function follow($connexion)
{
    if (isset($_GET['followSubmit'])) {
        $log = $_SESSION['idmem'];

        $log2 = $_GET['id'];

        $sql = "INSERT INTO s_abonner (idmem, idmem_membre) VALUES ('$log','$log2')";
        $res = mysqli_prepare($connexion, $sql);
        mysqli_stmt_execute($res);
        header("location: listmem.php");
        exit();
    }
}
