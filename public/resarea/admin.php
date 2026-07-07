<?php 
set_time_limit (0);
session_start();

header('X-XSS-Protection: 0');

//require_once 'config/db.php';
require_once 'config/dbnew.php';
require_once 'config/array.php';	
require_once 'fissi/functions_adm.php';
require_once 'fissi/all_posts.php';
require_once 'fissi/functions.php';

if($cmd=="destroy"){
	unset($_SESSION["loggato"]);
	unset($_SESSION["acl_login"]);
	unset($_SESSION["nome_login"]);
}

if(!isset($_SESSION["loggato"]) ){
	$_SESSION["loggato"] = "no";
	/*$_SESSION["loggato"] = "si";*/
}

if(!isset($_SESSION["nome_login"]) ){
	$_SESSION["nome_login"] = "";
}

if(isset($_POST['memorizza'])) {
	$memorizza=$_POST['memorizza'];
} else $memorizza=false;

if(isset($_COOKIE['mio_user_yccs'])) $prev_user = $_COOKIE['mio_user_yccs']; else $prev_user = "";
if(isset($_COOKIE['mio_pass_yccs'])) $prev_pass = $_COOKIE['mio_pass_yccs']; else $prev_pass = "";

$user_login = $pass_login = $log = "";

$val_user = "";
if(isset($_COOKIE['mio_user_yccs'])) $val_user = $_COOKIE['mio_user_yccs'];
$val_pass = "";
if(isset($_COOKIE['mio_pass_yccs'])) $val_pass = $_COOKIE['mio_pass_yccs'];

if( isset($_POST["user_login"]) && isset($_POST["pass_login"]) )
{
	$user_login = $_POST["user_login"];
	$pass_login = $_POST["pass_login"];
	$user_login=str_replace("'","\'",$user_login);
	//$pass_login=str_replace("'","\'",$pass_login);
	
	/*if ($memorizza && $user_login && $pass_login) {
	// memorizza comunque 
		$expires = time()+60*60*24*60; // exp in due mesi 
		setcookie  ( "mio_user_yccs", $user_login,  "$expires" );
		setcookie  ( "mio_pass_yccs", $pass_login,  "$expires" );
	}*/
	
	$query_login = "select  *  from users where user_adm=:user_login";
	$risu_login = $open_connection->connection->prepare($query_login);
	$risu_login->execute(array(':user_login'=>$user_login));
	
	$log = "no";
	if($risu_login)
	{
		$num_login = $risu_login->rowCount();
		if($num_login>0)
		{
			$arr_login = $risu_login->fetch();
			$acl_log = $arr_login['livello'];
			if($arr_login['pass_adm']===crypt($pass_login,$pass_login)){
				$nome_log = ucwords($arr_login['identificativo']);
				
				$_SESSION["acl_login"] = $acl_log ;
				$_SESSION["loggato"] = "si";
				$_SESSION["nome_login"] = $nome_log;
				
				$log = "si";
			}
		}
	}
} 

	$test = 0;
	$host = $_SERVER['HTTP_HOST'];
	if($host=="test.vianinilavori.it") $test = 1;
$oggetto_admin = new Functions_adm($array_sito);
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<title><?php if($test==1) echo "TEST | ";?><?php  echo strtoupper($nome_del_sito);?> - admin</title>
<base href="<?php echo $http;?>://<?php  echo $ind_sito ?>/resarea/" /> 
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<script src="https://kit.fontawesome.com/3103351369.js" crossorigin="anonymous"></script>

<!-- Plugin Stylesheets first to ease overrides -->
<?php if ($cmd=="gallery_ins" || $cmd=="foto_ins" || $cmd=="fotogallery_pagine_ins" || $cmd=="fotos_ins") { ?>
	<link rel="stylesheet" type="text/css" href="plugins/prettyphoto/css/prettyPhoto.css" media="screen">
	<link rel="stylesheet" href="plugins/plupload/jquery.plupload.queue.css" media="screen">
	<link rel="stylesheet" href="plugins/elfinder/css/elfinder.css"media="screen" >
<?php }?>
<link rel="stylesheet" type="text/css" href="custom-plugins/wizard/wizard.css" media="screen">

<link rel="stylesheet" type="text/css" href="plugins/cleditor/jquery.cleditor.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/login.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/custom-properties.css" media="screen">

<script src="ckeditor/ckeditor.js"></script>

<script src="js/libs/jquery-1.8.3.min.js"></script>
 
</head>

