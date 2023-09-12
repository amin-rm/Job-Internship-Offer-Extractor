<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
  <script>
    function afficher_message() {
      Swal.fire({
        title: 'Succès!',
        text: 'Votre message a été envoyé avec succès',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    }
    function afficher_message_erreur() {
  Swal.fire({
    title: 'Erreur!',
    text: 'Une erreur s\'est produite lors de l \'envoi du message',
    icon: 'error',
    confirmButtonText: 'OK'
  });
}

  </script>
</body>
</html>

<?php
require_once("database.php");
$conn=config::getConnexion();
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$email=$_POST["email"];
$message=$_POST["message"];

$req=$conn->prepare("INSERT INTO reclamation (Nom,Prenom,Email,Message) VALUES(?,?,?,?)");
$req->execute([$nom,$prenom,$email,$message]);

if(isset($req))
{
    echo "<script language='javascript'> 
    afficher_message();
    </script>";

    echo "<script language='javascript'> 
    setTimeout(function() {
        window.location.href = 'reclamation.html';
    }, 2000); 
    </script>";
}
else
{
    echo "<script language='javascript'> 
    afficher_message_erreur();
    </script>";

    echo "<script language='javascript'> 
    setTimeout(function() {
        window.location.href = 'reclamation.html';
    }, 2000); 
    </script>";
}
?>