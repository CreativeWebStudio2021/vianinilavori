@include('web.common.functions')
@extends('web.layout')

@section('content')
	<style>
		.google-map-container {
		  width: 100%;
		  height: 400px;
		  position: relative;
		}

		.google-map {
		  width: 100%;
		  height: 100%;
		}

	</style>
	<div class="google-map-container">
	  <div class="google-map" id="google-map"></div>
	</div>
	
	<style>
		.layout-split-container {
		  margin: 0 auto;
		  display: flex;
		  gap: 50px; 
		  margin-bottom:100px;
		}

		.layout-split-block {
		  flex: 1;
		  display: flex;
		  flex-direction: column;
		  font-family: sans-serif;
		}

		.layout-split-left {
		  flex: 0 0 calc(60% - 25px);
		}

		.layout-split-right {
		 flex: 0 0 calc(40% - 25px);
		}
		
		.expand-block {
		  position: relative;
		  overflow: hidden;
		  margin-bottom: 20px;
		}

		.expand-block__header {
		  position: relative;
		  padding: 15px 10px 15px 0;
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
		  font-weight: 400;
		  position: relative;
		  z-index: 2;
		}

		.expand-block__title .bold {
		  font-weight: bold;
		}

		.expand-block__content {
		  display: block;
		  padding: 20px 0;
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
		
		.form-control{
			width:100%; 
			min-height:30px; 
			margin:5px 0 15px; 
			border-radius:5px; 
			border:solid 1px #d5d5d5; 
			padding:5px;}
			
		.boxForm{padding:10px 30px}	
		
		.expand-block__title span {font-size:30px !important;}
		.formRiga1{gap:30px;}
		@media screen AND (max-width:900px){
			.layout-split-container{flex-direction:column}
		}
		@media screen AND (max-width:600px){
			.formRiga1{flex-direction:column; gap:0px;}
		}
		
		@media screen AND (max-width:400px){
			.boxForm{padding:10px 15px}	
			.form-control{width:95%;}
			.mainTextContainer{calc(100% - 20px) !important}
		}
		
		#pageContainer {
			background: url(web/images/v_grigia.png) no-repeat top center;
			//background-size: cover;
			background-attachment: scroll; /* default */
			position: relative;
			z-index: 1;
			overflow: hidden;
			padding-bottom:80px;
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
	<div style="width:100%;  padding-top:60px;" id="">	
		<section style="width:100%;">
			<div class="mainTextContainer">
				<div class="layout-split-container">
					<div class="layout-split-block layout-split-left">
						<div class="expand-block">
							<div class="expand-block__content" style="background:rgba(245,245,245,1); margin-top:20px;">
								<div class="boxForm">
									<div class="expand-block__header" style=" background:none; margin-bottom:30px;">
										<div class="expand-block__bg-hover"></div>
										<div class="expand-block__title">
											<span>Contatti</span>
										</div>
									</div>
									<form action="{{ url('/invia-contatto') }}" method="POST" name="contactFormAdvanced" id="contactFormAdvanced" autocomplete="off"  enctype="multipart/form-data">
										@csrf
										
										@if(session('success'))
											<div class="alert alert-success" style="background-color:#d4edda; color:#155724; padding:10px 15px; border-radius:4px; margin-bottom:20px;">
												{{ session('success') }}
											</div>
										@endif

										@if(session('error'))
											<div class="alert alert-danger" style="background-color:#f8d7da; color:#721c24; padding:10px 15px; border-radius:4px; margin-bottom:20px;">
												{{ session('error') }}
											</div>
										@endif

										<input type="hidden" value="true" name="emailSent" id="emailSent">

										<div style="display:flex;" class="formRiga1">
											<div style="display: flex; flex:1; flex-direction: column;">
												<span>Nome</span>
												<input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
											</div>
											<div style="display: flex; flex:1; flex-direction: column;">
												<span>Cognome</span>
												<input type="text" name="cognome" class="form-control" value="{{ old('cognome') }}" required>
											</div>
										</div>

										<div style="display:flex; gap:30px;">
											<div style="display: flex; flex:1; flex-direction: column;">
												<span>E-mail</span>
												<input type="text" name="email" class="form-control" value="{{ old('email') }}" required>
											</div>
										</div>
										
										<input type="text" name="fax_number" style="display:none" autocomplete="off">

										<div style="display:flex; gap:30px;">
											<div style="display: flex; flex:1; flex-direction: column;">
												<span>Messaggio</span>
												<textarea name="messaggio" class="form-control" rows="5" required>{{ old('messaggio') }}</textarea>
											</div>
										</div>

										<div class="row">
											<div class="form-group col-md-12">
												<?php /*<p class="mb-2">Accetta Trattamento dei dati <span style="color:{{ config('app.color1') }}">*</span></p>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="1" required> Accetto
													</label>
												</div>
												<p class="mb-2"><strong>Prima dell’invio del messaggio</strong> La invitiamo a <a href="privacy-policy.html" style="color:#E30613; text-decoration:underline;" target="_blank">consultare l’Informativa Privacy</a>.</p>*/?>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="1" required> 
														Dichiaro di aver preso visione dell'<a href="privacy-policy.html" target="_blank" style="text-decoration:underline">informativa privacy</a> resa ai sensi dell'art. 13 GDPR.
													</label>
												</div>
											</div>
										</div>
										
										<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
										
										<button type="submit" style="
											width: 190px;
											padding: 10px 5px;
											background: #E30613;
											border-radius: 26px;
											border: solid 1px #fff;
											cursor: pointer;
											margin-top: 20px;
											font-size: 16px;
											color: #fff;
											font-weight: bold;
											text-align: center;
											text-transform: uppercase;
											display: block;
											transition: background 0.3s ease;
										">INVIA</button>
									</form>
									<script src="https://www.google.com/recaptcha/api.js?render={{ config('app.google_recaptcha_public_key') }}"></script>
									<script>
										grecaptcha.ready(function() {
											grecaptcha.execute('{{ config('app.google_recaptcha_public_key') }}', {action: 'invia_contatto'}).then(function(token) {
												document.getElementById('g-recaptcha-response').value = token;
											});
										});
									</script>
								</div>
							</div>
						</div>		
					</div>
					
					
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
						  padding: 0px 10px;
						  margin: 10px 0; /* spazio sopra e sotto */
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
						  font-family: 'Arial', sans-serif;
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
						.iso-item:hover .iso-left {
						  color: #E73338;
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
						  font-size: 20px;
						}

						.iso-subtitle {
						  font-size: 20px;	  
						}
						.iso-subtitle a{color:#E73338;}
						.boxRecapiti{margin-top:60px;}
						
						@media screen AND (max-width:900px){
							.boxRecapiti{margin-top:0px;}						
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
							
							.iso-content{padding:0px 10px 0 10px;}
						}
						
						@media screen AND (max-width:600px){
							.iso-right img {
								width: 45px;
								height: 45px;
							}
							.iso-item{padding:0};
						}
						
						
						</style>

					<div class="layout-split-block layout-split-right">
						<div class="expand-block">
							<div class="expand-block__header boxRecapiti" style=" background:none; ">
								<div class="expand-block__bg-hover"></div>
								<div class="expand-block__title">
									<span>Recapiti</span>
								</div>
							</div>
							<div class="iso-list" style="margin-bottom:20px;">
									<div class="iso-wrapper">
										<a href="https://maps.app.goo.gl/BizmQh13qLgeqqzx8" target="_blank">
											<div class="iso-item"  data-index="1">
											  <div class="bg-hover"></div>
											  <div class="iso-left" style="width:32px;">
												<i class="fas fa-map-marker-alt" style="font-size:2.3em;"></i>
											  </div>
											  <div class="iso-content">
												<div class="iso-title">Indirizzo:</div>
												<div class="iso-subtitle">via Barberini, 11 - 00187 Roma (RM)</div>
											  </div>
											  <div class="iso-right">
												
											  </div>
											</div>
										</a>
								  </div>
								  <div class="iso-wrapper">
										<a href="tel:+39 06374921">
											<div class="iso-item"  data-index="1">
											  <div class="bg-hover"></div>
											  <div class="iso-left">
												<i class="fas fa-phone-alt" style="font-size:2em;"></i>
											  </div>
											  <div class="iso-content">
												<div class="iso-title">Telefono:</div>
												<div class="iso-subtitle">06.37.49.21</div>
											  </div>
											  <div class="iso-right">
												
											  </div>
											</div>
										</a>
								  </div>
								  <div class="iso-wrapper">
										<a href="mailto:info@vianinilavori.it">
											<div class="iso-item"  data-index="1">
											  <div class="bg-hover"></div>
											  <div class="iso-left">
												<i class="fas fa-envelope" style="font-size:2em;"></i>
											  </div>
											  <div class="iso-content">
												<div class="iso-title">Email:</div>
												<div class="iso-subtitle">info@vianinilavori.it</div>
											  </div>
											  <div class="iso-right">
												
											  </div>
											</div>
										</a>
								  </div>
							</div>
							
							<div class="expand-block__header " style=" background:none; ">
								<div class="expand-block__bg-hover"></div>
								<div class="expand-block__title">
									<span>Social</span>
								</div>
							</div>
							<div class="iso-list" style="margin-top:10px; margin-bottom:0px">
								<a href="https://www.linkedin.com/company/vianini-lavori-s-p-a-/" target="_blank">
									<img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="Seguici su Linkedin" width="45" style="margin-right:8px">
								</a>
								<a href="https://www.instagram.com/vianinilavorispa/" target="_blank">
									<img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Seguici su Instagram" width="45" style="margin-right:8px">
								</a>
							</div>
						</div>
						
						<div class="expand-block">
							<div class="expand-block__header" style=" background:none;">
								<div class="expand-block__bg-hover"></div>
								<div class="expand-block__title">
									<span>Clicca per aprire il tuo navigatore</span>
								</div>
							</div>
							<div class="iso-list">
								  <div class="iso-wrapper">
										<a href="https://maps.apple.com/?address=Via%20Barberini%2011,%2000187%20Roma,%20Italia&ll=41.904194,12.490213&q=Via%20Barberini%2011&_ext=EiYpUvQbcinzREAxVl9UM+b3KEA50MlBzk/0REBBJOntOBT+KEBQBA%3D%3D" target="_blank">
											<div class="iso-item"  data-index="1">
											  <div class="bg-hover"></div>
											  <div class="iso-left">
												<img style="width:40px;" src="web/images/ico-apple-mappe.png" alt="Apple Maps"/>
											  </div>
											  <div class="iso-content">
												<div class="iso-title">Apple Maps</div>
											  </div>
											  <div class="iso-right">
												
											  </div>
											</div>
										</a>
								  </div>
								  <div class="iso-wrapper">
										<a href="https://maps.app.goo.gl/Qe4NvTYaaN53pukf8" target="_blank">
											<div class="iso-item"  data-index="1">
											  <div class="bg-hover"></div>
											  <div class="iso-left">
												<img style="width:40px;" src="web/images/ico-google_maps.png" alt="Google Maps"/>
											  </div>
											  <div class="iso-content">
												<div class="iso-title">Google Maps</div>
											  </div>
											  <div class="iso-right">
												
											  </div>
											</div>
										</a>
								  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
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
</script>
	
	<script>
	  function initMap() {
		const location = { lat: 41.90412, lng: 12.4902 }; // Coordinate approssimative di Via Barberini 11, Roma

		const map = new google.maps.Map(document.getElementById("google-map"), {
		  center: location,
		  zoom: 16,
		});

		const marker = new google.maps.Marker({
		  position: location,
		  map: map,
		  title: "Via Barberini 11, Roma",
		  icon: {
			url: "web/images/logo_map.png", // Sostituisci con l'URL della tua icona personalizzata
			scaledSize: new google.maps.Size(40, 40), 
			
		  },
		});
	  }
	</script>

	<script async
	  src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api_key') }}&callback=initMap">
	</script>

@endsection	