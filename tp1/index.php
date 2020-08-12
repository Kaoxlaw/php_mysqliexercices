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
      <input type="text" name="nom" value="Votre nom"><br><br>
      <label>Prénom:</label>
      <input type="text" name="prenom" value="votre prénom"><br><br>
      <label>Date:</label>
      <input type="date" name="ladate"><br><br>
      <fieldset>
        <legend>Lieu de naissance: </legend>
        <input type="radio" name="lieu" value="Saint Denis">Saint Denis
        <input type="radio" name="lieu" value="Reste du monde">Reste du monde
      </fieldset>
      <br><br>
      <label>Adresse postale:</label><textarea rows="2" col="30" name="adressepostale" value="Votre adresse"></textarea>
      <br><br>
      <label>Code postal:</label><input type="text" pattern="[0-9]{5}" placeholder="Saissisez 5 chiffres maximum" name="cp" value="76000">
      <br><br>
      <label>E-mail:</label><input type="email" name="email" value="Votre adresse électronique">
      <br><br>
      <label>Site:</label><input type="url" name="website" value="Votre page Web">
      <br><br>
      <label>Téléphone:</label>
      <input type="text" name="telephone" pattern="0[6-7][0-9]{8}" value="0658898531" placeholder="Exemple : 0602030405 sans espace ni tirets">
      <br><br>
      <label>Semestre:</label>
      <select name="semestre" size=3>
        <option>S1</option>
        <option selected>S2</option>
        <!--Selection par défaut du choix S2 -->
        <option>S3</option>
        <option>S4</option>
      </select>
      <br><br>
      <label>Niveau en HTML:</label>
      <input type="range" name="niveauhtml" value="" max="10" min="0" step="1">
      <br><br>
      <fieldset id="fconnaissances">
        <legend>Connaissances: </legend>
        <input type="checkbox" checked="checked" name="connaissances[]" value="HTML">HTML
        <!--Selection par défaut du choix HTML -->
        <input type="checkbox" name="connaissances[]" value="CSS">CSS
        <input type="checkbox" name="connaissances[]" value="Formulaires">Formulaires
        <input type="checkbox" name="connaissances[]" value="JavaScript">JavaScript
      </fieldset>
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
    !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['ladate']) && !empty($_POST['lieu'])
    && !empty($_POST['adressepostale']) && !empty($_POST['cp']) && !empty($_POST['email']) && !empty($_POST['website'])
    && !empty($_POST['telephone']) && !empty($_POST['semestre']) && !empty($_POST['niveauhtml']) && !empty($_POST['connaissances'])
  ) {

    //etape5
    $nom = $idcom->escape_string($_POST['nom']);
    $prenom = $idcom->escape_string($_POST['prenom']);
    $ladate = $_POST['ladate'];
    $lieu = $idcom->escape_string($_POST['lieu']);
    $adressepostale = $idcom->escape_string($_POST['adressepostale']);
    $cp = $idcom->escape_string($_POST['cp']);
    $email = $idcom->escape_string($_POST['email']);
    $website = $idcom->escape_string($_POST['website']);
    $telephone = $idcom->escape_string($_POST['telephone']);
    $semestre = $idcom->escape_string($_POST['semestre']);
    $niveauhtml = $idcom->escape_string($_POST['niveauhtml']);

    $result = "";
    foreach ($_POST['connaissances'] as $val) {
      $result .= $val . '/';
    }
    $connaissances = $idcom->escape_string($result);

    // $connaissances = $idcom->escape_string($_POST['connaissances']);

    //etape6
    $request = "INSERT INTO formulaire (nom, prenom, ladate, lieu, adressepostale, cp, email, website, 
    telephone, semestre, niveauhtml, connaissances) VALUES 
    ('$nom', '$prenom', '$ladate', '$lieu', '$adressepostale', '$cp', '$email', '$website', 
    '$telephone','$semestre', '$niveauhtml','$connaissances')";

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