@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$filtroStato=0;
		if(request('completati')=="1") $filtroStato=1;
	@endphp
	<!-- Includi il file JavaScript di Google Maps con la tua API Key -->
	<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	
	<style>
        /* Imposta la dimensione della mappa */

		#map {
			height: calc(100vh);
			transition: width 0.3s ease;
			z-index:1;
			overflow:hidden;
		}

        .category {
			cursor: pointer;
			margin: 5px 0;
			padding: 5px 20px;
			background: #fff;
			color: #333;
			font-weight: 700;
			transition: background 0.3s, color 0.3s;
		}

		.category.active {
			background: #E41817;
			color: #fff;
		}
        .category:hover {
			background: #eaeaea;
			color: #333;
		}

		.category.active:hover {
			background: #E41817; /* Mantieni lo sfondo attivo */
			color: #fff;        /* Mantieni il colore del testo attivo */
		}
		.custom-marker{
			//background:#fff;
			background-image:url(web/images/logo_map.png);
			background-position:center 3px;
			background-size:cover;
			//border:solid 3px red;
			width:35px; 
			height:35px;
			//border-radius:50%;
			transition: all .08s
		}
		.marker-completed {
			background-image: url('web/images/logo_map_completed.png'); 
		}
		.marker-inprogress {
			background-image: url('web/images/logo_map.png');
		}

		.custom-marker:hover{
			animation: pulsazione 1.5s ease-out;
		}
		@keyframes pulsazione {
            0% {
				transform: scale(1);
			}
			6% {
				transform: scale(1.3);
			}
			12% {
				transform: scale(0.8);
			}
			18% {
				transform: scale(1.3);
			}
			50% {
				transform: scale(1);
			}
        }
		
		@keyframes pulsazione2 {
            0% {
				transform: scale(1.5);
			}
			15% {
				transform: scale(2);
			}
			100% {
				transform: scale(1.5);
			}
        }
		
		.catProg {
			margin: 15px 0px;
			font-family: Arial;
			font-size: 20px;
			cursor: pointer;
		}

		.catProgInner {
			display: inline-flex;
			border-bottom: solid 1px #D9D9D9;
			align-items: center;
		}

		.arrowProg {
			width: 10px;
			height: 10px;
			margin-top: -3px;
			margin-left: 2px;
			border-right: 2px solid #E73338;
			border-bottom: 2px solid #E73338;
			transform: rotate(-45deg);
			transition: all 0.5s ease;
		}

		.catProg:hover .nomeProg {
			font-weight: bold;
		}

		.catProg:hover .arrowProg {
			margin-left: 7px;
		}
		
		.openProg{
			width: 25px;
			height: 25px;
			margin-top:4px;
			border-right: 2px solid #000;
			border-bottom: 2px solid #000;
			transform: rotate(-45deg);
			transition: all 1s ease;
		}
		
		#navProg{
			position:absolute; 
			width:350px; 
			background:#fff; 
			left: -350px;
			top:130px; 
			z-index:100;
			transition: all 1s ease;
		}
		
		#listProg{			
			opacity:1;
			transition: all 1s ease;
		}
		
		#buttonOpenProg{
			opacity:0;
			transition: all 1s ease;
		}
		
		#buttonCloseProg{
			opacity:1;
			transition: all 1s ease;
		}
		
		#progCard{
			position:absolute; 
			width:calc(100% - 500px); 
			max-height:calc(100vh - 145px);
			min-height: 500px;
			overflow-y:scroll;
			scrollbar-width: none;
			-ms-overflow-style: none;
			background:#fff; 
			left:100%; 
			top:130px; 
			z-index:1;
			opacity:0;
			transition: opacity 0.5s ease, left 1s ease;
		}
		.progCard::-webkit-scrollbar {
		  display: none;
		}
		
		.project-detail {
		  width: 100vw;
		  height: 100vh;
		  overflow: hidden;
		  position: relative;
		  background: #000;
		  color: #fff;
		  font-family: sans-serif;
		}

		.hero {
		  position: relative;
		  width: 100%;
		  height: 100vh;
		  overflow: hidden;
		}

		.hero img {
		  width: 100%;
		  height: 100%;
		  object-fit: cover;
		  animation: kenburns 8s ease-in-out forwards;
		}

		@keyframes kenburns {
		  0% {
			transform: scale(1) translate(0, 0);
		  }
		  100% {
			transform: scale(1.2) translate(-5%, -5%);
		  }
		}

		.hero-content {
		  position: absolute;
		  top: 33%;
		  left: 5%;
		  transform: translateY(-50%);
		}

		.hero-content h1 {
		  font-size: 3rem;
		  margin: 0 0 1rem 0;
		}

		.subtitle span {
		  display: inline-block;
		  opacity: 0;
		  animation: fadeIn 1s forwards;
		}

		.subtitle span:nth-child(1) {
		  animation-delay: 0.5s;
		}
		.subtitle span:nth-child(2) {
		  animation-delay: 1.5s;
		}
		.subtitle span:nth-child(3) {
		  animation-delay: 2.5s;
		}
		.subtitle span:nth-child(4) {
		  animation-delay: 3.5s;
		}
		.subtitle span:nth-child(5) {
		  animation-delay: 4.5s;
		}

		@keyframes fadeIn {
		  to {
			opacity: 1;
		  }
		}

		.scroll-down {
		  margin-top: 2rem;
		  font-size: 2rem;
		  cursor: pointer;
		  animation: bounce 2s infinite;
		}

		@keyframes bounce {
		  0%, 100% {
			transform: translateY(0);
		  }
		  50% {
			transform: translateY(10px);
		  }
		}

		.detail-content {
		  width: 100%;
		  margin-top:20px;
		  overflow-x: hidden;
		  position: relative;
		  background: #fff;
		  color: #000;
		  height: 420px;
		}

		.scrollable-content {
		  height: 100%;
		  overflow-y: auto;
		}
		
		.close-btn {
		  position: absolute;
		  top: 33%;
		  right: 5%;
		  font-size: 3rem;
		  color: white;
		  cursor: pointer;
		  padding: 20px;
		  z-index: 10;
		  transition: transform 0.3s ease;
		}
		.close-btn:hover {
		  transform: scale(1.2);
		}
		
		.projTit{
			color:#E30613;
			font-weight:bold;
		}
		
		.project-metrics {
		  display: flex;
		  gap: 10px;
		  align-items: stretch;
		  height: auto;
		  margin-bottom:10px;
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
		  transform: translateY(-2px);
		}

		
		.catProgInner.active-cat .nomeProg {
			font-weight: bold;
		}
		
		    .gallery-carousel {
	  position: relative;
	  height: 350px;
      //height:calc(100% - 200px); 
	}
	.carousel-controls {
	  position: relative;
	  left: 50%;
	  transform: translateX(-50%);
	  display: flex;
	  gap: 10px;
	  z-index: 10;
	  margin-top:5px;
	}
	
	
	.carousel-track {
	  display: flex;
	  overflow-x: auto;
	  scroll-behavior: smooth;
	  height: 100%;
	  width: 100%; 
	  //height: calc(100% - 30px);	 
	  //scrollbar-width: none;
	  //-ms-overflow-style: none
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

	.image-wrapper {
	  display: contents;
	}
	
	.circleArrowProj {
	  width: 55px;
	  height: 55px;
	  border-radius: 50%;
	  background: #fff;
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  border: 1px solid #000;
	  cursor: pointer;
	  transition: background 0.3s ease;
	}
	
	.circleArrowProj:hover {
	  background: #E30613;
	  border-color: #E30613;
	}
	
	.circleArrowProj:hover .circleArrowProjIcon {
	  border-color: #fff !important;
	}
	
	.custom-marker.highlighted {
		transform: scale(1.5);
		animation: pulsazione2 1.5s ease-out infinite;
	}


		

		
		#buttonCloseProg{position:absolute; bottom:10px; right:15px; cursor:pointer;}
		@media screen AND (max-width:400px){
			#buttonCloseProg{left:25px};
		}
		
    </style>
	
	<div style="position:relative; width:100%; overflow:hidden">		
		<div id="map"></div>
		
		<div id="navProg">
			<div style="padding:30px 15px 50px 25px" id="listProg">
				@php
					$categorie = DB::table('categorie')
						->select('nome')
						->orderBy('ordine','DESC')
						->get();
				@endphp

				<div style="width:100%; border-bottom:solid 1px #000; font-family:Arial; font-weight:bold; font-size:30px; padding-bottom:5px">
					Progetti
				</div>

				<div class="catProg">
					<div class="catProgInner active-cat" data-category="Tutti">
						<div class="nomeProg">Tutti</div>
						<div class="arrowProg"></div>
					</div>
				</div>

				@foreach($categorie as $cat)
					<div class="catProg">
						<div class="catProgInner" data-category="{{ $cat->nome }}">
							<div class="nomeProg">{{ $cat->nome }}</div>
							<div class="arrowProg"></div>
						</div>
					</div>
				@endforeach
				@if($filtroStato)
					<style>
						.status-btn {
							display: inline-block;
							padding: 5px 16px;
							margin-right: 10px;
							background-color: #eaeaea;
							color: #000;
							font-weight: bold;
							border-radius: 20px;
							cursor: pointer;
							transition: all 0.3s ease;
						}

						.status-btn.active {
							background-color: #E41817;
							color: #fff;
						}
						.statusFilter{display:flex; gap:5px;}
					</style>
					<div id="statusFilter" style="margin-top: 20px;">
						<div class="status-btn" data-status="Lavoro in corso">In corso</div>
						<div class="status-btn" data-status="Lavoro completato">Completati</div>
					</div>
				@endif
			</div>
			<div id="buttonCloseProg">
				<img src="web/images/clode_panel.png" style="width:30px;" alt="Chiudi"/>
			</div>
			
			<div style="position:absolute; width:33px; height:35px; right:5px; top:50%; transform:translateY(-50%); cursor:pointer; " id="buttonOpenProg">
				<div class="openProg"></div>
			</div>
		</div>
		
		<div id="progCard">
			<div style="position:absolute; top:15px; right:15px; cursor:pointer;" id="buttonCloseCard">
				<img src="web/images/clode_panel.png" style="width:30px;" alt="Chiudi"/>
			</div>
		</div>
	</div>
		<!-- GLightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
		function getURLParams() {
			const params = new URLSearchParams(window.location.search);
			return {
				category_ric: params.get('category'),
				id: params.get('id')
			};
		}
		const { category_ric, id } = getURLParams();		
		function calculateImageWidths() {
		  const images = document.querySelectorAll('.carousel-image');
		  const Widths = [];

		  images.forEach((img) => {
			const style = window.getComputedStyle(img);
			const width = img.offsetWidth;
			const marginRight = parseFloat(style.marginRight) || 0;
			Widths.push(width + marginRight);
		  });

		  return Widths;
		}

		function easeInOutCubic(t) {
		  return t < 0.5
			? 4 * t * t * t
			: 1 - Math.pow(-2 * t + 2, 3) / 2;
		}


		function smoothScrollTo(element, target, duration) {
		  const start = element.scrollLeft;
		  const change = target - start;
		  const startTime = performance.now();

		  function animateScroll(currentTime) {
			const timeElapsed = currentTime - startTime;
			const t = Math.min(timeElapsed / duration, 1); // Clamp to [0,1]
			const eased = easeInOutCubic(t);

			element.scrollLeft = start + change * eased;

			if (t < 1) {
			  requestAnimationFrame(animateScroll);
			}
		  }

		  requestAnimationFrame(animateScroll);
		}

		
		function initCarousel(carouselContainer) {
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
		
		document.getElementById("buttonCloseProg").addEventListener("click", () => {
			document.getElementById('buttonOpenProg').style.opacity='1';
			document.getElementById('buttonCloseProg').style.opacity='0';
			document.getElementById('listProg').style.opacity='0';
			document.getElementById('navProg').style.left='-310px';
			
		});
		document.getElementById("buttonOpenProg").addEventListener("click", () => {
			document.getElementById('buttonCloseProg').style.opacity='1';
			document.getElementById('buttonOpenProg').style.opacity='0';
			document.getElementById('listProg').style.opacity='1';
			document.getElementById('navProg').style.left='0px';
			//setupCarouselScroll(); 
		});
		document.getElementById("buttonCloseCard").addEventListener("click", () => {
			const card = document.getElementById('progCard');
			const gallery = document.querySelector('.gallery-carousel');
			const images = document.querySelectorAll('.carousel-image');

			card.style.opacity = '0';
			card.style.left = '100%';

			// Reset animazioni gallery per usi futuri
			gallery.classList.remove('visible');
			images.forEach(img => img.classList.remove('show'));
		});

		
		function loadInfoBoxContent(id) {
			// Verifica che l'ID sia valido
			if (!id) {
				console.error("ID non valido!");
				return;
			}

			// Chiamata AJAX
			$.ajax({
				url: 'web/ajax/schede-mappa.php', // URL dell'endpoint
				type: 'POST', // Metodo HTTP
				data: { id: id }, // Passa l'ID al server
				dataType: 'html', // Attende un risultato in formato HTML
				success: function(response) {
					// Inserisce l'HTML ricevuto nella div
					$('#interactiveMapInfoBox').html(response);
				},
				error: function(xhr, status, error) {
					// Gestione degli errori
					console.error('Errore durante il caricamento dei dati:', error);
					$('#interactiveMapInfoBox').html('<p>Errore nel caricamento delle informazioni.</p>');
				}
			});
		}
		
		// Definizione dei dati (puoi sostituirli con un JSON dinamico)
		
		@php
			$p=0;
			if($filtroStato){
				$query_punti = DB::table('punti_mappa')
					->select('*')
					->where('visibile', '=', '1')
					->get();
			}else{
				$query_punti = DB::table('punti_mappa')
					->select('*')
					->where('visibile', '=', '1')
					->where('stato', '=', 'Lavoro in corso')
					->get();					
			}
		@endphp
		@foreach($query_punti AS $key_punti=>$value_punti)
			@php
			$locations = [];
			foreach ($query_punti as $punto) {
				$cat = DB::table('categorie')->where('id', $punto->categoria)->value('nome');

				$locations[] = [
					'lat' => floatval($punto->latitudine),
					'lng' => floatval($punto->longitudine),
					'category' => $cat,
					'stato' => $punto->stato,
					'title' => "{$punto->titolo}",
					'ID' => $punto->id,
				];
			}
			@endphp
		@endforeach
		
		
		const locations = {!! json_encode($locations, JSON_UNESCAPED_UNICODE) !!};
		

		// URL immagine marker
		//const markerImage = "web/img/map-marker3.png";
		const maxZoomVal = 12;
		
		let map, markerCluster, markers = [];

        // Funzione per inizializzare la mappa
        function initMap() {
            // Centro della mappa (latitudine e longitudine)
            const statoColors = {
				"Lavoro in corso": "#E41817",
				"Lavoro completato": "#818181"
			};

			const mapCenter = { lat: 41.8719, lng: 12.5674 }; // Centro Italia
            
            // Creazione della mappa
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 6, // Livello di zoom
                center: mapCenter, // Centro della mappa
				mapId: "41f00d557daad5ae",
				maxZoom: maxZoomVal,
				mapTypeControl: true,
				fullscreenControl: true,
				mapTypeControlOptions: {
					position: google.maps.ControlPosition.BOTTOM_LEFT, // Sposta il selettore mappa/satellite
				},
				fullscreenControl:false
            });
			
			locations.forEach((location) => {
				// Creazione del contenuto HTML per il marker
				const markerElement = document.createElement("div");
				//markerElement.className = 'custom-marker';
				markerElement.className = 'custom-marker ' + (location.stato === 'Lavoro completato' ? 'marker-completed' : 'marker-inprogress');

				// Creazione del marker avanzato
				const marker = new google.maps.marker.AdvancedMarkerElement({
					position: { lat: location.lat, lng: location.lng },
					map,
					content: markerElement,
					title: location.title,
				});
				marker.content.dataset.id = location.ID;
				marker.content.dataset.stato = location.stato;

				// Listener per il click sul marker
				marker.addListener("click", () => {
					const id = marker.content.dataset.id;
					const card = document.getElementById('progCard');
					const viewportWidth = window.innerWidth || document.documentElement.clientWidth;					
										
					if (viewportWidth > 1500) {
						card.style.left = '400px';
					} else if (viewportWidth > 1200 && viewportWidth <= 1500) {
						card.style.left = '400px';
						card.style.width = 'calc(100% - 450px)';
					} else if (viewportWidth > 1090 && viewportWidth <= 1200) {
						document.getElementById('buttonOpenProg').style.opacity='1';
						document.getElementById('buttonCloseProg').style.opacity='0';
						document.getElementById('listProg').style.opacity='0';
						document.getElementById('navProg').style.left='-310px';
			
						card.style.left = '50%';
						card.style.marginLeft = '-500px';
						card.style.width = '1000px';
					} else if (viewportWidth > 780 && viewportWidth <= 1090) {
						document.getElementById('buttonOpenProg').style.opacity='1';
						document.getElementById('buttonCloseProg').style.opacity='0';
						document.getElementById('listProg').style.opacity='0';
						document.getElementById('navProg').style.left='-310px';
			
						card.style.left = '50%';
						card.style.marginLeft = '-350px';
						card.style.width = '700px';
						card.style.overflowY = 'scroll';
					} else if (viewportWidth <= 780) {
						document.getElementById('buttonOpenProg').style.opacity='1';
						document.getElementById('buttonCloseProg').style.opacity='0';
						document.getElementById('listProg').style.opacity='0';
						document.getElementById('navProg').style.left='-310px';
						
						card.style.left = '5%';
						card.style.marginLeft = '0';
						card.style.width = '90%';
						card.style.overflowY = 'scroll';
					}

					// Carica contenuto via AJAX
					const BASE_URL = "{{ url('/') }}";
					fetch(`${BASE_URL}/get-project-card`, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: JSON.stringify({ id })
					})
					.then(response => response.text())
					.then(html => {
						card.innerHTML = `
							  <div style="position:absolute; top:15px; right:15px; cursor:pointer;" id="buttonCloseCard">
								<img src="web/images/clode_panel.png" style="width:30px;" alt="Chiudi"/>
							  </div>
							  ${html}
							`;

						setTimeout(() => {
							card.style.opacity = '1';
						}, 200);

						setTimeout(() => {
							const gallery = document.querySelector('.gallery-carousel');
							const images = document.querySelectorAll('.carousel-image');
							const viewportHeight = window.innerHeight || document.documentElement.clientHeight;
							//gallery.style.minHeight = (viewportHeight - 500) + "px";

							if (viewportWidth <= 780) {
								const projContainer = document.querySelector('.projContainer');
								projContainer.style.flexDirection = 'column';
								projContainer.style.gap = '30px';
							}

							images.forEach(img => img.classList.add('show'));
							//setupCarouselScroll();
							initCarousel(gallery); 

							// 💡 Re-inizializza GLightbox qui!
							GLightbox({
								selector: '.glightbox',
								touchNavigation: true,
								loop: true,
							});
						}, 800);
					});
					
				});



				// Listener per l'hover (mouseover e mouseout)
				marker.addListener("mouseover", () => {
					markerElement.style.transform = "scale(1.2)";
				});
				marker.addListener("mouseout", () => {
					markerElement.style.transform = "scale(1)";
				});

				// Aggiunta del marker alla lista
				markers.push({ marker, category: location.category });
				
				
			});
			
			if (id) {
				const point = markers.find(m => m.marker.content.dataset.id == id);
				if (point) {
					map.setZoom(12);
					map.setCenter(point.marker.position);

					// Applica classe "highlighted" per ingrandimento e animazione
					point.marker.content.classList.add('highlighted');
				}
			}
			
			// Renderer personalizzato per i cluster
			const customRenderer = {
				render({ count, position, markers }) {
					const stati = markers.map(m => m.stato);
					const hasCompleted = stati.includes("Lavoro completato");
					const hasInProgress = stati.includes("Lavoro in corso");

					let color = statoColors["Lavoro in corso"]; // default
						if (hasCompleted && !hasInProgress) {
							color = statoColors["Lavoro completato"];
						} else if (hasCompleted && hasInProgress) {
							color = "#b24d4c"; // stato misto
						}
						
					const div = document.createElement("div");
					div.style.position = "absolute";
					div.style.transform = "translate(-50%, -50%)";
					div.style.width = "50px";
					div.style.height = "50px";

					div.innerHTML = `
						<svg xmlns="http://www.w3.org/2000/svg" fill="${color}" viewBox="0 0 240 240" width="50" height="50">
							<circle cx="120" cy="120" opacity=".6" r="70"></circle>
							<circle cx="120" cy="120" opacity=".3" r="90"></circle>
							<circle cx="120" cy="120" opacity=".2" r="110"></circle>
							<text x="50%" y="50%" style="fill:#fff" text-anchor="middle" font-size="50" dominant-baseline="middle" font-family="roboto,arial,sans-serif">${count}</text>
						</svg>
					`;

					return new google.maps.marker.AdvancedMarkerElement({
						position,
						content: div,
					});
				}
,
			};
			
			// Creazione del cluster
			markerCluster = new markerClusterer.MarkerClusterer({
				map,
				markers: markers.map((m) => m.marker),
				renderer: customRenderer,
				maxZoom: maxZoomVal, // Livello massimo raggiungibile cliccando su un cluster
				zoomOnClick: true, // Abilita/disabilita lo zoom al clic su un cluster
				minimumClusterSize: 2, // Numero minimo di marker per formare un cluster
			});

			
			// Filtra i marker in base alla categoria
			function filterMarkers(category) {
				markerCluster.clearMarkers();
				const filteredMarkers = markers
					.filter((m) => m.category === category)
					.map((m) => m.marker);
				markerCluster.addMarkers(filteredMarkers);
			}
				
			
			// Avvia la mappa
			window.initMap = initMap;

			document.querySelectorAll('.catProgInner').forEach((el) => {
				const elCategory = el.getAttribute('data-category');

				function activateCategoryLogic() {
					// Rimuove tutte le classi attive
					document.querySelectorAll('.catProgInner').forEach(el2 => el2.classList.remove('active-cat'));
					el.classList.add('active-cat');

					// Chiude la card
					const card = document.getElementById('progCard');
					card.style.opacity = '0';
					card.style.left = '100%';

					const gallery = document.querySelector('.gallery-carousel');
					const images = document.querySelectorAll('.carousel-image');
					gallery?.classList.remove('visible');
					images.forEach(img => img.classList.remove('show'));

					// Applica i marker filtrati
					if (elCategory === 'Tutti') {
						markerCluster.clearMarkers();
						markerCluster.addMarkers(markers.map((m) => m.marker));
					} else {
						const filteredMarkers = markers
							.filter((m) => m.category === elCategory)
							.map((m) => m.marker);
						markerCluster.clearMarkers();
						markerCluster.addMarkers(filteredMarkers);
					}

					// Reset della vista
					map.setZoom(6);
					map.setCenter({ lat: 41.8719, lng: 12.5674 });
				}

				// CLICK handler
				el.addEventListener('click', activateCategoryLogic);

				// Se c'è una categoria da URL e corrisponde a questa, attiva la logica
				if (category_ric && category_ric === elCategory) {
					markerCluster.clearMarkers();
					markers.forEach(({ marker }) => marker.setMap(null));
					activateCategoryLogic();
				}
			});

        }			
		

		
		document.addEventListener('DOMContentLoaded', () => {
			let currentStatusFilter = "Lavoro in corso"; // default
			let currentCategoryFilter = "Tutti";         // default

			function applyFilters() {
				const visibleMarkers = markers.filter(({ marker, category }) => {
					const matchesCategory = (currentCategoryFilter === "Tutti" || category === currentCategoryFilter);
					@if($filtroStato)
						const matchesStatus = !currentStatusFilter || marker.stato === currentStatusFilter;
					@else
						const matchesStatus = marker.stato === "Lavoro in corso";
					@endif
					return matchesCategory && matchesStatus;
				}).map(({ marker }) => marker);

				markerCluster.clearMarkers();
				markerCluster.addMarkers(visibleMarkers);
			}

			@if($filtroStato)
				// Gestione click sui bottoni di stato
				document.querySelectorAll('.status-btn').forEach(btn => {
					btn.addEventListener('click', () => {
						if (btn.classList.contains('active')) {
							btn.classList.remove('active');
							currentStatusFilter = ""; // disattiva il filtro
						} else {
							document.querySelectorAll('.status-btn').forEach(b => b.classList.remove('active'));
							btn.classList.add('active');
							currentStatusFilter = btn.dataset.status;
						}
						applyFilters();
					});
				});
			@endif

			// Aggiusta il filtro quando cambia categoria
			document.querySelectorAll('.catProgInner').forEach((el) => {
				el.addEventListener('click', () => {
					currentCategoryFilter = el.getAttribute('data-category');
					applyFilters();
				});
			});

			
			setTimeout(() => {
				document.getElementById('navProg').style.left = '0px';
				document.getElementById('listProg').style.opacity = '1';
				document.getElementById('buttonCloseProg').style.opacity = '1';
			}, 500); // leggero delay per effetto smooth
		});



  function getViewportHeight() {
	  return window.innerHeight || document.documentElement.clientHeight;
	}
  document.addEventListener("DOMContentLoaded", () => {
	  const lightbox = GLightbox({
		selector: '.glightbox',
		touchNavigation: true,
		loop: true,
	  });
	  
	});
	document.body.addEventListener('click', function(e) {
	if (e.target.closest('#buttonCloseCard')) {
		const card = document.getElementById('progCard');
		card.style.opacity = '0';
		card.style.left = '100%';
	}
});

    </script>
	
	<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api_key') }}&callback=initMap&libraries=marker">
    </script>
@endsection	