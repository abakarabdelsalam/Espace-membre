 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="UTF-8">
     <title></title>
 </head>

 <body>
     <?php
        //$pseudo=$_SESSION['pesudo'];
        session_start();
        require("fonctionsutiles.php");
        connexionMYSQL();
        $connexion = connexionMYSQL();
        $log = $_SESSION['idmem'];

        //$id=$_SESSION['pseudo'];
        if (isset($_GET['supprimer'])) {
            $idcomp = $_GET['comp'];
            $idniv = $_GET['niv'];
            for ($i = 0; $i < count($idcomp); $i++) {
                for ($j = $i; $j < count($idniv); $j++) {
                    $idd = $idniv[$j];
                }
                var_dump($idcomp);
                echo ('br');
                var_dump($idniv);

                echo ($log . "," . $idcomp[$i] . "," . $idd);

                $sql1 = "DELETE FROM posseder WHERE idmem ='$log' AND idcomp='$idcomp[$i]' AND IDniv ='$idd' ;";
                $resultat = mysqli_query($connexion, $sql1);
                echo mysqli_error($connexion);
                if ($resultat <> NULL) {
                    $nbLignesMAJ = mysqli_affected_rows($connexion);
                    echo ("<h1>$nbLignesMAJ vous avez supprimer cette competence </h1>");
                } else {

                    echo "Aucune competence n'a été enregistrée";
                }
            }
            echo " <a href='profil.php'> Retourner</a>";
        }
        header("location: profil.php");
        exit();
        ?>
 </body>

 </html>