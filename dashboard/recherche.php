<?php
require_once ('../database.php');
$conn = config::getConnexion();
$cont =$_POST["search"];
if (!isset($cont))
{
    header("location:index.php");
    die();
}
else
{
    try
    {
    $Req = $db->prepare('SELECT * FROM mail_data WHERE Email LIKE ?');    
    $Req->execute(["%".$cont."%"]);
    $Req = $Req->fetchAll(PDO::FETCH_ASSOC);
    foreach($Req as $c)
    {
        echo("
        <tbody>
        <tr>
        <td align='center'><center><i><b>".$c['email']."</b></i></center></td>
        <td align='center'><center><b>".$c['region']."<b></center></td>
        <td align='center'><center>".$c['offer_type']."</center></td>
        <td align='center'><center>".$c['req_skills']."</center></td>
        <td align='center'><center>".$c['duration']."</center></td>
        </tr>
        </tbody>
        "); 
    }
    }
    catch (PDOException $e)
                    {
                        echo($e->getMessage());
                    }
}

?>