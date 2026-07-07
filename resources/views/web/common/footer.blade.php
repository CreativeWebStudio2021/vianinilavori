<style>
	#footer{
		width:100%; 
		//min-height:265px; 
		background:#565656;
		z-index:100000;
	}
	#footer-container{
		width:calc(100% - 400px);
		margin-left:200px; 
		padding-top:15px; 
		color:#fff; 
		display:flex;
		gap:20px
	}
	#footer-col1{
		width:25%; 
		text-align:left;
	}
	#footer-col2{
		width:30%; 
		text-align:left; 
		font-size:16px; 
		line-height:1.4; 
		color:#fff
	}
	#footer-col3{
		width:20%; 
		text-align:left; 
		font-size:16px; 
		line-height:1.4;  
		color:#fff
	}
	#footer-col4{
		width:25%; 
		text-align:left; 
		font-size:16px; 
		color:#fff;
	}
	#footer-credits{
		width:calc(100% - 400px); 
		margin-left:200px; 
		margin-top:20px; 
		font-size:14px; 
		color:#fff;
		border-top:solid 1px #fff; 
		padding:5px 0 10px;
	}
	#footer-credits-col1{
		float:left; 
		width:30%; 
		text-align:left
	}
	#footer-credits-col2,#footer-credits-col2b,#footer-credits-col2c{
		float:left; 
		width:70%; 
		text-align:right
	}
	#footer-credits-col2b{display:none;}
	#footer-credits-col2c{display:none;}
	
	@media screen AND (max-width:1600px){
		//#footer{min-height:300px;}
		#footer-credits-col2{display:none;}
		#footer-credits-col2b{display:block;}
		#footer-container, #footer-credits{
			width:calc(100% - 200px);
			margin-left:100px; 
		}
	}
	
	@media screen AND (max-width:1468px){
		#footer-container, #footer-credits{
			width:calc(100% - 100px);
			margin-left:50px; 
		}
	}
	
	@media screen AND (max-width:1024px){
		//#footer{min-height:500px;}
		#footer-container, #footer-credits{
			width:calc(100% - 200px);
			margin-left:100px; 
		}
		#footer-container {
			flex-wrap: wrap;
		}
		#footer-col1,
		#footer-col2,
		#footer-col3,
		#footer-col4 {
			width: 48%;
		}
		#footer-credits-col1{
			width:180px;
		}
		#footer-credits-col2 {
			width: calc(100% - 180px);
		}
		#footer-credits-col2b {
			width: calc(100% - 180px);
		}
		.spazioInfo{
			display:none;
		}
	}
	@media screen AND (max-width:800px){
		#footer-container, #footer-credits{
			width:calc(100% - 180px);
			margin-left:75px; 
		}
	}
	@media screen AND (max-width:699px){
		//#footer{min-height:870px;}
		#footer-container, #footer-credits{
			width:calc(100% - 40px);
			margin-left:20px; 
		}
		#footer-col1,
		#footer-col2,
		#footer-col3,
		#footer-col4 {
			width: 100%;
			text-align:center;
		}
		
		#footer-col1 > div {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 10px;
		}
		
		#footer-col4 {
			display: flex;
			justify-content: center;
			align-items: center;
		}
		
		#footer-credits{flex-wrap: wrap;}
		
		#footer-credits-col1{
			width: 100%;
			text-align:left !important;
			text-align:center !important;
		}
		#footer-credits-col2{
			width: 100%;
			text-align:left !important;
			text-align:center !important;
		}
		#footer-credits-col2b{
			width: 100%;
			text-align:left !important;
			text-align:center !important;
		}
		#footer-credits-col2c{
			width: 100%;
			text-align:left !important;
			text-align:center !important;
		}
		
		.spazioInfo{
			display:block;
		}
	}
	@media screen AND (max-width:455px){
		//#footer{min-height:880px;}
		#footer-credits-col2b{display:none}
		#footer-credits-col2c{display:block}
	}
