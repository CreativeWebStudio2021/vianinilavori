@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "ETICA, COMPLIANCE<br/>E WHISTLEBLOWING";
		$img_background="web/images/header_governance.jpg";
		$x=0;
	@endphp
	@include('web.common.page_title')
	
	<style>
	.iso-filter-wrapper {
	  display: flex;
	  justify-content: center;
	  align-items: center;
	  gap: 40px; /* 🔧 distanza regolabile tra voci */
	  margin: 20px 0;
	}

	.iso-filter-item a {
	  position: relative;
	  font-size: 20px;
	  font-family: Arial, sans-serif;
	  color: black;
	  font-weight: bold;
	  text-decoration: none;
	  transition: color 0.5s ease;
	}

	/* Effetto underline al passaggio */
	.iso-filter-item a::after {
	  content: '';
	  position: absolute;
	  bottom: -2px;
	  left: 0;
	  width: 0;
	  height: 1px;
	  background-color: #E73338;
	  transition: width 0.3s ease;
	}

	/* Hover */
	.iso-filter-item a:hover::after {
	  width: 100%;
	}

	/* Attivo: riga rossa visibile */
	.iso-filter-item a.active::after {
	  width: 100% !important;
	}

	
	
	.iso-list {
	  width: 100%;
	  margin-bottom:80px;
	}

	.iso-item {
	  position: relative;
	  padding: 5px 10px;
	  margin: 10px 0; /* spazio sopra e sotto */
	  background-color: white;
	  overflow: hidden;
	  display: flex;
	  align-items: center;
	  cursor:pointer;
	}

	/* Sfondo in entrata animata */
	.iso-item .bg-hover {
	  transition: all 0.5s ease;
	}

	.iso-item .bg-hover {
	  content: '';
	  position: absolute;
	  top: 5px;
	  bottom: 5px;
	  left: 0;
	  width: 0;
	  background: #D9D9D9;
	  z-index: 0;
	  transition: width 0.6s ease;
	}

	.iso-item:hover .bg-hover {
	  width: 100%;
	}

	.iso-item.selected .bg-hover {
	  width: 100%;
	}
	
	.iso-item.selected .icon-hover {
	  opacity: 1;
	}

	.iso-item.selected .icon-default {
	  opacity: 0;
	}


	/* Z-indices per layer sopra sfondo */
	.iso-left, .iso-content, .iso-right {
	  position: relative;
	  z-index: 2;
	}


	.iso-left img {
	  width: 62px;
	  height: 62px;
	  object-fit: contain;
	}

	.iso-content {
	  flex: 1;
	  padding: 0 30px;
	}

	.iso-title {
	  font-family: 'Arial';
	  font-weight: bold;
	  font-size: 30px;
	  color: black;
	}

	.iso-subtitle {
	  font-family: 'Nunito', sans-serif;
	  font-size: 25px;
	  color: #565656;
	  margin-top: 5px;
	}

	.iso-right {
	  width: 55px;
	  height: 55px;
	  position: relative;
	}

	.iso-right img {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 55px;
	  height: 55px;
	  object-fit: contain;
	  transition: opacity 0.3s ease;
	}

	.iso-right .icon-hover {
	  opacity: 0;
	}
	
	.iso-right .icon-close {
		width: 45px;
		height: 45px;
		position: absolute;
		top: 0;
		left: 0;
		object-fit: contain;
		transition: opacity 0.3s ease;
	}


	.iso-item:hover .icon-hover {
	  opacity: 1;
	}

	.iso-item:hover .icon-default {
	  opacity: 0;
	}

	/* Transizione fade per filtraggio */
	.iso-item {
	  opacity: 1;
	  transform: translateY(0);
	  transition: all 0.4s ease;
	}

	.iso-item.hide {
	  opacity: 0;
	  transform: translateY(20px);
	  pointer-events: none;
	  height: 0;
	  padding: 0;
	  margin: 0;
	  border: none;
	  overflow: hidden;
	}
	.iso-wrapper {
	  padding-bottom: 0px;
	  border-bottom: 2px solid #000;
	  background: #fff;
	}
	.iso-wrapper.hide {
		display: none !important;
	}

	@keyframes fadeUp {
	  0% {
		opacity: 0;
		transform: translateY(40px);
	  }
	  100% {
		opacity: 1;
		transform: translateY(0);
	  }
	}

	.iso-wrapper.animate-in {
	  animation-name: fadeUp;
	  animation-duration: 0.6s;
	  animation-timing-function: ease-out;
	  animation-fill-mode: both;
	}
	
	.iso-title {
	  font-family: 'Arial';
	  font-size: 30px;
	}

	.iso-subtitle {
	  font-size: 25px;	  
	}
	
	@media screen AND (max-width:800px){
		.iso-title {
		  font-size: 25px;
		}

		.iso-subtitle {
		  font-size: 20px;
		}
	}
	
	@media screen AND (max-width:600px){
		.iso-left{display:none;}
		.iso-content{padding:0px 10px 0 0;}
	}
	
	@media screen AND (max-width:600px){
		.iso-right img {
			width: 45px;
			height: 45px;
		}
		.iso-item{padding:0};
	}
	//.mainTextContainer p strong{color:{{config('app.color1')}}}
	
	.dynamic-text {
	  font-size: 24px;
	  line-height: 1.4;
	  transition: text-align 0.3s ease;
	  opacity:0;
	}

	.center {
		text-align: center;
	  }

	  .justify {
		text-align: justify;
	  }
	  
	.mainTextContainer {
		width:calc(100% - 600px) !important; 
		margin:0 auto;
	}
	@media screen AND (max-width:1600px){
		.mainTextContainer {	width:calc(100% - 400px) !important; }
	}
	@media screen AND (max-width:1468px){
		.mainTextContainer {	width:calc(100% - 200px) !important; }
	}
	@media screen AND (max-width:500px){
		.mainTextContainer {	width:calc(100% - 120px) !important; }
	}
	
	.linkList{display:flex; gap:80px; margin-bottom:80px;}
	@media screen AND (max-width:800px){
		#linkList {	flex-direction:column; gap:20px; margin-bottom:80px; }
	}
	
	.linkList ul li {
	  display: flex;
	  align-items: flex-start;
	  gap: 10px;
	  margin-bottom: 20px;
	}

	.link-block {
	  display: flex;
	  align-items: center;
	  justify-content: space-between;
	  flex-grow: 1;
	  width: 100%; /* 👈 fa occupare tutta la colonna */
	  padding: 5px 10px 5px 5px;
	  position: relative;
	  text-decoration: none;
	  color: #000;
	  border-bottom: 1px solid #D9D9D9;
	  transition: background 0.3s;
	  background: transparent;
	  box-sizing: border-box;
	}

	.link-block:hover {
	  //background: #d9d9d9;
	}

	.linkList li img.icon-li {
	  width: 30px;
	  height: 30px;
	  object-fit: contain;
	  flex-shrink: 0;
	  margin-top: 5px;
	  margin-left:-12px;
	}

	.link-texts {
	  display: flex;
	  flex-direction: column;
	  font-size: 28px;
	}

	.link-texts span {
	  font-weight: bold;
	}

	.link-texts .subtitle {
	  font-weight: normal;
	  font-size: 20px;
	  color: #555;
	}
	
	.link-block span {		 
		  font-weight: bold;
		  transition: background 0.3s;
		}
		
	.link-block .freccia {
	  width: 12px;
	  height: 12px;
	  position: relative;
	}

	.link-block .freccia::after {
	  content: '';
	  position: absolute;
	  right: 0;
	  top: 20%;
	  transform: translate(12px, -50%) rotate(-45deg);
	  width: 12px;
	  height: 12px;
	  border-right: 2px solid #E73338;
	  border-bottom: 2px solid #E73338;
	  transition: transform 0.4s ease;
	}

		.link-block:hover span {		  
		  background:#d9d9d9;
		}

		.link-block.active span {		  
		  background:#d9d9d9;
		}

	.link-block:hover .freccia::after {
	  transform: translate(18px, -50%) rotate(-45deg);
	}


		
		.mainTextContainer li {
		  margin-bottom:30px;
		  opacity:0;
		}
		
		.mainTextContainer li::before {
		  display:none;
		}

		.mainTextContainer li img.icon-li {
		  position: absolute;
		  left: 0;
		  top: -3px;
		  width: 30px;
		  height: 30px;
		  object-fit: contain;
		}
		
		#pageContainer {
			background: url(web/images/v_grigia_s.png) no-repeat top center;
			//background-size: cover;
			background-attachment: scroll; /* default */
			position: relative;
			z-index: 1;
			overflow: hidden;
		}
		
		#pageContainer::before {
		  content: '';
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  background: url(web/images/v_grigia_s.png) no-repeat top center;
		  //background-size: cover;
		  transform-origin: top center; 
		  z-index: 0;
		  pointer-events: none;
		  opacity: 0;
		  animation: bgPulse 4s ease-in-out infinite;
		}


		@keyframes bgPulse {
		  0% {
			transform: scaleY(1.0) scaleX(1.0);
			opacity: 0.7;
		  }
		  100% {
			transform: scaleY(2) scaleX(1.75);
			opacity: 0;
		  }
		}
		
		@media screen AND (max-width:1024px){
			.linkList{flex-direction:column; gap:0px;}
		}
		
		@keyframes fadeSlideRight {
			from { opacity: 0; transform: translateX(-30px); }
			to { opacity: 1; transform: translateX(0); }
		}

		@keyframes fadeSlideUp {
			from { opacity: 0; transform: translateY(30px); }
			to { opacity: 1; transform: translateY(0); }
		}

		.fade-slide-right {
			animation: fadeSlideRight 0.8s ease forwards;
		}

		.fade-slide-up {
			animation: fadeSlideUp 0.8s ease forwards;
		}
		

		/* animazione */
		@keyframes fadeInUp {
		  from {
			opacity: 0;
			transform: translateY(20px);
		  }
		  to {
			opacity: 1;
			transform: translateY(0);
		  }
		}
		
		#subMenuContainer {
			padding:0; 
			display:flex;
			justify-content: wrap;
			gap: 20px;
		}
		
		#subMenuContainer a.link-block {
		  display: flex;
		  flex: 0 0 25%;
		  box-sizing: border-box;
		  align-items: center;
		  justify-content: space-between;
		  padding: 5px 10px 5px 5px;
		  border-bottom: 1px solid #D9D9D9;
		  color: #000;
		  text-decoration: none;
		  transition: background 0.3s;
		}
		
		#subMenuContainer .link-block{
			opacity:0;
		}

		@media screen AND (max-width:1024px){			
			#subMenuContainer {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			#subMenuContainer a.link-block {
			  flex: 0 0 48%;
			}
		}

		@media screen AND (max-width:700px){			
			#subMenuContainer a.link-block {
			  flex: 0 0 100%;
			}
		}
		
		.listaPagine{padding:0 20px;}
		@media screen AND (max-width:700px){	
			.listaPagine{padding:0 10px;}
		}
		@media screen AND (max-width:400px){	
			.listaPagine{padding:0 0px;}
		}
		
		@media screen AND (max-width:850px){	
			.page-header-title{font-size:35px !important;}
		}
	</style>	
	
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">	
	
		<section style="width:100%; margin-bottom:40px;">
			<div class="mainTextContainer mainTextContainer2" style="margin-bottom:30px;">		
				<div id="subMenuContainer">			  
				  <a href="consiglio-di-amministrazione.html" title="Consiglio di Amministrazione" class="link-block">
						<span >Consiglio di Amministrazione&nbsp;</span>
						<div class="freccia"></div>
				  </a>			  
				  <a href="collegio-sindacale.html" title="Collegio Sindacale" class="link-block">
						<span >Collegio Sindacale&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a href="organismo-di-vigilanza.html" title="Organismo di Vigilanza" class="link-block">
						<span >Organismo di Vigilanza&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a href="etica-compliance-whistleblowing.html" title="Etica, Compliance e Whistleblowing" class="link-block active">
						<span >Etica, Compliance e Whistleblowing&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				</div>
			</div>
		</section>
		<section style="width:100%; margin-top:80px; margin-bottom:140px;">
			<div class="mainTextContainer mainTextContainer2 " style="position:relative; z-index:1;">
				<div class="dynamic-text center"  id="textBlock" style="margin-top:60px; margin-bottom:60px;">
					@php
						$query_intro = DB::table('testi_introduttivi')->where('pagina', 'Etica, Compliance e Whistleblowing')->get();
					@endphp
					@if(isset($query_intro[0]->testo) && !empty($query_intro[0]->testo))
						{!! $query_intro[0]->testo !!}
					@endif
				</div>
				<!-- Lista -->
				<div class="iso-list">
					
					<div class="linkList">
						<div style="flex:1;">
							<ul class="listaPagine">
								<li style="display: flex; align-items: center;  margin-bottom: 24.2px; padding:0 !important">
								  <a href="modello-231.html" title="Modello organizzativo ex D.lgs. 231/2001 - Etica, Compliance e Whistelblowing - {{ config('app.name') }}" class="link-block">
									<div class="link-texts">
									  <span>Modello organizzativo ex D.lgs. 231/2001</span>
									  <div class="subtitle"></div>
									</div>
									<div class="freccia"></div>
								  </a>
								</li>
								<li style="display: flex; align-items: center;  margin-bottom: 24.2px; padding:0 !important">
								  <a href="codice-etico-e-di-condotta.html" title="Codice Etico e di Condotta - Etica, Compliance e Whistelblowing - {{ config('app.name') }}"  class="link-block">
									<div class="link-texts">
									  <span>Codice Etico e di Condotta</span>
									  <div class="subtitle"></div>
									</div>
									<div class="freccia"></div>
								  </a>
								</li>
							</ul>
						</div>
						<div style="flex:1;">
							<ul class="listaPagine">
								<li style="display: flex; align-items: center;  margin-bottom: 24.2px; padding:0 !important">
								  <a href="rating-di-legalita.html" title="Rating di Legalità - Etica, Compliance e Whistelblowing - {{ config('app.name') }}" class="link-block">
									<div class="link-texts">
									  <span>Rating di Legalità</span>
									  <div class="subtitle"></div>
									</div>
									<div class="freccia"></div>
								  </a>
								</li>
								<li style="display: flex; align-items: center;  margin-bottom: 24.2px; padding:0 !important">
								  <a href="whistleblowing.html" title="Whistelblowing - Etica, Compliance e Whistelblowing - {{ config('app.name') }}" class="link-block">
									<div class="link-texts">
									  <span>Whistelblowing</span>
									  <div class="subtitle"></div>
									</div>
									<div class="freccia"></div>
								  </a>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</section>
	</div>
	<script>
     function applyDynamicTextAlign(el) {
		const lineHeight = parseFloat(getComputedStyle(el).lineHeight);
		const lines = Math.round(el.offsetHeight / lineHeight);
		if (lines > 2) {
		  el.classList.remove('center');
		  el.classList.add('justify');
		} else {
		  el.classList.remove('justify');
		  el.classList.add('center');
		}
	  }

	  const el = document.getElementById('textBlock');
	  applyDynamicTextAlign(el);

	  window.addEventListener('resize', () => applyDynamicTextAlign(el));
  </script>
  <script>
