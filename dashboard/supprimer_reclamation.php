<?php
require_once ('../database.php');
$conn = config::getConnexion();
$id=$_GET["id"];
$req=$conn->prepare("DELETE FROM reclamation WHERE ID=?");
$req->execute([$id]);
header('Location:page_admin.php');
?>