<body>
	<!-- Header -->
	<div id="mws-header" class="clearfix" style="background-color:#fff">
	<?php 
		include("fissi/testata_adm.inc.php");
	?>
	</div>
	<!-- Start Main Wrapper -->
    <div id="mws-wrapper">	
	<?php 
	include("fissi/menu_adm.inc.php");
	
	if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si")
	{
	?>
		<style>
			#mws-container {
				height:calc(100vh - 95px);
			  overflow-y: scroll;          /* mantiene lo scrolling */
			  scrollbar-width: none;       /* Firefox */
			  -ms-overflow-style: none;    /* Internet Explorer e vecchi Edge */
			}

			#mws-container::-webkit-scrollbar {   /* Chrome, Safari, Edge Chromium */
			  display: none;
			}
		</style>
		<!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
			<!-- Inner Container Start -->
            <div class="container">
				<?php 
				if(isset($_SESSION["acl_login"]) && ($_SESSION["acl_login"]=="300" || ($_SESSION["acl_login"]=="200" && $cmd!="utenti" && $cmd!="utenti_ins" && $cmd!="utenti_mod") || ($_SESSION["acl_login"]=="100" && ($cmd=="lavora_con_noi" || $cmd=="contatti")))){					
					if(is_file("include/".$cmd.".inc.php")){
						include("include/".$cmd.".inc.php");
					}else{
						include("include/home.inc.php");
					}
				}else{
					include("include/home.inc.php");
				}
				?>				
				<div style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:10000; display:none;" id="mask">
					<div style="position:relative; width:80%; height:80%; margin-left:10%; margin-top:5%; background:#fff;" id="frameContainer">
						<iframe src="" style="width:100%; height: 100%; border:none;" id="framePage"></iframe>
						<div style="position:absolute; top:10px; right:35px; cursor:pointer;" onclick="$('#mask').fadeOut(); <?php /*location.reload();*/?>">
							<i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
						</div>
					</div>
				</div>		
			</div>
		</div>
		<?php  
		if($test==1) {
			include("../../resources/views/web/common/test.blade.php");
		} ?>
	
	<?php 
	}
	else
	{
		include("login.inc.php");
	}
	?>
	</div>
	
	<!-- JavaScript Plugins -->
    
    <script src="js/libs/jquery.mousewheel.min.js"></script>
    <script src="js/libs/jquery.placeholder.min.js"></script>
    <script src="custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="jui/jquery-ui.custom.min.js"></script>
    <script src="jui/js/jquery.ui.touch-punch.js"></script>
	<script src="jui/js/jquery-ui-effects.min.js"></script>
	
    <!-- Plugin Scripts -->	
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	
    <script src="plugins/colorpicker/colorpicker-min.js"></script>
	<script src="plugins/validate/jquery.validate-min.js"></script>
	
    <!-- Core Script -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="js/core/themer.js"></script>
	
	<script src="js/demo/demo.widget.js"></script>
	
	<?php if($cmd=="posizioni_ins" || $cmd=="posizioni_mod" || $cmd=="news_ins" || $cmd=="news_mod" || $cmd=="comunicati_ins" || $cmd=="comunicati_mod"){?>
		<script type="text/javascript">
			$.datepicker.setDefaults( $.datepicker.regional[ "it" ] );
			$( ".mws-datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		</script>
	<?php }?>
	
	<?php  if ($cmd!="" && is_file("js/table/$cmd.table.php")) include("js/table/$cmd.table.php"); ?>
	
    <!-- Login Script -->
    <script src="js/core/login.js"></script>
	
	<!-- Demo Scripts (remove if not needed) 
    <script src="js/demo/demo.formelements.js"></script>-->
	<script src="plugins/cleditor/jquery.cleditor.min.js"></script>
	<script src="plugins/cleditor/jquery.cleditor.table.min.js"></script>
    <script src="plugins/cleditor/jquery.cleditor.xhtml.min.js"></script>
    <script src="plugins/cleditor/jquery.cleditor.icon.min.js"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {	
				// CLEditor
				$.fn.cleditor && $('.cleditor').cleditor({ width: '100%' });
			});
		}) (jQuery);	
	</script>
	<?php  
	if($log == "no")
	{
	?>
	<script language="javascript">
		(function($) {
			$(document).ready(function() {	
				window.alert('Non ci sono utenti attivi che possano accedere con queste username e password');
				document.login.user_login.value = '';
				document.login.pass_login.value = '';
				});
		}) (jQuery);
	</script>
	<?php 	
	}
	
	/*if($cmd=="prodotti" || $cmd=="offerte" || $cmd=="clienti"){?>
		<div style="position:fixed; width:100%; height:100%; left:0px; top:0px; background:url(img/mask.png); display:none; z-index:1000" id="mask"></div>
		<div style="position:fixed; width:700px; height:500px; top:80px; left:-120%; background:#ffffff; z-index:1100" id="box_add">
			<div style="position:absolute; top:10px; right:10px; width:30px; height:30px; background:url(img/chiudi.png); cursor:pointer; z-index:1200" onclick='$("#mask").fadeOut(); $("#box_add").animate({left : "-1000px"});'></div>
			<div style="position:absolute; top:0px; left:10px; width:100%; height:100%; z-index:1100">
				<iframe src="" style="width:700px; height:500px" frameborder=0 framescroll="none" id="frame_news"></frame>
			</div>
		</div>
		<script type="text/javascript">				
			function chiudi_box_add(){
				$("#mask").fadeOut(); 
				$("#box_add").animate({left : "-120%"});
			}
		</script>
	<?php }*/?>
</body>
</html>
