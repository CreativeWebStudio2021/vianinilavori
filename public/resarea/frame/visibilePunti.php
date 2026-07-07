<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['id_prod'])) $id_prod=$_GET['id_prod']; else $id_prod="";

$query="SELECT visibile FROM ".$prec_db."punti_mappa WHERE id='$id_prod'";
$resu = $open_connection->connection->query($query);
list($visibile)=$resu->fetch();

if($visibile==0) $query2="UPDATE ".$prec_db."punti_mappa SET visibile='1' WHERE id='$id_prod'";
else  $query2="UPDATE ".$prec_db."punti_mappa SET visibile='0' WHERE id='$id_prod'";
$risu = $open_connection->connection->query($query2);

?>