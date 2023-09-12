<?php
session_start();
?>

<html>
    <head>
        <title>Page Admin</title>
</head>
<body>
    <h1><u> La liste des Réclamations</h1></u> 
    <br
    <center>
    <table border="2">
        <tr>
        <th>
                NUMERO
           </th>

            <th>
                Nom
           </th>

           <th>
                Prenom
           </th>

           <th>
                Email
           </th>

           <th>
                Date Réclamation
           </th>
           <th>
                Message
           </th>
           <th>
                Etat
           </th>

           <th colspan="3">
            Opérations
            </th>
</tr>

<?php
require_once ('../database.php');
$conn = config::getConnexion();
$requete="SELECT * FROM reclamation";
$query=$conn->prepare($requete);
$query->execute();

$result=$query->fetchAll(PDO::FETCH_ASSOC);
if($result)
{
    foreach($result as $row)
    {
        $id=$row['ID'];
        $mail=$row['Email'];
        echo "<tr>";
        echo "<td>". $row['ID'] ."</td>";
        echo "<td>". $row['Nom'] ."</td>";
        echo "<td>". $row['Prenom'] ."</td>";
        echo "<td>". $row['Email'] ."</td>";
        echo "<td>". $row['Date Reclamation'] ."</td>";
        echo "<td>". $row['Message'] ."</td>";
        echo "<td>". $row['Etat']."</td>";
        echo "<td><a  href='supprimer.php?id=".$id."'>Supprimer</a></td>";
        echo "<td><a  href='modifier.php?id=".$id."'>Modifier</a></td>";
        echo "<td><a  href='repondre.php?id=".$id."&email=".$mail."'>Répondre</a></td>";
        echo "</tr>";
    }
}
?>
</table>
</body>
</html>