document.addEventListener('DOMContentLoaded', () => {
	// 1️⃣ SubMenu animazione
	const submenuItems = document.querySelectorAll('#subMenuContainer .link-block');
	submenuItems.forEach((item, index) => {
		item.style.opacity = '0';
		item.style.animationDelay = `${index * 150}ms`;
		item.classList.add('fade-slide-right');
	});

	// 2️⃣ Testo principale
	const introText = document.querySelector('.mainTextContainer .dynamic-text');
	if (introText) {
		introText.style.opacity = '0';
		introText.style.animation = 'fadeSlideUp 0.8s ease forwards';
		introText.style.animationDelay = '400ms';
	}

	// 3️⃣ Link delle due colonne
	const columns = document.querySelectorAll('.linkList ul');
	let delay = 800;

	columns.forEach((ul, colIndex) => {
	const items = ul.querySelectorAll('li');
		items.forEach((li, i) => {
			const delayMs = delay + (i * 150);
			li.style.animationDelay = `${delayMs}ms`;
			// 👇 attiva l'animazione con classe
			li.classList.add('fade-slide-up'); 
		});
	});

});

	
	document.querySelectorAll('.linkList li').forEach(li => {
		const img = li.querySelector('img.icon-li');
		if (!img) return;

		const srcOriginale = img.getAttribute('src');
		const srcRosso = srcOriginale.replace('_b.png', '_r.png');

		li.addEventListener('mouseenter', () => {
			img.setAttribute('src', srcRosso);
		});

		li.addEventListener('mouseleave', () => {
			img.setAttribute('src', srcOriginale);
		});
	});
</script>
@endsection	