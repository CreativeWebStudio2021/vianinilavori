@extends('web.layout')

@section('content')

@php
	$query_dett = DB::table('punti_mappa')
		->select('*')
		->where('id', '=', $id_dett)
		->get();
@endphp
@if(isset($query_dett[0]->file_custom) && $query_dett[0]->file_custom!="")
	@include('web.schedeCustom.'.$query_dett[0]->file_custom)
@else
	<style>
		
		.project-detail {
		  width: 100%;
		  position: relative;
		  color: #fff;
		  font-family: sans-serif;
		  overflow-x:hidden;
		}

		.hero {
		  position: relative;
		  width: 100vw;
		  min-width: 100vw;
		  height: 100vh;
		  overflow: hidden;
		}
		
		.hero-video {
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100vw;
		  min-width: 100vw;
		  height: 100vh;
		  min-height: 100vh;
		  object-fit: cover;
		  object-position: center;
		  z-index: 0;
		}
		
		.hero-overlay {
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2));
		  z-index: 1;
		  pointer-events: none; /* Così non blocca clic/touch */
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
		  top: 28%;
		  left: 5%;
		  transform: translateY(-50%);
		  z-index: 2;
		}

		.hero-content h1 {
		  font-size: 3rem;
		  margin: 0 0 1rem 0;
		}

		.subtitleContainer span {
		  display: inline-block;
		  color:#fff;
		}

		.subtitle2Container span {
		  display: inline-block;
		  color:#000;
		}
		

		@keyframes fadeIn {
		  to {
			opacity: 1 !important;
		  }
		}


		.detail-content {
		  width: 100vw;
		  //min-height: 100vh; /* era height: 100vh */
		  position: relative;
		  background: #fff;
		  color: #000;
		  overflow: visible; /* permetti lo scroll */
		}


		.scrollable-content {
		  height: 100%;
		  overflow: hidden;
		}

		
		.projTit{
			color:#E30613;
			font-weight:bold;
		}
		
		.project-metrics {
		  display: flex;
		  flex-direction:column;
		  gap: 0px;
		  align-items: stretch;
		  height: auto;
		  margin-bottom:20px;
		  padding-left:10px;
		}

		.icon-arrow {
		  color: #E30613;
		  display: flex;
		  align-items: center;
		  font-size: 24px;
		}

		.metric-value {
		  font-size: 20px !important;
		  font-weight: bold;
		  display: flex;
		  align-items: center;
		}

		.metric-label {
		  font-size: 20px !important;
		  display: flex;
		  align-items: flex-end;
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
		
		.project-item {
		  transform: translateX(120vw);
		  transition: transform 1.5s cubic-bezier(0.15, 0.85, 0.3, 1);
		  opacity: 0;
		}

		.project-item.entered {
		  transform: translateX(0);
		  opacity: 1;
		}
		

		.project-body-content {
		  text-align: justify;
		}
		@media screen AND (max-width:650px){
			.project-body-content {
			  text-align: left !important;
			}
		}

		.project-body-content p,
		.project-body-content div,
		.project-body-content span,
		.project-body-content li {
		  #text-align: justify;
		}
		
		.metric-value{
			position:relative;
			font-size:20px !important;
		}
		.metric-value::before {
		  content: '';
		  position: absolute;
		  left: -25px;
		  top: 3px;		  
		  width: 12px;
		  height: 12px;
		  border-right: 2px solid #E73338;
		  border-bottom: 2px solid #E73338;
		  transform: rotate(-45deg);
		}
		.project-metrics {
			margin-left:10px !important;
		}
		.gapProg{display:none}
		.gapSubtitle{display:inline}
		.datiProg{width:100%; font-size:20px; color:#000; line-height:1.8;}
		.boxFlexDett{gap:60px;}
		@media screen AND (max-width:1024px){
			.boxFlexDett{flex-direction:column; gap:30px;}
		}
		@media screen AND (max-width:600px){
			.gapProg{display:inline;}
			.gapSubtitle{display:inline !important;}
			.barSubTitle{display:none !important;;}
			.datiProg{ line-height:1.3;}
		}
		
		.mainTextContainer2 {
			margin-left:100px !important;
		}
		@media screen AND (max-width:1600px){
			.mainTextContainer2 {margin-left:30px !important;}
		}
		@media screen AND (max-width:1468px){
			.mainTextContainer2 {margin-left:-20px !important; }
		}
		@media screen AND (max-width:800px){
			.mainTextContainer2 {margin-left:0px !important;}
		}
		@media screen AND (max-width:500px){
			.mainTextContainer2 {margin-left:20px !important;}
			.project-detail h1{font-size:40px;}
		}
		
		@keyframes fadeInSlideUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		@keyframes fadeInSlideRight {
			from {
				opacity: 0;
				transform: translateX(-30px);
			}
			to {
				opacity: 1;
				transform: translateX(0);
			}
		}

		.fade-slide-up {
			animation: fadeInSlideUp 0.8s ease forwards;
		}

		.fade-slide-right {
			animation: fadeInSlideRight 0.8s ease forwards;
		}
		
		.animate-on-scroll {
			opacity: 0;
		}
		
		.gallery-carousel{
		width: 100%; 
		position: sticky;
		z-index: 5;
		position:relative;		
		transition: margin-top 0.5s ease;
	}

	.carousel-controls {
	  display: flex;
	  gap: 20px;
	  padding-left: 10px;
	 padding-top:320px;
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
	  display: flex;
	  width: 100%;
	  height: 300px;
	  overflow-x:auto;
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
	
	.project-body-content p,
	.project-body-content div,
	.project-body-content span,
	.project-body-content li {
	  opacity: 0;
	  transform: translateY(30px);
	  transition: opacity 0.5s ease, transform 0.5s ease;
	}

	.project-body-content .visible {
	  opacity: 1;
	  transform: translateY(0);
	}



#iframeContainer {
  position: fixed; 
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  z-index: 9998;
  visibility: hidden;
  pointer-events: none;
}
#iframeContainer iframe {
  width: 100%;
  height: 100%;
  border: none;
}

#introMaskSvg {
  position: fixed;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  z-index: 9999;
  opacity: 0;
  transition: opacity 0.5s ease-in;
  pointer-events: none;
}

