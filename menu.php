<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel='stylesheet' href='style.css'>
    <link rel='stylesheet' href='style5.css'>

</head>

<body>
    <div id="content">
        <div class='menu'>
            <ul>


                <li><a href='profil.php'>Mon profil</a></li>
                <li><a href='modifier.php'>Modifier mon Profil</a></li>
                <li><a href='listmem.php'>Liste des membres</a></li>
                <li><a href='rechercher.php'>Recherche</a></li>
                <li><a href='js.php'>Aidez Moi</a></li>



                <li><?php
					echo "<form method='GET' action='" . Logout() . "'>

    <button type='submit' name='logoutSubmit'> Déconnecter </button>

</form>";

					?></li>

        </div>
</body>

</html>