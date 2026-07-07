<?php 
$table="punti_mappa";
$pagina="punti";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_POST['stato_invio'])) $stato_invio=$_POST['stato_invio']; else $stato_invio="";

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
		//else if (document.gino.img_testata.value=="") alert('Immagine obbigatoria');
		else if (document.gino.latitudine.value=="") alert('Latitudine obbigatoria');
		else if (document.gino.longitudine.value=="") alert('Longitudine obbigatoria');
		else document.gino.submit();
	}
</script>
<?php 
if($stato_invio=="inviato"){
	$arr_no['stato_invio']=1;
	$arr_thumb['img_testata']=400;
	
	$oggetto_admin->inserisci_campi ($table , $arr_no, $arr_thumb, "img_up/punti");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Punti Mappa</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato_invio" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine($table);
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						<select name="categoria">
							<?php $query_cat="SELECT * FROM categorie ORDER BY ordine DESC";
							$risu_cat = $open_connection->connection->query($query_cat);
							while($arr_cat=$risu_cat->fetch()){?>
								<option value='<?php echo $arr_cat['id'];?>'><?php echo $arr_cat['nome'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Titolo*", "titolo" , "1", 'no');	
				if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){
					$oggetto_admin->campo_ins("File custom", "file_custom" , "1", 'no');	
				}
				$oggetto_admin->campo_ins("Sottotitolo 1", "sottotitolo1" , "1", 'no');	
				$oggetto_admin->campo_ins("Sottotitolo 2", "sottotitolo2" , "1", 'no');	
				$oggetto_admin->campo_ins("Sottotitolo 3", "sottotitolo3" , "1", 'no');	
				$oggetto_admin->campo_ins("Immagine", "img_testata" , "4", 'no',"","","","img_up/punti");	
				$oggetto_admin->campo_ins("Video <br/>Caricare tramite FTP in public/resarea/video e inserire solo il nome del file mp4<br/>Se inserito verrà mostrato al posto dell'immagine", "Video" , "1", 'no');	
				$oggetto_admin->campo_ins("Video Mobile<br/>Caricare tramite FTP in public/resarea/video e inserire solo il nome del file mp4<br/>Se inserito verrà mostrato al posto dell'immagine", "Video" , "1", 'no');	
				$oggetto_admin->campo_ins("Latitudine*", "latitudine" , "1", 'no');	
				$oggetto_admin->campo_ins("Longitudine*", "longitudine" , "1", 'no');	
				$oggetto_admin->campo_ins("Committente", "committente" , "1", 'no');	
				//$oggetto_admin->campo_ins("Tipologia", "tipologia" , "1", 'no');	
				$oggetto_admin->campo_ins("Ubicazione", "ubicazione" , "1", 'no');
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Stato</label>
					<div class="mws-form-item">
						<select name="stato">
							<option value='Lavoro in corso'>Lavoro in corso</option>
							<option value='Lavoro completato'>Lavoro completato</option>
						</select>
					</div>
				</div>

				<div style="width:100%; background:#26262A">
					<div style="padding:10px 10px; color:#fff">
						<b>Descrizione</b>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione Breve</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="descrizione_breve" name="descrizione_breve"></textarea>
					</div>
				</div>
				<?php 
				//$oggetto_admin->campo_ins("Titolo Descrizione", "titolo_descrizione" , "1", 'no');	
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Descrizione</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="descrizione" name="descrizione"></textarea>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Testo Link", "testo_link" , "1", 'no');	
				$oggetto_admin->campo_ins("Link (https://...)", "link" , "1", 'no');	
				//$oggetto_admin->campo_ins("Titolo Bullet Points", "titolo_valori" , "1", 'no');	
				?>
				<div style="width:100%; background:#26262A">
					<div style="padding:10px 10px; color:#fff">
						<b>Bullet Points</b>
					</div>
				</div>
				<?php
				$oggetto_admin->campo_ins("Titolo Bullet Point 1", "valore_dato_1" , "1", 'no');	
				$oggetto_admin->campo_ins("Testo Bullet Point 1", "descrizione_dato_1" , "1", 'no');	
				$oggetto_admin->campo_ins("Titolo Bullet Point 2", "valore_dato_2" , "1", 'no');	
				$oggetto_admin->campo_ins("Testo Bullet Point 2", "descrizione_dato_2" , "1", 'no');	
				$oggetto_admin->campo_ins("Titolo Bullet Point 3", "valore_dato_3" , "1", 'no');	
				$oggetto_admin->campo_ins("Testo Bullet Point 3", "descrizione_dato_3" , "1", 'no');	
				$oggetto_admin->campo_ins("Titolo Bullet Point 4", "valore_dato_4" , "1", 'no');	
				$oggetto_admin->campo_ins("Testo Bullet Point 4", "descrizione_dato_4" , "1", 'no');	
				$oggetto_admin->campo_ins("Titolo Bullet Point 5", "valore_dato_5" , "1", 'no');	
				$oggetto_admin->campo_ins("Testo Bullet Point 5", "descrizione_dato_5" , "1", 'no');	
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
$id_textarea = "descrizione";
include("ckeditor5.php");
$id_textarea = "descrizione_breve";
include("ckeditor5.php");
}
?>
