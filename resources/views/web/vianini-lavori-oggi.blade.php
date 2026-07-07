@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$img_background="web/images/header_La_nostra_storia.jpg"; 
		$page_title = "VIANINI LAVORI OGGI";
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
		  gap: 20px; 
		  justify-content: center;
		}

		.layout-split-block {
		  flex: 1;
		  display: flex;
		  flex-direction: column;
		  //align-items: center;
		  //justify-content: center;
		  font-family: sans-serif;
		}

		.layout-split-left {
		  
		}

		.layout-split-right {
		 
		}
		
		.expand-block {
		  position: relative;
		  //background: #fff;
		  overflow: hidden;
		  margin-bottom: 20px;
		} 

		.expand-block__header {
		  position: relative;
		  padding: 15px 10px 15px 0;
		  //background-color: white;
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
		  //justify-content: center;
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


		
		.expand-block__title span {
		  font-weight: 600;
		  font-size:30px;
		}
		
		.link-block {
		  display: inline-flex; /* importante: inline-block behavior con flex */
		  align-items: center;
		  gap: 12px; /* spazio tra testo e freccia */
		  font-size: 30px;
		  color: #000;
		  text-decoration: none;
		  transition: font-weight 0.3s;
		  position: relative;
		  border-bottom: 1px solid #D9D9D9;
		  max-width: 100%;
		  margin-top:20px;
		}

		.link-block span {
		  font-weight: bold;
		  transition: font-weight 0.3s;
		}

		.link-block .freccia {
		  width: 12px;
		  height: 12px;
		  position: relative;
		  flex-shrink: 0; /* evita che si schiacci */
		}

		.link-block .freccia::after {
		  content: '';
		  position: absolute;
		  right: 0;
		  top: 50%;
		  transform: translateY(-50%) rotate(-45deg);
		  width: 12px;
		  height: 12px;
		  border-right: 2px solid #E73338;
		  border-bottom: 2px solid #E73338;
		  transition: transform 0.4s ease;
		}

		.link-block:hover span {
		  font-weight: bold;
		}

		.link-block:hover .freccia::after {
		  transform: translate(4px, -50%) rotate(-45deg);
		}
		
		@media screen AND (max-width:1024px){		
			.layout-split-container{
				flex-direction:column;
				gap:40px;
			}
		
		}

		.circleArrowProj{
			border:solid 1px #000;
			cursor:pointer;
			transition: all 0.3s ease;
		}
		.circleArrowProj:hover{
			border:solid 1px #E30613;
			background:#E30613;
		}
		.circleArrowProjIcon{border-color:#000 !important}
		
		.circleArrowProj:hover .circleArrowProjIcon{
			border-color:#fff !important;
		}
		
		.catProgInner.active-cat .nomeProg {
			font-weight: bold;
		}
		
		
		.gallery-carousel{
			width: 100%; 
			position:relative;
			min-height:450px; 
			padding-top:90px !important;
		}
		

		.gallery-carousel {
		  width: 100%;
		  min-height: 450px;
		  z-index: 5;
		  //background: white; /* opzionale per visibilità */
		  padding-bottom: 80px; /* spazio per i bottoni */
		}

		.carousel-controls {
		  position: relative; 
		 margin-top:30px;
		  display: flex;
		  gap: 20px;
		  padding-left: 10px;
		}

		.circleArrowProj {
		  width: 68px;
		  height: 68px;
		  border-radius: 35px;
		  border: solid 1px #000;
		  cursor: pointer;
		  position: relative;
		  transition: all 0.3s ease;
		}

		.circleArrowProj:hover {
		  border-color: #E30613;
		  background: #E30613;
		}

		.circleArrowProjIcon {
		  position: absolute;
		  width: 30px;
		  height: 30px;
		  top: 17px;
		  border-color: #000 !important;
		}

		.circleArrowProj:hover .circleArrowProjIcon {
		  border-color: #fff !important;
		}

	
		.carousel-track {
		  display: flex;
		  width: 100%;
		  height: 100%;
		  overflow: auto;
		   scroll-behavior: auto;
		}

		.carousel-track a {
		  flex: 0 0 100%;
		  min-width: 100%;
		  height: 100%;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		}

		.carousel-image,
		.carousel-image-2 {
		  width: 100%;
		  height: 100%;
		  object-fit: cover; /* oppure "cover" se preferisci riempire tutto */
		  display: block;
		}

		
		.carousel-track::-webkit-scrollbar {
		  display: none;              
		}

		.carousel-image {
		  width: 100%;
		  height: 100%;
		  object-fit: cover;
		  flex-shrink: 0;
		}
		
		.animate-once {
		  opacity: 0;
		  transform: translateX(250px);
		  transition: opacity 1.5s ease, transform 1.5s ease;
		}
		.animate-once.visible {
		  opacity: 1;
		  transform: translateX(0);
		}
		
		
		.layout-split-container {
		  display: flex;
		  gap: 20px;
		  width: 100%;
		   box-sizing: border-box;
		}

		.layout-split-block {
		  flex: 1 1 50%; /* ogni blocco prende il 50% e può ridursi */
		  box-sizing: border-box;
		  padding: 0 10px;
		  display: flex;
		  flex-direction: column;
		  //justify-content: center;
		}
		
		@media screen and (max-width: 768px) {
		  .layout-split-block {
			flex: 1 1 100%; /* ora prendono tutta la riga */
			padding: 0 5px;
		  }
		}
		.gallery-carousel {
		  transition: margin-top 0.5s ease;
		}
		
		ul li::before {
		  top: 1.2em !important;
		}
		
		.link-block {
		  flex:  0 0 auto;
		  margin: 0px 50px 20px 5px;
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
		.mainTextContainer li::before {
		  content: '';
		  position: absolute;
		  left: 0;
		  top: 0.3em !important;
		}
		
		#pageContainer {
			background: url(web/images/v_grigia.png) no-repeat top center;
			//background-size: cover;
			background-attachment: scroll; /* default */
			position: relative;
			z-index: 1;
			overflow: hidden;
			//padding-bottom:120px;
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
		#pageContainer.fixed::before {
			transform: translateY(110px);
			opacity: 0.4;
		}
		
		#pageContainer2 {
			background: url(web/images/v_grigia.png) no-repeat top center;
			//background-size: cover;
			background-attachment: scroll; /* default */
			position: relative;
			z-index: 1;
			overflow:hidden;
		  //padding-bottom:60px;
		}
		
		#pageContainer2::before {
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
		#pageContainer2.fixed::before {
			transform: translateY(110px);
			opacity: 0.4;
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
			#pageContainer{padding-bottom:0px;}
			#pageContainer2{padding-bottom:0px;}
			.gallery-carousel{
				min-height:auto;
				padding-bottom:20px;
				padding-top:20px !important;
			}
		}
		
	</style>
	
	<div style="width:100%; margin-top:-61px; padding-top:60px;" id="pageContainer2">		
		<div class="layout-split-container mainTextContainer" id="vianini_lavori_oggi">
			<div class="layout-split-block layout-split-right">
				<div class="gallery-carousel" id="gallery-carousel-2">
				  <div class="carousel-track" id="carousel-track-2">
						<a href="web/images/operai_mob.jpg" class="glightbox" data-gallery="gallery-oggi">
							<img src="web/images/operai_mob.jpg" alt="Vianini Oggi" class="carousel-image-2">
						</a>
				  </div>
					<?php /*<div class="carousel-controls">
						<div id="prevBtnProj-2" class="circleArrowProj" data-track="2">
						  <div class="circleArrowProjIcon" style="top:17px; right:12px; border-left: 2px solid; border-top: 2px solid; transform: rotate(-45deg);"></div>
						</div>
						<div id="nextBtnProj-2" class="circleArrowProj" data-track="2">
						  <div class="circleArrowProjIcon" style="top:17px; left:12px; border-right: 2px solid; border-bottom: 2px solid; transform: rotate(-45deg);"></div>
						</div>
					</div>*/?>
				</div>			
			</div>
			
			<div class="layout-split-block layout-split-left">
				<div class="expand-block">
					<div class="expand-block__header">
						<div class="expand-block__bg-hover"></div>
						<div class="expand-block__title">
							<span style="font-weight:700">Vianini Lavori oggi</span>
						</div>
					</div>
					<div class="expand-block__content">
						<p>
							Vianini Lavori S.p.A. è un primario operatore nelle infrastrutture di trasporto (metropolitane, ferrovie, strade), nel ciclo idrico integrato, nell’edilizia civile e industriale, in cui porta il proprio bagaglio di esperienza, competenze e innovazione. La società è controllata del <a href="https://www.caltagironespa.it/" target="_blank" title="Gruppo Caltagirone - Sito Web" style="color: {{ config('app.rosso') }};"><strong>Gruppo Caltagirone</strong></a>, uno dei principali gruppi industriali privati italiani.
						</p>
						<p>
							Da oltre un secolo leader nei settori più avanzati dell’ingegneria civile e delle costruzioni, oggi ha un portafoglio di 26 commesse attualmente attive.
						</p>
							 

						<p>
							Nell’ultimo triennio la società ha rafforzato il proprio successo di posizionamento intercettando strategicamente le evoluzioni del mercato italiano e consolidando il portafoglio di lavori su tutto il territorio nazionale.
						</p>
							 

						<p>
							La crescita dei risultati operativi si conferma nel triennio 2023-2025, con ricavi a 590 milioni di euro e portafoglio lavori a 2,7 miliardi, rispettivamente sette e sei volte i valori di fine 2022: numeri che riflettono la solidità del percorso di crescita costruito negli ultimi anni con scelte industriali chiare, disciplina operativa e una strategia selettiva nelle acquisizioni. Leggi il <a href="resarea/files/news/CS_VIANINI_risultati2025_04032026.pdf" target="_blank" title="Comunicato Stampa crescita Vianini Lavori" style="color: {{ config('app.rosso') }};"><strong>Comunicato Stampa</strong></a>.
						</p>
							 

						<p>
							Innovazione, sicurezza, sostenibilità e meritocrazia sono gli elementi cardine della nuova strategia del Gruppo, che oggi conta su una struttura organizzativa qualificata ed efficiente di oltre 200 uomini e donne.
						</p>
							 

						<p>
							Vianini Lavori ha inoltre dato impulso nel 2021 alla costituzione del <strong>Consorzio Stabile Eteria</strong>, sinergia tra le società e i partner <strong>Itinera</strong>, <strong>Sinelec</strong> (Gruppo Gavio) e <strong>I.CO.P.</strong>, impresa nazionale ad alta specializzazione. Il Consorzio si pone come uno dei principali player del settore costruzioni nel Paese.
						</p>
						<style>
							.mainTextContainer li img.icon-li {
							  position: absolute;
							  left: 0;
							  top: -3px;
							  margin-left:-12px;
							  width: 30px;
							  height: 30px;
							  object-fit: contain;
							  flex-shrink: 0;
							}
							#sezLink li::before {
							  display:none !important;
							}

						</style>
						<div id="sezLink">
							<ul style="padding-left:15px; margin-top:30px">
								<li>
									<img class="icon-li" src="{{ asset('web/images/icon_pdf_b.png') }}" alt="Certificazione UNI ISO 45001 - Sicurezza sul lavoro - {{ config('app.name') }}">
									<a target="_blank" href="{{ mostra_pdf_url('VL_Company Profile_31.03.2025_rev1.pdf', 'Company Profile - ' . config('app.name'), 'doc') }}" title="Company Profile - {{ config('app.name') }}" class="link-block">
										<span>Company Profile</span>
										<div class="freccia"></div>
									</a>
								</li>
							</ul>
						</div>		
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- GLightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
/*(function() {
  const offset = 110;
  const originalHash = window.location.hash;

  // Scroll custom con offset
  function scrollWithOffset(id) {
    const target = document.getElementById(id);
    if (target) {
      const top = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  }

  // Blocca scroll nativo immediatamente (anche su refresh)
  if (originalHash) {
    // 1. Scorri subito in alto
    window.scrollTo(0, 0);
    // 2. Rimuove temporaneamente l'hash
    history.replaceState(null, null, window.location.pathname + window.location.search);
  }

  // Dopo che tutto è pronto: scroll con offset
  window.addEventListener('load', () => {
    if (originalHash) {
      scrollWithOffset(originalHash.substring(1));
      // Ripristina l’hash nell’URL
      history.replaceState(null, null, window.location.pathname + window.location.search + originalHash);
    }
  });

  // Scroll da link cliccato nella stessa pagina
  document.addEventListener('click', function(e) {
    const link = e.target.closest('a[href^="#"]');
    if (link) {
      const hash = link.getAttribute('href').substring(1);
      if (document.getElementById(hash)) {
        e.preventDefault();
        scrollWithOffset(hash);
        history.replaceState(null, null, window.location.pathname + window.location.search + '#' + hash);
      }
    }
  });
})();*/