</style>
<div id="footer">
    <div id="footer-container">
      <div id="footer-col1">
		<a href="{{ config('app.url') }}"  alt="Vianini Lavori">
				<img src="{{ asset('web/images/vianini_bianco_trasparente.png') }}" style="width:223px;" />
			</a>
			<div style="display:flex; <?php if($cmd=="home") {?>margin-top:-25px;<?php }else{?> margin-top:10px;<?php }?>">
				<div>
					<a href="https://www.linkedin.com/company/vianini-lavori-s-p-a-/" target="_blank">
						<img src="{{ asset('web/images/linkedin_w.png') }}" style="width:18px;" alt="LinkedIn"/>
					</a>
				</div>
				<div style="margin-left:10px;">
					<a href="https://www.instagram.com/vianinilavorispa/" target="_blank">
						<img src="{{ asset('web/images/instagram_w.png') }}" style="width:18px;" alt="Instagram"/>
					</a>
				</div>
				<div style="margin-left:10px;">
					<a href="https://www.youtube.com/@vianinilavorispa" target="_blank">
						<img src="{{ asset('web/images/youtube_w.png') }}" style="width:18px;" alt="Youtube"/>
					</a>
				</div>
				<div style="margin-left:14px;">
					<a href="lavora-con-noi.html" style="font-size:16px" title="Lavora con noi - {{ config('app.name') }}">
						LAVORA CON NOI
					</a>
				</div>
			</div>
		</div>
      <div id="footer-col2">
        <b>CONTATTI</b><br/>
		SEDE LEGALE: {{ config('app.indirizzo') }} <br/>
		TELEFONO: <a href="tel:+39 <?php echo str_replace(".","",config('app.telefono')); ?>">+39 {{ config('app.telefono') }}</a><br/>
		EMAIL: <a href="mailto:{{ config('app.email_def') }}">{{ config('app.email_def') }}</a><br/>
		PEC: <a href="mailto:{{ config('app.pec') }}">{{ config('app.pec') }}</a>
		<br/><br/>

      </div>
      <div id="footer-col3">
        <B>SITE MAP</B> <BR/>
		<a href="la-nostra-storia.html" title="Chi Siamo - {{ config('app.name') }}">CHI SIAMO</a> <BR/>
		<a href="il-gruppo.html" title="Il Gruppo - {{ config('app.name') }}">IL GRUPPO</a> <BR/>
		<a href="mission-e-vision.html" title="In Cosa Crediamo - {{ config('app.name') }}">IN COSA CREDIAMO</a> <BR/>
		<a href="progetti/tutti_i_progetti.html" title="Progetti - {{ config('app.name') }}">PROGETTI</a> <BR/>
		<a href="politiche.html" title="Sostenibilità - {{ config('app.name') }}">SOSTENIBILITÀ</a> <BR/>
		<a href="news.html" title="News & Media - {{ config('app.name') }}">NEWS & MEDIA</a> <BR/>
		<a href="https://portalefornitori-vianinilavori.geo.app.jaggaer.com/esop/geo-host/public/portalefornitori-vianinilavori/web/login.jst?_ncp=1736339707752.99097-1" title="E-Procurement - {{ config('app.name') }}">E-PROCUREMENT</a> <BR/>
		<a href="contatti.html" title="Contatti - {{ config('app.name') }}">CONTATTI</a> <BR/>
		<a href="itc.html" title="ITC - {{ config('app.name') }}">ITC</a>
      </div>
      <div id="footer-col4">
        
		<div style="width:180px; margin-top:0px;">
			<?php /*<img src="web/images/ecovadis-dec-2024.png" alt="Ecovadis Gold 2024" style="width:100%"/>*/?>
			<img src="web/images/ecovadis-nov-2025.png" alt="Ecovadis Platinum 2025" style="width:100%"/>
		</div>
      </div>
    </div>
	<div id="footer-credits">
		<div id="footer-credits-col1">
			<a href="privacy-policy.html" title="COOKIE POLICY - {{ config('app.name') }}">
				<span style="white-space: nowrap; font-size:14px; color:#fff;">COOKIE POLICY</span>
			</a>
			&nbsp;&nbsp;
			<a href="privacy-policy.html" title="PRIVACY POLICY - {{ config('app.name') }}">
				<span style="white-space: nowrap; font-size:14px; color:#fff;">PRIVACY POLICY</span>
			</a>
			<br/>
			<a href="informativa-candidati.html" title="INFORMATIVA CANDIDATI - {{ config('app.name') }}">
				<span style="white-space: nowrap; font-size:14px; color:#fff;">INFORMATIVA CANDIDATI</span>
			</a>
			<span class="spazioInfo">&nbsp;&nbsp;</span>
			<a href="informativa-fornitori.html" title="INFORMATIVA FORNITORI - {{ config('app.name') }}">
				<span style="white-space: nowrap; font-size:14px; color:#fff;">INFORMATIVA FORNITORI</span>
			</a>
		</div>
		<div id="footer-credits-col2">
			<a href="https://www.creativewebstudio.it" style="color:#fff; text-decoration:none" title="Creative Web Studio - Web Agency Civiravecchia" target="_blank">
				© Creative Web Studio – 2025. All rights reserved.
			</a>
			<br/>
			REA n. 461019 – C. FISC. N. 03873930584 – P. IVA 01252951007
		</div>
		<div id="footer-credits-col2b">
			<a href="https://www.creativewebstudio.it" style="color:#fff; text-decoration:none" title="Creative Web Studio - Web Agency Civiravecchia" target="_blank">
				© Creative Web Studio – 2025. All rights reserved.
			</a>
			<br/>
			REA n. 461019 – C. FISC. N. 03873930584 – P. IVA 01252951007
		</div>
		<div id="footer-credits-col2c">
			<a href="https://www.creativewebstudio.it" style="color:#fff; text-decoration:none" title="Creative Web Studio - Web Agency Civiravecchia" target="_blank">
				© Creative Web Studio – 2025. All rights reserved.
			</a>
			<br/>
			REA n. 461019 – C. FISC. N. 03873930584<br/>P. IVA 01252951007
		</div>
		<div style="clear:both"></div>
	</div>
	@php
	$oggi = new DateTime(); // data attuale
	$inizio = new DateTime('2025-12-08');
	$fine = new DateTime('2026-01-07'); // 9 gennaio escluso
	
	//if($_SERVER['REMOTE_ADDR']=="93.45.34.21"){
		if ($inizio <= $oggi && $oggi < $fine) {
			$natale = "1";
		}
	//}  
	//ANCHE IN layout.inc.php
	@endphp
	
	@if(!empty($natale))
		<style>
			#footer {
				background: #e40613 !important;
				position: relative;
				overflow: hidden;
			}

			.footerNataleImg {
				position: absolute;
				top: 0;
				left: 50%;
				transform: translateX(-50%);
				width: 100%;
				opacity: 0;
				transition: opacity 0.8s ease;
				z-index: 1;
				pointer-events: none;
			}
		</style>

		<img id="footerNataleRami" class="footerNataleImg" style="opacity:1" src="web/images/footer_natale_rami.png" />
		
		<img id="footerNatale1" class="footerNataleImg" src="web/images/footer_natale_2.png" />
		<img id="footerNatale2" class="footerNataleImg" src="web/images/footer_natale_3.png" />

		<script>
			document.addEventListener('DOMContentLoaded', () => {
				const images = [
					"web/images/footer_natale_2.png",
					"web/images/footer_natale_3.png",
					"web/images/footer_natale_4.png"
				];

				const img1 = document.getElementById('footerNatale1');
				const img2 = document.getElementById('footerNatale2');

				let current = 0;
				let next = 1;

				img1.src = images[current];
				img1.style.opacity = 1;

				setInterval(() => {
					const fadeOut = current % 2 === 0 ? img1 : img2;
					const fadeIn = current % 2 === 0 ? img2 : img1;

					fadeIn.src = images[next];
					fadeIn.style.zIndex = 2;
					fadeOut.style.zIndex = 1;

					fadeOut.style.opacity = 0;
					fadeIn.style.opacity = 1;

					current = next;
					next = (next + 1) % images.length;
				}, 3000);
			});
		</script>
	@endif

</div>