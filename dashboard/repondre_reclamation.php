<?php
require_once ('../database.php');
$conn = config::getConnexion();
$email=$_GET['email'];
$id=$_GET['id'];

echo ('
<!DOCTYPE html>
<html>
<head>
<style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    form {
      width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    label {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .textarea {
      width: 100%;
      height: 200px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #button {
      display: block;
      width: 100px;
      margin: 20px auto;
      padding: 10px;
      font-size: 16px;
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    #button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<center>
<form name="fr" method="POST" action="envoyer.php?id='.$id.'&email='.$email.'">
<label><h3><u> Votre Réponse </u></h3></label>

<textarea class="textarea" name="message" id="message" cols="60" rows="30" placeholder="Votre Message"></textarea>
<br>
<input type="submit" id="button" name="send" value="Envoyer" class="btn">
</center>
</body>
</head>
</html>
');

?>