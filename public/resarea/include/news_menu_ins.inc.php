<?php 
$table="news_menu";
$pagina="news_menu";
$directory="news";
$title_pag="News Menù";

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
		if (document.inserimento.img.value=="") alert('Immagine obbigatoria');	
		else document.inserimento.submit();
	}
</script>
<?php 
if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']=300;
	$arr_thumb['img_m']=300;
	
	$_POST['visibile']='1';
	
	$_POST['titolo']=str_replace('"','\"',$_POST['titolo']);
	$_POST['titolo'] = str_replace("è", "&egrave;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("é", "&eacute;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("à", "&agrave;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("ì", "&igrave;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("ò", "&ograve;", $_POST['titolo']);
	$_POST['titolo'] = str_replace("ù", "&ugrave;", $_POST['titolo']);

	$oggetto_admin->inserisci_campi($table , $arr_no ,  $arr_thumb, "img_up/$directory");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci <?php echo $title_pag;?></b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine($table);
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
	<?php 
				$oggetto_admin->campo_ins("Immagine *<br /><i>(Dim. 786x203 pixel)</i>" , "img" , "4", 'no');
				$oggetto_admin->campo_ins("Immagine Mobile *<br /><i>(Dim. 480x200 pixel)</i>" , "img_mob" , "4", 'no');
	?>
				<div class="mws-form-row" style="padding-top:0px">
					<label class="mws-form-label" style="padding-left:10px">Titolo</label>
					<div class="mws-form-item">
						<input type="text" name="titolo" class="medium" maxlength="40"/>
					</div>
				</div>
	<?php 
				$oggetto_admin->campo_ins("Link<i>(a partire da http://...)</i>" , "link" , "1", 'no');
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
<script language="javascript">
function MaxCaratteri(Object, MaxLen)
{
    return (Object.value.length <= MaxLen);
}
</script>
<?php 
}
?>
