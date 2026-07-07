@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "STRATEGIA DI<br/>SOSTENIBILITÀ";
		$img_background="web/images/header_Strategia_di_sostenibilita_e_Bilanci_di_sostenibilita.jpg";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Chi Siamo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<style>
		.layout-split-container {
		  width: calc(100% - 240px);
		  margin: 0 auto;
		  display: flex;
		  flex-direction: column;
		  gap: 20px; 
		  margin-bottom:100px;
		}

		.layout-split-block {
		  flex: 1;
		  display: flex;
		  flex-direction: column;
		  align-items: center;
		  justify-content: center;
		  font-family: sans-serif;
		}

		.layout-split-left {
		  
		}

		.layout-split-right {
		 
		}
		
		.expand-block {
		  position: relative;
		  overflow: hidden;
		 // margin-bottom:20px; 
		  text-align:justify
		}

		.expand-block__header {
		  position: relative;
		  padding: 15px 10px;
		  display: flex;
		  align-items: center;
		  border-bottom: 2px solid #000;
		}
		
		.expand-block,
		.expand-block__header {
		  width: 100%;
		  box-sizing: border-box;
		}
		
		.expand-block__title,
		.expand-block__icon {
		  flex-shrink: 0;
		}

		.expand-block__title {
		  flex: 1;
		  font-size: 40px;
		  font-family: Arial, sans-serif;
		  display: flex;
		  gap: 10px;
		  color: #000;
		  font-weight: 400;
		  position: relative;
		  z-index: 2;
		}

		.expand-block__title .bold {
		  font-weight: bold;
		}
		
		.layout-split-block.layout-split-right {
		  align-items: flex-start; /* invece di center */
		  justify-content: flex-start; /* in alto */
		  position: relative;
		  display: flex;
		  flex-direction: column;
		}
		
		.expand-block {
		  opacity: 0;
		  transform: translateY(20px);
		  transition: opacity 1.2s ease-out, transform 1.2s ease-out;
		}

		.expand-block.visible {
		  opacity: 1;
		  transform: translateY(0);
		}

		.project-metrics {
		  display: flex;
		  gap: 3px;
		  align-items: stretch;
		  height: auto;
		  margin-bottom:20px;
		}

		.icon-arrow {
		  color: #E30613;
		  display: flex;
		  align-items: center;
		  font-size: 24px;
		}

		.metric-value {
		  font-size: 19px;
		  font-weight: bold;
		  display: flex;
		  align-items: center;
		}

		.metric-label {
		  font-size: 19px;
		  display: flex;
		  gap:5px;
		  justify-content: center;
		}
		
		.left-block {
		  opacity: 0;
		  transform: translatex(50px);
		  transition: opacity 1.2s ease-out, transform 1.2s ease-out;
		}

		.left-block.visible {
		  opacity: 1;
		  transform: translateX(0);
		}
		
		@media screen AND (max-width:1024px){
			.layout-split-container{
				flex-direction: column;
			}
			
			.expand-block {
			  margin-bottom:0px;
			}
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
		
		.metric-value{
			position:relative;
			min-height:80px;
			text-align: center;
		}
		

		.project-metrics {
		  display: flex;
		  gap: 3px;
		  align-items: stretch;
		  height: auto;
		  margin-bottom:20px;
		  flex-direction: column;
		}
		
		#subMenuContainer {
			padding:0; 
			display:flex;
		}
		@media screen AND (max-width:1024px){			
			#subMenuContainer {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			.link-block {
				flex: 0 0 50%; 
				box-sizing: border-box;
				padding: 0 10px;
				text-decoration: none;
			}
		}
		
		.block1, .block2, .block3, .block4, .block5{
			width:600px; background:#F5F5F5;
		}
		.metric-label img {width:35%;}
		
		.blockRow1, .blockRow2, .blockRow3 {display:flex; gap:10px}
		.blockRow2{display:none}
		.blockRow3{display:none}
		@media screen AND (max-width:1199px){
			.blockRow1 .block4, .blockRow1 .block5{display:none}
			.blockRow2{display:flex}
			.blockRow2 .block1, .blockRow2 .block2, .blockRow2 .block3{display:none}
			.blockRow2 .block4, .blockRow2 .block5{width:33%}
			.blockRow2 .block4{margin-left:17%;}
		}
		@media screen AND (max-width:750px){
			.blockRow1 .block3{display:none}
			.blockRow2 .block5{display:none}
			.blockRow2 .block3{display:flex}
			.blockRow2 .block3, .blockRow2 .block4{width:50%}			
			.blockRow2 .block4{margin-left:0;}
			.blockRow3{display:flex}
			.blockRow3 .block1, .blockRow3 .block2, .blockRow3 .block3, .blockRow3 .block4{display:none}
			.blockRow3 .block5{width:50%}
			.blockRow3 .block5{margin-left:25%;}
		}
		@media screen AND (max-width:520px){
			.blockRow2{display:none}
			.blockRow3{display:none}
			.blockRow1 .block1, .blockRow1 .block2, .blockRow1 .block3, .blockRow1 .block4, .blockRow1 .block5{display:flex; width:100%;}
		.blockRow1{flex-direction:column;}
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
		@media screen AND (max-width:650px){
			.mainTextContainer {	width:calc(100% - 100px) !important; }
		}
		
		.link-block {
		  flex:  0 0 auto;
		  //margin: 0px 50px 20px 20px;
		  border-bottom: solid 1px #D9D9D9;
		  font-size: 30px;
		  display: flex;
		  align-items: center;
		  justify-content: space-between;
		  color: #000;
		  text-decoration: none;
		  transition: font-weight 0.3s;
		  position: relative;
		  z-index: 5;
		  cursor:pointer;
		  margin-top:0 !important;
		}
		
		.link-block span {
		  background:rgba(255,255,255,0);
		  font-weight: bold;
		  transition: background 0.3s;
		}

		.link-block .freccia {
		  width: 12px;
		  height: 12px;
		  position: relative;
		  transition: transform 0.4s ease;
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
		
		#subMenuContainer {
			padding:0; 
			display:flex;
			justify-content: wrap;
			gap: 20px;
		}
		
		
		#subMenuContainer a.link-block {
		  display: flex;
		  flex: 1;
		  box-sizing: border-box;
		  align-items: center;
		  justify-content: space-between;
		  padding: 5px 10px 5px 5px;
		  border-bottom: 1px solid #D9D9D9;
		  color: #000;
		  text-decoration: none;
		  transition: background 0.3s;
		}
		
		@media screen AND (max-width:1024px){			
			#subMenuContainer {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			.link-block {
				flex: 0 0 50%; 
				box-sizing: border-box;
				padding: 0 10px;
				text-decoration: none;
			}
		}
		
		.link-block{
			//margin:0 20px 20px 0;
		}
		
		#subMenuContainer {
			padding:0; 
			display:flex;
			justify-content: space-between;
		}
		@media screen AND (max-width:1024px){			
			#subMenuContainer {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			.link-block {
				flex: 0 0 50%; 
				box-sizing: border-box;
				padding: 0 10px;
				text-decoration: none;
			}
		}
		@media screen AND (max-width:700px){			
			#subMenuContainer a.link-block {
			  flex: 0 0 100%;
			}
		}
		
		
		#subMenuContainer{width:1100px; margin:0 auto;}
		@media screen AND (max-width:1600px){
			#subMenuContainer {	width:calc(100% - 400px) !important; }
		}
		@media screen AND (max-width:1468px){
			#subMenuContainer {	width:calc(100% - 200px) !important; }
		}
		@media screen AND (max-width:1024px){
			#subMenuContainer {	width:100% !important; }
		}
		@media screen AND (max-width:500px){
			#subMenuContainer {	width:100% !important; }
		}
		
		#pageContainer {
			background: url(web/images/v_grigia.png) no-repeat top center;
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
		  background: url(web/images/v_grigia.png) no-repeat top center;
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
	</style>
	
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">	
		<section style="width:100%; margin-bottom:40px;">
			<div class="mainTextContainer mainTextContainer2" style="margin-bottom:30px;">		
				<div id="subMenuContainer">			  
				  <a href="politiche.html" title="Politiche" class="link-block">
						<span >&nbsp;Politiche&nbsp;</span>
						<div class="freccia"></div>
				  </a>			  
				  <a href="rating-di-sostenibilita.html" title="Rating di Sostenibilità" class="link-block">
						<span >&nbsp;Rating di Sostenibilità&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a href="global-compact.html" title="Global Compact" class="link-block">
						<span >&nbsp;Global Compact&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				</div>
			</div>
		</section>
		
		
		<section style="width:100%; margin-bottom:60px; position:relative; z-index:1;">
			<div class="layout-split-container mainTextContainer">
				<div class="layout-split-block layout-split-left">
					<div  class="expand-block__content">
						<p>
							<strong>Vianini Lavori S.p.A.</strong>, leader nel settore delle grandi infrastrutture, esempio di tradizione e modernità, è da sempre attenta ai temi della <strong>sostenibilità</strong>.
						</p>
						<p>
							L’azienda persegue nel tempo l’obiettivo di creare valore per tutti i suoi stakeholder, svolgendo attività ad elevato impatto sociale, nel rispetto dei principi della legalità, della correttezza e della sostenibilità in tutte le sue componenti: <strong>ambientale, sociale, governance ed etica di business</strong>. Consapevole della rilevanza degli impatti ambientali legati al settore edile, <strong>Vianini Lavori S.p.A.</strong> monitora con attenzione le proprie attività per <span style="color: {{ config('app.rosso') }};"><strong>ridurre le emissioni</strong></span>, ottimizzare l’uso delle risorse naturali e promuovere pratiche innovative a basso impatto ambientale.
						</p>
						<p>
							Questo impegno si traduce in strategie mirate alla mitigazione delle conseguenze derivanti dai progetti infrastrutturali, in linea con le <strong>migliori pratiche internazionali</strong>.
						</p>
						<p>
							L’impegno in tema di sostenibilità di <strong>Vianini Lavori S.p.A.</strong> si concretizza anche attraverso l’adozione di sistemi di gestione dei processi aziendali certificati secondo <strong>standard/linee guida internazionali</strong> (e.g. <strong>ISO 14001:2015</strong> per la gestione ambientale, <strong>ISO 50001:2018</strong> per la gestione energetica, <strong>ISO 45001:2018</strong> per la salute e sicurezza sul luogo di lavoro, <strong>ISO 39001:2012</strong> sulla sicurezza stradale, <strong>ISO 37001:2016</strong> per la gestione dell’anticorruzione, <strong>SA 8000:2014</strong> per la Responsabilità Sociale, <strong>ISO 30415:2021</strong> e la <strong>PdR 125:2022</strong> per la Diversity & Inclusion e la parità di genere).
						</p>
						<p>
							La responsabilità di <strong>Vianini Lavori S.p.A</strong> nei confronti della sostenibilità, infine, si riverbera lungo la propria catena di fornitura, attraverso una gestione degli acquisti conformata alle <span style="color: #E73338;"><strong>linee guida ISO 20400:2017</strong></span> per l’approvvigionamento sostenibile.
						</p>
						<p>
							Sulla base dei tali premesse, <strong>Vianini lavori S.p.A.</strong> ha identificato <span style="color: #E73338;"><strong>5 Pillar</strong></span> che fungono da driver delle linee strategiche di sostenibilità.
						</p>

					</div>
				</div>
				<?php for($i=1; $i<=3; $i++ ){?>
					<div  class="blockRow{{$i}}">
						<div class="block1 expand-block">
							<div style="padding:20px;">
								<div class="project-metrics">							  
									<div class="metric-value">Gestione della governance in chiave sostenibile</div>
									<div class="metric-label">
										<img src="web/images/strategia-di-sostenibilita-12.jpg" alt=""/>
										<img src="web/images/strategia-di-sostenibilita-16.jpg" alt=""/>
									</div>
								</div>
							</div>
						</div>
						<div class="block2 expand-block">
							<div style="padding:20px;">
								<div class="project-metrics">							  
									<div class="metric-value">Tutela e valorizzazione del capitale umano</div>
									<div class="metric-label">
										<img src="web/images/strategia-di-sostenibilita-5.jpg" alt=""/>
										<img src="web/images/strategia-di-sostenibilita-4.jpg" alt=""/>
										<img src="web/images/strategia-di-sostenibilita-8.jpg" alt=""/>
									</div>
								</div>
							</div>
						</div>
						<div class="block3 expand-block">
							<div style="padding:20px;">
								<div class="project-metrics">							  
									<div class="metric-value">Tutela dell’ambiente e della biodiversità</div>
									<div class="metric-label">
										<img src="web/images/strategia-di-sostenibilita-7.jpg" alt=""/>
										<img src="web/images/strategia-di-sostenibilita-13.jpg" alt=""/>
									</div>
								</div>
							</div>
						</div>
						<div class="block4 expand-block">
							<div style="padding:20px;">
								<div class="project-metrics">							  
									<div class="metric-value">Valorizzazione della comunità in cui si opera</div>
									<div class="metric-label">
										<img src="web/images/strategia-di-sostenibilita-11.jpg" alt=""/>
									</div>
								</div>
							</div>
						</div>
						<div class="block5 expand-block">
							<div style="padding:20px;">
								<div class="project-metrics">							  
									<div class="metric-value">Sviluppo innovativo e sostenibile</div>
									<div class="metric-label">
										<img src="web/images/strategia-di-sostenibilita-8.jpg" alt=""/>
										<img src="web/images/strategia-di-sostenibilita-9.jpg" alt=""/>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>			
			</div>
		</section>
	</div>
	
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const expandBlocks = document.querySelectorAll('.expand-block');

		  const observer = new IntersectionObserver((entries, obs) => {
			entries.forEach(entry => {
			  if (entry.isIntersecting) {
				setTimeout(() => {
				  entry.target.classList.add('visible');
				}, 300);
				obs.unobserve(entry.target);
			  }
			});
		  }, {
			threshold: 0.1
		  });

		  expandBlocks.forEach(block => observer.observe(block));
		  
		const leftBlocks = document.querySelectorAll('.left-block');

		  const observer2 = new IntersectionObserver((entries, obs) => {
			entries.forEach(entry => {
			  if (entry.isIntersecting) {
				setTimeout(() => {
				  entry.target.classList.add('visible');
				}, 300);
				obs.unobserve(entry.target);
			  }
			});
		  }, {
			threshold: 0.1
		  });

		  leftBlocks.forEach(block2 => observer2.observe(block2));

	});
	
	
</script>
@endsection	