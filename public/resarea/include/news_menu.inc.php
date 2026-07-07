<?php 
$table="news_menu";
$pagina="news_menu";
$directory="news";
$title_pag="News Menù";

if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;

$rif="";

$num_s = 0;
$query_s = "select id from $table";
$risu_s = $open_connection->connection->query($query_s);
if ($risu_s) $num_s = $risu_s->rowCount();

if($azione=="cancella" && $id_canc!="")
{		
	$query_canc_img = "select img from $table where id='$id_canc'";
	$risu_canc_img = $open_connection->connection->query($query_canc_img);
	if ($risu_canc_img) {
		list($img) = $risu_canc_img->fetch();
		if (is_file("img_up/$directory/$img")) @unlink("img_up/$directory/$img");
	}
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
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
	if($azione=="programmazione_del") {
		$query_del_prog="UPDATE $table SET data_start = NULL, data_end = NULL WHERE id='".$id_canc."'";
		$risu_del_prog = $open_connection->connection->query($query_del_prog);
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
			list($img) = $risu_canc_img->fetch();
			if (is_file("img_up/$directory/$img")) @unlink("img_up/$directory/$img");
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
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b><?php echo $title_pag;?></b></div>
	
	<div style="height:30px;width:100%;text-align:right"><a href="admin.php?cmd=<?php echo $pagina;?>_ins<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" style="color:#7a7a7a"><b>Aggiungi <?php echo $title_pag;?></b></a> &nbsp; </div>
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Elenco <?php echo $title_pag;?></span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"></th>
					<th style="width:200px">Immagine</th>
					<th style="text-align:left;">Titolo</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "SELECT * FROM $table ORDER BY ordine DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				$rec_pag=20;					
				$pag_tot=ceil($num_ele/$rec_pag);					
				$start=($pag_att-1)*$rec_pag;
				
				if($num_ele>0)
				{					  
					for($x=0;$x<$num_ele;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$titolo = $arr_ele['titolo'];
						$id_campo = $arr_ele['id'];
						$foto = $arr_ele['img'];
						$visibile = $arr_ele['visibile'];		
						$color = ($x % 2 === 0) ? '#ffffff' : '#f2f2f2';						
				?>
				<script type="text/javascript">
					lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";
				</script>
				<tr style="background:<?php echo $color;?>">
					<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>
					<td align="center" valign="center"><img src="img_up/<?php echo $directory;?>/<?php  echo $foto; ?>"/></td>
					<td><?php  echo $titolo; ?></td>
					<td style="width:10%">
						<span class="btn-group">
							<a class="btn btn-small" id="visibile_<?php echo $id_campo;?>" style="cursor:pointer; color:<?php if($visibile=='0'){?>red<?php }else{?>green<?php }?>" onclick="visibile('<?php echo $id_campo;?>')"><i class="fa fa-eye" aria-hidden="true"></i></a>
							
							<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>
							<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>
							<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>
							<a href="admin.php?cmd=<?php echo $pagina;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>
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
							<a href="admin.php?cmd=<?php echo $pagina;?>_mod&id_rec=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-pencil"></i></a>
							<a OnClick="return confirm('Sei sicuro di voler cancellare questo elemento?');" href="admin.php?cmd=<?php echo $pagina;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>
						</span>
						
					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>	
		<?php  //include("fissi/multipagina.inc.php"); ?>
		<a href=""  onClick="return confirm('Cancellare gli elementi selezionati?')" id="cancella_sel" style="display:none;"><div style="padding:5px"><input type="button" value="CANCELLA SELEZIONATI"/></div></a>
	</div>
</div>
<iframe id="hiddenFrame" src="" style="display:none"></iframe>
<script>
  function visibile(id){
    if(document.getElementById('visibile_'+id).style.color=="red"){
      document.getElementById('visibile_'+id).style.color="green";      
    }else{
      document.getElementById('visibile_'+id).style.color="red";
    }
    document.getElementById('hiddenFrame').src="frame/cambiaNewsMenu.php?id_dett="+id;
  }
</script>
