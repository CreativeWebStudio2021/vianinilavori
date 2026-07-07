<?php 
$table="punti_mappa";
$pagina="punti";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
if(isset($_GET['ric_stato'])) $ric_stato=$_GET['ric_stato']; else $ric_stato="";
if(isset($_GET['ric_cat'])) $ric_cat=$_GET['ric_cat']; else $ric_cat="";

$rif="";
$criterio="";
$ordine = "ordine";

if($ric_stato!=""){
	$rif.="&ric_stato=".$ric_stato;
	$criterio.= " AND stato = '$ric_stato' ";
}
if($ric_cat!=""){
	$rif.="&ric_cat=".$ric_cat;
	$criterio.= " AND categoria = '$ric_cat' ";
	$ordine = "ordine_categoria";
}
	
if($azione=="cancella")
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_img = "select img_testata from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/punti/$img")) @unlink("img_up/punti/$img");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		//window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($ric_cat==""){
		if($azione=="sali") $oggetto_admin->sali($table, "$id_canc") ;
		if($azione=="scendi") $oggetto_admin->scendi($table, "$id_canc") ;
		if($azione=="primo") $oggetto_admin->primo($table, "$id_canc");
		if($azione=="ultimo") $oggetto_admin->ultimo($table, "$id_canc");
		if($azione=="cambia") {
			if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
			if($new_pos!="") $oggetto_admin->cambia($table, "$id_canc", "$new_pos");			
		}
		
		if($azione=="attiva") $open_connection->connection->query("update $table set visibile='1' where id='$id_canc'") ;
		if($azione=="disattiva") $open_connection->connection->query("update $table set visibile='0' where id='$id_canc'") ;
		
		if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia" || $azione=="attiva" || $azione=="disattiva"){?>
			<script type="text/javascript">
				window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
			</script>
		<?php 
		}
	}else{
		if($azione=="sali") $oggetto_admin->sali2($table, "ordine_categoria", "$id_canc", "categoria", "$ric_cat") ;
		if($azione=="scendi") $oggetto_admin->scendi2($table, "ordine_categoria", "$id_canc", "categoria", "$ric_cat") ;
		if($azione=="primo") $oggetto_admin->primo2($table, "ordine_categoria", "$id_canc", "categoria", "$ric_cat");
		if($azione=="ultimo") $oggetto_admin->ultimo2($table, "ordine_categoria", "$id_canc", "categoria", "$ric_cat");
		if($azione=="cambia") {
			if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
			if($new_pos!="") $oggetto_admin->cambia2($table, "ordine_categoria", "$id_canc", "$new_pos", "categoria", "$ric_cat");			
		}
		
		if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia" || $azione=="attiva" || $azione=="disattiva"){?>
			<script type="text/javascript">
				window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
			</script>
		<?php 
		}
	}
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select pdf from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($file) = $risu_canc_img->fetch();
			if (is_file("img_up/files/certificazioni/$file")) @unlink("img_up/$file");
		}
		
		$query_canc = "delete from $table where id='".$temp[$z]."'";
		$risu_canc = $open_connection->connection->query($query_canc);
	}?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php 	
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
		}else{
			document.getElementById('cancella_sel').style.display="none";
		}
	}
	
	function aggiugni_tutti(){
		start = document.getElementById('start').innerHTML;
		end = document.getElementById('end').innerHTML;
		total = document.getElementById('total').innerHTML;
		
		if(document.getElementById('check_tutti').checked){
			ind_lista = 0;
			ind_check = 1;
			for(i=start-1; i<end; i++){
				lista_tutti+=lista_ind[ind_lista]+";";
				ind_lista++;
			}
			for(i=start; i<=end; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=true;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="block";
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
		}else{
			lista_tutti="";
			ind_check = 1;
			for(i=start; i<=total; i++){
				if(document.getElementById('check_'+ind_check))
					document.getElementById('check_'+ind_check).checked=false;
				ind_check++;
			}
			document.getElementById('cancella_sel').style.display="none";
		}	
	}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Punti Mappa</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div style="float:left; width:calc(100% - 220px); height:60px;  display:flex; gap:20px">
		<div>
			Categoria<br/>
			<?php 
			$link_change = "admin.php?cmd=punti";
			if($ric_stato!="") $link_change .= "&ric_stato=".$ric_stato;
			?>
			<select name="ric_cat" onchange="window.location='<?php echo $link_change;?>&ric_cat='+this.value">
				<option></option>
				<?php 
				$query_cat="SELECT * FROM categorie ORDER BY ordine DESC";
				$risu_cat = $open_connection->connection->query($query_cat);
				while($arr_cat=$risu_cat->fetch()){?>
					<option value='<?php echo $arr_cat['id'];?>' <?php if($arr_cat['id'] == $ric_cat){?>selected="selected"<?php }?>><?php echo $arr_cat['nome'];?></option>
				<?php }?>
			</select>
		</div>
		<div>
			Stato<br/>
			<?php 
			$link_change = "admin.php?cmd=punti";
			if($ric_cat!="") $link_change .= "&ric_cat=".$ric_cat;
			?>
			<select name="ric_stato" onchange="window.location='<?php echo $link_change;?>&ric_stato='+this.value">
				<option></option>
				<option value='Lavoro in corso' <?php if($ric_stato=="Lavoro in corso"){?>selected="selected"<?php }?>>Lavoro in corso</option>
				<option value='Lavoro completato' <?php if($ric_stato=="Lavoro completato"){?>selected="selected"<?php }?>>Lavoro completato</option>
			</select>
		</div>
	</div>
	<div style="float:right; width:200px; height:30px; text-align:right; margin-bottom:10px;">
		<a href="admin.php?cmd=<?php echo $pagina;?>_ins<?php echo $rif;?>"><button class="btn btn-success"><b>Aggiungi Punti Mappa</b></button></a> &nbsp; 
	</div>
	<div style="clear:both"></div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Punti Mappa</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="text-align:left; width:200px">Img</th>
					<th style="text-align:left">Titolo</th>
					<th style="text-align:left">Categoria</th>
					<th style="text-align:center; width:80px;">Gallery</th>
					<?php /*<th style="text-align:center; width:80px;">Webcam</th>*/?>
					<th style="width:80px;">Vis. Scheda<br/>Lavori Compl.</th>
					<th style="width:80px;">Visibile</th>
					<th style="text-align:left">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from $table WHERE 1 $criterio order by $ordine DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					
					$rec_pag=2000;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 $criterio ORDER BY $ordine DESC LIMIT $start,$rec_pag";
					//echo $query_ele;
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$titolo = ucfirst($arr_ele['titolo']);
						$titolo_bold = ucfirst($arr_ele['titolo_bold']);
						$img_testata = $arr_ele['img_testata'];
						$categoria = $arr_ele['categoria'];
						$file_custom = $arr_ele['file_custom'];
						$stato = $arr_ele['stato'];
						$visibile = $arr_ele['visibile'];
						$visibile_scheda = $arr_ele['visibile_scheda'];
						$video = $arr_ele['video'] ?? null;
						$color = ($x % 2 === 0) ? '#ffffff' : '#f2f2f2';
			?>	
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr style="background:<?php echo $color;?>">
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center">
						<?php  echo $start+$x+1; ?>
					</td>
					<td align="left" valign="center">
						<div style="width:100%; min-height:100px;  position:relative;">
							<?php if(file_exists("img_up/punti/".$img_testata)){?> 
								<img src="img_up/punti/<?php if(file_exists("img_up/punti/s_".$img_testata)) echo "s_";?><?php echo $img_testata;?>" style="width:100%" alt=""/>
							<?php }?>
							<?php if($video){?>
								<div style="position:absolute; width:100%; height:100%; background:rgba(0,0,0,0.8); top:0; left:0;">
									<div style="position:absolute; color:#fff; width:100%; text-align:center; left:0; top:50%; transform:translateY(-50%); font-size:18px; font-weight:600;">
										VIDEO
									</div>
								</div>
							<?php }?>
						</div>
					</td>
					<td align="left" valign="center">
						<?php  echo $titolo; ?> <b><?php  echo $titolo_bold; ?></b>
						<br/>
						<span style="font-style:0.9em"><i><?php  echo $stato; ?></i></span>
						<?php if(isset($file_custom) && $file_custom!=""){?>
							<div style="width:70px; background:#000; margin-top:3px;color:#fff; text-align:center; border-radius:3px; font-size:0.8em">
								<div style="padding:1px 5px"><b>CUSTOM</b></div>
							</div>
						<?php }?>
					</td>
					<td align="left" valign="center">
						<?php 
						$query_cat="SELECT nome FROM categorie WHERE id='".$categoria."'";
						$risu_cat=$open_connection->connection->query($query_cat);
						list($nome_cat)=$risu_cat->fetch();
						
						echo $nome_cat; ?>
					</td>
					<td align="center" valign="center">
						<?php 
						$query_gal = "SELECT id FROM punti_mappa_gallery WHERE id_rife='".$id_campo."'";
						$risu_gal = $open_connection->connection->query($query_gal);
						$num_gal = $risu_gal->rowCount();
						?>
						<div style="width:30px; height:30px; border-radius:15px; bottom:2px; right:2px; text-align:center; background:#000;  cursor:pointer;" onclick="document.getElementById('framePage').src='frame/puntiGallery.php?id_rife=<?php echo $id_campo;?>'; $('#mask').fadeIn();">						
							<div style="color:#fff; padding-top:5px; font-weight:bold;"><?php echo $num_gal;?></div>
						</div>
					</td>
					<td  align="center" valign="center">								
						<a style="cursor:pointer" onclick="gestisci_vis_scheda('<?php echo $id_campo;?>')">						
							<div style="width:30px; height:30px" id="visibilita_scheda_<?php echo $id_campo;?>">
								<?php  if ($visibile_scheda=='1'){?>
									<i class="fa-solid fa-circle-check fa-2x" style="color:#99D000"></i>
								<?php }else{?>
									<i class="fa-regular fa-circle fa-2x" style="color:red"></i>
								<?php }?>
							</div>
						</a>
					</td>
					<td  align="center" valign="center">
						<?php if(isset($file_custom) && $file_custom!=""){?>
						<a style="opacity:0.4">
						<?php }else{?>		
						<a style="cursor:pointer" onclick="gestisci_vis('<?php echo $id_campo;?>')">
						<?php }?>
							<div style="width:30px; height:30px" id="visibilita_<?php echo $id_campo;?>">
								<?php  if ($visibile=='1'){?>
									<i class="fa-solid fa-circle-check fa-2x" style="color:#99D000"></i>
								<?php }else{?>
									<i class="fa-regular fa-circle fa-2x" style="color:red"></i>
								<?php }?>
							</div>
						</a>
					</td>
					<td style="width:10%; text-align:left">
						<span class="btn-group">
							<?php if($ric_stato==""){?>
								<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
								<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
								<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
								<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
								<div class="btn btn-small" style="position:relative; width:15px; height:20px; ">
									<div style="position:absolute; width:20px; height:20px; top:2px; left:7px; border:solid:#000; background:#fff; z-index:99"></div>
									<div style="position:absolute; width:20px; height:20px; top:-2px; left:7px; z-index:100">
										<form action="admin.php" method="GET">
											<input type="hidden" name="cmd" value="<?php echo $pagina;?>"/>
											<input type="hidden" name="id_canc" value="<?php  echo $id_campo; ?>"/>
											<input type="hidden" name="azione" value="cambia"/>
											<input type="hidden" name="pag_att" value="<?php echo $pag_att;?>"/>
											<input type="text" name="new_pos" value="<?php  echo $start+$x+1; ?>" style="width:15px; height:10px; padding:0; margin:0; border:0; text-align:center; background:none"/>
										</form>
									</div>
								</div>
							<?php }?>
							<?php if(isset($file_custom) && $file_custom!=""){?>
								<?php if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){?>
									<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
									<a  onClick="return confirm('Cancellare gli elementi selezionati?')"href="admin.php?cmd=<?php echo $pagina;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
								<?php }else{?>	
									<a class="btn btn-small" style="opacity:0.4" onclick="alert('Progetto CUSTOM, non modificabile!')"><i class="icon-pencil"></i></a>
								<?php }?>								
							<?php }else{?>							
								<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
								<a  onClick="return confirm('Cancellare gli elementi selezionati?')"href="admin.php?cmd=<?php echo $pagina;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
							<?php }?>
						</span>
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		<?php  include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('cancellare l\'elemento?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
<iframe id="hiddenFrame" style="display:none"></iframe>
<script type="text/javascript">
  function gestisci_vis(id){
	var curSrc = $("#visibilita_"+id).html();
	
	if (curSrc.includes('99D000')) { 
		$("#visibilita_"+id).html('<i class="fa-regular fa-circle fa-2x" style="color:red"></i>')
	}else{
		$("#visibilita_"+id).html('<i class="fa-solid fa-circle-check fa-2x" style="color:#99D000"></i>')
	}
		
	$("#hiddenFrame").attr("src", "frame/visibilePunti.php?id_prod="+id);
  }
  function gestisci_vis_scheda(id){
	var curSrc = $("#visibilita_scheda_"+id).html();
	
	if (curSrc.includes('99D000')) { 
		$("#visibilita_scheda_"+id).html('<i class="fa-regular fa-circle fa-2x" style="color:red"></i>')
	}else{
		$("#visibilita_scheda_"+id).html('<i class="fa-solid fa-circle-check fa-2x" style="color:#99D000"></i>')
	}
	$("#hiddenFrame").attr("src", "frame/visibilePuntiScheda.php?id_prod="+id);
  }
</script>

