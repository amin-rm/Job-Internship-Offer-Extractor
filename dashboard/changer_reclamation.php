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
        text: 'Modification effectue avec succees',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    }
    function afficher_message_erreur() {
  Swal.fire({
    title: 'Erreur!',
    text: 'Une erreur s\'est produite lors de l \'envoi du modification',
    icon: 'error',
    confirmButtonText: 'OK'
  });
}
  </script>
</body>
</html>

<?php
require_once('../database.php');
$conn = config::getConnexion();
$id=$_GET['id'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$email=$_POST['email'];
$message=$_POST['message'];

if(isset($nom))
{
$query = $conn-> prepare ('UPDATE reclamation SET Nom = ?  where ID =?');
$query->execute([$nom,$id]);
}
if(isset($prenom))
{
$query = $conn-> prepare ('UPDATE reclamation SET Prenom = ?  where ID =?');
$query->execute([$prenom,$id]);
}

if(isset($email))
{
$query = $conn-> prepare ('UPDATE reclamation SET Email = ?  where ID =?');
$query->execute([$email,$id]);
}
if(isset($message))
{
$query = $conn->prepare('UPDATE reclamation SET Message = ?  where ID =?');
$query->execute([$message,$id]);
}

echo "<script language=javascript> afficher_message(); </script>";
echo "<script language='javascript'> 
      setTimeout(function() {
          window.location.href = 'page_admin.php';
      }, 2000); 
      </script>";
?>