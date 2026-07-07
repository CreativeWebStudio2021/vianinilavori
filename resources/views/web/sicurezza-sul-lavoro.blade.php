@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "SICUREZZA<br/>SUL LAVORO";
		$img_background="web/images/header_Sicurezza_sul_lavoro.jpg";
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
		  gap: 40px; 
		  margin-bottom:100px;
		}

		.layout-split-block {
		  flex: 1;
		  display: flex;
		  flex-direction: column;
		  align-items: center;
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
		  gap: 10px;
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
		  font-size: 30px;
		  font-weight: bold;
		  display: flex;
		  align-items: center;
		}

		.metric-label {
		  font-size: 20px;
		  display: flex;
		  align-items: flex-end;
		  transform: translateY(2px);
		}
		
		@media screen AND (max-width:1024px){
			.layout-split-container{
				flex-direction:column;
				gap:40px;
			}
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
		
		.expand-block__title span {
		  font-weight: 600;
		  font-size:30px;
		}
		
		.link-block{
			//margin:0 60px 20px 0;
		}
		
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
		
		@keyframes fadeSlideRight {
			from { opacity: 0; transform: translateX(-30px); }
			to { opacity: 1; transform: translateX(0); }
		}
		
		@keyframes fadeSlideLeft {
			from { opacity: 0; transform: translateX(60px); }
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
				  <a href="mission-e-vision.html" title="Mission e Vision - In cosa Crediamo - {{ config('app.name') }}" class="link-block">
						<span >Mission e Vision&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a  href="sicurezza-sul-lavoro.html" title="Sicurezza sul lavoro - In cosa Crediamo - {{ config('app.name') }}" class="link-block active">
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
				  <a href="mission-e-vision.html" title="Mission e Vision - In cosa Crediamo - {{ config('app.name') }}" class="link-block">
						<span >Mission e Vision&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a  href="sicurezza-sul-lavoro.html" title="Sicurezza sul lavoro - In cosa Crediamo - {{ config('app.name') }}" class="link-block active">
						<span >Sicurezza sul lavoro&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				</div>
			</div>
		</section>
	
		<div class="layout-split-container mainTextContainer" style="margin-bottom:80px;">
			<div class="layout-split-block layout-split-left">
				<div class="expand-block">
					<div class="expand-block__header">
						<div class="expand-block__bg-hover"></div>
						<div class="expand-block__title">
							<span>Sicurezza sul lavoro</span>
						</div>
					</div>
					<div class="expand-block__content">
						<p>Ogni giorno <strong>ci impegniamo a creare ambienti di lavoro sicuri e protetti per tutti i nostri collaboratori</strong>, adottando le migliori pratiche e rispettando con rigore le normative vigenti.<br />
						<br />
						Costruire significa tutelare, valorizzare e innovare, perch&eacute; <strong style="color:#E73338">il futuro si costruisce in sicurezza</strong>.<br />
						<br />
						Il nostro impegno &egrave; certificato dalla <strong>UNI ISO 45001</strong>, che attesta l&rsquo;adozione di standard elevati nella gestione della salute e sicurezza sul lavoro.</p>

					</div>
					<style>
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
							  transition: font-weight 0.3s;
							  //white-space: nowrap; /* evita il ritorno a capo */
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
		
							.mainTextContainer li img.icon-li {
							  position: absolute;
							  left: 0;
							  top: -3px;
							  margin-left:-20px;
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
							<ul>
								<li>
									<img class="icon-li" src="{{ asset('web/images/icon_pdf_b.png') }}" alt="Certificazione UNI ISO 45001 - Sicurezza sul lavoro - {{ config('app.name') }}">
									<a href="{{ mostra_pdf_url('ISO_45001_2018.pdf', 'Certificato ISO 45001') }}" target="_blank" class="link-block" style="width:99%; text-wrap:wrap; margin-left:0;">
										<span>Scarica la certificazione UNI ISO 45001</span>
										<div class="freccia"></div>
									</a>
								</li>
							</ul>
						</div>		
				</div>		
			</div>
			<style>
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
					min-height:500px; 
				}
				

				.gallery-carousel {
				  width: 100%;
				  min-height: 300px;
				  position: sticky;
				  top: 120px;
				  z-index: 5;
				  padding-bottom: 80px; /* spazio per i bottoni */
				}

				.carousel-controls {
				  position: absolute;
				  bottom: -80px;
				  left: 0;
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
				  position: absolute;
				  width: 100%; 
				  height: 100%;
				  display: flex;
				  gap: 15px;
				  overflow-x:auto;
				  scroll-behavior: smooth;
				  scrollbar-width: none;
				  -ms-overflow-style: none
				  opacity:0;;
				}
				
				.carousel-track::-webkit-scrollbar {
				  display: none;              
				}

				.carousel-image {
				  opacity: 0;
				  height: 100%;
			  object-fit: cover;
				  transform: translateX(250px);
				  transition: opacity 1.5s cubic-bezier(0.15, 0.85, 0.3, 1), transform 1.5s cubic-bezier(0.15, 0.85, 0.3, 1);
				}

				.carousel-image.active {
				  opacity: 1;
				  transform: translateX(0);
				}
				
				@media screen AND (max-width:1100px){
					.gallery-carousel {
						  min-height: 370px !important;
					}
				}
			</style>
			<div class="layout-split-block layout-split-right">
				<div class="gallery-carousel" style="min-height:310px;">
				  <div class="carousel-track" id="carousel-track">
					<a href="web/images/operai_mob.jpg" class="glightbox" data-gallery="gallery-1">
						<img class="fade-in-slide-left single-image-1" style="position:absolute; width:100%; height:100%; object-fit:cover; object-position:center center " src="web/images/operai_mob.jpg" alt="Sicurezza sul Lavoro">
					</a>
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
	
	// 1️⃣ carousel-track animazione
	const cTrack = document.querySelectorAll('#carousel-track');
	cTrack.forEach((item, index) => {
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
    }, { threshold: 0.3 });

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