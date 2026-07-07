<?php 
$table="punti_mappa";
$pagina="punti";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_POST['stato_invio'])) $stato_invio=$_POST['stato_invio']; else $stato_invio="";

$rif="";
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_categoria = $arr_rec['categoria'];
$n_titolo = htmlspecialchars($arr_rec['titolo'], ENT_QUOTES, 'UTF-8');
$n_file_custom = htmlspecialchars($arr_rec['file_custom'], ENT_QUOTES, 'UTF-8');
$n_titolo_bold = htmlspecialchars($arr_rec['titolo_bold'], ENT_QUOTES, 'UTF-8');
$n_sottotitolo1 = htmlspecialchars($arr_rec['sottotitolo1'], ENT_QUOTES, 'UTF-8');
$n_sottotitolo2 = htmlspecialchars($arr_rec['sottotitolo2'], ENT_QUOTES, 'UTF-8');
$n_sottotitolo3 = htmlspecialchars($arr_rec['sottotitolo3'], ENT_QUOTES, 'UTF-8');
$n_img_testata = $arr_rec['img_testata'];
$n_video = $arr_rec['video'];
$n_video_mobile = $arr_rec['video_mobile'];
$n_latitudine = $arr_rec['latitudine'];
$n_longitudine = $arr_rec['longitudine'];
$n_committente = htmlspecialchars($arr_rec['committente'], ENT_QUOTES, 'UTF-8');
$n_ubicazione = htmlspecialchars($arr_rec['ubicazione'], ENT_QUOTES, 'UTF-8');
//$n_tipologia = htmlspecialchars($arr_rec['tipologia'], ENT_QUOTES, 'UTF-8');
$n_stato = htmlspecialchars($arr_rec['stato'], ENT_QUOTES, 'UTF-8');
$n_descrizione = htmlspecialchars($arr_rec['descrizione'], ENT_QUOTES, 'UTF-8');
$n_descrizione_breve = htmlspecialchars($arr_rec['descrizione_breve'], ENT_QUOTES, 'UTF-8');
$n_valore_dato_1 = htmlspecialchars($arr_rec['valore_dato_1'], ENT_QUOTES, 'UTF-8');
$n_descrizione_dato_1 = htmlspecialchars($arr_rec['descrizione_dato_1'], ENT_QUOTES, 'UTF-8');
$n_valore_dato_2 = htmlspecialchars($arr_rec['valore_dato_2'], ENT_QUOTES, 'UTF-8');
$n_descrizione_dato_2 = htmlspecialchars($arr_rec['descrizione_dato_2'], ENT_QUOTES, 'UTF-8');
$n_valore_dato_3 = htmlspecialchars($arr_rec['valore_dato_3'], ENT_QUOTES, 'UTF-8');
$n_descrizione_dato_3 = htmlspecialchars($arr_rec['descrizione_dato_3'], ENT_QUOTES, 'UTF-8');
$n_valore_dato_4 = htmlspecialchars($arr_rec['valore_dato_4'], ENT_QUOTES, 'UTF-8');
$n_descrizione_dato_4 = htmlspecialchars($arr_rec['descrizione_dato_4'], ENT_QUOTES, 'UTF-8');
$n_valore_dato_5 = htmlspecialchars($arr_rec['valore_dato_5'], ENT_QUOTES, 'UTF-8');
$n_descrizione_dato_5 = htmlspecialchars($arr_rec['descrizione_dato_5'], ENT_QUOTES, 'UTF-8');
//$n_titolo_descrizione = htmlspecialchars($arr_rec['titolo_descrizione'], ENT_QUOTES, 'UTF-8');
//$n_titolo_valori = htmlspecialchars($arr_rec['titolo_valori'], ENT_QUOTES, 'UTF-8');
$n_css_custom = htmlspecialchars($arr_rec['css_custom'], ENT_QUOTES, 'UTF-8');
$n_testo_link = htmlspecialchars($arr_rec['testo_link'], ENT_QUOTES, 'UTF-8');
$n_link = htmlspecialchars($arr_rec['link'], ENT_QUOTES, 'UTF-8');


