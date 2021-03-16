<!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    require("fonctionsutiles.php");
    connexionMYSQL();
    $connexion = connexionMYSQL();

    $nomcomp = $_GET["comp"];
    $sql = "INSERT INTO `competence` (`idcomp`, `Nomcomp`) VALUES ('','$nomcomp' )";
    $resultat = mysqli_query($connexion, $sql);
    echo mysqli_error($connexion);
    if ($resultat <> NULL) {
        $nbLignesMAJ = mysqli_affected_rows($connexion);
        echo ("<h1>$nbLignesMAJ une competence a été ajoutée </h1>");
    } else {

        echo "Aucune competence n'a été enregistrée";
    }

    echo " <a href='profil.php'> Retourner</a>";


    ?>
</body>

</html>