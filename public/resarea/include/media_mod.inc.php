<?php 
$table="media";
$pagina="media";
$directory="media";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_tit = $arr_rec['titolo'];
$n_testo = $arr_rec['testo'];
$n_id_rife = (int)($arr_rec['id_rife'] ?? 0);
$n_id_gruppo = (int)($arr_rec['id_gruppo'] ?? 0);

$rif="";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
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
	/*$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}*/
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;

	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  "", "img_up/".$directory, "files/".$directory);

?>
	<script language="javascript">
		window.location = "admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>" ;
	</script>
<?php 
}
else
{		
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Testi Foto/Video</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Titolo*" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec","","","","",1);
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Sezione</label>
					<div class="mws-form-item">
						<select name="id_gruppo">
							<?php
							if($n_id_rife>0){
								$risu_gruppi = $open_connection->connection->query("SELECT * FROM media_gruppi WHERE id_gallery='$n_id_rife' ORDER BY ordine DESC");
								if($risu_gruppi){
									while($arr_gruppo = $risu_gruppi->fetch()){
										?>
										<option value="<?php echo (int)$arr_gruppo['id']; ?>" <?php if($n_id_gruppo==(int)$arr_gruppo['id']){?>selected="selected"<?php }?>>
											<?php echo htmlspecialchars($arr_gruppo['nome']); ?>
										</option>
										<?php
									}
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="testo" name="testo"><?php  echo $n_testo; ?></textarea>
					</div>
				</div>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;"><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"> <i>cliccando sulla gomma che compare vicino ad un campo si cancella il contenuto del campo stesso</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>

<?php 
$id_textarea = "testo";
include("ckeditor5.php");

}
?>
