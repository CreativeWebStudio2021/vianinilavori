<?php 
$table="news_menu";
$pagina="news_menu";
$directory="news";
$title_pag="News Menù";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

if ($campocanc!="titolo") $n_titolo = $arr_rec['titolo'];
	else $n_titolo = ""; 
$n_img = $arr_rec['img'];
$n_img_mob = $arr_rec['img_mob'];
if ($campocanc!="link") $n_link = $arr_rec['link'];
	else $n_link = ""; 
?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		<?php if(!$n_img || $n_img==""){?>
			if (document.inserimento.img.value=="") alert('Immagine obbigatoria');	
				else document.inserimento.submit();
		<?php }?>
		document.inserimento.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$directory/$cancimg")){unlink("img_up/$directory/$cancimg");}
	if(is_file("img_up/$directory/s_$cancimg")){unlink("img_up/$directory/s_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']=300;
	$arr_thumb['img_m']=300;
	
	$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	$_POST['titolo'] = str_replace("è", "&egrave;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("é", "&eacute;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("à", "&agrave;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("ì", "&igrave;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("ò", "&ograve;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("ù", "&ugrave;", $_POST['titolo']);
	
	$oggetto_admin->modifica_campi($table ,$id_rec , $arr_no ,  $arr_thumb, "img_up/$directory");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica <?php echo $title_pag;?></b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_mod("Immagine *<br /><i>(Dim. 786x203 pixel)</i>" , "img" , "$n_img"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/$directory");
				$oggetto_admin->campo_mod("Immagine Mobile *<br /><i>(Dim. 480x200 pixel)</i>" , "img_mob" , "$n_img_mob"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/$directory");
				?>
				<div class="mws-form-row" style="padding-top:0px">
					<label class="mws-form-label" style="padding-left:10px">Titolo<br /><a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php echo $id_rec;?>&campocanc=titolo" style="color:#333"><i class="fa fa-eraser" aria-hidden="true"></i></a></label>
					<div class="mws-form-item">
						<input type="text" name="titolo" class="medium" maxlength="40" value="<?php  echo $n_titolo; ?>"/>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Link<br /><i>(a partire da http://...)</i><br /><a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php echo $id_rec;?>&campocanc=link" style="color:#333"><i class="fa fa-eraser" aria-hidden="true"></i></a></label>
					<div class="mws-form-item">
						<input type="text" name="link" class="medium" maxlength="150" value="<?php  echo $n_link; ?>"/>
					</div>
				</div>
				<br/><br/>
				<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
				<div style="margin-left:20px; padding-bottom:10px;"><i class="fa fa-eraser" aria-hidden="true"></i> <i>clicca sulla gomma a fianco dei campi non obbligatori per cancellarne il contenuto</i></div>
			</div>
			<div class="mws-button-row">
				<input type="button" value="Modifica" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
