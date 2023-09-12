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
        text: 'Compte créer avec succees',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    }
   function afficher_message_erreur() {
  Swal.fire({
    title: 'Erreur!',
    text: 'Compte existe deja',
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
if((isset($_POST["username"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["password"])))
{
$username=$_POST["username"];
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$email=$_POST["email"];
$password=MD5($_POST["password"]);
$role=$_POST["user-type"];
$req=$conn->prepare("SELECT * FROM user WHERE Email=? OR Username=?");
$req->execute([$email,$username]);
if($req->rowCount()>0)
{
    echo "<script language='javascript'> 
    afficher_message_erreur();
    </script>";
    echo "<script language='javascript'> 
    setTimeout(function() {
        window.location.href = 'signup.html';
    }, 2000); 
    </script>";
}
else
{
$req2=$conn->prepare("INSERT INTO user VALUES(?,?,?,?,?,?)");
$res=$req2->execute([$username,$nom,$prenom,$email,$password,$role]);
if($res)
{
echo "<script language='javascript'> 
    afficher_message();
    </script>";
    echo "<script language='javascript'> 
    setTimeout(function() {
        window.location.href = 'login.html';
    }, 2000); 
    </script>";
}
else
{
    echo "Erreur au niveau de l'insertion";
}
}
}
?>






