<div class="mws-panel grid_8">
	<?php 	
	if(!empty($_SESSION["loggato"]) && $_SESSION["loggato"] == "si"){
		$table="media";
		$pagina="media";
		$directory="media";

		$id_rec = $id_rife = $_GET['id_rec'] ?? '';
		$id_gruppo = $_GET['id_gruppo'] ?? '';
		if($id_rec!=""){
			$rif = "&id_rec=".$id_rec;
			$criterio = "AND id_rife='$id_rife'";
			if($id_gruppo!==""){
				$rif .= "&id_gruppo=".$id_gruppo;
				$criterio .= " AND id_gruppo='".(int)$id_gruppo."'";
			}
		}
		
		if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
		if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";

		
		if($id_rife==""){
		?>
			<div class="mws-panel grid_12">
				<div style="height:50px;font-size:1.2em;padding-top:10px">
					<b>Media Gallery</b>
				</div>
				<div class="mws-panel-body no-padding" style="padding:20px !important;">
					Seleziona prima una gallery per gestire foto/video al suo interno.
					<br/><br/>
					<a href="admin.php?cmd=categorie_media" class="btn btn-success">Vai alle Gallery</a>
				</div>
			</div>
		<?php
		}else{
		?>
		<script type="text/javascript">
			var lista_ind=new Array();
			var lista_del="";
			var lista_tutti="";
			function aggiungi_lista(id_check, id_campo){
				if(document.getElementById('check_'+id_check).checked){
					lista_del+=""+id_campo+";";
				} else {
					lista_del = lista_del.replace(id_campo+";", "");
				}
				if(lista_del!=""){
					document.getElementById('cancella_sel').style.display="block";
					document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $pagina;?>&azione=cancella_sel&lista='+lista_del;
				}else{
					document.getElementById('cancella_sel').style.display="none";
				}
			}
			
			function aggiugni_tutti(){
				start = document.getElementById('start').innerHTML;
				end = document.getElementById('end').innerHTML;
				total = document.getElementById('total').innerHTML;

				if(document.getElementById('check_tutti').checked){
					for(i=start-1; i<end; i++){
						lista_tutti+=lista_ind[i]+";";
					}
					for(i=start; i<=end; i++){
						document.getElementById('check_'+i).checked=true;
					}
					document.getElementById('cancella_sel').style.display="block";
					document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $pagina;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
				}else{
					lista_tutti="";
					for(i=start; i<=total; i++){
						document.getElementById('check_'+i).checked=false;
					}
					document.getElementById('cancella_sel').style.display="none";
				}	
			}
			
			function verifica(){
				if (document.inserimento.img.value=="") alert('Foto obbigatoria');	
				else document.inserimento.submit();
			}
		</script>

		<?php 
		$default_group_id = 0;
		$risu_default = $open_connection->connection->query("SELECT id FROM media_gruppi WHERE id_gallery='".(int)$id_rife."' AND is_default='1' LIMIT 1");
		if($risu_default && $risu_default->rowCount()>0){
			$arr_default = $risu_default->fetch();
			$default_group_id = (int)$arr_default['id'];
		}else{
			$ordine_default = $oggetto_admin->trova_ordine("media_gruppi", "id_gallery", "$id_rife");
			$open_connection->connection->query("INSERT INTO media_gruppi (id_gallery, nome, is_default, ordine, stato, visibile) VALUES ('".(int)$id_rife."', 'Media senza sezione', '1', '$ordine_default', '1', '1')");
			$default_group_id = (int)$open_connection->connection->lastInsertId();
		}
		if($default_group_id>0){
			$open_connection->connection->query("UPDATE media SET id_gruppo='$default_group_id' WHERE id_rife='".(int)$id_rife."' AND id_gruppo='0'");
		}
		
		if($azione=="cancella")
{	
			if(!$id_canc) 
				$id_canc = $_POST['conferma']; /* dal $.post di ajax */
			
			$query_canc_img = "select img from $table where id='$id_canc'";
			$risu_canc_img = $open_connection->connection->query($query_canc_img);
			if ($risu_canc_img) {
				list($img) = $risu_canc_img->fetch();
				if (is_file("img_up/media/$img")) @unlink("img_up/media/$img");
				if (is_file("img_up/media/m_$img")) @unlink("img_up/media/m_$img");
				if (is_file("img_up/media/s_$img")) @unlink("img_up/media/s_$img");
			}
			
			$query_canc = "delete from $table where id='$id_canc'";
			$risu_canc = $open_connection->connection->query($query_canc);
			
		?>
			<script language="javascript">		
				//window.alert("Il campo e' stato cancellato con successo");
				window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>";
			</script>
		<?php 
		} 
		
		if($stato=="inviato")
		{
			/*$arr_no['stato']=1;
			$arr_thumb="no";

			$oggetto_admin->inserisci_campi("$table" , $arr_no ,  $arr_thumb, "img_up/azienda", "", "800");*/
			
			for($x=0; $x<count ($_FILES['img']['name']); $x++){
				//echo "@".$_FILES['img']['name'][$x]."<br/>";
				
				$nome_file = $_FILES['img']['name'][$x];
				$temp_file = $_FILES['img']['tmp_name'][$x];
				if ($nome_file) {		
					
					$nome_file =  $oggetto_admin->scrivi_img($nome_file , $temp_file, "img_up/$directory");
					
					list($larghezza_gr , $height, $type, $attr) = getimagesize($temp_file);
					if ($larghezza_gr>1920) $oggetto_admin->thumbjpg_new(1920,$temp_file,$nome_file,"img_up/$directory");		
					$oggetto_admin->thumbjpg(450,$temp_file,$nome_file,"img_up/$directory","m_");

					$ordine = $oggetto_admin->trova_ordine($table, "id_rife", "$id_rife");
					
					$id_gruppo_post = (int)($_POST['id_gruppo'] ?? 0);
					$id_rife_post = (int)($_POST['id_rife'] ?? 0);
					if($id_gruppo_post<=0) $id_gruppo_post = $default_group_id;
					$query_ins_file = "insert into $table (img, ordine, tipo, id_rife, id_gruppo) values ('$nome_file', $ordine,'".$_POST['tipo']."', '$id_rife_post', '$id_gruppo_post')";
					$risu_ins_file = $open_connection->connection->query($query_ins_file);
				}
			}
		?>
			<script language="javascript">
				window.location = "admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>" ;
			</script>
		<?php 
		}
		if($stato=="inviato_video")
		{					
			$ordine = $oggetto_admin->trova_ordine($table, "id_rife", "$id_rife");
			
			$_POST['img'] = $oggetto_admin->getYoutubeVideoID($_POST['img']);
			
			$id_gruppo_post = (int)($_POST['id_gruppo'] ?? 0);
			$id_rife_post = (int)($_POST['id_rife'] ?? 0);
			if($id_gruppo_post<=0) $id_gruppo_post = $default_group_id;
			$query_ins_file = "insert into $table (img, ordine, tipo, id_rife, id_gruppo) values ('".$_POST['img']."', $ordine,'".$_POST['tipo']."', '$id_rife_post', '$id_gruppo_post')";
			$risu_ins_file = $open_connection->connection->query($query_ins_file);				
			?>
			<script language="javascript">
				window.location = "admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>" ;
			</script>
		<?php }
		
		if ($id_canc) {
			$id_gruppo_ord = isset($_GET['id_gruppo_ord']) ? (int)$_GET['id_gruppo_ord'] : null;
			if($id_gruppo_ord !== null){
				if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "id_gruppo", "$id_gruppo_ord") ;
				if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "id_gruppo", "$id_gruppo_ord") ;
				if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "id_gruppo", "$id_gruppo_ord") ;
				if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "id_gruppo", "$id_gruppo_ord") ;
			}else{
				if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "id_rife", "$id_rife") ;
				if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "id_rife", "$id_rife") ;
				if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "id_rife", "$id_rife") ;
				if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "id_rife", "$id_rife") ;
			}
			
			if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo"){?>
				<script type="text/javascript">
					window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
				</script>
			<?php }
		}
		
		if($azione=="add_gruppo" && !empty($_POST['nome_gruppo']) && $id_rife!=""){
			$nome_gruppo = str_replace('"','\"',trim($_POST['nome_gruppo']));
			$sottotitolo_gruppo = str_replace('"','\"',trim($_POST['sottotitolo_gruppo'] ?? ''));
			$ordine_gruppo = $oggetto_admin->trova_ordine("media_gruppi", "id_gallery", "$id_rife");
			$open_connection->connection->query("INSERT INTO media_gruppi (id_gallery, nome, sottotitolo, is_default, ordine, stato, visibile) VALUES ('".(int)$id_rife."', '$nome_gruppo', '$sottotitolo_gruppo', '0', '$ordine_gruppo', '1', '1')");
			?>
			<script type="text/javascript">
				window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
			</script>
			<?php
		}
		
		if($azione=="gruppo_rename" && !empty($_POST['nome_gruppo_edit']) && !empty($_GET['id_gruppo_mov'])){
			$id_gruppo_mov = (int)$_GET['id_gruppo_mov'];
			$nome_gruppo_edit = str_replace('"','\"',trim($_POST['nome_gruppo_edit']));
			$sottotitolo_gruppo_edit = str_replace('"','\"',trim($_POST['sottotitolo_gruppo_edit'] ?? ''));
			$open_connection->connection->query("UPDATE media_gruppi SET nome='$nome_gruppo_edit', sottotitolo='$sottotitolo_gruppo_edit' WHERE id='$id_gruppo_mov' AND id_gallery='".(int)$id_rife."'");
			?>
			<script type="text/javascript">
				window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
			</script>
			<?php
		}
		
		if($azione=="gruppo_delete" && !empty($_GET['id_canc_gruppo'])){
			$id_canc_gruppo = (int)$_GET['id_canc_gruppo'];
			$risu_is_default = $open_connection->connection->query("SELECT is_default FROM media_gruppi WHERE id='$id_canc_gruppo' AND id_gallery='".(int)$id_rife."' LIMIT 1");
			$is_default = 0;
			if($risu_is_default && $risu_is_default->rowCount()>0){
				$arr_is_default = $risu_is_default->fetch();
				$is_default = (int)$arr_is_default['is_default'];
			}
			if($is_default!==1){
				$open_connection->connection->query("UPDATE media SET id_gruppo='$default_group_id' WHERE id_gruppo='$id_canc_gruppo'");
				$open_connection->connection->query("DELETE FROM media_gruppi WHERE id='$id_canc_gruppo'");
			}
			?>
			<script type="text/javascript">
				window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
			</script>
			<?php
		}
		
		if(!empty($_GET['id_gruppo_mov'])){
			$id_gruppo_mov = (int)$_GET['id_gruppo_mov'];
			if($azione=="gruppo_sali") $oggetto_admin->sali("media_gruppi", "$id_gruppo_mov", "id_gallery", "$id_rife");
			if($azione=="gruppo_scendi") $oggetto_admin->scendi("media_gruppi", "$id_gruppo_mov", "id_gallery", "$id_rife");
			if($azione=="gruppo_primo") $oggetto_admin->primo("media_gruppi", "$id_gruppo_mov", "id_gallery", "$id_rife");
			if($azione=="gruppo_ultimo") $oggetto_admin->ultimo("media_gruppi", "$id_gruppo_mov", "id_gallery", "$id_rife");
			if($azione=="gruppo_sali" || $azione=="gruppo_scendi" || $azione=="gruppo_primo" || $azione=="gruppo_ultimo"){?>
				<script type="text/javascript">
					window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>';
				</script>
			<?php }
		}
		
		?>
		
		
		<div class="mws-panel grid_12">
			<div style="font-size:1.2em;padding-top:10px">
				Gestione Media Gallery
				<?php
				$nome_gallery = "";
				$risu_gal = $open_connection->connection->query("SELECT nome FROM categorie_media WHERE id='".(int)$id_rife."' LIMIT 1");
				if($risu_gal){
					$arr_gal = $risu_gal->fetch();
					$nome_gallery = $arr_gal['nome'] ?? "";
				}
				if($nome_gallery!=""){
					echo " - <b>".htmlspecialchars($nome_gallery)."</b>";
				}
				?>
			</div>
			
			<div style="display:flex; gap:10px; align-items: center; margin-top:10px;">
				<a href="admin.php?cmd=categorie_media" class="btn">Torna alle Gallery</a>
			</div>

			<?php if($id_rife!=""){?>
			<div class="mws-panel-header" style="margin-top:20px;">
				<span style="color:#DB912D;"><i class="icon-table"></i> Elenco Sezioni</span>
			</div>
			<div class="mws-panel-body no-padding" style="margin-bottom:40px;">
				<form class="mws-form" action="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&azione=add_gruppo" method="post">
					<div class="mws-form-inline">
						<div class="mws-form-row">
							<label class="mws-form-label">Nuova sezione</label>
							<div class="mws-form-item" style="display:flex; flex-wrap:wrap; gap:8px; align-items:center;">
								<input type="text" name="nome_gruppo" value="" placeholder="Nome sezione" style="min-width:200px;" />
								<input type="text" name="sottotitolo_gruppo" value="" placeholder="Sottotitolo (opzionale)" style="min-width:220px;" />
								<input type="submit" class="btn btn-success" value="Aggiungi sezione" />
							</div>
						</div>
					</div>
				</form>
				<table class="mws-table" style="border-top: solid 1px #ccc;">
					<thead>
						<tr>
							<th style="width:50px;">#</th>
							<th>Nome e sottotitolo</th>
							<th style="width:220px;">Azioni</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$risu_gruppi = $open_connection->connection->query("SELECT * FROM media_gruppi WHERE id_gallery='".(int)$id_rife."' ORDER BY ordine DESC");
						$ng = 1;
						if ($risu_gruppi) {
							while($arr_gruppo = $risu_gruppi->fetch()) {
								$id_gr = (int)$arr_gruppo['id'];
								$is_default = (int)($arr_gruppo['is_default'] ?? 0);
								?>
								<tr>
									<td><?php echo $ng; ?></td>
									<td>
										<form action="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_gruppo_mov=<?php echo $id_gr; ?>&azione=gruppo_rename" method="post" style="display:flex; flex-direction:column; gap:6px; align-items:flex-start;">
											<div style="display:flex; flex-wrap:wrap; gap:8px; align-items:center;">
												<input type="text" name="nome_gruppo_edit" value="<?php echo htmlspecialchars($arr_gruppo['nome']); ?>" placeholder="Nome" style="min-width:180px;" />
												<input type="text" name="sottotitolo_gruppo_edit" value="<?php echo htmlspecialchars($arr_gruppo['sottotitolo'] ?? ''); ?>" placeholder="Sottotitolo (opz.)" style="min-width:200px;" />
												<button type="submit" class="btn btn-small">Salva</button>
												<?php if($is_default===1){?><span class="btn btn-small" title="Sezione di default"><i class="icon-star"></i></span><?php }?>
											</div>
										</form>
									</td>
									<td>
										<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_gruppo_mov=<?php echo $id_gr; ?>&azione=gruppo_primo" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
										<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_gruppo_mov=<?php echo $id_gr; ?>&azione=gruppo_sali" class="btn btn-small"><i class="icon-arrow-up"></i></a>
										<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_gruppo_mov=<?php echo $id_gr; ?>&azione=gruppo_scendi" class="btn btn-small"><i class="icon-arrow-down"></i></a>
										<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_gruppo_mov=<?php echo $id_gr; ?>&azione=gruppo_ultimo" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
										<?php if($is_default!==1){?>
											<a onclick="return confirm('Eliminare la sezione? I media passeranno nella sezione di default.');" href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_canc_gruppo=<?php echo $id_gr; ?>&azione=gruppo_delete" class="btn btn-small"><i class="icon-trash"></i></a>
										<?php }else{?>
											<span class="btn btn-small" title="Sezione di default non eliminabile"><i class="icon-lock"></i></span>
										<?php }?>
									</td>
								</tr>
								<?php
								$ng++;
							}
						}
						?>
					</tbody>
				</table>
			</div>
			<?php }?>

			<div id="start" style="display:none"></div>
			<div id="end" style="display:none"></div>
			<div id="total" style="display:none"></div>
			
			<div class="mws-panel-header">
				<div style="float:left; cursor:pointer; color:#DB912D" onclick="addImg();">
					<div class="btn" style="color:#27272B;"><i class="icon-plus"></i> Inserisci FOTO</div>
				</div>						
				<div style="float:left; cursor:pointer; color:#DB912D; margin-left:20px" onclick="addVideo();">
					<div class="btn" style="color:#27272B;"><i class="icon-plus"></i> Inserisci VIDEO</div>
				</div>
				<div style="clear:both; "></div>
			</div>
			
			<div class="mws-panel-body no-padding" style="display:none" id="addImg">
				<form name="inserimento" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="stato" value="inviato">
					<input type="hidden" name="tipo" value="foto">
					<input type="hidden" name="id_rife" value="<?php echo $id_rife;?>">

					<div class="mws-form-inline">
						<div style="padding:20px">
							<strong>INSERISCI FOTO</strong>
						</div>
			<?php 
						$oggetto_admin->campo_ins("Foto *<br />" , "img" , "42", 'no');
			?>
						<div class="mws-form-row">
							<label class="mws-form-label">Sezione</label>
							<div class="mws-form-item">
								<select name="id_gruppo">
									<?php
									if($id_rife!=""){
										$risu_gruppi = $open_connection->connection->query("SELECT * FROM media_gruppi WHERE id_gallery='".(int)$id_rife."' ORDER BY ordine DESC");
										if($risu_gruppi){
											while($arr_gruppo = $risu_gruppi->fetch()){
												echo "<option value=\"".(int)$arr_gruppo['id']."\">".htmlspecialchars($arr_gruppo['nome'])."</option>";
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						<br/><br/>
						<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
					</div>
					<div class="mws-button-row">
						<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
						<input type="button" value="Annulla" class="btn" onclick="addImg()">
					</div>
				</form>
			</div>
			
			<div class="mws-panel-body no-padding" style="display:none" id="addVideo">
				<form name="inserimento2" class="mws-form" action="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>" method="post" enctype="multipart/form-data">
					<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->
					<input type="hidden" name="stato" value="inviato_video">
					<input type="hidden" name="tipo" value="video">
					<input type="hidden" name="id_rife" value="<?php echo $id_rife;?>">

					<div class="mws-form-inline">
						<div style="padding:20px">
							<strong>INSERISCI VIDEO</strong>
						</div>
			<?php 
						$oggetto_admin->campo_ins("Video (YouTube)*<br />" , "img" , "1", 'no');
			?>
						<div class="mws-form-row">
							<label class="mws-form-label">Sezione</label>
							<div class="mws-form-item">
								<select name="id_gruppo">
									<?php
									if($id_rife!=""){
										$risu_gruppi = $open_connection->connection->query("SELECT * FROM media_gruppi WHERE id_gallery='".(int)$id_rife."' ORDER BY ordine DESC");
										if($risu_gruppi){
											while($arr_gruppo = $risu_gruppi->fetch()){
												echo "<option value=\"".(int)$arr_gruppo['id']."\">".htmlspecialchars($arr_gruppo['nome'])."</option>";
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						<br/><br/>
						<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>
					</div>
					<div class="mws-button-row">
						<input type="submit" value="Inserisci" class="btn btn-danger">
						<input type="button" value="Annulla" class="btn" onclick="addVideo()">
					</div>
				</form>
			</div>
			<script>
				function addImg(){
					$('#addVideo').hide();
					if(document.getElementById('addImg').style.display=='none'){
						$('#addImg').fadeIn();
					}else $('#addImg').fadeOut();
				}
				function addVideo(){
					$('#addImg').hide();
					if(document.getElementById('addVideo').style.display=='none'){
						$('#addVideo').fadeIn();
					}else $('#addVideo').fadeOut();
				}
			</script>
			
			<div class="mws-panel-header" style="margin-top:20px;">
				<span style="color:#DB912D; display:flex; gap:10px; align-items:start;">
					<i class="icon-table"></i> 
					<div style="display:flex; flex-direction:column; gap:3px;">
					    <span style="font-size:14px; color:#fff; line-height:1; font-weight:bold;">Elenco Foto/Video</span>
				    	<span style="font-size:12px; color:#fff; line-height:1; font-style:italic;">Le frecce agiscono internamente alla sezione del blocco. Ordinando le sezioni (tabella sopra), cambia anche l'ordine dei blocchi qui sotto.</span>
					</div>
				</span>
			</div>
			<div class="mws-panel-body no-padding">
				<table class="mws-datatable-fn mws-table">
					<thead>
						<tr>
							<th style="width:20px"></th>
							<th style="width:150px">Foto</th>
							<th style="text-align:center; width:50px">Tipo</th>
							<th style="width:140px; text-align:left;">Sezione</th>
							<th style="width:100px; text-align:left;">Categoria</th>
							<th style="text-align:left">Testo</th>
							<th>Azioni</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$blocchi = array();
						$risu_blocchi = $open_connection->connection->query("SELECT id, nome, ordine, is_default FROM media_gruppi WHERE id_gallery='".(int)$id_rife."' ORDER BY ordine DESC");
						if($risu_blocchi){
							while($arr_b = $risu_blocchi->fetch()){
								$blocchi[] = array(
									'id' => (int)$arr_b['id'],
									'nome' => $arr_b['nome'],
									'tipo' => 'gruppo',
									'is_default' => (int)($arr_b['is_default'] ?? 0)
								);
							}
						}
						$riga_num = 0;
						foreach($blocchi as $blocco){
							$id_blocco = (int)$blocco['id'];
							echo '<tr><td colspan="7" style="background:#222;color:#fff;">'.htmlspecialchars($nome_gallery).' - <b>'.htmlspecialchars($blocco['nome']).'</b></td></tr>';
							$query_ele = "SELECT * FROM $table WHERE id_rife='".(int)$id_rife."' AND id_gruppo='".$id_blocco."' ORDER BY ordine DESC";
							$risu_ele = $open_connection->connection->query($query_ele);
							if(!$risu_ele || $risu_ele->rowCount()==0){
								echo '<tr><td colspan="7"><i>Nessun media in questo blocco</i></td></tr>';
								continue;
							}
							while($arr_ele = $risu_ele->fetch()){
								$riga_num++;
								$foto = $arr_ele['img'];
								$id_campo = $arr_ele['id'];
								$id_cat = $arr_ele['id_rife'];
								$id_gruppo_media = (int)($arr_ele['id_gruppo'] ?? 0);
								$tipo = $arr_ele['tipo'];										
								$color = ($riga_num % 2 === 0) ? '#ffffff' : '#f2f2f2';
								
								$link=$http.'://'.$ind_sito.'/admin/img_up/media/'.$foto;
								?>
								<tr style="background:<?php echo $color;?>">
									<td align="center" valign="center"><?php  echo $riga_num; ?></td>
									<td style="position:relative">
										<?php if($tipo=="foto"){?>
											<img src="img_up/media/<?php if(is_file("img_up/media/s_".$foto)) echo "s_";?><?php  echo $foto; ?>" style="width:100%"/>
										<?php }else{?>
											<img src="https://i.ytimg.com/vi/<?php echo $foto;?>/hqdefault.jpg" style="width:100%"/>									
										<?php }?>
									</td>
									<td style="text-align:center;">
										<?php if($tipo=="foto"){?>
											<i class="fa-solid fa-image fa-2x"></i>
										<?php }else{?>
											<i class="fa-solid fa-video fa-2x"></i>
										<?php }?>
									</td>
									<td style="text-align:center;">
										<select name="id_gruppo" class="gruppo-select" data-id="<?= $id_campo; ?>">
											<?php
											$risu_gruppi_row = $open_connection->connection->query("SELECT * FROM media_gruppi WHERE id_gallery='".(int)$id_rife."' ORDER BY ordine DESC");
											if($risu_gruppi_row){
												while($arr_gruppo_row = $risu_gruppi_row->fetch()){
													$id_gr_row = (int)$arr_gruppo_row['id'];
													?>
													<option value="<?= $id_gr_row; ?>" <?php if($id_gruppo_media==$id_gr_row){?>selected="selected"<?php }?>>
														<?= htmlspecialchars($arr_gruppo_row['nome']); ?>
													</option>
													<?php
												}
											}
											?>
										</select>
									</td>
									<td style="text-align:center;">
										<select name="id_rec"  class="categoria-select" data-id="<?= $id_campo; ?>">
											<option value="">- Seleziona -</option>
											<option value="0" <?php if($id_cat==0){?>selected="selected"<?php }?>>Nessuna</option>
											<?php 
											$query_cat = "SELECT * FROM categorie_media ORDER BY ordine DESC";
											$risu_cat = $open_connection->connection->query($query_cat);
											while ($arr_cat = $risu_cat->fetch()) {
											?>
												<option value="<?= $arr_cat['id']; ?>" <?php if($id_cat==$arr_cat['id']){?>selected="selected"<?php }?>>
													<?= $arr_cat['nome']; ?>
												</option>
											<?php } ?>
										</select>
									</td>
									<td>
										<div style="display:flex; gap:10px; align-items:center;">
										<input type="text" class="testo-input" data-id="<?= $id_campo; ?>" value="<?= htmlspecialchars($arr_ele['testo'] ?? ''); ?>" style="width: 100%;" />
											<a href="#" style="width:30px; font-size:1.5em;" class="clear-texto" data-id="<?= $id_campo; ?>" title="Svuota campo">
												<i style="color:#111;" class="icon-trash"></i>
											</a>
										</div>
									</td>
									<td style="width:10%">
										<span class="btn-group">
											<?php if($id_rife!=""){?>
												<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&id_gruppo_ord=<?php echo $id_gruppo_media; ?>&azione=primo&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
												<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&id_gruppo_ord=<?php echo $id_gruppo_media; ?>&azione=sali&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
												<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&id_gruppo_ord=<?php echo $id_gruppo_media; ?>&azione=scendi&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
												<a href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&id_gruppo_ord=<?php echo $id_gruppo_media; ?>&azione=ultimo&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
											<?php }?>
											<a onclick="return confirm('Cancellare questo elemento?')" href="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
										</span>
									</td>
								</tr>
								<?php 
							}
						}
					?>
					</tbody>
				</table>	
				
				<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
			</div>
		</div>
		
		<script>
			$(document).ready(function() {
				document.querySelectorAll('.categoria-select').forEach(select => {
					select.addEventListener('change', function () {
						const id_media = this.dataset.id;
						const id_categoria = this.value;

						fetch('ajax/update_categoria.php', {
							method: 'POST',
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded'
							},
							body: new URLSearchParams({
								id_media: id_media,
								id_categoria: id_categoria
							})
						})
						.then(res => res.text())
						.then(res => {
							if (res === 'ok') {
								console.log('Categoria aggiornata con successo');
							} else {
								alert('Errore: ' + res);
							}
						})
						.catch(err => {
							alert('Errore AJAX: ' + err);
						});
					});
				});
				
				document.querySelectorAll('.gruppo-select').forEach(select => {
					select.addEventListener('change', function () {
						const id_media = this.dataset.id;
						const id_gruppo = this.value;

						fetch('ajax/update_gruppo_media.php', {
							method: 'POST',
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded'
							},
							body: new URLSearchParams({
								id_media: id_media,
								id_gruppo: id_gruppo
							})
						})
						.then(res => res.text())
						.then(res => {
							if (res === 'ok') {
								window.location.reload();
							} else {
								alert('Errore: ' + res);
							}
						})
						.catch(err => {
							alert('Errore AJAX: ' + err);
						});
					});
				});

				
				const debounce = (callback, delay) => {
					let timeout;
					return (...args) => {
						clearTimeout(timeout);
						timeout = setTimeout(() => callback(...args), delay);
					};
				};

				const updateTesto = debounce((id, testo) => {
					console.log('Saving:', id, testo);

					fetch('ajax/update_testo_media.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						},
						body: new URLSearchParams({
							id: id,
							testo: testo
						})
					})
					.then(res => res.text())
					.then(res => {
						if (res !== 'ok') {
							console.error('Errore:', res);
						}
					})
					.catch(err => console.error('AJAX error:', err));
				}, 300); // 300ms di attesa

				$('.testo-input').on('input', function () {
					const id = $(this).data('id');
					const testo = $(this).val();
					updateTesto(id, testo);
				});
				
				document.querySelectorAll('.clear-texto').forEach(btn => {
					btn.addEventListener('click', function(e) {
						e.preventDefault();
						
						const id = this.dataset.id;
						const input = document.querySelector('.testo-input[data-id="' + id + '"]');

						fetch('ajax/update_testo_media.php', {
							method: 'POST',
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded'
							},
							body: new URLSearchParams({
								id: id,
								testo: ''
							})
						})
						.then(response => response.text())
						.then(response => {
							if (response === 'ok') {
								input.value = '';
							} else {
								alert('Errore: ' + response);
							}
						})
						.catch(error => {
							alert('Errore AJAX: ' + error);
						});
					});
				});


			});
			</script>
		<?php } ?>

	<?php }?>
</div>