document.addEventListener('DOMContentLoaded', () => {
  // Preload images before calculating width
  const preloadImages = (images) => {
    return Promise.all(Array.from(images).map(img => {
      return new Promise(resolve => {
        if (img.complete) {
          resolve();
        } else {
          img.onload = () => resolve();
          img.onerror = () => resolve(); // fallback in caso di errore
        }
      });
    }));
  };
/*
  const carouselImages = document.querySelectorAll('.carousel-image');
  const carouselImages2 = document.querySelectorAll('.carousel-image-2');
  const carouselTrack = document.getElementById('carousel-track');
  const carouselTrack2 = document.getElementById('carousel-track-2');
  const nextBtn = document.getElementById('nextBtnProj');
  const nextBtn2 = document.getElementById('nextBtnProj-2');
  const prevBtn = document.getElementById('prevBtnProj');
  const prevBtn2 = document.getElementById('prevBtnProj-2');

  function initCarousel(carouselContainer) {console.log("AAAA");
	  const track = carouselContainer.querySelector('.carousel-track');
	  const images = track.querySelectorAll('.carousel-image');
	  const nextBtn = carouselContainer.querySelector('.circleArrowProj:nth-of-type(2)');
	  const prevBtn = carouselContainer.querySelector('.circleArrowProj:nth-of-type(1)');
	  let currentIndex = 0;

	  const getSlideWidth = () => images[0]?.offsetWidth || carouselContainer.offsetWidth;

	  const scrollToSlide = (index) => {
		const slideWidth = getSlideWidth();
		const maxScroll = track.scrollWidth - track.clientWidth;
		const target = Math.min(index * slideWidth, maxScroll);
		track.scrollTo({ left: target, behavior: 'smooth' });
	  };

	  if (nextBtn && prevBtn) {
		nextBtn.addEventListener('click', () => {
		  currentIndex = (currentIndex + 1) % images.length;
		  scrollToSlide(currentIndex);
		});

		prevBtn.addEventListener('click', () => {
		  currentIndex = (currentIndex - 1 + images.length) % images.length;
		  scrollToSlide(currentIndex);
		});
	  }

	  // Animazione una tantum su caricamento
	  images.forEach((img, i) => {
		img.classList.add('animate-once');
		if (img.complete) {
		  setTimeout(() => img.classList.add('visible'), i * 100);
		} else {
		  img.onload = () => {
			setTimeout(() => img.classList.add('visible'), i * 100);
		  };
		}
	  });
	}
	
	const carousel = document.getElementById('carouselStoria');
    initCarousel(carousel);
*/
  // FadeIn+SlideUp blocchi di testo
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
  
  
	  
});
document.addEventListener("DOMContentLoaded", () => {
  const lightbox = GLightbox({
	selector: '.glightbox',
	touchNavigation: true,
	loop: true,
  });
});


document.querySelectorAll('#sezLink li').forEach(li => {
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