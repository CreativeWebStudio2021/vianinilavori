<?php 
session_start();

require_once '../config/dbnew.php';	
require_once '../config/array.php';	
require_once '../fissi/functions.php';
require_once '../fissi/functions_adm.php';
require_once '../fissi/all_posts.php';

$oggetto_admin = new Functions_adm($array_sito);

?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<title><?php  echo strtoupper($nome_del_sito);?> - admin</title>
<base href="<?php echo $http;?>://<?php  echo $ind_sito ?>/resarea/" /> 
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/login.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/demo.css" media="screen"><?php /**/?>

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">

<?php /*<script src="ckeditor/ckeditor.js"></script>*/?>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

</head>



<body>
	<!-- Header -->
	<!-- Start Main Wrapper -->
    <div id="mws-wrapper">	
	<?php 
	if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si")
	{
	if(isset($_GET['id_rife'])) $id_rife=$_GET['id_rife']; else $id_rife="";
	if($id_rife!=""){
		?>
		<!-- Inner Container Start -->

			<div class="container">

				<?php 

				$table=$prec_db."punti_mappa_webcam";
				if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att=1;
				if(isset($_GET['id_canc'])) $id_canc=$_GET['id_canc']; else $id_canc="";
				$rif="?id_rife=".$id_rife;

				if($azione=="cancella" && $id_canc!="")
				{						

					$query_canc = "delete from $table where id='$id_canc'";
					$risu_canc = $open_connection->connection->query($query_canc);
				?>
					<script language="javascript">		
						//window.alert("Il campo e' stato cancellato con successo");
						window.location="frame/puntiWebcam.php<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>";
					</script>
				<?php 
				} 



				if ($id_canc) {
					if($azione=="sali") $oggetto_admin->sali("$table", "$id_canc", "id_rife","$id_rife") ;
					if($azione=="scendi") $oggetto_admin->scendi("$table", "$id_canc", "id_rife","$id_rife") ;
					if($azione=="primo") $oggetto_admin->primo("$table", "$id_canc", "id_rife","$id_rife") ;
					if($azione=="ultimo") $oggetto_admin->ultimo("$table", "$id_canc", "id_rife","$id_rife") ;
					if($azione=="cambia") {
						if(isset($_GET['new_pos'])) $new_pos=$_GET['new_pos']; else $new_pos="";
						if($new_pos!="") $oggetto_admin->cambia("$table", "$id_canc", "$new_pos");	
					}				

					if($azione=="sali" || $azione=="scendi" || $azione=="primo" || $azione=="ultimo" || $azione=="cambia"){?>
						<script type="text/javascript">
							window.location='frame/puntiWebcam.php<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>';
						</script>

					<?php }

				}



				if($azione=="cancella_sel") {

					if(isset($_GET['lista'])) $lista=$_GET['lista']; else $lista="";

					$temp=explode(";",$lista);

					for($z=0; $z<count($temp)-1; $z++){
						$query_canc = "delete from $table where id='".$temp[$z]."'";
						$risu_canc = $open_connection->connection->query($query_canc);
					}?>

					<script type="text/javascript">
						window.location='frame/puntiWebcam.php<?php echo $rif;?>';
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

							document.getElementById('cancella_sel').href='frame/puntiWebcam.php<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_del;

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

							document.getElementById('cancella_sel').href='frame/puntiWebcam.php<?php echo $rif;?>&pag_att=<?php echo $pag_att;?>&azione=cancella_sel&lista='+lista_tutti;

						}else{

							lista_tutti="";

							for(i=start; i<=total; i++){

								document.getElementById('check_'+i).checked=false;

							}

							document.getElementById('cancella_sel').style.display="none";

						}	

					}

					

					function verifica(){

						if (document.inserimento.link.value=="") alert('Link Webcam obbigatorio');	

						//else document.inserimento.submit();

					}

				</script>



				<?php 

				if($stato=="inviato")
				{
					$arr_no['stato']=1;
					$arr_thumb="no";
					$oggetto_admin->inserisci_campi("$table" , $arr_no ,  $arr_thumb, "img_up/punti", "", "800");
				?>

					<script language="javascript">
						window.location = "frame/puntiWebcam.php<?php echo $rif;?>" ;
					</script>

				<?php 

				}?>



				<div class="mws-panel grid_12">
					<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Webcam </b></div>					

					<div id="start" style="display:none"></div>
					<div id="end" style="display:none"></div>
					<div id="total" style="display:none"></div>				

					<div class="mws-panel-header">
						<div style="float:left; cursor:pointer; color:#DB912D" onclick="addImg();">
							<div class="btn" style="color:#27272B;"><i class="icon-plus"></i> Inserisci Webcam</div>
						</div>	
						<div style="clear:both; "></div>
					</div>

					<div class="mws-panel-body no-padding" style="display:none" id="addImg">

						<form name="inserimento" class="mws-form" action="frame/puntiWebcam.php<?php echo $rif;?>" method="post" enctype="multipart/form-data" onchange="this.submit()">

							<!--<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>-->

							<input type="hidden" name="stato" value="inviato">
							<input type="hidden" name="id_rife" value="<?php echo $id_rife;?>">
							<input type="hidden" name="ordine" value="<?php echo $oggetto_admin->trova_ordine($table, $id_rife);?>">



							<div class="mws-form-inline">

					<?php 

								$oggetto_admin->campo_ins("Link Webcam *<br />" , "link" , "1", 'no');

					?>

								<br/><br/>

								<div style="margin-left:20px; padding-bottom:10px;">* <i>campi obbligatori</i></div>

							</div>

							<div class="mws-button-row">

								<input type="button" value="Inserisci" class="btn btn-danger" onclick="verifica()">
								<input type="button" value="Annulla" class="btn" onclick="addImg()">

							</div>

						</form>

					</div>

					<script>

						function addImg(){

							if(document.getElementById('addImg').style.display=='none'){

								$('#addImg').fadeIn();

							}else $('#addImg').fadeOut();

						}

					</script>

					

					<div class="mws-panel-header" style="margin-top:40px;">

						<span style="color:#DB912D;"><i class="icon-table"></i> Elenco Webcam</span>

					</div>

					<div class="mws-panel-body no-padding">

						<table class="mws-datatable-fn mws-table">

							<thead>

								<tr>

									<th style="width:20px !important"><?php /*<input type="checkbox" id="check_tutti" onclick="aggiugni_tutti()"/>*/?></th>

									<th style="width:20px !important"></th>

									<th style="width:200px !important">Webcam</th>
									<th >Link</th>

									<th>Azioni</th>

								</tr>

							</thead>

							<tbody>

							<?php 

								$query_ele = "SELECT * FROM $table WHERE id_rife='$id_rife' ORDER BY ORDINE DESC";

								$risu_ele = $open_connection->connection->query($query_ele);

								

								$num_ele = 0;

								if($risu_ele)

									$num_ele = $risu_ele->rowCount();	

								

								if($num_ele>0)

								{						  

									$rec_pag=100;					

									$pag_tot=ceil($num_ele/$rec_pag);					

									$start=($pag_att-1)*$rec_pag;

									$query_ele = "SELECT * FROM $table WHERE id_rife='$id_rife' ORDER BY ORDINE DESC LIMIT $start,$rec_pag";

									$risu_ele = $open_connection->connection->query($query_ele);

									$num_item=$risu_ele->rowCount();

									

									for($x=0;$x<$num_item;$x++)			

									{						

										$arr_ele = $risu_ele->fetch();

										$link = $arr_ele['link'];

										$id_campo = $arr_ele['id'];

										?>

										<script type="text/javascript">

											lista_ind[<?php echo $x;?>]="<?php echo $id_campo;?>";

										</script>

										<tr>

											<td align="center" valign="center">

												<input type="checkbox" id="check_<?php echo $x+1;?>" onclick="aggiungi_lista('<?php echo $x+1;?>','<?php echo $id_campo;?>')"/>

											</td>

											<td align="center" valign="center"><?php  echo $start+$x+1; ?></td>

											<td style="position:relative">

												<img src="<?php  echo $link; ?>&time=<?php echo time();?>" style="width:200px"/>

											</td>

											<td style="position:relative">

												<?php  echo $link; ?>

											</td>

											<td style="width:10%">

												<span class="btn-group">

													<a href="frame/puntiWebcam.php<?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&azione=primo&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up-2"></i></a>

													<a href="frame/puntiWebcam.php<?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&azione=sali&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-up"></i></a>

													<a href="frame/puntiWebcam.php<?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&azione=scendi&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down"></i></a>

													<a href="frame/puntiWebcam.php<?php echo $rif;?>&id_canc=<?php  echo $id_campo; ?>&azione=ultimo&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-arrow-down-2"></i></a>							

													<a onclick="return confirm('Cancellare questo elemento?')" href="frame/puntiWebcam.php<?php echo $rif;?>&azione=cancella&id_canc=<?php  echo $id_campo; ?>&pag_att=<?php echo $pag_att;?>" class="btn btn-small"><i class="icon-trash"></i></a>

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

				

			</div>

		<?php 

		}

	}

	?>

	</div>

		

	<!-- JavaScript Plugins -->

   <script src="https://code.jquery.com/jquery-1.8.3.min.js" integrity="sha256-YcbK69I5IXQftf/mYD8WY0/KmEDCv1asggHpJk1trM8=" crossorigin="anonymous"></script>

    

    <!-- jQuery-UI Dependent Scripts -->

	<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.min.js" integrity="sha256-eEa1kEtgK9ZL6h60VXwDsJ2rxYCwfxi40VZ9E0XwoEA=" crossorigin="anonymous"></script>

  

	 <!-- jQuery-UI Dependent Scripts -->

    <script src="jui/js/jquery-ui-1.9.2.min.js"></script>

    <script src="jui/jquery-ui.custom.min.js"></script>

    <script src="jui/js/jquery.ui.touch-punch.js"></script>

	<script src="jui/js/jquery-ui-effects.min.js"></script>

	

</body>

</html>

