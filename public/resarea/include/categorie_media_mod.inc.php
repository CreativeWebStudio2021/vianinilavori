<?php 
$table="categorie_media";
$directory="media";

$query_rec = "select * from $table where id='$id_rec'";
$risu_rec    = $open_connection->connection->query($query_rec);
$arr_rec = $risu_rec->fetch();

$n_nome = htmlspecialchars($arr_rec['nome'], ENT_QUOTES, 'UTF-8');
$n_testo = $arr_rec['testo'];
$n_sottotitolo = htmlspecialchars($arr_rec['sottotitolo'] ?? '', ENT_QUOTES, 'UTF-8');
$n_luogo = htmlspecialchars($arr_rec['luogo'] ?? '', ENT_QUOTES, 'UTF-8');
$n_anteprima = htmlspecialchars($arr_rec['anteprima'] ?? '', ENT_QUOTES, 'UTF-8');
$n_pulsante_testo = htmlspecialchars($arr_rec['pulsante_testo'] ?? '', ENT_QUOTES, 'UTF-8');
$n_pulsante_tipo = $arr_rec['pulsante_tipo'] ?? 'libero';
$n_pulsante_link = htmlspecialchars($arr_rec['pulsante_link'] ?? '', ENT_QUOTES, 'UTF-8');
$n_progetto = (int)($arr_rec['progetto'] ?? 0);

$rif="";
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
?>
<style>
    .mws-form-item img:not(#anteprimaPreviewImg) {
		display: none;
	}
