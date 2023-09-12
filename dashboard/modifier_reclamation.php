<?php
require_once('../database.php');
$conn = config::getConnexion();
$id=$_GET['id'];
$req=$conn->prepare("SELECT * FROM reclamation WHERE ID=?");
$req->execute([$id]);
$res=$req->fetchAll(PDO::FETCH_OBJ);
foreach($res as $row)
{
    echo ('
    <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de Réclamation</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
  <div class="container">
    <h1>Formulaire de Réclamation</h1>
    <form name="f2" method="POST" action="changer_reclamation.php?id='.$row->ID.'">
      <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value ='.$row->Nom.'>
      </div>
      <div class="form-group">
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value='.$row->Prenom.'>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value='.$row->Email.'>
      </div>
      <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message">'.$row->Message.'</textarea>
      </div>
      <button type="submit"  class="btn" name="envoyer">Modifier</button>
    </form>
  </div>
</body>
</html>
    ');
}
?>