<?php 
$table="cariche";
$pagina="cariche";
$directory="cariche";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_categoria = $arr_rec['categoria'];
$n_nome = $arr_rec['nome'];
$n_cognome = $arr_rec['cognome'];
$n_foto = $arr_rec['img'];
$n_testo = $arr_rec['testo'];
$n_carica = $arr_rec['carica'];
$n_sesso = $arr_rec['sesso'];
$n_linkedin = $arr_rec['linkedin'];
$n_instagram = $arr_rec['instagram'];
$n_facebook = $arr_rec['facebook'];

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
if($campocanc!="")
{
	$risu_img = $open_connection->connection->query("select $campocanc from $table where id='$id_rec'");
	list($cancimg) = $risu_img->fetch();
	
	if(is_file("img_up/$directory/$cancimg")){unlink("img_up/$directory/$cancimg");}
	if(is_file("img_up/$directory/s_$cancimg")){unlink("img_up/$directory/s_$cancimg");}
	
	$query_canc_img = "update $table set $campocanc='' where id='$id_rec'";
	$open_connection->connection->query($query_canc_img);
?>
	<script language="javascript">
		window.location='admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>';
	</script>	
<?php 
}

if($stato=="inviato")
{
	$arr_no['stato']=1;
	$arr_thumb['img']=400; 

	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no ,  "", "img_up/".$directory, "files/".$directory);

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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Carica</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="gino" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Categoria</label>
					<div class="mws-form-item">
						<input type="hidden" name="categoria" value="<?php echo $n_categoria;?>"/>	
						
							<?php $query_cat="SELECT * FROM categorie_cariche ORDER BY ordine DESC";
							$risu_cat = $open_connection->connection->query($query_cat);
							while($arr_cat=$risu_cat->fetch()){?>
								<div style="padding-top:5;"><b> <?php if($arr_cat['id']==$n_categoria){?><?php echo $arr_cat['nome'];?><?php }?></b></div>
							<?php }?>
						
					</div>
				</div>
				<?php 
				$oggetto_admin->campo_mod("Nome*" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec","","","","",1);
				$oggetto_admin->campo_mod("Cognome" , "cognome" , "$n_cognome"  , "1", 'no', "$cmd", "$id_rec","","","","",0);				
				$oggetto_admin->campo_mod("Foto" , "img" , "$n_foto"  , "4", 'no', "$cmd", "$id_rec","","","img_up/".$directory);
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Sesso</label>
					<div class="mws-form-item">
						<select name="sesso">
							<option value='m' <?php  if($n_sesso=="m"){?>selected="selected"<?php }?>>M</option>
							<option value='f' <?php if($n_sesso=="f"){?>selected="selected"<?php }?>>F</option>
						</select>
					</div>
				</div>
				<div class="mws-form-row">
					<label class="mws-form-label">Testo</label>
					<div class="mws-form-item">
						<textarea class="ckeditor" id="testo" name="testo"><?php  echo $n_testo; ?></textarea>
					</div>
				</div>
				
				<?php 
				$oggetto_admin->campo_mod("Carica" , "carica" , "$n_carica"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				$oggetto_admin->campo_mod("LinkedIn" , "linkedin" , "$n_linkedin"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				$oggetto_admin->campo_mod("Instagram" , "instagram" , "$n_instagram"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
				$oggetto_admin->campo_mod("Facebook" , "facebook" , "$n_facebook"  , "1", 'no', "$cmd", "$id_rec","","","","",0);
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
$id_textarea = "testo";
include("ckeditor5.php");

}
?>
