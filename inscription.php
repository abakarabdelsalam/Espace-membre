<?php
require("fonctionsutiles.php");
connexionMYSQL();
$connexion = connexionMYSQL();
// on teste si le visiteur a soumis le formulaire
if (isset($_GET['inscription']) && $_GET['inscription'] == 'Inscription') {
  // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
  if ((isset($_GET['nom']) && !empty($_GET['nom'])) && (isset($_GET['prenom']) && !empty($_GET['prenom'])) && (isset($_GET['pseudo']) && !empty($_GET['pseudo'])) && (isset($_GET['mail']) && !empty($_GET['mail'])) && (isset($_GET['password']) && !empty($_GET['password'])) && (isset($_GET['password_confirm']) && !empty($_GET['password_confirm']))) {

    // on teste les deux mots de passworde
    if ($_GET['password'] != $_GET['password_confirm']) {
      $erreur = 'Les 2 mots de passe sont différents.';
    } else {

      // on recherche si ce pseudo est déjà utilisé par un autre membre
      $sql = 'SELECT count(*) FROM membre WHERE pseudo="' . ($_GET['pseudo']) . '" and email="' . ($_GET['mail']) . '"';
      $req = mysqli_query($connexion, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error());
      $data = mysqli_fetch_array($req);

      if ($data[0] == 0) {
        $sql = 'INSERT INTO membre (`idmem`, `nommem`, `prenommem`, `pseudo`, `email`, `mot_de_passe`) VALUES("", "' . ($_GET['nom']) . '", "' . ($_GET['prenom']) . '","' . ($_GET['pseudo']) . '","' . ($_GET['mail']) . '","' . ($_GET['password']) . '")';
        mysqli_query($connexion, $sql);

        session_start();
        $_SESSION['mail'] = $_GET['mail'];
        $_SESSION['pseudo'] = $_GET['pseudo'];
        header('Location: index.php');
        exit();
      } else {
        $erreur = 'Un membre possède déjà ce pseudo ou ce mail.';
      }
    }
  } else {
    $erreur = 'Au moins un des champs est vide.';
  }
}
?>
<html>

<head>
    <title>Inscription</title>
    <link rel='stylesheet' href='style1.css'>
</head>

<body>
    <div id="content">
        <h1>Inscription à l'espace membre : </h1><br />
        <form action="inscription.php" method="GET">


            <p><label for 'nom'>Nom</label> <input type="text" name="nom"
                    value="<?php if (isset($_GET['nom'])) echo htmlentities(trim($_GET['nom'])); ?>"></p>
            <p><label for 'prenom'> Prénom :</label> <input type="text" name="prenom"
                    value="<?php if (isset($_GET['prenom'])) echo htmlentities(trim($_GET['prenom'])); ?>"></p>
            <p><label for 'pseudo'> Pseudo :</label> <input type="text" name="pseudo"
                    value="<?php if (isset($_GET['pseudo'])) echo htmlentities(trim($_GET['pseudo'])); ?>"></p>
            <p><label for 'mail'> Mail :</label> <input type="text" name="mail"
                    value="<?php if (isset($_GET['mail'])) echo htmlentities(trim($_GET['mail'])); ?>"></p>
            <p><label for 'password'>Mot de passe :</label> <input type="password" name="password"
                    value="<?php if (isset($_GET['password'])) echo htmlentities(trim($_GET['password'])); ?>"></p>
            <p><label for 'password_confirm'>Confirmation du mot de passe :</label> <input type="password"
                    name="password_confirm"
                    value="<?php if (isset($_GET['password_confirm'])) echo htmlentities(trim($_GET['password_confirm'])); ?>">
            </p>

            <p><input type="submit" name="inscription" value="Inscription"></p>
        </form>
        <a href="connexion.php">Déjà inscrit ? Vous connecter</a>
        <?php
    if (isset($erreur)) echo '<br />', $erreur;
    ?>

        <p>
            Veuillez vous inscrire pour avoir un compte.
        </p>
    </div>

    <body>
    </body>

</html>