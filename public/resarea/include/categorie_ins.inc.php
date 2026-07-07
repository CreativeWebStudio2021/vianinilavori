<?php 
$table="categorie";

$rif="";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
?>

<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.inserimento.nome.value=="") alert('Nome obbigatorio');				
		else document.inserimento.submit();
	}
</script>
<?php 


if($stato=="inviato")
{
	$arr_no['stato']=1;
	/*$arr_thumb['img']="120" ; */
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);

	$oggetto_admin->inserisci_campi ("$table" , $arr_no ,  "" );
?>
	<script language="javascript">
		window.location = "admin.php?cmd=<?php echo $table;?><?php echo $rif;?>" ;
	</script>
<?php 
}
else
{
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci <?php echo $table;?></b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<?php 
			$ord = $oggetto_admin->trova_ordine("$table", "id_rife", "$id_rife");
			echo "<input type=hidden name=ordine value=$ord>";	
			?>
			<div class="mws-form-inline">
				<?php 
				$oggetto_admin->campo_ins("Nome*" , "nome" , "1", 'no');
				?>
				
			</div>
			<div class="mws-button-row">
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
				<input type="button" value="Annulla" class="btn" onclick="annulla()">
			</div>
		</form>
	</div>
</div>
<?php 
}
?>
