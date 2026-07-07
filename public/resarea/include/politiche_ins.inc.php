<?php 
$table="politiche";
$pagina="politiche";
$directory="files/politiche";

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
		else if (document.gino.file.value=="") alert('File obbigatorio');
		else document.gino.submit();
	}
</script>
<?php 
if($stato_invio=="inviato"){
	$arr_no['stato_invio']=1;
	$arr_thumb['img_testata']=400;
	
	$oggetto_admin->inserisci_campi ($table , $arr_no, $arr_thumb, "img_up/punti",$directory );
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci POLITICA</b></div>
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
				<?php 
				$oggetto_admin->campo_ins("Titolo*", "titolo" , "1", 'no');	
				$oggetto_admin->campo_ins("File*", "file" , "5", 'no',"","","","",$directory);	
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
