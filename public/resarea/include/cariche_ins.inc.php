<?php 
$table="cariche";
$pagina="cariche";
$directory="cariche";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['ric_cat'])) $ric_cat=$_GET['ric_cat']; else $ric_cat="";

$rif="";
if($ric_cat!="") $rif.="&ric_cat=$ric_cat";
$rif.="&pag_att=$pag_att";
?>
<script language="javascript">
	function annulla(){
		window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
	}
</script>

<script language="javascript">
	function verifica(){
		if (document.gino.nome.value=="") alert('Nome obbigatorio');
		else document.gino.submit();
	}
</script>
<?php 
if($stato=="inviato"){
	$arr_no['stato']=1;
	$arr_thumb['img']=400; 
	
	$_POST['ordine'] = $oggetto_admin->trova_ordine($table, "categoria", $_POST['categoria']);
	
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Carica</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_ins<?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<input type="hidden" name="categoria" value="<?php echo $ric_cat;?>"/>	
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						
							<?php $query_cat="SELECT * FROM categorie_cariche ORDER BY ordine DESC";
							$risu_cat = $open_connection->connection->query($query_cat);
							while($arr_cat=$risu_cat->fetch()){?>
								<div style="padding-top:5;"><b> <?php if($ric_cat!==NULL && $ric_cat==$arr_cat['id']){?><?php echo $arr_cat['nome'];?><?php }?></b></div>
							<?php }?>
						
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("Nome *", "nome" , "1", 'no');	
				$oggetto_admin->campo_ins("Cognome", "cognome" , "1", 'no');	
				$oggetto_admin->campo_ins("Carica", "carica" , "1", 'no');
				$oggetto_admin->campo_ins("Foto", "img" , "4", 'no');	
			?>
				<div class="mws-form-row">
					<label class="mws-form-label">Sesso</label>
					<div class="mws-form-item">
						<select name="sesso">
							<option value='m'>M</option>
							<option value='f'>F</option>
						</select>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="testo" name="testo"></textarea>
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_ins("LinkedIn", "linkedin" , "1", 'no');	
				$oggetto_admin->campo_ins("Instagram", "instagram" , "1", 'no');	
				$oggetto_admin->campo_ins("Facebook", "facebook" , "1", 'no');	
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