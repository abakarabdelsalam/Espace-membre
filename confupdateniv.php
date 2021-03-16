<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php

    //$pseudo=$_SESSION['pseudo'];
    session_start();
    require("fonctionsutiles.php");
    connexionMYSQL();
    $connexion = connexionMYSQL();
    $log = $_SESSION['idmem'];
    ///$id=$_SESSION['pseudo'];

    mysqli_error($connexion);
    //if (!isset($_GET['comp']));
    if (isset($_GET['supprimer'])) {
        $idcomp = $_GET['comp'];
        $idniv = $_GET['niv'];
        // for ($i = 0; $i < count($idcomp); $i++) {
        //for ($j = 0; $j < count($idniv); $j++) {
        //    
        //}

        ///echo($log.",".$idcomp[$i].",".$idniv[$j]);
        echo "</br>";
        var_dump($idcomp);
        echo ('br');
        var_dump($idniv);
        ///$sql1 ="UPDATE posseder  SET idcomp='$idcomp[0]',IDniv='$idniv[0]' where idmem='$log';" ;
        $sql1 = "UPDATE posseder SET IDniv='$idniv[0]' WHERE idmem='$log' AND idcomp='$idcomp[0]' ;";

        $resultat = mysqli_query($connexion, $sql1);
        echo mysqli_error($connexion);
        if ($resultat <> NULL) {
            $nbLignesMAJ = mysqli_affected_rows($connexion);
            echo ("<h1>$nbLignesMAJ Modification ou ajout des competences effectuées</h1>");
        } else {

            echo "Aucune competence n'a été enregistrée";
        }
        // }
        echo " <a href='profil.php'> Retourner</a>";
    }
    header("location: profil.php");
    exit();
    ?>

</body>

</html>