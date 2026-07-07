<?php 
require_once '../config/dbnew.php';	

if(isset($_GET['id_cat'])) $id_cat=$_GET['id_cat']; else $id_cat="";

$query="SELECT bio_visibile FROM ".$prec_db."categorie_cariche WHERE id='$id_cat'";
$resu = $open_connection->connection->query($query);
list($bio_visibile)=$resu->fetch();

if($bio_visibile==0) $query2="UPDATE ".$prec_db."categorie_cariche SET bio_visibile='1' WHERE id='$id_cat'";
else  $query2="UPDATE ".$prec_db."categorie_cariche SET bio_visibile='0' WHERE id='$id_cat'";
$risu = $open_connection->connection->query($query2);

?>