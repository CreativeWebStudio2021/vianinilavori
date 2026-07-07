@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "RASSEGNA<br/>STAMPA";
		$img_background="web/images/header_Rassegna_Stampa_e_News.jpg";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Chi Siamo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<style>
		.iso-list {
		  width: 100%;
		  margin-bottom: 80px;
		}

		.iso-wrapper {
		  position: relative;
		  padding-bottom: 0px;
		  border-bottom: 2px solid #000;
		  overflow: hidden;
		}

		.iso-item {
		  position: relative;
		  padding: 15px 20px;
		  overflow: hidden;
		  display: flex;
		  align-items: center;
		  cursor: pointer;
		}

		/* Sfondo in entrata animata */
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

		.iso-item:hover .bg-hover,
		.iso-item.selected .bg-hover {
		  width: 100%;
		}

		.iso-content {
		  flex: 1;
		  flex-direction: column;
		  font-size: 30px;
		  font-family: Arial, sans-serif;
		  display: flex;
		  gap: 10px;
		  color: #000;
		  font-weight: 400;
		  position: relative;
		  z-index: 2;
		}

		.iso-content .bold {
		  font-weight: bold;
		}

		.iso-right {
		  width: 55px;
		  height: 55px;
		  position: relative;
		  z-index: 2;
		}

		.arrow-down, .icon-close {
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%) rotate(45deg);
		  width: 18px;
		  height: 18px;
		  border-right: 2px solid #000;
		  border-bottom: 2px solid #000;
		  transition: all 0.3s ease;
		}

		.arrow-down {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%) rotate(45deg);
			width: 18px;
			height: 18px;
			border-right: 2px solid #000;
			border-bottom: 2px solid #000;
			transition: all 0.3s ease;
		}

		.iso-item:hover .arrow-down {
			border-color: #E73338;
		}

		.icon-close-img {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			display: none;
		}


		.icon-close {
		  transform: translate(-50%, -50%) rotate(-135deg);
		  display: none;
		}

		.iso-item.selected .arrow-down {
		  display: none;
		}

		.iso-item.selected .icon-close {
		  display: block;
		}

		.iso-pdf-preview {
		  display: none;
		  padding: 20px;
		  position: relative;
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
		
		.detail-content {
		  width: 100%;
		  margin-top:20px;
		  overflow-x: hidden;
		  position: relative;
		  color: #000;
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
		  font-size: 30px;
		  font-weight: bold;
		  display: flex;
		  align-items: center;
		}

		.metric-label {
		  font-size: 20px;
		  display: flex;
		  align-items: flex-end;
		  transform: translateY(-4px);
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
			position:relative;
			min-height:500px; 
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
		}
		
		.carousel-track::-webkit-scrollbar {
		  display: none;              
		}

		.carousel-image {
		  opacity: 0;
		  transform: translateX(250px);
		  transition: opacity 1.5s cubic-bezier(0.15, 0.85, 0.3, 1), transform 1.5s cubic-bezier(0.15, 0.85, 0.3, 1);
		}

		.carousel-image.show {
		  opacity: 1;
		  transform: translateX(0);
		}

		
		.iso-wrapper {
		  opacity: 0;
		  transform: translateY(40px);
		  animation: fadeUp 0.6s ease-out forwards;
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

		.iso-content span{
				font-size:30px;
			}
		
		.categoria-pill {
		  display: inline-block;
		  margin-left: 10px;
		  padding: 2px 15px;
		  background: #D9D9D9; /* stesso colore dello sfondo hover */
		  border-radius: 15px;
		  font-size: 1em !important;
		  color: #000;
		  transition: background 0.3s ease;
		}
		.data-pill {
			font-size:0.5em
		}
		
		.data-pill, .categoria-pill{font-size:20px !important;}
		
		.iso-item:hover .categoria-pill {
		  background: #f0f0f0;
		}
		
		.gapPill{display:none}
		
		@media screen AND (max-width:500px){
			.iso-content span{
				font-size:20px;
			}
			.data-pill, .categoria-pill{font-size:15px !important;}			
			.iso-item{padding:15px 10px !important;}
			.gapPill{display:inline}
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
			
		.news-body-content {
		  text-align: justify;
		}

		.news-body-content p,
		.news-body-content div,
		.news-body-content span,
		.news-body-content li {
		  text-align: justify;
		}
		@media screen AND (max-width:650px){
			.news-body-content {
			  text-align: left !important;
			}
			
			.news-body-content p,
			.news-body-content div,
			.news-body-content span,
			.news-body-content li {
			  text-align: left !important;
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
		@media screen AND (max-width:500px){
			.mainTextContainer {	width:calc(100% - 120px) !important; }
		}
	</style>	
	
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">	
		<section style="width:100%;">
			<div class="mainTextContainer">
				<div class="iso-list">				
				
					@php
						$query = DB::table('comunicati_stampa')->select('*')->where('visibile', '=', '1');					
						$query->orderby('data_news', 'DESC');
						$query_news = $query->get();
					@endphp
					@foreach($query_news AS $key_news=>$value_news)
					@php $index = $value_news->id; @endphp
					<div class="iso-wrapper">
						<div class="iso-item" data-index="{{ $index }}">
							<div class="bg-hover"></div>
							<div class="iso-content">
								<span class="bold">{{ $value_news->titolo }}</span>
								<span class="data-pill">{{ date_to_data($value_news->data_news) }}@if(isset($value_news->testata) && $value_news->testata!="")<span class="gapPill"><br/></span><span class="categoria-pill">{{$value_news->testata}}</span>@endif</span>
							</div>
							<div class="iso-right">
								<div class="arrow-down"></div>
								<img src="web/images/clode_panel.png" class="icon-close-img" style="display:none; width: 30px; height: 30px;" alt="Close Icon">
							</div>
						</div>
						<div class="iso-pdf-preview" id="pdf-preview-{{ $index }}">
							<div class="detail-content" id="detail-content">
								<div class="scrollable-content">
									<div style="padding:0px;">
										<div style="width:100%; display:flex; gap:20px">
											<div style="flex:1;">
												@if(isset($value_news->sottotitolo))
													<span class="projTit">{{$value_news->sottotitolo}}</span>
												@endif
												<div style="margin-top:25px;">
													<div style=" font-size:20px;" class="news-body-content">
														{!! $value_news->testo !!}
													</div>
												</div>
												@php
													$linkUrl = null;
													$linkText = 'LINK';
													if (!empty($value_news->link)) {
														$linkUrl = $value_news->link;
													}

													if (!empty($value_news->pdf)) {
														$linkUrl = 'resarea/files/comunicati/' . $value_news->pdf;
														$linkText = 'APRI PDF';
													}


													if (!empty($value_news->testo_link)) {
														$linkText = strtoupper($value_news->testo_link);
													}
												@endphp

												@if($linkUrl)
													<div style="display:flex; gap:15px;">
														<div style="width:190px; height:auto; padding:10px 5px; background:#E30613; border-radius:26px; border:solid 1px #fff; cursor:pointer; margin-top:40px;">
															<a href="{{ $linkUrl }}" target="_blank" style="text-decoration:none">
																<div style="font-size:16px; color:#fff; width:100%; text-align:center;">
																	<b>{{ $linkText }}</b>
																</div>
															</a>
														</div>
													</div>
												@endif

												
											</div>
											
											
											@php
												$imgs = collect([
													$value_news->img ?? null,
													$value_news->img2 ?? null,
													$value_news->img3 ?? null
												])->filter()->values();
											@endphp

											@if($imgs->isNotEmpty())
												<div style="flex:1;">
														<div class="gallery-carousel">
															<div class="carousel-track" id="carousel-track-{{ $index }}">
																@foreach($imgs as $i => $img)
																	<img src="resarea/img_up/comunicati/{{ $img }}" alt="{{ $value_news->titolo }} - Immagine {{ $i+1 }}" class="carousel-image">
																@endforeach
															</div>
														</div>

														@if($imgs->count() > 1)
															<div style="position:relative; width:100%; height:100px;">
																<!-- BOTTONE NEXT -->
																<div id="nextBtnProj-{{ $index }}" class="circleArrowProj" style="position:absolute; left:90px; top:10px; width:68px; height:68px; border-radius:35px;">
																	<div class="circleArrowProjIcon" style="position:absolute; width:30px; height:30px; top:17px; left:12px; border-right:2px solid; border-bottom:2px solid; transform:rotate(-45deg);"></div>
																</div>
																<!-- BOTTONE PREV -->
																<div id="prevBtnProj-{{ $index }}" class="circleArrowProj" style="position:absolute; left:0px; top:10px; width:68px; height:68px; border-radius:35px;">
																	<div class="circleArrowProjIcon" style="position:absolute; width:30px; height:30px; top:17px; right:12px; border-left:2px solid; border-top:2px solid; transform:rotate(-45deg);"></div>
																</div>
															</div>
														@endif
												</div>
											@endif
												
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>
	</div>
		
	<script>
		document.querySelectorAll('.iso-item').forEach(item => {
		  item.addEventListener('click', () => {
			const index = item.getAttribute('data-index');
			const preview = document.getElementById('pdf-preview-' + index);
			const isAlreadyOpen = item.classList.contains('selected');

			// Chiudi tutto
			document.querySelectorAll('.iso-item').forEach(i => {
			  i.classList.remove('selected');
			  i.querySelector('.arrow-down').style.display = 'block';
			  i.querySelector('.icon-close-img').style.display = 'none';
			});
			document.querySelectorAll('.iso-pdf-preview').forEach(pre => $(pre).slideUp());

			// Se clic su item già aperto: chiudilo solo
			if (isAlreadyOpen) return;

			// Altrimenti apri nuovo
			item.classList.add('selected');
			$(preview).slideDown();
			animateCarouselImages(index);


			// Aggiorna freccia/icon
			item.querySelector('.arrow-down').style.display = 'none';
			item.querySelector('.icon-close-img').style.display = 'block';

			// ❗Corretto: passa index alla funzione
			setTimeout(() => setupCarouselScroll(index), 300);
		  });
		});


		
		
		function calculateImageWidths(trackElement) {
		  const images = trackElement.querySelectorAll('.carousel-image');
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



		function setupCarouselScroll(index) {
		  const carouselTrack = document.getElementById('carousel-track-' + index);
		  const nextBtn = document.getElementById('nextBtnProj-' + index);
		  const prevBtn = document.getElementById('prevBtnProj-' + index);
		  const imageWidths = calculateImageWidths(carouselTrack);

		  let currentIndex = 0;

		  nextBtn.onclick = () => {
			if (currentIndex < imageWidths.length - 1) {
			  currentIndex++;
			  const newScrollLeft = imageWidths.slice(0, currentIndex).reduce((a, b) => a + b, 0);
			  smoothScrollTo(carouselTrack, newScrollLeft + (currentIndex * 15), 100);
			}
		  };

		  prevBtn.onclick = () => {
			if (currentIndex > 0) {
			  currentIndex--;
			  const newScrollLeft = imageWidths.slice(0, currentIndex).reduce((a, b) => a + b, 0);
			  smoothScrollTo(carouselTrack, newScrollLeft + (currentIndex * 15), 100);
			}
		  };
		}

		function animateCarouselImages(index) {
		  const carouselTrack = document.getElementById('carousel-track-' + index);
		  const images = carouselTrack.querySelectorAll('.carousel-image');

		  images.forEach((img, i) => {
			setTimeout(() => {
			  img.style.opacity = '1';
			  img.style.transform = 'translateX(0)';
			}, i * 150); // Ritardo progressivo
		  });
		}
		
		document.addEventListener('DOMContentLoaded', () => {
			const wrappers = document.querySelectorAll('.iso-wrapper');

			wrappers.forEach((wrapper, i) => {
			  wrapper.style.animationDelay = `${i * 0.15}s`;
			});
		  });

	</script>
@endsection	