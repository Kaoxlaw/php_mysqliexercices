<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <title>Mon formulaire</title>
  <link rel="stylesheet" href=styles.css>
</head>

<body>
  <header></header>
  <h1> Mon premier formulaire</h1>

  <form action="index.php" method="post">
    <fieldset id="main">
      <legend>Notre formulaire :</legend>
      <label>Nom:</label>
      <input type="text" name="nom" value="Votre nom">
      <br><br>
      <input type="submit" value="Envoyer">
      <input type="reset" value="Annuler">
    </fieldset>
  </form>
  <br>
  <footer> Formulaire réalisé dans le cadre du TP 2 de la formation de développeurs intégrateurs et codeurs web</footer>

  <?php
  //Etape1 Inclusion des paramètres de connexion
  include_once("myparams.php");

  //Etape2 Connexion au serveur
  $idcom = new mysqli(HOST, USER, PASS, "formulaire", PORT);

  //Etape3 Affichage d'un message en cas d'erreurs
  if (!$idcom) {
    echo "Connexion impossible à la base";
    exit();
  }

  //etape4
  if (
    !empty($_POST['nom'])
  ) {

    //etape5
    $nom = $idcom->escape_string($_POST['nom']);

    //etape6
    $request = "SELECT * FROM formulaire WHERE nom LIKE '$nom%'";

    //etape7
    $result = $idcom->query($request);


    //etape8
    echo "<table border>
    <tr>
    <td> Nom </td>
    <td> Prenom </td>
    <td> Date de naissance </td>
    <td> Lieu de naissance </td>
    <td> Adresse </td>
    <td> Code Postal </td>
    <td> Email </td>
    <td> SiteWeb </td>
    <td> Telephone </td>
    <td> Semestre </td>
    <td> Niveau HTML </td>
    <td> Connaissances </td>

    </tr>";

    //etape8
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      echo "<tr>
      <td>" . $row['nom'] . "</td>
      <td>" . $row['prenom'] . "</td>
      <td>" . $row['ladate'] . "</td>
      <td>" . $row['lieu'] . "</td>
      <td>" . $row['adressepostale'] . "</td>
      <td>" . $row['cp'] . "</td>
      <td>" . $row['email'] . "</td>
      <td>" . $row['website'] . "</td>
      <td>" . $row['telephone'] . "</td>
      <td>" . $row['semestre'] . "</td>
      <td>" . $row['niveauhtml'] . "</td>
      <td>" . $row['connaissances'] . "</td>
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