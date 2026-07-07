<?php 
$table="certificazioni";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = htmlspecialchars($arr_rec['nome'], ENT_QUOTES, 'UTF-8');
$n_descrizione = htmlspecialchars($arr_rec['descrizione'], ENT_QUOTES, 'UTF-8');
$n_pdf = $arr_rec['pdf'];
$n_categoria = $arr_rec['categoria'];

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
		var pdf_old = "<?php  echo $n_pdf; ?>";
		if (document.gino.nome.value=="") alert('Nome obbigatorio');
		else if (document.gino.pdf.value=="" && pdf_old=="") alert('Pdf obbigatorio');
		else document.gino.submit();
	}
</script>
<?php 
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("files/certificazioni/$cancimg")){unlink("files/certificazioni/$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$oggetto_admin->modifica_campi ("$table" ,$id_rec , $arr_no ,  "", "", "files/certificazioni");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica <?php echo $table;?></b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			<div class="mws-form-row">
				<label class="mws-form-label">Categoria</label>
				<div class="mws-form-item">
					<select name="categoria">
						<option value='attestazione' <?php if($n_categoria=="attestazione"){?>selected="selected"<?php }?>>Attestazioni</option>
						<option value='certificazione' <?php if($n_categoria=="certificazione"){?>selected="selected"<?php }?>>Certificazione</option>
					</select>
				</div>
			</div>
			<?php 
			$oggetto_admin->campo_mod("Nome*", "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec","","","","","1");
			$oggetto_admin->campo_mod("Descrizione", "descrizione" , "$n_descrizione"  , "1", 'no', "$cmd", "$id_rec");
			$oggetto_admin->campo_mod("PDF" , "pdf" , "$n_pdf"  , "5", 'no', "$cmd", "$id_rec","","","","files/certificazioni");
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
}
?>
