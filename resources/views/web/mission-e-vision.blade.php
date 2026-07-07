@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "MISSION<br/>& VISION";
		$img_background="web/images/header_Mission_e_Vision.jpg";
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
		  gap: 80px; 
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
		  margin-bottom: 20px;
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
		  font-size: 30px;
		  font-family: Arial, sans-serif;
		  display: flex;
		  gap: 10px;
		  color: #000;
		  font-weight: 600;
		  position: relative;
		  z-index: 2;
		}

		.expand-block__title .bold {
		  font-weight: bold;
		}

		.expand-block__content {
		  display: block;
		  padding: 20px 0;
		  text-align:justify;
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
		  gap: 0px;
		  align-items: stretch;
		  height: auto;
		  margin-bottom:10px;
		  flex-direction: column;
		}

		.icon-arrow {
		  color: #E30613;
		  display: flex;
		  align-items: center;
		  font-size: 24px;
		}

		.metric-value {
		  font-size: 25px;
		  font-weight: bold;
		  display: flex;
		}

		.metric-label {
		  font-size: 20px;
		  display: flex;
		  align-items: flex-end;
		  transform: translateY(2px);
		  text-align:justify;
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
		
		.metric-value{
			position:relative;
		}
		.metric-value::before {
		  content: '';
		  position: absolute;
		  left: -25px;
		  top: 7px;		  
		  width: 12px;
		  height: 12px;
		  border-right: 2px solid #E73338;
		  border-bottom: 2px solid #E73338;
		  transform: rotate(-45deg);
		}
		
		.expand-block__title span {
		  font-weight: 600;
		  font-size:30px;
		}
		
		.link-block{
			//margin:0 60px 20px 0;
		}
		
		
		.missionList{display:flex; gap:50px; opacity:0}
		.missionList{flex-direction:column; gap:0px;}
		
		
		#subMenuDesk{display:block}
		#subMenuMob{display:none}
		
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
		
			.layout-split-container{
				flex-direction:column;
				gap:0px;
			}
			.missionList{flex-direction:column; gap:0px;}
		}
		
		#subMenuContainer {
			padding:0; 
			display:flex;
			justify-content: wrap;
			gap: 50px;
		}
		
		#subMenuContainer a.link-block {
		  display: flex;
		  flex: 0 0 calc(25% - 37.5px);
		  box-sizing: border-box;
		  align-items: center;
		  justify-content: space-between;
		  padding: 5px 10px 5px 5px;
		  border-bottom: 1px solid #D9D9D9;
		  color: #000;
		  text-decoration: none;
		  transition: background 0.3s;
		}

		#subMenuContainer2 {
			padding:0; 
			display:flex;
			justify-content: wrap;
			gap: 50px;
		}
		
		#subMenuContainer .link-block{
			opacity:0;
		}
		#subMenuContainer2 .link-block{
			opacity:0;
		}
		
		#subMenuContainer2 a.link-block {
		  display: flex;
		  flex: 0 0 calc(50% - 50px);
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
			#subMenuDesk{display:none}
			#subMenuMob{display:block}
		}
		

		@media screen AND (max-width:700px){			
			#subMenuContainer2{
				flex-wrap:wrap;
				gap:20px;
			}
			#subMenuContainer2 a.link-block {
			  flex: 0 0 100%;
			}
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
		
		.missionList{margin-top:40px;}
		@media screen AND (max-width:1929px){
			.project-metrics{margin-bottom:35px !important;}
		}		
		@media screen AND (max-width:1830px){
			.project-metrics{margin-bottom:45px !important;}
		}		
		@media screen AND (max-width:1230px){
			.project-metrics{margin-bottom:60px !important;}
		}		
		@media screen AND (max-width:1180px){
			.project-metrics{margin-bottom:80px !important;}
		}	
		@media screen AND (max-width:1080px){
			.project-metrics{margin-bottom:100px !important;}
		}
		@media screen AND (max-width:1024px){
			.project-metrics{margin-bottom:10px !important;}
			.missionList{margin-top:0px; padding-left:20px;
				margin-bottom:60px ;}
		}
		
		@keyframes fadeSlideLeft {
			from { opacity: 0; transform: translateX(60px); }
			to { opacity: 1; transform: translateX(0); }
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

		.fade-slide-left {
			animation: fadeSlideLeft 0.8s ease forwards;
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
	</style>
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">	
	
		<section style="width:100%; margin-bottom:40px;" id="subMenuDesk">
			<div class="mainTextContainer mainTextContainer2" style="margin-bottom:30px;">		
				<div id="subMenuContainer">			  
				  <a  class="link-block"  id="block1" style="border:none"> </a>			  
				  <a href="mission-e-vision.html" title="Mission e Vision - In cosa Crediamo - {{ config('app.name') }}" class="link-block active">
						<span >Mission e Vision&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a  href="sicurezza-sul-lavoro.html" title="Sicurezza sul lavoro - In cosa Crediamo - {{ config('app.name') }}" class="link-block">
						<span >Sicurezza sul lavoro&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a class="link-block" id="block4" style="border:none"> </a>
				</div>
			</div>
		</section>
		
		<section style="width:100%; margin-bottom:40px;" id="subMenuMob">
			<div class="mainTextContainer mainTextContainer2" style="margin-bottom:30px;">		
				<div id="subMenuContainer2">			  
				  <a href="mission-e-vision.html" title="Mission e Vision - In cosa Crediamo - {{ config('app.name') }}" class="link-block active">
						<span >Mission e Vision&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a  href="sicurezza-sul-lavoro.html" title="Sicurezza sul lavoro - In cosa Crediamo - {{ config('app.name') }}" class="link-block">
						<span >Sicurezza sul lavoro&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				</div>
			</div>
		</section>
	
		<div class="mainTextContainer">
			<div class="expand-block">
				<div class="expand-block__header">
					<div class="expand-block__bg-hover"></div>
					<div class="expand-block__title">
						<span>Progettare il futuro con innovazione, affidabilità e sicurezza</span>
					</div>
				</div>
			</div>		
		</div>
		<div class="layout-split-container mainTextContainer" style="margin-bottom:50px;">
			<div class="layout-split-block layout-split-left">
				<div class="expand-block">
					<div class="expand-block__content" style="line-height:1.05">
						<?php /*<p>
							Il nostro lavoro è <strong>dare forma al futuro</strong>: immaginare, progettare e costruire. La nostra storia ci ha insegnato che i grandi traguardi si raggiungono solo con una <strong>visione condivisa</strong>, la forza di un gruppo solido e la determinazione di una <strong>squadra ambiziosa</strong>.
						</p>
						/*<p>
							Crediamo fermamente nella meritocrazia, perché ogni persona è il motore del cambiamento: ognuno ha il diritto di vedere riconosciuto il proprio <strong>talento</strong> e il valore del suo impegno. Valorizziamo chi eccelle, chi si distingue per dedizione, competenza e capacità di innovazione, promuovendo <strong>una cultura aziendale che premia il merito</strong> e alimenta la crescita professionale. È grazie alle nostre persone che riusciamo a realizzare progetti ambiziosi, all’altezza delle sfide del nostro tempo.
						</p>*
						<p>
							La nostra missione è ideare e realizzare infrastrutture che favoriscano la <strong>mobilità</strong>, la <strong>connettività</strong> e il <strong>benessere delle comunità</strong>. Attraverso <strong>tecnologie innovative</strong> e pratiche sostenibili, ci dedichiamo a progetti rispettosi dell’ambiente e orientati ad uno <strong>sviluppo equo e duraturo</strong>.
						</p>
						<p>
							Ci impegniamo nella <strong>tutela ambientale</strong>, nella <strong>sicurezza</strong> e nella <strong>salute dei lavoratori</strong>, promuovendo soluzioni che coniughino <strong>progresso e sostenibilità</strong>. Ogni opera ha un impatto sul territorio, per questo <strong>monitoriamo costantemente</strong> il contesto in cui operiamo, valorizzando le risorse e minimizzando le interferenze con gli ecosistemi.
						</p>*/?>
						
						<p style="margin:0 0 12px 0;">
						Il nostro lavoro è <strong>dare forma al futuro</strong>: immaginare, progettare e costruire.
						</p>
						<p style="margin:12px 0;">
						Crediamo fermamente nella meritocrazia, perché ogni persona è il motore del cambiamento: ognuno ha il diritto di vedere riconosciuto il proprio <strong>talento</strong> e il valore del suo impegno. Valorizziamo chi eccelle, chi si distingue per dedizione, competenza e capacità di innovazione, promuovendo <strong>una cultura aziendale che premia il merito</strong> e alimenta la crescita professionale. È grazie alle nostre persone che riusciamo a realizzare progetti ambiziosi, all’altezza delle sfide del nostro tempo.
						</p>
						<p style="margin:12px 0;">
						Ci impegniamo nella <strong>tutela ambientale</strong>, nella <strong>sicurezza</strong> e nella <strong>salute dei lavoratori</strong>, promuovendo soluzioni che coniughino <strong>progresso e sostenibilità</strong>. Ogni opera ha un impatto sul territorio, per questo <strong>monitoriamo costantemente</strong> il contesto in cui operiamo, valorizzando le risorse e minimizzando le interferenze con gli ecosistemi.
						</p>
						<p style="margin:12px 0;">
						La nostra storia ci ha insegnato che i grandi traguardi si raggiungono solo con una visione condivisa, la forza di un gruppo solido e la determinazione di una squadra ambiziosa.
						</p>
					</div>
				</div>		
			</div>
			
			<div class="layout-split-block layout-split-right">
				<div style="width:calc(100% - 20px); ">
					<div style="" class="missionList">
						<div style="flex:1">
							<div class="project-metrics" style="padding-bottom:40px;">							  
							  <div class="metric-value">Qualità:</div>
							  <div class="metric-label" style="line-height:1.2"><span class="expand-block__content" style="padding:0 !important">Puntiamo all'eccellenza in ogni progetto, attraverso standard elevati in tutte le fasi del processo costruttivo.</span></div>
							</div>
							<div class="project-metrics" style="padding-bottom:35px;">							 
							  <div class="metric-value">Sostenibilità:</div>
							  <div class="metric-label" style="line-height:1.2"><span class="expand-block__content" style="padding:0 !important">Adottiamo pratiche che minimizzano l'impatto ambientale e promuovono l'uso responsabile delle risorse.</span></div>
							</div>
						</div>
						<div style="flex:1">
							<div class="project-metrics">							 
							  <div class="metric-value">Etica:</div>
							  <div class="metric-label" style="line-height:1.2"><span class="expand-block__content" style="padding:0 !important">Operiamo con integrità e trasparenza, promuovendo una cultura della legalità e del rispetto.</span></div>
							</div>
						</div>
					</div>
				</div>
						
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- GLightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
window.addEventListener('scroll', () => {
  const rightBlock = document.querySelector('.layout-split-block.layout-split-right');
  const gallery = rightBlock.querySelector('.gallery-carousel');

  if (rightBlock && gallery) {
    const rightRect = rightBlock.getBoundingClientRect();
    const galleryHeight = gallery.offsetHeight;
    const viewportTop = 120;

    let marginTop = 0;

    // Sposta in basso quando arriva a 120px dal top del viewport
    if (rightRect.top < viewportTop) {
      marginTop = viewportTop - rightRect.top;
    }

    // Limite massimo per non uscire dal contenitore destro
    const maxMargin = rightRect.height - galleryHeight;

    // Clamping: mantieni tra 0 e maxMargin
    marginTop = Math.min(Math.max(0, marginTop), maxMargin);

    gallery.style.marginTop = `${marginTop}px`;
  }
});
document.addEventListener('DOMContentLoaded', () => {
  // 1️⃣ SubMenu animazione
	const submenuItems = document.querySelectorAll('#subMenuContainer .link-block');
	submenuItems.forEach((item, index) => {
		item.style.opacity = '0';
		item.style.animationDelay = `${index * 150}ms`;
		item.classList.add('fade-slide-right');
	});
	
	// 1️⃣ SubMenu animazione
	const submenuItems2 = document.querySelectorAll('#subMenuContainer2 .link-block');
	submenuItems2.forEach((item, index) => {
		item.style.opacity = '0';
		item.style.animationDelay = `${index * 150}ms`;
		item.classList.add('fade-slide-right');
	});
	
	// 1️⃣ missionList
	const missionList = document.querySelectorAll('.missionList');
	missionList.forEach((item, index) => {
		item.style.opacity = '0';
		item.style.animationDelay = `500ms`; 
		item.classList.add('fade-slide-left');
	});
	
  // Carousel Image Activation on Scroll
  const carouselImages = document.querySelectorAll('.carousel-image');
  if (carouselImages.length > 0) {
    let hasAnimated = false;

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !hasAnimated) {
          hasAnimated = true;

          carouselImages.forEach((img, i) => {
            img.style.transitionDelay = `${i * 0.1}s`;
            img.classList.add('active');
          });

          observer.disconnect(); // Stop observing all
        }
      });
    }, { threshold: 0.1 });

    carouselImages.forEach(img => observer.observe(img));
  }

  // Carousel Scroll Buttons
  const carouselTrack = document.getElementById('carousel-track');
  const nextBtn = document.getElementById('nextBtnProj');
  const prevBtn = document.getElementById('prevBtnProj');

  if (carouselTrack && nextBtn && prevBtn) {
    const imageWidths = Array.from(document.querySelectorAll('.carousel-image')).map(img => {
      const style = window.getComputedStyle(img);
      return img.offsetWidth + parseFloat(style.marginRight || 0);
    });

    let currentIndex = 0;

    const easeInOutCubic = t => t < 0.5
      ? 4 * t * t * t
      : 1 - Math.pow(-2 * t + 2, 3) / 2;

    const smoothScrollTo = (element, target, duration) => {
      const start = element.scrollLeft;
      const change = target - start;
      const startTime = performance.now();

      const animateScroll = currentTime => {
        const timeElapsed = currentTime - startTime;
        const t = Math.min(timeElapsed / duration, 1);
        element.scrollLeft = start + change * easeInOutCubic(t);
        if (t < 1) requestAnimationFrame(animateScroll);
      };

      requestAnimationFrame(animateScroll);
    };

    nextBtn.addEventListener('click', () => {
      if (currentIndex < imageWidths.length - 1) {
        currentIndex++;
        const newScrollLeft = imageWidths.slice(0, currentIndex).reduce((a, b) => a + b, 0);
        smoothScrollTo(carouselTrack, newScrollLeft + (currentIndex * 15), 300);
      }
    });

    prevBtn.addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        const newScrollLeft = imageWidths.slice(0, currentIndex).reduce((a, b) => a + b, 0);
        smoothScrollTo(carouselTrack, newScrollLeft + (currentIndex * 15), 300);
      }
    });
  }
  
  // FadeIn+SlideUp solo quando visibili
	const expandBlocks = document.querySelectorAll('.expand-block');
	
	const observer = new IntersectionObserver((entries, obs) => {
	  entries.forEach(entry => {
		if (entry.isIntersecting) {
		  setTimeout(() => {
			entry.target.classList.add('visible');
		  },  300);
		  obs.unobserve(entry.target); // osserva solo una volta
		}
	  });
	}, {
	  threshold: 0.1
	});

	expandBlocks.forEach(block => observer.observe(block));

});
document.addEventListener("DOMContentLoaded", () => {
  const lightbox = GLightbox({
	selector: '.glightbox',
	touchNavigation: true,
	loop: true,
  });
});
</script>
@endsection	