?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.titolo.value=="") alert('Titolo obbigatorio');
		
		else if (document.gino.latitudine.value=="") alert('Latitudine obbigatoria');
		else if (document.gino.longitudine.value=="") alert('Longitudine obbigatoria');
		else document.gino.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/punti/$cancimg")){unlink("img_up/punti/$cancimg");}
	if(is_file("img_up/punti/s_$cancimg")){unlink("img_up/punti/s_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc = NULL where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato_invio=="inviato")
{
	$arr_no['stato_invio']=1;
	$arr_thumb['img_testata']=400;

	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  "", "img_up/punti", "files/punti");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Punti Mappa</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato_invio" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						<select name="categoria">
							<?php $query_cat="SELECT * FROM categorie ORDER BY ordine DESC";
							$risu_cat = $open_connection->connection->query($query_cat);
							while($arr_cat=$risu_cat->fetch()){?>
								<option value='<?php echo $arr_cat['id'];?>' <?php if($arr_cat['id'] == $n_categoria){?>selected="selected"<?php }?>><?php echo $arr_cat['nome'];?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Titolo*" , "titolo" , "$n_titolo"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
				if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){
					$oggetto_admin->campo_mod("File Custom" , "file_custom" , "$n_file_custom"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				}
				$oggetto_admin->campo_mod("Sottotitolo 1" , "sottotitolo1" , "$n_sottotitolo1"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Sottotitolo 2" , "sottotitolo2" , "$n_sottotitolo2"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Sottotitolo 3" , "sottotitolo3" , "$n_sottotitolo3"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Immagine", "img_testata" , "$n_img_testata"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/punti" ,"", '0');
				$oggetto_admin->campo_mod("Video <br/>Caricare tramite FTP in public/resarea/video e inserire solo il nome del file mp4<br/>Se inserito verrà mostrato al posto dell'immagine" , "video" , "$n_video"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
				$oggetto_admin->campo_mod("Video Mobile<br/>Caricare tramite FTP in public/resarea/video e inserire solo il nome del file mp4<br/>Se inserito verrà mostrato al posto dell'immagine" , "video_mobile" , "$n_video_mobile"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
				$oggetto_admin->campo_mod("Latitudine*", "latitudine" , "$n_latitudine"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
				$oggetto_admin->campo_mod("Longitudine*", "longitudine" , "$n_longitudine"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
				$oggetto_admin->campo_mod("Committente", "committente" , "$n_committente"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", "");
				//$oggetto_admin->campo_mod("Tipologia", "tipologia" , "$n_tipologia"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", "");
				$oggetto_admin->campo_mod("Ubicazione", "ubicazione" , "$n_ubicazione"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", "");
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Stato</label>
					<div class="mws-form-item">
						<select name="stato">
							<option <?php if($n_stato=="Lavoro in corso"){?>selected="selected"<?php }?> value='Lavoro in corso'>Lavoro in corso</option>
							<option <?php if($n_stato=="Lavoro completato"){?>selected="selected"<?php }?> value='Lavoro completato'>Lavoro completato</option>
						</select>
					</div>
				</div>
				
				<div style="width:100%; background:#26262A">
					<div style="padding:10px 10px; color:#fff">
						<b>Descrizione</b>
					</div>
				</div>
				
				<div class="mws-form-row">
					<label class="mws-form-label">
						Descrizione Breve
						<br/>
						<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php echo $id_rec;?>&campocanc=descrizione_breve" class="testo10" ><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="descrizione_breve" name="descrizione_breve"><?php echo $n_descrizione_breve?></textarea>
					</div>
				</div>
				<?php 
				//$oggetto_admin->campo_mod("Titolo Descrizione", "titolo_descrizione" , "$n_titolo_descrizione"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">
						Descrizione
						<br/>
						<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php echo $id_rec;?>&campocanc=descrizione" class="testo10" ><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="descrizione" name="descrizione"><?php echo $n_descrizione?></textarea>
					</div>
				</div>			
				<?php 
				$oggetto_admin->campo_mod("Testo Link", "testo_link" , "$n_testo_link"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Link (https://...)", "link" , "$n_link"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				//$oggetto_admin->campo_mod("Titolo Bullet Points", "titolo_valori" , "$n_titolo_valori"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				?>
				<div style="width:100%; background:#26262A">
					<div style="padding:10px 10px; color:#fff">
						<b>Bullet Points</b>
					</div>
				</div>
				<?php
				$oggetto_admin->campo_mod("Titolo Bullet Point 1", "valore_dato_1" , "$n_valore_dato_1"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Testo Bullet Point 1", "descrizione_dato_1" , "$n_descrizione_dato_1"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Titolo Bullet Point 2", "valore_dato_2" , "$n_valore_dato_2"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Testo Bullet Point 2", "descrizione_dato_2" , "$n_descrizione_dato_2"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Titolo Bullet Point 3", "valore_dato_3" , "$n_valore_dato_3"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Testo Bullet Point 3", "descrizione_dato_3" , "$n_descrizione_dato_3"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Titolo Bullet Point 4", "valore_dato_4" , "$n_valore_dato_4"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Testo Bullet Point 4", "descrizione_dato_4" , "$n_descrizione_dato_4"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Titolo Bullet Point 5", "valore_dato_5" , "$n_valore_dato_5"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				$oggetto_admin->campo_mod("Testo Bullet Point 5", "descrizione_dato_5" , "$n_descrizione_dato_5"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '0');
				?>
				<?php if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){?>
				<div style="width:100%; background:#26262A">
					<div style="padding:10px 10px; color:#fff">
						<b>CUSTOM</b>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">
						CSS Custom
						<br/>
						<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php echo $id_rec;?>&campocanc=css_custom" class="testo10" ><img align="middle" src="img/erasure.png" alt="Cancella il contenuto del campo"></a>
					</label>
					<div class="mws-form-item">
						<textarea  id="css_custom" name="css_custom" style="width:100%; height:100px"><?php echo $n_css_custom?></textarea>
					</div>
				</div>
				<?php }?>
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
$id_textarea = "descrizione";
include("ckeditor5.php");
$id_textarea = "descrizione_breve";
include("ckeditor5.php");

}
?>
