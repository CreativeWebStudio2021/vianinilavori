<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['id_campo'])) $id_campo=$_GET['id_campo']; else $id_campo="";

$query="SELECT visibile FROM ".$prec_db."news_menu WHERE id='$id_campo'";
$resu = $open_connection->connection->query($query);
list($visibile)=$resu->fetch();

if($visibile==0) $query2="UPDATE ".$prec_db."news SET visibile='1' WHERE id='$id_campo'";
else  $query2="UPDATE ".$prec_db."news SET visibile='0' WHERE id='$id_campo'";
$risu = $open_connection->connection->query($query2);

?>