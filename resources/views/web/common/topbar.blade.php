<!-- Topbar -->
<div id="topbar" class="topbar-fullwidth" style="background:#F3F3F3; border-bottom:solid 1px #D0D0D0">
	<div class="container">
		<div class="row">
			<div class="col-md-6" style="width:50%; padding:0;">
				<ul class="top-menu soloDesk">
					<li><a href="tel:+39076624720" title="{{ config('app.name') }} - Chiamaci" style="margin:0;"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
					<li><a href="tel:+39076624720" title="{{ config('app.name') }} - Chiamaci"><b>+39 0766 24720</b></a></li>
					<li>|&nbsp;&nbsp;&nbsp;&nbsp;</li>
					<li><a href="mailto:info@paben.com" title="{{ config('app.name') }} - Contattaci" style="margin:0;"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
					<li><a href="mailto:info@paben.com" title="{{ config('app.name') }} - Contattaci"><b>info@paben.com</b></a></li>
				</ul>
				<ul class="top-menu soloMob">
					<li><a href="tel:+39076624720" title="{{ config('app.name') }} - Chiamaci" style="margin:0;"><i class="fa fa-phone" aria-hidden="true"></i></a></li>					
					<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
					<li><a href="mailto:info@paben.com" title="{{ config('app.name') }} - Contattaci" style="margin:0;"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>					
				</ul>
			</div>
			<div class="col-md-6  d-sm-block" style="width:50%;	padding:0;">
				<div class="social-icons social-icons-colored-hover">
					<ul class="soloDesk">
						@if(isset($_SESSION['set_loggato_paben']) && $_SESSION['set_loggato_paben']=='1')
							<li><a href="logout.html" title="{{ config('app.name') }} - Logout" style="width:120px; color:#333333 !important">Logout</a></li>
						@else
							<li><a href="{{ Lang::get('website.Login/Registrati link') }}" title="{{ config('app.name') }} - {{ Lang::get('website.Login/Registrati menu') }}" style="color:#333333 !important"><i class="fa fa-user" aria-hidden="true"></i></a></li>
							<li><a href="{{ Lang::get('website.Login/Registrati link') }}" title="{{ config('app.name') }} - {{ Lang::get('website.Login/Registrati menu') }}" style="width:120px; color:#333333 !important">{{ Lang::get('website.Login/Registrati menu') }}</a></li>
						@endif
						<li><a style="color:#333333 !important">|</a></li>
						<li><a href="{{ Lang::get('website.Carrello link') }}" title="{{ config('app.name') }} - {{ Lang::get('website.Carrello menu') }}" style="color:#333333 !important"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
						<li><a href="{{ Lang::get('website.Carrello link') }}" title="{{ config('app.name') }} - {{ Lang::get('website.Carrello menu') }}" style="width:85px; text-align:left; color:#333333 !important">{{ Lang::get('website.Carrello menu') }} (0)</a></li>
					</ul>
					<ul class="soloMob">
						<li><a href="{{ Lang::get('website.Login/Registrati link') }}" title="{{ config('app.name') }} - {{ Lang::get('website.Login/Registrati menu') }}"><i class="fa fa-user" aria-hidden="true"></i></a></li>
						<li><a href="{{ Lang::get('website.Login/Registrati link') }}" title="{{ config('app.name') }} - {{ Lang::get('website.Login/Registrati menu') }}" style="width:120px;">{{ Lang::get('website.Login/Registrati menu') }}</a></li>						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: Topbar -->