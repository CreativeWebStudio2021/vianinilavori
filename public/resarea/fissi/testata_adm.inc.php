<!-- Logo Container -->
<div id="mws-logo-container" style="background-color:#fff">

	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
	<div id="mws-logo-wrap" style="background-color:#fff">
		<a href="<?php echo $http;?>://<?php echo $ind_sito;?>"><img src="img/logo_vianini-trasp.png" style="width:130px" alt="<?php echo $nome_del_sito?>"></a>
	</div>
</div>

<!-- User Tools (notifications, logout, profile, change password) -->
<div id="mws-user-tools" class="clearfix">
	<?php 
		if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]=="si") {
	?>
	<!-- User Information and functions section -->
	<div id="mws-user-info" class="mws-inset">
	
		<!-- User Photo -->
		<div id="mws-user-photo">
			<img src="css/icons/icol32/user_gray.png" alt="User Photo">
		</div>
		
		<!-- Username and Functions -->
		<div id="mws-user-functions">
			<div id="mws-username">
				Ciao, <?php  echo $_SESSION["nome_login"]; ?>
			</div>
			<ul>
				<li><a href="admin.php?cmd=destroy">Logout</a></li>
			</ul>
		</div>
	</div>
	<?php 
		}
	?>
</div>
