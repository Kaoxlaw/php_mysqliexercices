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

      <!-- <label>Prénom</label>
      <input type="text" name="prenom"> <br> <br>

      <label>Date de naissance</label>
      <input type="date" name="naissance"> <br> <br>

      <label>Ville</label>
      <input type="text" name="ville"> <br> <br> -->

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
  if (!empty($_POST['nom'])) {

    //etape5
    $nom = $idcom->escape_string($_POST['nom']);

    //etape6
    $request = "SELECT * FROM carnet WHERE nom LIKE '$nom%'";

    //etape7
    $result = $idcom->query($request);

    echo "<table border>
    <tr>
    <td> Nom </td>
    <td> Prenom </td>
    <td> Date de naissance </td>
    <td> Ville </td>
    </tr>";

    //etape8
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      echo "<tr>
      <td>
      " . $row['nom'] . "
      </td>
      <td>
      " . $row['prenom'] . "
      </td>
      <td>
      " . $row['naissance'] . "
      </td>
      <td>
      " . $row['ville'] . "
      </td>
      </tr>";
      echo "<br/>";
    };

    //Fermeture de la connexion
    $idcom->close();
  } else {
    echo "Veuillez remplir le formulaire!";
  }
  echo "</table>";

  ?>

</body>

</html>