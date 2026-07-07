<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['id_prod'])) $id_prod=$_GET['id_prod']; else $id_prod="";

$query="SELECT visibile_scheda FROM ".$prec_db."punti_mappa WHERE id='$id_prod'";
$resu = $open_connection->connection->query($query);
list($visibile_scheda)=$resu->fetch();

if($visibile_scheda==0) $query2="UPDATE ".$prec_db."punti_mappa SET visibile_scheda='1' WHERE id='$id_prod'";
else  $query2="UPDATE ".$prec_db."punti_mappa SET visibile_scheda='0' WHERE id='$id_prod'";
$risu = $open_connection->connection->query($query2);

?>