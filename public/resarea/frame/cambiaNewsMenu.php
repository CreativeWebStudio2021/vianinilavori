<?php 
require_once '../config/dbnew.php';	
if(isset($_GET['id_dett'])) $id_dett=$_GET['id_dett']; else $id_dett="";

$query="SELECT visibile FROM ".$prec_db."news_menu WHERE id='$id_dett'";
$resu = $open_connection->connection->query($query);
list($visibile)=$resu->fetch();

if($visibile==0) $query2="UPDATE ".$prec_db."news_menu SET visibile='1' WHERE id='$id_dett'";
else  $query2="UPDATE ".$prec_db."news_menu SET visibile='0' WHERE id='$id_dett'";
echo $query2;
$risu = $open_connection->connection->query($query2);

?>