#closeMapBtn {
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 10001;
  padding: 10px 18px;
  background-color: {{config('app.color1')}};
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: none;
  opacity: 0;
  transition: opacity 0.3s ease;
}
#closeMapBtn.show {
  display: block;
  opacity: 1;
}

.project-body-content ul {
  margin-bottom: 1.2em;
  list-style-type: disc;
}

.project-body-content li {
  margin-bottom: 0.5em;
}

#videoProgDesk{ display:block;}
#videoProgMob{ display:none;}
@media screen AND (max-width:580px){
	#videoProgDesk{ display:none;}
	#videoProgMob{ display:block;}
}

@if(isset($query_dett[0]->css_custom) && $query_dett[0]->css_custom!="")
	{!! $query_dett[0]->css_custom !!}
@endif
	
	</style>

	<div class="project-detail">
		@php
			$video = $query_dett[0]->video ?? null;
			$video_path = public_path("resarea/video/{$video}");
			
			$video_mob = $query_dett[0]->video_mobile ?? null;
			$video_path_mob = public_path("resarea/video/{$video_mob}");
  
			$img = $query_dett[0]->img_testata ?? null;
			$img_path = public_path("resarea/img_up/punti/{$img}");
		@endphp
		
		@if ($video && file_exists($video_path))
			 <div class="hero">
				<video autoplay muted loop playsinline class="hero-video" id="videoProgDesk">
					@if(empty($_GET['test']))
						<source src="resarea/video/{{$query_dett[0]->video}}" type="video/mp4">
					@else
						<source src="resarea/video/{{ str_replace('_def','',$query_dett[0]->video) }}" type="video/mp4">						
					@endif
				  Il tuo browser non supporta il tag video.
				</video>
				@if ($video_mob && file_exists($video_path_mob))
					<video autoplay muted loop playsinline class="hero-video" id="videoProgMob" style="width:100%; height:100%; object-fit:cover; object-position: center">
					  <source src="resarea/video/{{$query_dett[0]->video_mobile}}" type="video/mp4">
					  Il tuo browser non supporta il tag video.
					</video>
				@endif
				<div class="hero-overlay"></div>
				<div class="hero-content mainTextContainer mainTextContainer2">
				  <h1 class="title animate-on-scroll">{{$query_dett[0]->titolo}}</h1>
				  <div class="subtitleContainer animate-on-scroll">
					@php $delay = 0.5; @endphp
					@if(isset($query_dett[0]->sottotitolo1) && $query_dett[0]->sottotitolo1!="")
					  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo1}}</span>
					  @php $delay += 1; @endphp
					@endif
					@if(isset($query_dett[0]->sottotitolo2) && $query_dett[0]->sottotitolo2!="")
					  <span class="animate-on-scroll subtitle" class="barSubTitle">|</span>
					  <span class="gapSubtitle"><br/></span>
					  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo2}}</span>
					  @php $delay += 1; @endphp
					@endif
					@if(isset($query_dett[0]->sottotitolo3) && $query_dett[0]->sottotitolo3!="")
					  <span class="animate-on-scroll subtitle" class="barSubTitle"style="animation-delay: {{$delay}}s">|</span>
					  <span class="gapSubtitle"><br/></span>
					  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo3}}</span>
					@endif
				  </div>
				</div>
			  </div>
		@elseif ($img && file_exists($img_path))
		  <div class="hero">
			<img src="resarea/img_up/punti/{{$query_dett[0]->img_testata}}" alt="{{$query_dett[0]->titolo}} {{$query_dett[0]->titolo_bold}}">
			<div class="hero-overlay"></div>
			<div class="hero-content mainTextContainer mainTextContainer2">
			  <h1 class="title animate-on-scroll">{{$query_dett[0]->titolo}}</h1>
			  <div class="subtitleContainer animate-on-scroll">
				@php $delay = 0.5; @endphp
				@if(isset($query_dett[0]->sottotitolo1) && $query_dett[0]->sottotitolo1!="")
				  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo1}}</span>
				  @php $delay += 1; @endphp
				@endif
				@if(isset($query_dett[0]->sottotitolo2) && $query_dett[0]->sottotitolo2!="")
				  <span class="animate-on-scroll subtitle" class="barSubTitle">|</span>
				  <span class="gapSubtitle"><br/></span>
				  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo2}}</span>
				  @php $delay += 1; @endphp
				@endif
				@if(isset($query_dett[0]->sottotitolo3) && $query_dett[0]->sottotitolo3!="")
				  <span class="animate-on-scroll subtitle" class="barSubTitle"style="animation-delay: {{$delay}}s">|</span>
				  <span class="gapSubtitle"><br/></span>
				  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo3}}</span>
				@endif
			  </div>
			</div>
		  </div>
	  @endif
	  <style>
		#detail-content {
			background: url(web/images/v_grigia_sfondo.png) no-repeat left center;
			background-size:cover;
			
			position: relative;
			z-index: 1;
			overflow: hidden;
		}
		#detail-flex{
			width:100%; 
			display:flex
		}
		.project-sidebar{
			flex:0 0 550px; 
			margin-right:50px;
			position:relative; 
			z-index:1
		}
		@media screen AND (max-width:1300px){
			.project-sidebar{
				flex:0 0 400px; 
			}
		}
		@media screen AND (max-width:1024px){
			#detail-flex{
				flex-direction:column;
			}
			.project-sidebar{
				flex:1; 
				margin-right:0px;
			}
		}
	  </style>
	  <div class="detail-content" id="detail-content">
		<div class="scrollable-content mainTextContainer">
			@if (($img && file_exists($img_path)) || ($video && file_exists($video_path)))
			<div style="padding:80px 0 50px 0">
			@else
			<div style="padding:120px 0 50px 0">
				<div style="padding-bottom:20px;">
					<h1>{{$query_dett[0]->titolo}}</h1>
				</div>
			@endif
				<div id="detail-flex">
					<div  class="project-sidebar"> 
						<div style="padding:30px; background:rgb(255,255,255,0.2); margin-bottom:20px; ">
							<div class="datiProg">
								@php
									$p=0;
									$query_gal = DB::table('punti_mappa_gallery')
										->select('*')
										->where('id_rife', '=', $query_dett[0]->id)
										->orderby('ordine', 'DESC')
										->get();
									$count_gal = $query_gal->count();
									
									$dati=0;
									if(isset($query_dett[0]->valore_dato_1) || isset($query_dett[0]->valore_dato_2) || isset($query_dett[0]->valore_dato_3) || isset($query_dett[0]->valore_dato_4) || isset($query_dett[0]->valore_dato_5) ){
										$dati=1;
									}
								@endphp
								
								<style>
									.projTitCol-{{ $query_dett[0]->id }}{width:100%; font-size:20px; color:#000;}
									@if($count_gal==0 && $dati==0)
										.projTitCol-{{ $query_dett[0]->id }}{
											width:60%;
											display:flex; 
											gap:100px;
										}
										@media screen AND (max-width:1024px){
											.projTitCol-{{ $query_dett[0]->id }}{
												gap:0px;
												flex-direction:column;
											}
										}
									@endif
								</style>
								
								<div class="projTits animate-on-scroll projTitCol-{{ $query_dett[0]->id }}">
									<div style="flex:1; display:flex; flex-direction:column; gap:10px; line-height:1.2; margin-bottom:10px; text-align:justify;" class="projTitCol1-{{ $query_dett[0]->id }}">
										@if(isset($query_dett[0]->committente))
											<div><span class="projTit">Committente</span>:<span class="gapProg"><br/></span> {{ $query_dett[0]->committente }}<br/></div>
										@endif
										@if(isset($query_dett[0]->ubicazione))
											<div><span class="projTit">Ubicazione</span>:<span class="gapProg"><br/></span> {{$query_dett[0]->ubicazione }}<br/></div>
										@endif
									
										@if(isset($query_dett[0]->tipologia))
											<?php /*<div><span class="projTit">Tipologia di contratto</span>:<span class="gapProg"><br/></span> {{$query_dett[0]->tipologia }}<br/></div>*/?>
										@endif
										@if(isset($query_dett[0]->stato))
											<div><span class="projTit">Stato di lavorazione</span>:<span class="gapProg"><br/></span> {{ ucfirst(str_replace("Lavoro ","",$query_dett[0]->stato));}}<br/></div>
										@endif
									</div>
								</div>
							</div>
							
							@php
								$dati = 0;
								if(isset($query_dett[0]->valore_dato_1) && $query_dett[0]->valore_dato_1!="") $dati=1;
								if(isset($query_dett[0]->valore_dato_2) && $query_dett[0]->valore_dato_2!="") $dati=1;
								if(isset($query_dett[0]->valore_dato_3) && $query_dett[0]->valore_dato_3!="") $dati=1;
								if(isset($query_dett[0]->valore_dato_4) && $query_dett[0]->valore_dato_4!="") $dati=1;
								if(isset($query_dett[0]->valore_dato_5) && $query_dett[0]->valore_dato_5!="") $dati=1;
							@endphp
							
							@if($dati==1)
								<div class="leftColDiv" style="width:100%; height:2px; background:#000; margin-top:30px; margin-bottom:30px"></div>
								<div style="width:calc(100% - 20px);  margin-top:25px;" class="projMetrics animate-on-scroll">
									<div style="">
										@if(isset($query_dett[0]->titolo_valori))
											<div style="font-size:20px; color:{{config('app.color1')}}; font-weight:bold; margin-bottom:20px;">
												{{ $query_dett[0]->titolo_valori }}
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_1))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_1 }}</div>
											  @if(isset($query_dett[0]->descrizione_dato_1))<div class="metric-label">{{ $query_dett[0]->descrizione_dato_1 }}</div>@endif
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_2))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_2 }}</div>
											  @if(isset($query_dett[0]->descrizione_dato_2))<div class="metric-label">{{ $query_dett[0]->descrizione_dato_2 }}</div>@endif
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_3))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_3 }}</div>
											  @if(isset($query_dett[0]->descrizione_dato_3))<div class="metric-label">{{ $query_dett[0]->descrizione_dato_3 }}</div>@endif
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_4))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_4 }}</div>
											  @if(isset($query_dett[0]->descrizione_dato_4))<div class="metric-label">{{ $query_dett[0]->descrizione_dato_4 }}</div>@endif
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_5))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_5 }}</div>
											  @if(isset($query_dett[0]->descrizione_dato_5))<div class="metric-label">{{ $query_dett[0]->descrizione_dato_5 }}</div>@endif
											</div>
										@endif
									</div>
								</div>
							@endif							
							
							@if($count_gal>0)
								<div style="width:calc(100% - 20px);margin-top:30px; margin-bottom:10px;" class="projMetrics">
									@if($count_gal==1)
										<div style="width:100%; min-height:300px;  position:relative; overflow:hidden">
											@foreach($query_gal AS $key_gal=>$value_gal)
												@php $p++ @endphp
												<a href="resarea/img_up/punti/{{ $value_gal->img }}" class="glightbox" data-gallery="gallery-{{ $query_dett[0]->id }}">
													<img class="fade-in-slide-left single-image-{{ $query_dett[0]->id }}" style="position:absolute; width:100%; height:100%; object-fit:cover; object-position:center center " src="resarea/img_up/punti/{{ $value_gal->img }}" alt="{{ $query_dett[0]->titolo }} - Immagine {{$p}}">
												</a>
											@endforeach
										</div>	
									@else
										<div class="gallery-carousel">
										  <div class="carousel-track" id="carousel-track">
											
											@foreach($query_gal AS $key_gal=>$value_gal)
												@php $p++ @endphp
												<a href="resarea/img_up/punti/{{ $value_gal->img }}" class="glightbox" data-gallery="gallery-{{  $query_dett[0]->id }}">
													<img src="resarea/img_up/punti/{{ $value_gal->img }}" alt="{{ $query_dett[0]->titolo }} - Immagine {{$p}}" class="carousel-image active">
												</a> 
											@endforeach
										  </div>
											@if($count_gal>1)
												<div class="carousel-controls ">
													<div id="prevBtnProj" class="circleArrowProj" data-track="1">
													  <div class="circleArrowProjIcon " style="top:17px; right:12px; border-left: 2px solid; border-top: 2px solid; transform: rotate(-45deg);"></div>
													</div>
													<div id="nextBtnProj" class="circleArrowProj" data-track="1">
													  <div class="circleArrowProjIcon" style="top:17px; left:12px; border-right: 2px solid; border-bottom: 2px solid; transform: rotate(-45deg);"></div>
													</div>
												</div>
											@endif
										</div>
									@endif
								</div>
							@endif
							
							@if($query_dett[0]->stato=="Lavoro in corso")
							<div class="animate-on-scroll buttMapp" style="
								
								width:190px;
								height:auto;
								padding:10px 5px;
								background:#E30613;
								border-radius:26px;
								border:solid 1px #fff;
								cursor:pointer;
								margin-top:30px;
							">
							  <a href="mappa-interattiva.html?id={{ $query_dett[0]->id }}" id="nextBtnMap"  style="text-decoration:none"><div style="font-size:16px; color:#fff; width:100%; text-align:centeR;"><b>MAPPA INTERATTIVA</b></div></a>
							</div>
							@endif
						</div>
						
					</div>
					
					<style>
						.project-body-content{
							display:flex:1; 
							font-size:20px; 
							margin-top:30px;
						}
						.project-body-content p{
							margin-top:0; margin-bottom:30px;
						}
						
						.project-body-content ul li{
							margin-left:20px !important;
						}
					</style>
					<div style=" margin-bottom:30px;">
						<div class="project-body-content">
							@if(isset($query_dett[0]->titolo_descrizione))
								<div style="width:100%; font-size:25px; font-weight:bold;">
									{!!$query_dett[0]->titolo_descrizione!!}
								</div>
							@endif
							{!!$query_dett[0]->descrizione!!}
							@if(isset($query_dett[0]->link))
								<style>
									.mainTextContainer li img.icon-li {
									  position: absolute;
									  left: 0;
									  top: -3px;
									  margin-left:-22px;
									  width: 30px;
									  height: 30px;
									  object-fit: contain;
									  flex-shrink: 0;
									}
									#sezLink{
										display:flex;
										margin-top:10px;
									}
									#sezLink li::before {
									  display:none !important;
									}
									
									.link-block {
									  flex:1;
									  margin: 0px 50px 20px 5px;
									  border-bottom: solid 1px #D9D9D9;
									  font-size: 20px;
									  font-weight:600;
									  display: flex;
									  align-items: center;
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
									  top: 50%;
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
								</style>
								<div id="sezLink">
									<ul>
										<li>
											<img class="icon-li" src="{{ asset('web/images/mondo_icon_b.png') }}" style="width:40px;" alt="{!!$query_dett[0]->testo_link!!} - {!!$query_dett[0]->titolo!!} - {{ config('app.name') }}">
											<a href="{!!$query_dett[0]->link!!}" target="_blank" title="{!!$query_dett[0]->testo_link!!}" class="link-block">
											@if(isset($query_dett[0]->testo_link))
												{!!$query_dett[0]->testo_link!!}
											@else
												Vedi Link
											@endif
											<div class="freccia"></div>
											</a>
										</li>
									</ul>
								</div>	
							@endif
						</div>
						
					</div>
					<div style="clear:both;"></div>
				</div>
				
			</div>
		</div>
	  </div>
	</div>

	<!-- GLightbox CSS -->
	<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
	<!-- GLightbox JS -->
	<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>


	<script>
	  const mobileMenuIcon = document.getElementById('mobileMenuIcon');
	const mobileMenuPanel = document.getElementById('mobile-menu-panel');
	const mobileMenuPanel2 = document.getElementById('mobile-menu-panel2');
	const logoVianini = document.getElementById('header-logo');	
	
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

	document.addEventListener('DOMContentLoaded', () => {
		
	});
		  
	  document.addEventListener("DOMContentLoaded", () => {
		  const lightbox = GLightbox({
			selector: '.glightbox',
			touchNavigation: true,
			loop: true,
		  });
		});
		
	document.addEventListener('DOMContentLoaded', () => {
		const options = {
			threshold: 0.1
		};

		const observer = new IntersectionObserver((entries) => {
			entries.forEach((entry, index) => {
				if (entry.isIntersecting) {
					const el = entry.target;

					if (el.classList.contains('title') || el.classList.contains('subtitleContainer') || el.classList.contains('subtitle')) {
						el.style.animationDelay = `${index * 0.7}s`;
						el.classList.add('fade-slide-up');
					}

					observer.unobserve(el);
				}
			});
		}, options);

		['.title', '.subtitleContainer', '.subtitle'].forEach(selector => {
			document.querySelectorAll(selector).forEach(el => {
				observer.observe(el);
			});
		});
	});

	@if (($img && file_exists($img_path)) || ($video && file_exists($video_path)))	
	document.addEventListener('DOMContentLoaded', () => {
		const options = {
			threshold: 0.1
		};

		const observer = new IntersectionObserver((entries) => {
			entries.forEach((entry, index) => {
				if (entry.isIntersecting) {
					const el = entry.target;

					if (el.classList.contains('title2') || el.classList.contains('subtitle2Container') || el.classList.contains('buttMapp')) {
						el.style.animationDelay = `${index * 0.2}s`;
						el.classList.add('fade-slide-up');
						carousel = document.querySelector('.gallery-carousel');
						initCarousel(carousel); 
					} else if (el.classList.contains('projTits') || el.classList.contains('projMetrics')) {
						el.style.animationDelay = `${index * 0.1}s`;
						el.classList.add('fade-slide-right');
					}

					observer.unobserve(el);
				}
			});
		}, options);

		['.title2', '.subtitle2Container', '.projTits', '.projMetrics', '.buttMapp'].forEach(selector => {
			document.querySelectorAll(selector).forEach(el => {
				observer.observe(el);
			});
		});
	});
	@else
		document.addEventListener('DOMContentLoaded', () => {
			const elementsFadeSlideUp = document.querySelectorAll('.title2, .subtitle2Container, .buttMapp');
			const elementsFadeSlideRight = document.querySelectorAll('.projTits, .projMetrics');

			elementsFadeSlideUp.forEach((el, index) => {
				el.style.animationDelay = `${index * 0.2}s`;
				el.classList.add('fade-slide-up');
				
				const carousel = document.querySelector('.gallery-carousel');
				if (carousel) {
					initCarousel(carousel);
				}
				
			});

			elementsFadeSlideRight.forEach((el, index) => {
				el.style.animationDelay = `${index * 0.4}s`;
				el.classList.add('fade-slide-right');
			});
		});

	@endif

	
	
	document.addEventListener('DOMContentLoaded', () => {
	  const bodyContent = document.querySelector('.project-body-content');

	  if (!bodyContent) return;

	  const elements = bodyContent.querySelectorAll('p, div, span, li');

	  const observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
		  if (entry.isIntersecting) {
			elements.forEach((el, index) => {
			  setTimeout(() => {
				el.classList.add('fade-slide-up');
			  }, index * 150); // Ritardo crescente: 100ms tra ogni riga
			});

			observer.unobserve(entry.target);
		  }
		});
	  }, { threshold: 0.1 });

	  observer.observe(bodyContent);
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
	
	

	let mobileMenuOpen = false;

		mobileMenuIcon.addEventListener('click', () => {
	    const menuItems = mobileMenuPanel.querySelectorAll('ul li');
	  
	  if (!mobileMenuOpen) {
		// Apri il menu
		mobileMenuPanel.classList.add('open');
		mobileMenuIcon.src='web/images/clode_panel.png';
		logoVianini.src = 'web/images/logo_vianini-trasp2.png';
		mobileMenuOpen = true;
		header.classList.add('hovered');
		
		menuItems.forEach((item, index) => {
		  setTimeout(() => {
			item.style.opacity = '1';
			item.style.transform = 'translateX(0)';
		  }, index * 100); // delay tra gli elementi
		});
	  } else {
		// Chiudi il menu
		mobileMenuPanel.classList.remove('open');
		mobileMenuPanel2.classList.remove('open');
		document.querySelectorAll('#mobile-menu-panel ul li').forEach(li => {
		  li.classList.remove('selected');
		});
		if(currentSlide && currentSlide==0){
			header.classList.remove('hovered');
			logoVianini.src = 'web/images/logo_vianini-trasp_w.png';
			mobileMenuIcon.src='web/images/nav-bars-w.png';
		}else{
			@if($cmd=="progetto_dett")
				const scrollY = window.scrollY;
			
				if (scrollY >= 100){
					header.classList.add('hovered');
					logoVianini.src = 'web/images/logo_vianini-trasp2.png';
					mobileMenuIcon.src='web/images/nav-bars.png';
				}else{
					header.classList.remove('hovered');
					header.classList.remove('header-wrapper-transparent');
					logoVianini.src = 'web/images/logo_vianini-trasp_w.png';
					mobileMenuIcon.src='web/images/nav-bars-w.png';
				}
			@else
				header.classList.add('hovered');
				logoVianini.src = 'web/images/logo_vianini-trasp2.png';
				mobileMenuIcon.src='web/images/nav-bars.png';
			@endif
		}
		
		mobileMenuOpen = false;
		
		menuItems.forEach(item => {
		  item.style.opacity = '0';
		  item.style.transform = 'translateX(-100px)';
		});
	  }
	});

