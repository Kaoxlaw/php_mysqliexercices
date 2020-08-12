<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connect To MySQL</title>
</head>

<body>


  <h1>Ceci est mon formulaire</h1>

  <form method="post" action="index.php">
    <fieldset>
      <legend>Enregistrement des contacts dans le carnet</legend>
      <label>Nom</label>
      <input type="text" name="nom"> <br> <br>

      <label>Prénom</label>
      <input type="text" name="prenom"> <br> <br>

      <label>Date de naissance</label>
      <input type="date" name="naissance"> <br> <br>

      <label>Ville</label>
      <input type="text" name="ville"> <br> <br>

      <input type="submit" value="envoyer"> <br> <br>

    </fieldset>
  </form>

  <?php
  //Etape1 Inclusion des paramètres de connexion
  include_once("myparams.inc.php");

  //Etape2 Connexion au serveur
  $idcom = new mysqli(HOST, USER, PASS, "carnet", PORT);

  //Etape3 Affichage d'un message en cas d'erreurs
  if (!$idcom) {
    echo "Connexion impossible à la base)";
    exit();
  }

  //etape4
  if (!empty($_POST['nom']) && ($_POST['prenom']) && ($_POST['naissance']) && ($_POST['ville'])) {

    //etape5
    $nom = $idcom->escape_string($_POST['nom']);
    $prenom = $idcom->escape_string($_POST['prenom']);
    $naissance = $_POST['naissance'];
    $ville = $idcom->escape_string($_POST['ville']);

    //etape6
    $request = "INSERT INTO carnet (nom, prenom, naissance, ville) VALUES ('$nom', '$prenom', '$naissance', '$ville')";

    //etape7
    $result = $idcom->query($request);

    //etape8
    if ($result) {
      echo "Vous avez bien été enregistré au numéro $idcom->insert_id";
    } else {
      echo "error $idcom->error";
    }

    //Fermeture de la connexion
    $idcom->close();
  } else {
    echo "Veuillez remplir le formulaire!";
  }

  ?>

</body>

</html>