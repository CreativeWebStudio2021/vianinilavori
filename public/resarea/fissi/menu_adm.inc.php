<?php 
	if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si"){
?>
<!-- Necessary markup, do not remove -->
<div id="mws-sidebar-stitch"></div>
<div id="mws-sidebar-bg"></div>

<style>
	#mws-sidebar {
		height:calc(100vh - 84px); 		
	  overflow-y: scroll;          /* mantiene lo scrolling */
	  scrollbar-width: none;       /* Firefox */
	  -ms-overflow-style: none;    /* Internet Explorer e vecchi Edge */
	}

	#mws-sidebar::-webkit-scrollbar {   /* Chrome, Safari, Edge Chromium */
	  display: none;
	}
</style>

<!-- Sidebar Wrapper -->
<div id="mws-sidebar">

	<!-- Hidden Nav Collapse Button -->
	<div id="mws-nav-collapse">
		<span></span>
		<span></span>
		<span></span>
	</div>
	
	<style>
		.iconMenu{float:left; width:40px; color:#fff}
		.textMenu{float:left; width:calc(100% - 45px); margin-top:5px; color:#fff}
		.activeMenu .iconMenu{color:red !important}
		.activeMenu .textMenu{color:red !important}
	</style>
	
	<!-- Main Navigation -->
	<div id="mws-navigation">
		<ul>
			<?php if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="200"){?>
				<?php if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){?>
					<li>
						<div style="padding:10px" <?php  if ($cmd=="utenti") { ?>class="activeMenu"<?php  } ?>>
							<div class="iconMenu"><i class="fa-solid fa-users fa-2x"></i></div>
							<div class="textMenu"><a href="admin.php?cmd=utenti" style="color:#fff">Gestione Utenti</a></div>
							<div style="clear:both"></div>
						</div>
					</li>
				<?php }?>
													
				<li style="margin-top:20px">
					<div style="padding:10px" <?php  if ($cmd=="categorie" || $cmd=="punti") { ?>class="activeMenu"<?php  } ?>>
						<div class="iconMenu"><i class="fa-solid fa-map fa-2x"></i></div>
						<div class="textMenu">Progetti</div>
						<div style="clear:both"></div>
					</div>
					<ul>
						<li><a href="admin.php?cmd=categorie">Categorie</a></li>
						<li><a href="admin.php?cmd=punti">Progetti</a></li>
					</ul>
				</li>
													
				<li style="margin-top:20px">
					<div style="padding:10px" <?php  if ($cmd=="news" || $cmd=="news_ins" || $cmd=="news_mod" || $cmd=="categorie_news" || $cmd=="categorie_news_ins" || $cmd=="categorie_news_mod") { ?>class="activeMenu"<?php  } ?>>
						<div class="iconMenu"><i class="fa-solid fa-newspaper fa-2x"></i></div>
						<div class="textMenu">News</div>
						<div style="clear:both"></div>
					</div>
					<ul>
						<li><a href="admin.php?cmd=categorie_news">Categorie</a></li>
						<li><a href="admin.php?cmd=news">Articoli</a></li>
						<li><a href="admin.php?cmd=news_menu">Slide foto menù</a></li>
					</ul>
				</li>
													
				<li style="margin-top:20px">
					<div style="padding:10px" <?php  if ($cmd=="media" || $cmd=="media_ins" || $cmd=="media_mod" || $cmd=="categorie_media" || $cmd=="categorie_media_ins" || $cmd=="categorie_media_mod") { ?>class="activeMenu"<?php  } ?>>
						<a href="admin.php?cmd=categorie_media">	
							<div class="iconMenu"><i class="fa-solid fa-camera fa-2x"></i></div>
							<div class="textMenu">Foto/Video Gallery</div>
							<div style="clear:both"></div>
						</a>
					</div>
				</li>
				
				<li style="margin-top:20px">
					<div style="padding:10px" <?php  if ($cmd=="comunicati") { ?>class="activeMenu"<?php  } ?>>
						<a href="admin.php?cmd=comunicati">
							<div class="iconMenu"><i class="fa-solid fa-newspaper fa-2x"></i></div>
							<div class="textMenu">Rassegna Stampa</div>
							<div style="clear:both"></div>
						</a>
					</div>
				</li>
				
				
					<li style="margin-top:20px">
						<div style="padding:10px" <?php  if ($cmd=="certificazioni") { ?>class="activeMenu"<?php  } ?>>
							<a href="admin.php?cmd=certificazioni">
								<div class="iconMenu"><i class="fa-solid fa-certificate fa-2x"></i></div>
								<div class="textMenu">Certificazioni</div>
								<div style="clear:both"></div>
							</a>
						</div>
					</li>
				<?php if(isset($_SESSION["acl_login"]) && $_SESSION["acl_login"]>="300"){?>										
					<li style="margin-top:20px">
						<div style="padding:10px" <?php  if ($cmd=="cariche") { ?>class="activeMenu"<?php  } ?>>
							<div class="iconMenu"><i class="fas fa-user-tie fa-2x"></i></div>
							<div class="textMenu">Cariche</div>
							<div style="clear:both"></div>
						</div>
						<ul>
							<li><a href="admin.php?cmd=categorie_cariche">CATEGORIE</a></li>
							<li><a href="admin.php?cmd=cariche&ric_cat=3">Consiglio di Amministrazione</a></li>
							<li><a href="admin.php?cmd=cariche&ric_cat=2">Collehio Sindacale</a></li>
							<li><a href="admin.php?cmd=cariche&ric_cat=1">Organismo di Vigilanza</a></li>
						</ul>
					</li>
														
					<li style="margin-top:20px">
						<div style="padding:10px" <?php  if ($cmd=="bilanci") { ?>class="activeMenu"<?php  } ?>>
							<a href="admin.php?cmd=bilanci">
								<div class="iconMenu"><i class="fa-solid fa-file-pdf fa-2x"></i></div>
								<div class="textMenu">Bilanci</div>
								<div style="clear:both"></div>
							</a>
						</div>
					</li>
														
					<li style="margin-top:5px">
						<div style="padding:10px" <?php  if ($cmd=="bilanci_sostenibilita") { ?>class="activeMenu"<?php  } ?>>
							<a href="admin.php?cmd=bilanci_sostenibilita">
								<div class="iconMenu"><i class="fa-solid fa-file-pdf fa-2x"></i></div>
								<div class="textMenu">Bilanci di sostenibilità</div>
								<div style="clear:both"></div>
							</a>
						</div>
					</li>	
														
					<li style="margin-top:5px">
						<div style="padding:10px" <?php  if ($cmd=="politiche") { ?>class="activeMenu"<?php  } ?>>
							<a href="admin.php?cmd=politiche">
								<div class="iconMenu"><i class="fa-solid fa-file-pdf fa-2x"></i></div>
								<div class="textMenu">Politiche</div>
								<div style="clear:both"></div>
							</a>
						</div>
					</li>	
				<?php }?>									
				<li style="margin-top:20px">
					<div style="padding:10px" <?php  if ($cmd=="testi") { ?>class="activeMenu"<?php  } ?>>
						<div class="iconMenu"><i class="fa-solid fa-file-lines fa-2x"></i></div>
						<div class="textMenu">Testi introduttivi</div>
						<div style="clear:both"></div>
					</div>
					<ul>
						<?php 
						$query_testi = "SELECT * FROM testi_introduttivi ORDER BY ordine DESC";
						$risu_testi = $open_connection->connection->query($query_testi);
						while($arr_testi=$risu_testi->fetch()){?>
							<li><a href="admin.php?cmd=testi&id_rec=<?php echo $arr_testi['id'];?>" <?php if(isset($id_rec) && $id_rec==$arr_testi['id'] && $cmd=="testi") {?> style="font-weight:bold"<?php }?>><?php echo $arr_testi['pagina'];?></a></li> 
						<?php }?>
					</ul>
				</li>									
				<li style="margin-top:20px">
					<div style="padding:10px" <?php  if ($cmd=="itc") { ?>class="activeMenu"<?php  } ?>>
						<a href="admin.php?cmd=itc">
							<div class="iconMenu"><i class="fa-solid fa-link fa-2x"></i></div>
							<div class="textMenu">ITC</div>
							<div style="clear:both"></div>
						</a>
					</div>
				</li>	
			<?php } ?>
			<li style="margin-top:20px">
				<div style="padding:10px" <?php  if ($cmd=="lavora_con_noi") { ?>class="activeMenu"<?php  } ?>>
					<a href="admin.php?cmd=lavora_con_noi">
						<div class="iconMenu"><i class="fa-solid fa-helmet-safety fa-2x"></i></div>
						<div class="textMenu">Lavora con Noi</div>
						<div style="clear:both"></div>
					</a>
				</div>
			</li>							
			<li style="margin-top:20px">
				<div style="padding:10px" <?php  if ($cmd=="contatti") { ?>class="activeMenu"<?php  } ?>>
					<a href="admin.php?cmd=contatti">
						<div class="iconMenu"><i class="fa-solid fa-address-book fa-2x"></i></div>
						<div class="textMenu">Contatti</div>
						<div style="clear:both"></div>
					</a>
				</div>
			</li>
															
			<li style="margin-top:50px"><a href="../home.html"><i class="icon-bended-arrow-left"></i> <i>Torna al sito</i></a></li>
		</ul>
	</div>         
</div>
<?php 
}
?>

