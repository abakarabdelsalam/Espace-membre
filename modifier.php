<?php

session_start();
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();

?>


<!DOCTYPE html>
<html>

<head>
    <title>Modifications du profil</title>
    <link rel='stylesheet' href='style3.css'>
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

    <?php
    $log = $_SESSION['idmem'];
    $reqprofil = "SELECT * FROM membre WHERE membre.idmem='$log'";
    $resprofil = mysqli_query($connexion, $reqprofil);
    $profil = mysqli_fetch_array($resprofil);
    ?>
    <form action='confmodif.php' method='GET'>



        <p> <label for='nommodif'> Nom : </label> <input type='text' name='nommodif' value='<?php echo '' . $profil["nommem"] . ''; ?>' size='20' placeholder='Saisissez votre nom' required /> </p>
        <p> <label for='prenommodif'> Prénom : </label> <input type='text' name='prenommodif' value='<?php echo '' . $profil["prenommem"] . ''; ?>' size='20' placeholder='Saisissez votre prenom' required /></p>
        <p> <label for='pseudomodif'> Pseudo : </label> <input type='text' name='pseudomodif' value='<?php echo '' . $profil["pseudo"] . ''; ?>' size='20' placeholder='Saisissez votre Pseudo' required /></p>
        <p> <label for='mailmodif'> Email : </label> <input type='text' name='mailmodif' value='<?php echo '' . $profil["email"] . ''; ?>' size='20' placeholder='Saisissez votre mail' required /></p>
        <p> <label for='passwordmodif'>Mot de passe: </label> <input type='password' name='passwordmodif' value='<?php echo '' . $profil["mot_de_passe"] . ''; ?>' size='20' placeholder='Saisissez votre mot de passe' required /> </p>



        <p> <label for='btnmodif'> </label> <input type='submit' value='Page suivant ' name='btnmodif' />
        </p>

    </form>


</body>

</html>