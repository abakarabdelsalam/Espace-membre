<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    session_start();
    require("fonctionsutiles.php");
    connexionMYSQL();
    $connexion = connexionMYSQL();
    ///$pseud=$_SESSION['pseudo'];
    $pseud = $_SESSION['mem'];
    $pseudo = $_SESSION["pseudo"];
    ////$comprec=$_SESSION["comprec"];
    //$nivposs=$_SESSION["nivposs"];
    //$_SESSION['mem']=$_GET['lstmem'];
    $log = $_SESSION['idmem'];

    if (isset($_GET['recommander'])) {

        $idcomp = $_GET['comp'];
        $reqprofil = "SELECT * FROM membre WHERE membre.idmem_membre='$pseud'";
        $resprofil = mysqli_query($connexion, $reqprofil);

        for ($i = 0; $i < count($idcomp); $i++) {
            $sql1 = "INSERT INTO `recommander` (`idmem`, `idcomp`, `idmem_membre`) VALUES ('$log', '$idcomp[$i]','$pseud');";
            $resultat = mysqli_query($connexion, $sql1);
            echo mysqli_error($connexion);
            if ($resultat <> NULL) {
                $nbLignesMAJ = mysqli_affected_rows($connexion);
                echo ("<h1>$nbLignesMAJ Vous  avez recommander des competence .</h1>");
            } else {

                echo "Aucune competence n'a été recommandéée";
            }
        }
        echo " <a href='profil.php'> Retourner</a>";
    }
    header("location: listmem.php");
    exit();
    ?>


</body>

</html>