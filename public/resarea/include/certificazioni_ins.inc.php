<?php 
$table="certificazioni";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.nome.value=="") alert('Nome obbigatorio');
		else if (document.gino.pdf.value=="") alert('Pdf obbigatorio');
		else document.gino.submit();
	}
</script>
<?php 
if($stato=="inviato"){
	$arr_no['stato']=1;
	
	$oggetto_admin->inserisci_campi ("$table" , $arr_no, "", "", "files/certificazioni");
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
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
<?php 
			$ord = $oggetto_admin->trova_ordine($table);
			echo "<input type=hidden name=ordine value=$ord>";	
?>
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						<select name="categoria">
							<option value='attestazione'>Attestazioni</option>
							<option value='certificazione'>Certificazione</option>
						</select>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Nome*", "nome" , "1", 'no');	
				$oggetto_admin->campo_ins("Descrizione", "descrizione" , "1", 'no');	
				$oggetto_admin->campo_ins("PDF*", "pdf" , "5", 'no');	
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
}
?>
