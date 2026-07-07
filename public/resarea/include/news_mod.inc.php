<?php 
$table="news";
$pagina="news";
$directory="news";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_categoria = $arr_rec['categoria'];
$n_tit = $arr_rec['titolo'];
$n_sottotitolo = $arr_rec['sottotitolo'];
$n_foto = $arr_rec['img'];
$n_foto2 = $arr_rec['img2'];
$n_foto3 = $arr_rec['img3'];
$n_data = $oggetto_admin->date_to_data($arr_rec['data_news']);
$n_testo = $arr_rec['testo'];
$n_pdf = $arr_rec['pdf'];
$n_link = $arr_rec['link'];
$n_video = $arr_rec['video'];
$n_linkedin = $arr_rec['linkedin'];
$n_instagram = $arr_rec['instagram'];
$n_testo_link = $arr_rec['testo_link'];

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.titolo.value=="") alert('Titolo obbigatorio');
		else if (document.gino.data_mod.value=="") alert('Data obbigatoria');
		else document.gino.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$cancimg")){unlink("img_up/$cancimg");}
	if(is_file("img_up/s_$cancimg")){unlink("img_up/s_$cancimg");}
	
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
	$arr_no['data_mod']=1;
	$arr_thumb['img']=400; 
	$arr_thumb['img2']=400; 
	$arr_thumb['img3']=400; 
	
	if (isset($_POST['data_mod'])) $_POST['data_news'] = $oggetto_admin->date_to_data($_POST['data_mod']);

	if (isset($_POST['data_mod'])) $data_mod = $oggetto_admin->date_to_data($_POST['data_mod']);
		else $data_mod = "";

	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  "", "img_up/".$directory, "files/".$directory);
	
	if ($data_mod!="") $open_connection->connection->query("update $table set data_news='$data_mod' where id='$id_rec'");
	$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

	if ($categoria === "") {$categoria = null;}

	$sql = "UPDATE $table SET categoria = :categoria WHERE id = :id";
	$stmt = $open_connection->connection->prepare($sql);
	$stmt->execute([':categoria' => $categoria,':id' => $id_rec,]);

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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica news</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						<select name="categoria">
							<option value=""></option>
							<?php $query_cat="SELECT * FROM categorie_news ORDER BY ordine DESC";
							$risu_cat = $open_connection->connection->query($query_cat);
							while($arr_cat=$risu_cat->fetch()){?>
								<option value='<?php echo $arr_cat['id'];?>' <?php if($arr_cat['id'] == $n_categoria){?>selected="selected"<?php }?>><?php echo $arr_cat['nome'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Titolo*" , "titolo" , "$n_tit"  , "1", 'no', "$cmd", "$id_rec","","","","",1);
				$oggetto_admin->campo_mod("Sottotitolo" , "sottotitolo" , "$n_sottotitolo"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				?>
				
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Data *</label>
						<div class="mws-form-item">
							<input type="text" name="data_mod" class="mws-datepicker large"  value="<?php echo $n_data;?>" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Foto" , "img" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec","","","img_up/".$directory);
				$oggetto_admin->campo_mod("Foto 2" , "img2" , "$n_foto2"  , "4", 'no', "$cmd", "$id_rec","","","img_up/".$directory);
				$oggetto_admin->campo_mod("Foto 3" , "img3" , "$n_foto3"  , "4", 'no', "$cmd", "$id_rec","","","img_up/".$directory);
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="testo" name="testo"><?php  echo $n_testo; ?></textarea>
					</div>
				</div>
				
				<?php 
				$oggetto_admin->campo_mod("Pdf" , "pdf" , "$n_pdf"  , "5", 'no', "$cmd", "$id_rec","","","","files/news",0);
				$oggetto_admin->campo_mod("Link" , "link" , "$n_link"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				$oggetto_admin->campo_mod("Testo Link" , "testo_link" , "$n_testo_link"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				$oggetto_admin->campo_mod("Video" , "video" , "$n_video"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				$oggetto_admin->campo_mod("Link LinkedIn" , "linkedin" , "$n_linkedin"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				$oggetto_admin->campo_mod("Link Instagram" , "instagram" , "$n_instagram"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				?>
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
