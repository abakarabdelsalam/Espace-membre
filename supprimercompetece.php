<!DOCTYPE html>
<html>

<head>

    <title>Suppression des competence </title>

</head>

<body>
    <form action="confsupprimercompetence.php" method="GET">

        <?php

        session_start();
        require("fonctionsutiles.php");
        connexionMYSQL();
        $connexion = connexionMYSQL();
        $log = $_SESSION['idmem'];

        echo ('<h1> veuillez modifier les  competences et le niveau </h1>');


        $query = "SELECT c.nomcomp,c.idcomp   FROM competence c, posseder p  where p.idcomp=c.idcomp and p.idmem='$log';";
        $result = mysqli_query($connexion, $query);
        //$i=0;
        while ($ligne = mysqli_fetch_array($result)) {
            $codea = $ligne['idcomp'];
            $noma = $ligne["nomcomp"];
            echo ("<p>");


            echo ("<input type = \"checkbox\" name = \"comp[]\" value = \"$codea\">");;


            echo utf8_encode($ligne["nomcomp"]);
            ///$taleau[$codea]=$i;
            //$i=$i+1;
            echo ("      ");
            $query = "SELECT p.IDniv,Nomniv FROM niveau n, posseder p where p.IDniv=n.IDniv and p.idcomp='$codea' ;";
            echo ("<select name='niv[]'>");
            $curseur1 = mysqli_query($connexion, $query);
            mysqli_error($connexion);
            while ($nuplet = mysqli_fetch_array($curseur1)) {
                $niv = $nuplet['IDniv'];
                $nomniv = $nuplet['Nomniv'];

                echo ("<option value=\"$niv\">");
                echo ($niv);
                echo ($nomniv);
                echo ("</option>");
            }
            echo ("</select>");
            echo ("</p>");
        }

        ?>

        <input type="submit" name="supprimer" value="supprimer" />
    </form>

    <a href="profil.php"> Retour au profil </a>

</body>

</html>