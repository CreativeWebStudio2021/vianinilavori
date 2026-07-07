<?php 
$table="comunicati_stampa";
$pagina="comunicati";
$directory="comunicati";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";
$criterio="";

if($azione=="cancella")
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc_img = "select img from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($logo) = $risu_canc_img->fetch();
		if (is_file("img_up/$logo")) @unlink("img_up/$logo");
		if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.alert("Il campo e' stato cancellato con successo");
		window.location="admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
	</script>
<?php 
} 

if ($id_canc) {
	if($azione=="sali") $oggetto_admin->sali($table, "$id_canc") ;
	if($azione=="scendi") $oggetto_admin->scendi($table, "$id_canc") ;
	if($azione=="primo") $oggetto_admin->primo($table, "$id_canc");
	if($azione=="ultimo") $oggetto_admin->ultimo($table, "$id_canc");
	if($azione=="cambia") {
		if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
		if($new_pos!="") $oggetto_admin->cambia($table, "$id_canc", "$new_pos");			
	}
	
	if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
		<script type="text/javascript">
			window.location='admin.php?cmd=<?php echo $pagina;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
		</script>
	<?php }
}

if($azione=="cancella_sel") {
	if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";
	$temp=explode(";",$lista);
	for($z=0; $z<count($temp)-1; $z++){
		$query_canc_img = "select img from $table where id='".$temp[$z]."'";
		$risu_canc_img = $open_connection->connection->query($query_canc_img);
		if ($risu_canc_img) {
			list($logo) = $risu_canc_img->fetch();
			if (is_file("img_up/$logo")) @unlink("img_up/$logo");
			if (is_file("img_up/s_$logo")) @unlink("img_up/s_$logo");
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;
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
			document.getElementById('cancella_sel').href='admin.php?cmd=<?php echo $table;?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;
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
<iframe id="hiddenFrame" style="display:none"></iframe>
<script>
function cambiaComunicato(id) {
  const el = document.getElementById('news_' + id);
  const isVisible = el.style.color === 'green';
  el.style.color = isVisible ? 'red' : 'green';
  document.getElementById('hiddenFrame').src = 'frame/cambiaComunicato.php?id_campo=' + id;
}
</script>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Rassegna Stampa</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<?php 
	// Recupera il protocollo (http o https)
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	// Recupera il nome del server
	$serverName = $_SERVER['SERVER_NAME'];

	// Recupera la porta (se diversa dalla porta standard)
	$port = ($_SERVER['SERVER_PORT'] != '80' && $_SERVER['SERVER_PORT'] != '443') ? ":" . $_SERVER['SERVER_PORT'] : "";

	// Recupera l'URI della richiesta
	$requestUri = $_SERVER['REQUEST_URI'];

	// Combina tutti i componenti per ottenere la URL completa
	$fullUrl = $protocol . $serverName . $port . $requestUri;
	?>
	
	<div style="float:right; width:200px; height:30px; text-align:right">
		<a href="admin.php?cmd=<?php echo $pagina;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>"><button class="btn btn-success"><b>Aggiungi elemento</b></button></a> &nbsp; 
	</div>
	<div style="clear:both; height:10px"></div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco Rassegna Stampa</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"><input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/></th>
					<th style="width:20px"></th>
					<th style="width:80px">Data</th>
					<th style="width:120px">Foto</th>
					<th align="left">Titolo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from $table WHERE 1  order by data_news DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$rec_pag=2000;					
					$pag_tot=ceil($num_ele/$rec_pag);					
					$start=($pag_att-1)*$rec_pag;
					$query_ele = "SELECT * FROM $table WHERE 1 ORDER BY data_news DESC";
					//echo $query_ele;
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$foto = $arr_ele['img'];
						$tit = $oggetto_admin->puntini(ucfirst($arr_ele['titolo']));
						$sottotit = $oggetto_admin->puntini(ucfirst($arr_ele['sottotitolo']));
						$data = $oggetto_admin->date_to_data($arr_ele['data_news']);
						$id_campo = $arr_ele['id'];
						$visibile = $arr_ele['visibile'];
						$testata = $arr_ele['testata'];
			?>	
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr>
					<td align="center" valign="center">
						<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>
					</td>
					<td align="center" valign="center">
						<?php  echo $start+$x+1; ?>
					</td>
					<td align="center" valign="center"><?php  echo $data; ?></td>
					<td align="center" valign="center">
						<?php  if ($foto!="" && file_exists("img_up/$directory/$foto")) { ?>
							<img src="img_up/<?php echo $directory;?>/<?php  if (file_exists("img_up/$directory/s_$foto")) { ?>s_<?php }?><?php  echo $foto; ?>" alt="" style="width:100%"/>
						<?php  } ?>
					</td>
					<td align="left" valign="center">
						<?php  echo $tit; ?>
						<?php if(isset($sottotit) && $sottotit!=""){?>
							<br><span style="font-size:0.9em;"><?php echo $sottotit;?></span>
						<?php }?>
						<?php if(isset($testata) && $testata!=""){?>
							<br><span style="font-size:0.9em;"><b><?php echo $testata;?></b></span>
						<?php }?>
					</td>
					<td style="width:10%">
						<span class="btn-group">
							<a title="Visibilità" onclick="cambiaComunicato('<?php echo $id_campo;?>')" id="news_<?php echo $id_campo;?>" class="btn btn-small" style="cursor:pointer; color:<?php if($visibile==0){?>red<?php }else{?>green<?php }?>"><i class="icon-newspaper"></i></a>							
							<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a href="admin.php?cmd=<?php echo $pagina;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
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
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>




