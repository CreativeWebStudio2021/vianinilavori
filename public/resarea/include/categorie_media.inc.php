<?php 
$table="categorie_media";

$criterio="";
$riferimenti="";
$rif=""; 

if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife='';
if($id_rife!="") {
	$criterio=" AND id_rife='$id_rife'";
	$rif.="&id_rife=$id_rife";
}
if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
$rif.="&pag_att=$pag_att";
if(isset($_GET['id_tag'])) $id_tag=$_GET['id_tag']; else $id_tag="";

if($azione=="cancella")
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	/*
	$query_canc_img = "select img from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/$img")) @unlink("img_up/$img");
	}*/
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $table;?><?php echo $rif;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc") ;
	if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc") ;
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos") ;	
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php }
	
	if ($azione=="attiva") $query_agg = $open_connection->connection->query("update $table set visibile='1' where id='$id_canc'");
	if ($azione=="disattiva") $query_agg = $open_connection->connection->query("update $table set visibile='0' where id='$id_canc'");
	
	if ($azione=="scarica") {
		include("include/scarica_prodotti.inc.php");
		scarica_prodotti($id_riferimento,$id_canc);
	}
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		/*$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/$img")) @unlink("img_up/$img");
		}*/
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php 	
}

if($azione=="add_tag" && !empty($_POST['nome_tag'])) {
	$nome_tag = str_replace('"','\"',trim($_POST['nome_tag']));
	$ordine_tag = $oggetto_admin->trova_ordine("media_tag", "", "");
	$open_connection->connection->query("INSERT INTO media_tag (nome, ordine, stato, visibile) VALUES ('$nome_tag', '$ordine_tag', '1', '1')");
	?>
	<script type="text/javascript">
		window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
	</script>
	<?php
}

if($id_tag!="") {
	if($azione=="tag_sali") $oggetto_admin->sali("media_tag", "$id_tag");
	if($azione=="tag_scendi") $oggetto_admin->scendi("media_tag", "$id_tag");
	if($azione=="tag_primo") $oggetto_admin->primo("media_tag", "$id_tag");
	if($azione=="tag_ultimo") $oggetto_admin->ultimo("media_tag", "$id_tag");
	if($azione=="tag_cancella") {
		$open_connection->connection->query("DELETE FROM media_gallery_tag WHERE id_tag='".(int)$id_tag."'");
		$open_connection->connection->query("DELETE FROM media_tag WHERE id='".(int)$id_tag."'");
	}
	if($azione=="tag_sali" || $azione=="tag_scendi" || $azione=="tag_primo" || $azione=="tag_ultimo" || $azione=="tag_cancella"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>';
		</script>
	<?php }
}
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			for(i=start; i<=total; i++){
				document.getElementById('check_'+i).checked=false;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}

	function toggleTagPanel() {
		var panel = document.getElementById('tag-panel-body');
		if (!panel) return;
		if (panel.style.display === 'none') {
			panel.style.display = '';
		} else {
			panel.style.display = 'none';
		}
	}
