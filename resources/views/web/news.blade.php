@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "NEWS";
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
		  font-size: 40px;
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
		  font-size: 40px;
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
	  position: relative;
	  display: flex;
	  overflow-x: auto;
	  width: 100%;
	  height: 500px;
	  scroll-behavior: smooth;
	  scrollbar-width: none;
	  -ms-overflow-style: none
	}

	.carousel-track::-webkit-scrollbar {
	  display: none;              
	}


	.carousel-track a {
	  flex: 0 0 100%;
	  min-width: 100%;
	  height: 100%;
	  display: flex;
	  justify-content: center;
	  align-items: center;
	}

	.carousel-image{
	  position:absolute;
	  width: 100%;
	  height: 100%;
	  object-fit: cover;
	  display: block;
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


		.link-block {
		  flex:  0 0 auto;
		  margin: 0px 50px 20px 20px;
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
		  cursor:pointer
		}
		
		.link-block span {
		  font-weight: bold;
		  transition: background 0.3s;
		}

		.link-block .freccia, .link-block .frecciaUp {
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
		  transform: translate(12px, -50%) rotate(45deg);
		  width: 12px;
		  height: 12px;
		  border-right: 2px solid #E73338;
		  border-bottom: 2px solid #E73338;
		  transition: transform 0.4s ease;
		}

		.link-block .frecciaUp::after {
		  content: '';
		  position: absolute;
		  right: 0;
		  top: 80%;
		  transform: translate(12px, -50%) rotate(-135deg);
		  width: 12px;
		  height: 12px;
		  border-right: 2px solid #E73338;
		  border-bottom: 2px solid #E73338;
		  transition: transform 0.4s ease;
		}

		.link-block:hover span {		  
		  background:#d9d9d9;
		}

		.link-block:hover .freccia::after {
		  transform: translate(18px, -50%) rotate(45deg);
		}

		.link-block:hover .frecciaUp::after {
		  transform: translate(18px, -50%) rotate(-135deg);
		}

		.filter-panel {
		  position: absolute;
		  top: 150%;
		  left: 0;
		  padding: 30px 35px 10px;
		  background: rgba(255, 255, 255, 0.95);
		  border: 1px solid #ccc;
		  z-index: 10;
		  min-width: 50px;
		  opacity: 0;
		  transform: translateX(-15px);
		  transition: opacity 0.4s ease, transform 0.4s ease;
		  pointer-events: none;
		}
		
		.filter-panel .freccia {
		  width: 12px;
		  height: 12px;
		  position: relative;
		  transition: transform 0.4s ease;
			
		}

		.filter-panel .freccia::after {
		  content: '';
		  position: absolute;
		  right: 0;
		  top: 20%;
		  transform: translate(12px, -50%) rotate(-45deg);
		  width: 12px;
		  height: 12px;
		  border-right: 2px solid #000;
		  border-bottom: 2px solid #000;
		  transition: transform 0.4s ease;
		}

		.link-block.active span {
		  background: #d9d9d9;
		}

		@keyframes fadeSlideIn {
		  0% {
			opacity: 0;
			transform: translateX(-15px);
		  }
		  100% {
			opacity: 1;
			transform: translateX(0);
		  }
		}

		.filter-link {
		  position: relative;
		  opacity: 0;
		  transform: translateX(-15px);
		  transition: opacity 0.3s ease, transform 0.3s ease, font-weight 0.3s;
		  display: flex;
		  align-items: center;
		  margin-bottom: 20px;
		  font-size: 22px;
		  white-space: nowrap;
		  font-weight: normal;
		  padding-right: 20px; /* spazio per freccia */
		}

		.filter-link .arrow-small {
		  position: absolute;
		  right: 0;
		  top: 50%;
		  transform: translateY(-50%) rotate(-45deg);
		  width: 10px;
		  height: 10px;
		  border-right: 2px solid #000;
		  border-bottom: 2px solid #000;
		  transition: transform 0.3s ease;
		  pointer-events: none;
		}

		.filter-link:hover {
		 // font-weight: bold;
		}

		.filter-link:hover .arrow-small {
		  transform: translateY(0px) rotate(-45deg) translateX(8px);
		}
		
		.filter-link.show {
		  opacity: 1 !important;
		  transform: translateX(0) !important;
		}

		.link-block.active .filter-panel {
		  opacity: 1;
		  transform: translateX(0);
		  pointer-events: auto;
		}
		
		.filter-link.active {
		  font-weight: bold;
		}
		
		.rimuovi-filtri{
			width:120px;
			height:auto;
			padding:4px;
			background:#E30613;
			border-radius:26px;
			border:solid 1px #fff;
			color:#fff;
			cursor:pointer;
			font-size:13px;
			font-weight:bold;
			text-align:centeR;
			transition:all 0.3s
		}
		.rimuovi-filtri:hover{
			border:solid 1px #fff;
			color:#E30613
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

		.iso-item:hover .categoria-pill {
		  background: #f0f0f0;
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
		.iso-content span{
			font-size:30px;
		}
		
		.newsBottom{
			display: flex; 
			gap: 15px; 
			justify-content: space-between; 
			align-items: flex-start;			
		}
		.bottNewsContainer{
			flex: 1; 
			display: flex; 
			justify-content: flex-end; 
			align-items: center; 
			margin-top:40px;
		}
		.flexNewsContainer{
			width:100%; 
			display:flex; 
			gap:30px;
			overflow-x:hidden;
		}
		
		.fade-in-slide-left {
		  opacity: 0;
		  transform: translateX(100px);
		  transition: opacity 1.5s ease, transform 1.5s ease;
		}

		.fade-in-slide-left.show {
		  opacity: 1;
		  transform: translateX(0);
		}
		
		.data-pill, .categoria-pill{font-size:20px !important;}
		
		.gapPill{display:none}
		.bottNewsContainer1{display:flex;}
		.bottNewsContainer2{display:none;}
		@media screen AND (max-width:1200px){
			.newsBottom{
				flex-direction: column;
			}
			.link-block{margin-left:0;}
			.bottNewsContainer{margin-top:10px;}
		}
		@media screen AND (max-width:1024px){
			.flexNewsContainer{
				flex-direction: column;
			}
			.bottNewsContainer1{display:none;}
			.bottNewsContainer2{display:flex;}
		}
		@media screen AND (max-width:500px){
			.iso-content span{
				font-size:20px;
			}
			.data-pill, .categoria-pill{font-size:15px !important;}
			
			.iso-item{padding:15px 10px !important;}
			.gapPill{display:inline}
			.categoria-pill{margin-left:0}
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
				
				<div style="padding:0; display:flex;">
					  @if(!empty($nomiCategorie) && count($nomiCategorie)>0)
						  <div class="link-block" data-type="categoria">
							<span @if(request('categoria'))style="background:#d9d9d9"  @endif>&nbsp;Categoria&nbsp;</span>
							<div class="freccia"></div>
							<div class="filter-panel" id="categoria-panel">
							  @foreach($nomiCategorie as $categoria)
								<a href="{{ url()->current() }}?categoria={{ urlencode($categoria) }}@if(request('anno'))&anno={{ request('anno') }}@endif"
								   class="filter-link @if(request('categoria') == $categoria) active @endif">
									{{ $categoria }} <span class="arrow-small" style="background:#fff"></span>
								</a>
							  @endforeach

							</div>
						  </div>
					  @endif
					  @if(!empty($anni))
						  <div class="link-block" data-type="anno">
							<span @php if(request('anno')){@endphp style="background:#d9d9d9" @php }@endphp>&nbsp;Anno&nbsp;</span>
							<div class="freccia"></div>
							<div class="filter-panel" id="categoria-panel">
							  @foreach($anni as $anno)
								<a href="{{ url()->current() }}?anno={{ $anno }}@if(request('categoria'))&categoria={{ urlencode(request('categoria')) }}@endif"
								   class="filter-link @if(request('anno') == $anno) active @endif">
									{{ $anno }} <span class="arrow-small" style="background:#fff"></span>
								</a>
							  @endforeach


							</div>
						  </div>
					  @endif
					  
					  @if(request('anno') || request('categoria'))
						<div style="margin-top:-3px;">
							<a href="news.html">
								<div class="rimuovi-filtri">						 
									RIMUOVI FILTRI
								</div>
							</a>
						</div>
					@endif
				</div>
				
				<div class="iso-list">				
				
					@foreach($query_news AS $key_news=>$value_news)
						@php 
							$index = $value_news->id; 
							
							$query = DB::table('categorie_news')->select('nome')->where('id', '=', $value_news->categoria);			
							$query_cat = $query->get();
						@endphp
						<div class="iso-wrapper">
							<div class="iso-item" data-index="{{ $index }}">
								<div class="bg-hover"></div>
								<div class="iso-content">
									<span class="bold">{{ $value_news->titolo }}</span>
									<span class="data-pill">{{ date_to_data($value_news->data_news) }}@if(isset($query_cat[0]) && $query_cat[0]->nome)<span class="gapPill"><br/></span><span class="categoria-pill">{{$query_cat[0]->nome}}</span>@endif</span>
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
											@php
												$imgs = collect([
													$value_news->img ?? null,
													$value_news->img2 ?? null,
													$value_news->img3 ?? null
												])->filter()->values();
												
											@endphp
											<div class="flexNewsContainer">
												@if($imgs->count() > 0)
													<div style="flex:0 0 60%;" class="flexLeftNews">
												@else
													<div style="flex:0 0 100%;" class="flexLeftNews">
												@endif
													@if(isset($value_news->sottotitolo))
														<span class="projTit">{{$value_news->sottotitolo}}</span>
													@endif
													<div style="margin-top:25px;">
														<div style=" font-size:20px;" class="news-body-content">
															{!! $value_news->testo !!}
														</div>
													</div>
													
													@if(isset($value_news->video))
														<style>
															.video-container {
															  max-width: 100%;
															  overflow: hidden;
															}

															video {
															  width: 100%;
															  height: auto; /* Altezza proporzionata alla larghezza */
															  display: block;
															}
														</style>
														<div class="video-container">
															<video src="resarea/video/{{$value_news->video}}" controls  muted playsinline>
															  Il tuo browser non supporta il tag video.
															</video>
														</div>
													@endif
													
													@php
														$linkUrl = null;
														$linkText = 'LINK';
														if (!empty($value_news->link)) {
															$linkUrl = $value_news->link;
														}

														if (!empty($value_news->pdf)) {
															$linkUrl = 'resarea/files/news/' . $value_news->pdf;
															$linkText = 'APRI PDF';
														}


														if (!empty($value_news->testo_link)) {
															$linkText = strtoupper($value_news->testo_link);
														}
													@endphp
													
													@if(!empty($value_news->linkedin) || !empty($value_news->instagram))
														@if(!empty($value_news->linkedin))
															<a href="{{ $value_news->linkedin }}" target="_blank">
																<img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="Linkedin" width="45" style="margin-right:12px">
															</a>
														@endif
														@if(!empty($value_news->instagram))
															<a href="{{ $value_news->instagram }}" target="_blank">
																<img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="45">
															</a>
														@endif
													@endif
													
													<div class="newsBottom">
													  <div style="flex: 1;">
														@if($linkUrl)
														  <div style="width:190px; padding:10px 5px; background:#E30613; border-radius:26px; border:solid 1px #fff; cursor:pointer; margin-top:40px;">
															<a href="{{ $linkUrl }}" target="_blank" style="text-decoration:none">
															  <div style="font-size:16px; color:#fff; width:100%; text-align:center;">
																<b>{{ $linkText }}</b>
															  </div>
															</a>
														  </div>
														@endif
													  </div>

													  <div class="bottNewsContainer bottNewsContainer1">
														<div style="cursor:pointer" class="link-block close-preview-link" style="margin: 0;">
														  <span>&nbsp;TORNA ALLE NEWS&nbsp;</span>
														  <div class="frecciaUp"></div>
														</div>
													  </div>
													</div>


													
												</div>
												
												@if($imgs->count() > 0)
													<div style="flex:0 0 40%;" class="flexRightNews">
														

														@if($imgs->isNotEmpty())
															@if($imgs->count() > 1)
																<div class="gallery-carousel">
																	<div class="carousel-track" id="carousel-track-{{ $index }}">
																		@foreach($imgs as $i => $img)
																			<a href="resarea/img_up/news/{{ $img }}" class="glightbox" data-gallery="gallery-{{ $index }}">
																				<img src="resarea/img_up/news/{{ $img }}" alt="{{ $value_news->titolo }} - Immagine {{ $i+1 }}" class="carousel-image">
																			</a>
																		@endforeach
																	</div>
																</div>

																<div style="position:relative; width:100%; height:100px;">
																	<!-- BOTTONE PREV -->
																	<div class="circleArrowProj" data-action="next" style="position:absolute; left:90px; top:10px; width:68px; height:68px; border-radius:35px;">
																		<div class="circleArrowProjIcon" style="position:absolute; width:30px; height:30px; top:17px; left:12px; border-right:2px solid; border-bottom:2px solid; transform:rotate(-45deg);"></div>
																	</div>
																	<!-- BOTTONE NEXT -->
																	<div class="circleArrowProj" data-action="prev" style="position:absolute; left:0px; top:10px; width:68px; height:68px; border-radius:35px;">
																		<div class="circleArrowProjIcon" style="position:absolute; width:30px; height:30px; top:17px; right:12px; border-left:2px solid; border-top:2px solid; transform:rotate(-45deg);"></div>
																	</div>
																</div>
															@else
																<div class="gallery-carousel">
																	<div class="carousel-track" id="carousel-track-{{ $index }}">
																	@foreach($imgs AS $i => $img)
																		<a href="resarea/img_up/news/{{ $img }}" class="glightbox" data-gallery="gallery-{{ $index }}">
																			<img  src="resarea/img_up/news/{{ $img }}" alt="{{ $value_news->titolo }}" style="position:absolute; width:100%; height:100%; object-fit:cover; object-position:center center "  class="carousel-image">
																		</a>
																	@endforeach
																	</div>
																</div>
															@endif
														@endif
														<div class="bottNewsContainer bottNewsContainer2" style="justify-content:flex-start; margin-top:30px">
															<div style="cursor:pointer" class="link-block close-preview-link" style="margin: 0;">
															  <span>&nbsp;TORNA ALLE NEWS&nbsp;</span>
															  <div class="frecciaUp"></div>
															</div>
														  </div>
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
				@if($query_news->isEmpty())
					<div style="padding: 0px 0 100px 0; text-align:center; font-size: 20px; font-weight: bold;">
						Nessuna news trovata per i filtri selezionati.
					</div>
				@endif
				<div style="text-align:center; padding:40px 0;">
					{{ $query_news->links('vendor.pagination.news-custom') }}
				</div>

			</div>
		</section>
	</div>
	
	<!-- GLightbox CSS -->
	<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
	<!-- GLightbox JS -->
	<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
	<script>
		window.addEventListener('scroll', () => {
		  document.querySelectorAll('.flexRightNews').forEach(container => {
			const gallery = container.querySelector('.gallery-carousel');
			const containerRect = container.getBoundingClientRect();
			const galleryHeight = gallery.offsetHeight;
			
			const windowTop = window.scrollY;
			const containerTop = container.getBoundingClientRect().top + window.scrollY;
			const containerBottom = containerTop + container.offsetHeight;

			const maxScroll = containerBottom - galleryHeight - 120;
			const desiredTop = Math.min(windowTop + 120, maxScroll);
			const relativeTop = desiredTop - containerTop;

			if (windowTop + 120 >= containerTop && windowTop < containerBottom - galleryHeight) {
			  gallery.style.marginTop = `${relativeTop}px`;
			} else if (windowTop + 120 < containerTop) {
			  gallery.style.marginTop = `0px`;
			}
		  });
		});
		
		
		
		

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
			$(preview).slideDown({
			  complete: function () {
				const rect = item.getBoundingClientRect();
				const offsetTop = window.pageYOffset + rect.top - 110; // 110px di margine
				window.scrollTo({ top: offsetTop, behavior: 'smooth' });
			  }
			});


			// Aggiorna freccia/icon
			item.querySelector('.arrow-down').style.display = 'none';
			item.querySelector('.icon-close-img').style.display = 'block';

		  });
		});

		document.querySelectorAll('.close-preview-link').forEach(link => {
		  link.addEventListener('click', (e) => {
			const preview = link.closest('.iso-pdf-preview');
			const item = preview?.previousElementSibling;

			if (preview && item) {
			  $(preview).slideUp();
			  item.classList.remove('selected');

			  const arrow = item.querySelector('.arrow-down');
			  const closeIcon = item.querySelector('.icon-close-img');
			  if (arrow) arrow.style.display = 'block';
			  if (closeIcon) closeIcon.style.display = 'none';
			}
		  });
		});

		function initCarousel(carouselContainer) {
		  const track = carouselContainer.querySelector('.carousel-track');
		  const images = track.querySelectorAll('.carousel-image');
		  const nextBtn = carouselContainer.querySelector('.circleArrowProj:nth-of-type(1)');
		  const prevBtn = carouselContainer.querySelector('.circleArrowProj:nth-of-type(2)');
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

		document.querySelectorAll('.flexRightNews').forEach(initCarousel);

		
		document.addEventListener('DOMContentLoaded', () => {
		  const allCarousels = document.querySelectorAll('.gallery-carousel');

		  allCarousels.forEach(carousel => {
			initCarousel(carousel);
		  });
		});
		
		document.addEventListener('DOMContentLoaded', () => {
			const wrappers = document.querySelectorAll('.iso-wrapper');

			wrappers.forEach((wrapper, i) => {
			  wrapper.style.animationDelay = `${i * 0.15}s`;
			});
		  });
			  
		  const panels = {
			categoria: document.getElementById('categoria-panel'),
			anno: document.getElementById('anno-panel')
		  };

		  function showPanel(name, linkBlock) {
			Object.entries(panels).forEach(([key, panel]) => {
			  const block = document.querySelector(`.link-block[data-type="${key}"]`);
			  if (key === name) {
				panel.style.display = 'block';
				panel.classList.add('fadeSlideIn');
				linkBlock.classList.add('active');
				const links = panel.querySelectorAll('.filter-link');
				links.forEach((link, i) => {
				  setTimeout(() => link.classList.add('show'), i * 100);
				});
			  } else {
				panel.style.display = 'none';
				block?.classList.remove('active');
				const links = panel.querySelectorAll('.filter-link');
				links.forEach(link => link.classList.remove('show'));
			  }
			});
		  }

	document.querySelectorAll('.link-block').forEach(block => {
		const panel = block.querySelector('.filter-panel');

		block.addEventListener('click', (e) => {
		  e.stopPropagation(); // evita che clic interno chiuda subito

		  const isActive = block.classList.contains('active');

		  // Chiudi tutti
		  document.querySelectorAll('.link-block').forEach(lb => lb.classList.remove('active'));

		  if (!isActive) {
			block.classList.add('active');

			// Effetto slide-in filtri
			const links = panel.querySelectorAll('.filter-link');
			links.forEach((link, i) => {
			  link.classList.remove('show');
			  setTimeout(() => link.classList.add('show'), i * 100);
			});
		  }
		});
	  });

	  // Chiudi pannelli cliccando fuori
	  document.addEventListener('click', function (event) {
		const linkBlocks = document.querySelectorAll('.link-block');

		let clickedInside = false;

		linkBlocks.forEach(block => {
		  if (block.contains(event.target)) {
			clickedInside = true;
		  }
		});

		if (!clickedInside) {
		  linkBlocks.forEach(lb => lb.classList.remove('active'));
		}
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