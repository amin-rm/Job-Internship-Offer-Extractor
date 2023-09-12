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
        text: 'Bienvenue',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    }
   function afficher_message_erreur() {
  Swal.fire({
    title: 'Erreur!',
    text: 'Adresse Mail ou Mot de Passe est incorrect',
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
session_start();
if(isset($_POST["email"]) && isset($_POST["password"]))
{
$email=$_POST["email"];
$pass = MD5($_POST["password"]);
$req = $conn->prepare("SELECT * FROM user WHERE Email=? AND Pass=MD5(?)");
$req->execute([$email, $_POST["password"]]);
$res = $req->fetchAll(PDO::FETCH_ASSOC);
if($req->rowCount()>0)
{
  echo "<script language='javascript'> 
    afficher_message();
    </script>";
  foreach($res as $resu)
    {
      if($resu["Pass"]==$pass)
      {
        $_SESSION["Username"]=$resu["Username"];
        $_SESSION['Nom'] = $resu['Nom'];
        $_SESSION['Prenom'] = $resu['Prenom'];
        $_SESSION['Email'] = $resu['Email'];
        $_SESSION['Role'] = $resu['Role'];
      }
    }
    echo "<script language='javascript'> 
    setTimeout(function() {
        window.location.href = 'dashboard/index.php';
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
        window.location.href = 'login.html';
    }, 2000); 
    </script>";
}


}
?>