<div id="mws-login-wrapper">
	<div id="mws-login">
		<h1>Login</h1>
		<div class="mws-login-lock"><i class="icon-lock"></i></div>
		<div id="mws-login-form">
			<form name="login" class="mws-form" action="admin.php" method="post">
				<div class="mws-form-row">
					<div class="mws-form-item">
						<input type="text" name="user_login" value="<?php echo $val_user?>" class="mws-login-username required" placeholder="username">
					</div>
				</div>
				<div class="mws-form-row">
					<div class="mws-form-item">
						<input type="password" name="pass_login" value="<?php echo $val_pass?>" class="mws-login-password required" placeholder="password">
					</div>
				</div>
				<div id="mws-login-remember" class="mws-form-row mws-inset">
					<ul class="mws-form-list inline">
						<li>
							<input name="memorizza" id="memorizza" type="checkbox"> 
							<label for="memorizza">Remember me</label>
						</li>
					</ul>
				</div>
				<div class="mws-form-row">
					<input type="submit" value="Login" class="btn btn-success mws-login-button">
				</div>
			</form>
			<script language="javascript">
				if (leggiCookie('mio_user_yccs')!="") user = leggiCookie('mio_user_yccs');
					else user = "username";
				if (leggiCookie('mio_pass_yccs')!="") pass = leggiCookie('mio_pass_yccs');
					else pass = "password";
				document.login.user_login.value = user;
				document.login.pass_login.value = pass;
			</script>
		</div>
	</div>
</div>