@if (($img && file_exists($img_path)) || ($video && file_exists($video_path)))
	const headerVianini = document.getElementById('header-wrapper');
	const mobMenuIconVianini = document.getElementById('mobileMenuIcon');
	
	document.addEventListener('DOMContentLoaded', () => {
		//updateHeaderMode(0);		
		logoVianini.src = 'web/images/logo_vianini-trasp_w.png';
		mobMenuIconVianini.src = 'web/images/nav-bars-w.png';
	});
	
	function handleScrollEffect() {
		const scrollY = window.scrollY;
		if (scrollY >= 100 || mobileMenuOpen || panelOpen) {
			updateHeaderMode(1);		
			
		} else {
			@if (($img && file_exists($img_path)) || ($video && file_exists($video_path)))
				updateHeaderMode(0);
				headerVianini.classList.remove('hovered');
				logoVianini.src = 'web/images/logo_vianini-trasp_w.png';
				mobMenuIconVianini.src = 'web/images/nav-bars-w.png';
			@else
				updateHeaderMode(1);
				logoVianini.src = 'web/images/logo_vianini-trasp2.png';
				mobMenuIconVianini.src = 'web/images/nav-bars.png';
			@endif
			
		}

		if(!mobileMenuOpen){
			if (scrollY >= 100){
				mobMenuIconVianini.src = 'web/images/nav-bars.png';
			}else{
				@if (($img && file_exists($img_path)) || ($video && file_exists($video_path)))
					mobMenuIconVianini.src = 'web/images/nav-bars-w.png';
				@else
					mobMenuIconVianini.src = 'web/images/nav-bars.png';					
				@endif
			}
		}else{
			mobMenuIconVianini.src = 'web/images/clode_panel.png';
		}
	}

	window.addEventListener('scroll', handleScrollEffect);
	document.addEventListener('DOMContentLoaded', handleScrollEffect);
	
	// Hover solo se pannello NON aperto
	headerVianini.addEventListener('mouseenter', () => {
	  
		headerVianini.classList.add('hovered');
		logoVianini.src = 'web/images/logo_vianini-trasp2.png';
		linkedin.src = 'web/images/linkedin_b.png';
		instagram.src = 'web/images/instagram_b.png';
		if(!mobileMenuOpen){
			mobMenuIconVianini.src = 'web/images/nav-bars.png';
		}else{
			mobMenuIconVianini.src = 'web/images/clode_panel.png';
		}
		
	  
	});

	headerVianini.addEventListener('mouseleave', () => {
	  if (scrollY >= 100 || mobileMenuOpen || panelOpen) {
			updateHeaderMode(1);				
		} else {
			@if (($img && file_exists($img_path)) || ($video && file_exists($video_path)))
				headerVianini.classList.remove('hovered');
				updateHeaderMode(0);
			@else
				updateHeaderMode(1);
			@endif
			
		}

		if(!mobileMenuOpen){
			@if (($img && file_exists($img_path)) || ($video && file_exists($video_path)))
				if (scrollY >= 100){
					mobMenuIconVianini.src = 'web/images/nav-bars.png';
				}else{
					mobMenuIconVianini.src = 'web/images/nav-bars-w.png';					
				}
			@else
				mobMenuIconVianini.src = 'web/images/nav-bars.png';
			@endif
		}else{
			mobMenuIconVianini.src = 'web/images/clode_panel.png';
		}
	});
@endif
</script>
@endif


@endsection
