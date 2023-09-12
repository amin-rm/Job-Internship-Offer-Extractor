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
        text: 'Votre Réponse a été envoyé avec succès',
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
require "repondre_reclamation.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email=$_GET['email'];
$id=$_GET['id'];

require 'C:\xampp\htdocs\Réclamation\dashboard\phpmailer\src\Exception.php';
require 'C:\xampp\htdocs\Réclamation\dashboard\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Réclamation\dashboard\phpmailer\src\SMTP.php';

if (isset($_POST["send"]))
{
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username="jawhertalbi12@gmail.com";
    $mail->Password="lzhloxsdkhilazeg";
    $mail->SMTPSecure='ssl';
    $mail->Port=465;
    $mail->setFrom('jawhertalbi12@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject="Reponse de votre reclamation";
    $mail->Body=$_POST["message"];
    if($mail->send())
    {
      echo "<script language='javascript'> 
      afficher_message();
      </script>";
  
      echo "<script language='javascript'> 
      setTimeout(function() {
          window.location.href = 'page_admin.php';
      }, 2000); 
      </script>";
        $etat=1;
        $query = $conn->prepare('UPDATE reclamation SET Etat = ?  where ID =?');
        $query->execute([$etat,$id]);
    }
    else
    {
      echo "<script language='javascript'> 
      afficher_message_erreur();
      </script>";
  
      echo "<script language='javascript'> 
      setTimeout(function() {
          window.location.href = 'page_admin.php';
      }, 2000); 
      </script>";
    }
}
?>