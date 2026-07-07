<?php 
$table="categorie_media";
$directory="media";

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


if($stato=="inviato")
{
	$arr_no['stato']=1;
	/* tag_ids[] è un array POST: non è colonna di categorie_media, va escluso da inserisci_campi */
	$arr_no['tag_ids']=1;
	$arr_thumb['anteprima']=400;
	$_POST['nome']=str_replace('"','\"',$_POST['nome']);

	/* inserisci_campi usa una propria connessione e ritorna l'id inserito */
	$id_gallery = (int) $oggetto_admin->inserisci_campi("$table", $arr_no, $arr_thumb, "img_up/".$directory);
	if ($id_gallery > 0) {
		$ordine_default = $oggetto_admin->trova_ordine("media_gruppi", "id_gallery", "$id_gallery");
		$open_connection->connection->query("INSERT INTO media_gruppi (id_gallery, nome, is_default, ordine, stato, visibile) VALUES ('$id_gallery', 'Media senza sezione', '1', '$ordine_default', '1', '1')");
	}
	if ($id_gallery > 0 && isset($_POST['tag_ids']) && is_array($_POST['tag_ids'])) {
		$open_connection->connection->query("DELETE FROM media_gallery_tag WHERE id_gallery='$id_gallery'");
		foreach ($_POST['tag_ids'] as $tag_id) {
			$tag_id = (int)$tag_id;
			if ($tag_id > 0) {
				$open_connection->connection->query("INSERT INTO media_gallery_tag (id_gallery, id_tag) VALUES ('$id_gallery', '$tag_id')");
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
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Inserisci Categoria Media</b></div>
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
				<?php 
				$oggetto_admin->campo_ins("Sottotitolo" , "sottotitolo" , "1", 'no');
				$oggetto_admin->campo_ins("Luogo" , "luogo" , "1", 'no');
				$oggetto_admin->campo_ins("Anteprima" , "anteprima" , "4", 'no');
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Preview anteprima</label>
					<div class="mws-form-item">
						<div id="anteprimaPreviewWrap" style="display:none;">
							<img id="anteprimaPreviewImg" src="" alt="Preview anteprima" style="max-width:280px; max-height:170px; border:1px solid #ddd; padding:3px; background:#fff;" />
						</div>
						<div id="anteprimaPreviewEmpty" style="color:#777; font-style:italic;">Seleziona un'immagine per vedere l'anteprima.</div>
					</div>
				</div>
				<?php
				$oggetto_admin->campo_ins("Testo bottone" , "pulsante_testo" , "1", 'no');
				?>
				<div class="mws-form-row">
					<label class="mws-form-label">Tipo link bottone</label>
					<div class="mws-form-item">
						<select name="pulsante_tipo" id="pulsante_tipo" onchange="toggleButtonFields()">
							<option value="libero">Link libero</option>
							<option value="progetto">Progetto</option>
						</select>
					</div>
				</div>
				<div class="mws-form-row" id="row_link_libero">
					<label class="mws-form-label">Link libero bottone</label>
					<div class="mws-form-item">
						<input type="text" name="pulsante_link" value="" class="medium"/>
					</div>
				</div>
				<div class="mws-form-row" id="row_link_progetto" style="display:none;">
					<label class="mws-form-label">Progetto bottone</label>
					<div class="mws-form-item">
						<select name="progetto">
							<option value="0">- Seleziona -</option>
							<?php
							$query_prog = "SELECT * FROM punti_mappa ORDER BY titolo ASC";
							$risu_prog = $open_connection->connection->query($query_prog);
							if ($risu_prog) {
								while ($arr_prog = $risu_prog->fetch()) {
									echo "<option value=\"".$arr_prog['id']."\">".htmlspecialchars($arr_prog['titolo'])."</option>";
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
						$query_tag = "SELECT * FROM media_tag ORDER BY ordine DESC, nome ASC";
						$risu_tag = $open_connection->connection->query($query_tag);
						if ($risu_tag) {
							while ($arr_tag = $risu_tag->fetch()) {
								?>
								<label style="display:inline-block; margin-right:20px;">
									<input type="checkbox" name="tag_ids[]" value="<?php echo (int)$arr_tag['id']; ?>" />
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
				<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
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
				img.src = '';
				wrap.style.display = 'none';
				empty.style.display = '';
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