</style>
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
	
	function toggleButtonFields() {
		var tipo = document.getElementById('pulsante_tipo');
		var libero = document.getElementById('row_link_libero');
		var progetto = document.getElementById('row_link_progetto');
		if (!tipo || !libero || !progetto) return;
		if (tipo.value === 'progetto') {
			libero.style.display = 'none';
			progetto.style.display = '';
		} else {
			libero.style.display = '';
			progetto.style.display = 'none';
		}
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
	/* tag_ids[] è un array POST: non è colonna di categorie_media, va escluso da modifica_campi */
	$arr_no['tag_ids']=1;
	$arr_thumb['anteprima']=400; 
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);

	$oggetto_admin->modifica_campi("$table" ,$id_rec , $arr_no , "", "img_up/".$directory);
	
	$id_gallery = (int)$id_rec;
	if ($id_gallery > 0) {
		$open_connection->connection->query("DELETE FROM media_gallery_tag WHERE id_gallery='$id_gallery'");
		if (isset($_POST['tag_ids']) && is_array($_POST['tag_ids'])) {
			foreach ($_POST['tag_ids'] as $tag_id) {
				$tag_id = (int)$tag_id;
				if ($tag_id > 0) {
					$open_connection->connection->query("INSERT INTO media_gallery_tag (id_gallery, id_tag) VALUES ('$id_gallery', '$tag_id')");
				}
			}
		}
	}
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Modifica Categoria Media</b></div>
	<div class="mws-panel-header">
		<span>Dati richiesti</span>
	</div>
	<div class="mws-panel-body no-padding">
		<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_rec; ?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
			<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
			<input type="hidden" name="stato" value="inviato">
			<div class="mws-form-inline">
			<?php 
			$oggetto_admin->campo_mod("Nome *" , "nome" , "$n_nome"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
			?>
			<?php 
			$oggetto_admin->campo_mod("Sottotitolo" , "sottotitolo" , "$n_sottotitolo"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
			$oggetto_admin->campo_mod("Luogo" , "luogo" , "$n_luogo"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
			$oggetto_admin->campo_mod("Anteprima" , "anteprima" , "$n_anteprima"  , "4", 'no', "$cmd", "$id_rec", "", "", "img_up/".$directory, "", '1');
			?>
			<div class="mws-form-row">
				<label class="mws-form-label">Preview anteprima</label>
				<div class="mws-form-item">
					<div id="anteprimaPreviewWrap" <?php if($n_anteprima==""){?>style="display:none;"<?php }?>>
						<img
							id="anteprimaPreviewImg"
							src="<?php if($n_anteprima!=""){?>img_up/<?php echo $directory;?>/<?php echo $n_anteprima; ?><?php }?>"
							alt="Preview anteprima"
							style="max-width:280px; max-height:170px; border:1px solid #ddd; padding:3px; background:#fff;"
						/>
					</div>
					<div id="anteprimaPreviewEmpty" style="color:#777; font-style:italic;<?php if($n_anteprima!=""){?> display:none;<?php }?>">Seleziona un'immagine per vedere l'anteprima.</div>
				</div>
			</div>
			<?php
			$oggetto_admin->campo_mod("Testo bottone" , "pulsante_testo" , "$n_pulsante_testo"  , "1", 'no', "$cmd", "$id_rec", "", "", "" ,"", '1');
			?>
			<div class="mws-form-row">
				<label class="mws-form-label">Tipo link bottone</label>
				<div class="mws-form-item">
					<select name="pulsante_tipo" id="pulsante_tipo" onchange="toggleButtonFields()">
						<option value="libero" <?php if($n_pulsante_tipo=="libero"){?>selected="selected"<?php }?>>Link libero</option>
						<option value="progetto" <?php if($n_pulsante_tipo=="progetto"){?>selected="selected"<?php }?>>Progetto</option>
					</select>
				</div>
			</div>
			<div class="mws-form-row" id="row_link_libero">
				<label class="mws-form-label">Link libero bottone</label>
				<div class="mws-form-item">
					<input type="text" name="pulsante_link" value="<?php echo $n_pulsante_link; ?>" class="medium"/>
				</div>
			</div>
			<div class="mws-form-row" id="row_link_progetto">
				<label class="mws-form-label">Progetto bottone</label>
				<div class="mws-form-item">
					<select name="progetto">
						<option value="0">- Seleziona -</option>
						<?php
						$query_prog = "SELECT * FROM punti_mappa ORDER BY titolo ASC";
						$risu_prog = $open_connection->connection->query($query_prog);
						if ($risu_prog) {
							while ($arr_prog = $risu_prog->fetch()) {
								?>
								<option value="<?php echo (int)$arr_prog['id']; ?>" <?php if($n_progetto==(int)$arr_prog['id']){?>selected="selected"<?php }?>>
									<?php echo htmlspecialchars($arr_prog['titolo']); ?>
								</option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="mws-form-row">
				<label class="mws-form-label">Testo</label>
				<div class="mws-form-item">
					<textarea class="ckeditor" id="testo" name="testo"><?php  echo $n_testo; ?></textarea>
				</div>
			</div>
			<div class="mws-form-row">
				<label class="mws-form-label">Tag gallery</label>
				<div class="mws-form-item">
					<?php
					$tag_sel = array();
					$risu_tag_sel = $open_connection->connection->query("SELECT id_tag FROM media_gallery_tag WHERE id_gallery='".(int)$id_rec."'");
					if ($risu_tag_sel) {
						while ($arr_tag_sel = $risu_tag_sel->fetch()) {
							$tag_sel[] = (int)$arr_tag_sel['id_tag'];
						}
					}
					$query_tag = "SELECT * FROM media_tag ORDER BY ordine DESC, nome ASC";
					$risu_tag = $open_connection->connection->query($query_tag);
					if ($risu_tag) {
						while ($arr_tag = $risu_tag->fetch()) {
							$id_tag = (int)$arr_tag['id'];
							?>
							<label style="display:inline-block; margin-right:20px;">
								<input type="checkbox" name="tag_ids[]" value="<?php echo $id_tag; ?>" <?php if(in_array($id_tag, $tag_sel)){?>checked="checked"<?php }?> />
								<?php echo htmlspecialchars($arr_tag['nome']); ?>
							</label>
							<?php
						}
					} else {
						echo "<i>Nessun tag disponibile. Crea la tabella media_tag.</i>";
					}
					?>
				</div>
			</div>
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
?>
<script>
	toggleButtonFields();
	(function () {
		var fileInput = document.querySelector('input[type="file"][name="anteprima"]');
		var wrap = document.getElementById('anteprimaPreviewWrap');
		var img = document.getElementById('anteprimaPreviewImg');
		var empty = document.getElementById('anteprimaPreviewEmpty');
		if (!fileInput || !wrap || !img || !empty) return;

		fileInput.addEventListener('change', function () {
			var f = (this.files && this.files[0]) ? this.files[0] : null;
			if (!f) {
				<?php if($n_anteprima!=""){ ?>
				img.src = "img_up/<?php echo $directory;?>/<?php echo $n_anteprima; ?>";
				wrap.style.display = '';
				empty.style.display = 'none';
				<?php } else { ?>
				img.src = '';
				wrap.style.display = 'none';
				empty.style.display = '';
				<?php } ?>
				return;
			}
			var url = URL.createObjectURL(f);
			img.src = url;
			wrap.style.display = '';
			empty.style.display = 'none';
		});
	})();
</script>
<?php

}
?>