</script>
<div class="mws-panel grid_8" style="margin-bottom:20px;">
	
	<div class="mws-panel-header" style="display:flex;justify-content:space-between;align-items:center; margin-top:20px;">
		<span>Gestione tag</span>
		<button type="button" class="btn btn-small" onclick="toggleTagPanel()">Apri/Chiudi</button>
	</div>
	<div class="mws-panel-body no-padding" id="tag-panel-body" style="display:none;">
		<form class="mws-form" action="admin.php?cmd=<?php echo $table;?>&azione=add_tag<?php echo $rif;?>" method="post">
			<div class="mws-form-inline">
				<div class="mws-form-row">
					<label class="mws-form-label">Nuovo tag</label>
					<div class="mws-form-item">
						<input type="text" name="nome_tag" value="" />
						<input type="submit" class="btn btn-success" value="Aggiungi tag" style="margin-left:10px;" />
					</div>
				</div>
			</div>
		</form>

		<table class="mws-table" style="border-top: solid 1px #ccc;">
			<thead>
				<tr>
					<th style="width:50px;"></th>
					<th style="text-align:left">Nome</th>
					<th style="width:220px; text-align:left;">Azioni</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$risu_tag = $open_connection->connection->query("SELECT * FROM media_tag ORDER BY ordine DESC");
				$i = 1;
				if ($risu_tag) {
					while($arr_tag = $risu_tag->fetch()) {
						$id_tag_row = (int)$arr_tag['id'];
						?>
						<tr>
							<td align="center" valign="center"><?php echo $i; ?></td>
							<td><?php echo htmlspecialchars($arr_tag['nome']); ?></td>
							<td style="text-align:left;">
								<a href="admin.php?cmd=<?php echo $table;?>&id_tag=<?php echo $id_tag_row; ?>&azione=tag_primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
								<a href="admin.php?cmd=<?php echo $table;?>&id_tag=<?php echo $id_tag_row; ?>&azione=tag_sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
								<a href="admin.php?cmd=<?php echo $table;?>&id_tag=<?php echo $id_tag_row; ?>&azione=tag_scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
								<a href="admin.php?cmd=<?php echo $table;?>&id_tag=<?php echo $id_tag_row; ?>&azione=tag_ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
								<a onclick="return confirm('Cancellare il tag?');" href="admin.php?cmd=<?php echo $table;?>&id_tag=<?php echo $id_tag_row; ?>&azione=tag_cancella<?php echo $rif;?>" class="btn btn-small"><i class="icon-trash"></i></a>
							</td>
						</tr>
						<?php
						$i++;
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="mws-panel grid_8">
	<div style="display:flex; justify-content:space-between; align-items:center; ">
		<div style="height:30px;font-size:1.2em;padding-top:10px"><b>Foto/Video Gallery</b></div>
		<div style="height:30px; text-align:right; margin-bottom:10px;">
			<a href="admin.php?cmd=<?php echo $table;?>_ins<?php echo $rif;?>">
				<button class="btn btn-success">
					<b>Aggiungi Gallery</b>
				</button>
			</a> 
			&nbsp; 
		</div>		
	</div>

	<div class="mws-panel-body no-padding" id="gallery-panel-body">
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Foto/Video Gallery</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-table">
			<thead>
				<tr>
					<th style="width:50px;"></th>
					<th style="text-align:left">Titolo / Sottotitolo</th>
					<th style="text-align:left; min-width:200px;">Anteprima</th>
					<th style="text-align:left; min-width:160px;">Tag</th>
					<th style="width:140px; text-align:center;">Media</th>
					<th style="text-align:left">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY ordine DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{					  
					$rec_pag=20;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY ordine DESC LIMIT $start,$rec_pag";
					$risu_ele = $open_connection->connection->query($query_ele);
					$rows = array();
					if ($risu_ele) {
						while ($r = $risu_ele->fetch()) {
							$rows[] = $r;
						}
					}
					$num_item = count($rows);
					$tags_by_gallery = array();
					if ($num_item > 0) {
						$ids = array();
						foreach ($rows as $r) {
							$ids[] = (int)$r['id'];
						}
						$in = implode(',', $ids);
						$rq_tags = $open_connection->connection->query("SELECT mgt.id_gallery, mt.nome FROM media_gallery_tag mgt INNER JOIN media_tag mt ON mt.id = mgt.id_tag WHERE mgt.id_gallery IN ($in) ORDER BY mt.ordine DESC, mt.nome ASC");
						if ($rq_tags) {
							while ($tr = $rq_tags->fetch()) {
								$gid = (int)$tr['id_gallery'];
								if (!isset($tags_by_gallery[$gid])) {
									$tags_by_gallery[$gid] = array();
								}
								$tags_by_gallery[$gid][] = htmlspecialchars($tr['nome'], ENT_QUOTES, 'UTF-8');
							}
						}
					}
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $rows[$x];
						$nome = $arr_ele['nome'];
						$sottotitolo = $arr_ele['sottotitolo'] ?? '';
						$luogo = $arr_ele['luogo'] ?? '';
						$anteprima = trim((string)($arr_ele['anteprima'] ?? ''));
						$id_prog = $arr_ele['progetto'];
						$pulsante_tipo = $arr_ele['pulsante_tipo'] ?? 'libero';
						$pulsante_testo = $arr_ele['pulsante_testo'] ?? '';
						$pulsante_link = $arr_ele['pulsante_link'] ?? '';
						$id_campo = $arr_ele['id'];
			?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td>
						<?php  echo htmlspecialchars($nome); ?>
						<?php if($sottotitolo!=""){?>
							<br/>
							<span style="font-size:12px; color:#666;"><?php echo htmlspecialchars($sottotitolo); ?></span>
						<?php }?>
						<?php if($luogo!=""){?>
							<br/>
							<span style="font-size:11px; color:#666; font-style:italic;"><?php echo htmlspecialchars($luogo); ?></span>
						<?php }?>
					</td>
					
					<td style="font-size:12px; line-height:1.4;">
						<?php if($anteprima!=""){ ?>
							<div style="display:flex; align-items:center; gap:8px;">
								<img src="img_up/media/<?php echo htmlspecialchars($anteprima, ENT_QUOTES, 'UTF-8'); ?>" alt="" style="width:90px; height:54px; object-fit:cover; border:1px solid #ddd;" />
								<span><?php echo htmlspecialchars($anteprima, ENT_QUOTES, 'UTF-8'); ?></span>
							</div>
						<?php } else { ?>
							<span style="color:#999;">—</span>
						<?php } ?>
					</td>
					<td style="font-size:12px; line-height:1.4;">
						<?php
						$tag_list = isset($tags_by_gallery[(int)$id_campo]) ? $tags_by_gallery[(int)$id_campo] : array();
						if (count($tag_list) > 0) {
							echo implode(', ', $tag_list);
						} else {
							echo '<span style="color:#999;">—</span>';
						}
						?>
					</td>
					<td style="text-align:center;">
						<a href="admin.php?cmd=media&id_rec=<?php echo $id_campo; ?>" class="btn btn-small btn-success">Apri media</a>
					</td>
					<td style="width:10%">
						<span class="btn-group">
							
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=<?php echo $table;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
							<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
								<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
								<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
									<form action="admin.php" method="GET">
										<input type="hidden" name="cmd" value="<?php echo $table;?>"/>
										<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
										<input type="hidden" name="azione" value="cambia"/>
										<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
										<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
									</form>
								</div>
							</div>
							
							<a href="admin.php?cmd=<?php echo $table;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a onclick="return confirm('cancellare l\'elemento?');" href="admin.php?cmd=<?php echo $table;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		
		<?php include("fissi/multipagina.inc.php");?>
		
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>

<script>
	$(document).ready(function() {
		document.querySelectorAll('.progetto-select').forEach(select => {
			select.addEventListener('change', function () {
				const id_media = this.dataset.id;
				const id_progetto = this.value;

				fetch('ajax/update_progetto.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					body: new URLSearchParams({
						id_media: id_media,
						id_progetto: id_progetto
					})
				})
				.then(res => res.text())
				.then(res => {
					if (res === 'ok') {
						console.log('Progetto aggiornato con successo');
					} else {
						alert('Errore: ' + res);
					}
				})
				.catch(err => {
					alert('Errore AJAX: ' + err);
				});
			});
		});
	});
</script>