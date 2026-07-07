<?php 
$table="testi_introduttivi";
$pagina="testi";

if(isset($_GET['id_rec'])) $id_rec=$_GET['id_rec'];
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $pagina;?>&id_rec=<?php echo $id_rec;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		document.gino.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc = NULL where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $pagina;?>&id_rec=<?php echo $id_rec;?>';
	</script>	
<?php 
} 

if($stato=="inviato"){
	$arr_no['stato']=1;
	
	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  "", "img_up/".$directory, "files/".$directory);
	
?>
	<script language="javascript">
		window.location = "admin.php?cmd=<?php echo $pagina;?>&id_rec=<?php echo $id_rec;?>" ;
	</script>
<?php 
}else{
	?>
	<div class="mws-panel grid_8">
		<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Testi introduttivi pagine</b></div>
		<?php 
		$query_testi = "SELECT * FROM ".$prec_db."testi_introduttivi WHERE id='$id_rec'ORDER BY ordine DESC";
		$risu_testi = $open_connection->connection->query($query_testi);
		while($arr_testi=$risu_testi->fetch()){?>
			<div class="mws-panel-header">
				<span><?php echo $arr_testi['pagina'];?></span>
			</div>
			<div class="mws-panel-body no-padding">
				<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>&id_rec=<?php echo $id_rec;?>" method="post" enctype="multipart/form-data">
					<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
					<input type="hidden" name="stato" value="inviato">
					<div class="mws-form-inline">
						
						<div class="mws-form-row">
							<label class="mws-form-label">
								Testo
								<br/><a href="admin.php?cmd=<?php echo $pagina;?>&id_rec=<?php echo $id_rec;?>&campocanc=testo" class="testo10" ><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a></label>
							</label>
							<div class="mws-form-item">
								
								<textarea class="ckeditor" id="testo" name="testo"><?php echo $arr_testi['testo'];?></textarea>
							</div>
						</div>
						
						
					</div>
					<div class="mws-button-row">
						<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
						<input type="button" value="Annulla" class="btn" onclick="annulla()">
					</div>
				</form>
			</div>
		<?php }?>
		
		<div style="margin-left:20px; padding-bottom:10px;"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
	</div>

	<?php 
	$id_textarea = "testo";
	include("ckeditor5.php");
}?>
