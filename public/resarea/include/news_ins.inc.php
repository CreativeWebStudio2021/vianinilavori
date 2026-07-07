<?php 
$table="news";
$pagina="news";
$directory="news";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=news<?php echo $rif;?>';
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
if($stato=="inviato"){
	print_r($_POST);
	$arr_no['stato']=1;
	$arr_no['data_mod']=1;
	$arr_thumb['img']=400; 
	$arr_thumb['img2']=400; 
	$arr_thumb['img3']=400; 
	
	if (isset($_POST['data_mod'])) $_POST['data_news'] = $oggetto_admin->date_to_data($_POST['data_mod']);
		
	$oggetto_admin->inserisci_campi ($table , $arr_no, $arr_thumb, "img_up/".$directory);
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci news</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=news_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						<select name="categoria">
							<option></option>
							<?php $query_cat="SELECT * FROM categorie_news ORDER BY ordine DESC";
							$risu_cat = $open_connection->connection->query($query_cat);
							while($arr_cat=$risu_cat->fetch()){?>
								<option value='<?php echo $arr_cat['id'];?>'><?php echo $arr_cat['nome'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Titolo *", "titolo" , "1", 'no');	
				$oggetto_admin->campo_ins("Sottotitolo", "sottotitolo" , "1", 'no');	
				?>
				<div class="mws-form-inline">
					<div class="mws-form-row">
						<label class="mws-form-label">Data *</label>
						<div class="mws-form-item">
							<input type="text" name="data_mod" class="mws-datepicker large"  value="" readonly="readonly" style="width:20%">
						</div>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Foto", "img" , "4", 'no');	
				$oggetto_admin->campo_ins("Foto 2", "img2" , "4", 'no');	
				$oggetto_admin->campo_ins("Foto 3", "img3" , "4", 'no');	
			?>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="testo" name="testo"></textarea>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Pdf", "pdf" , "5", 'no');	
				$oggetto_admin->campo_ins("Link (se non c'è Pdf)", "link" , "1", 'no');	
				$oggetto_admin->campo_ins("Testo link", "testo_link" , "1", 'no');
				$oggetto_admin->campo_ins("Video", "video" , "1", 'no');	
				$oggetto_admin->campo_ins("Link LinkedIn", "linkedin" , "1", 'no');	
				$oggetto_admin->campo_ins("Link Instagram", "instagram" , "1", 'no');	
				?>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
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