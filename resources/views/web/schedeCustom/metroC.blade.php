@php
	$query_dett = DB::table('punti_mappa')
		->select('*')
		->where('id', '=', $id_dett)
		->get();
@endphp
<style>
	.project-detail {
	  width: 100%;
	  position: relative;
	  color: #fff;
	  font-family: sans-serif;
	  /*overflow-x:hidden;*/
	}

	.hero {
	  position: relative;
	  width: 100%;
	  height: 100vh;
	  overflow: hidden;
	}

	.hero-video {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  min-height: 100%;
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
	  width: 100%;
	  max-width: 100%;
	  min-height: 100vh; /* era height: 100vh */
	  position: relative;
	  background: #fff;
	  color: #000;
	  overflow: visible; /* permetti lo scroll */
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
		font-size:25px;
	}
	.metric-value::before {
	  content: '';
	  position: absolute;
	  left: -20px;
	  top: -4px;		  
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
	.boxFlexDett{gap:30px;}
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
 padding-top:450px;
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
  height: 435px;
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
  opacity: 0;
  
  transform: translateX(250px);
  transition: opacity 1.5s cubic-bezier(0.15, 0.85, 0.3, 1), transform 1.5s cubic-bezier(0.15, 0.85, 0.3, 1);
}

.carousel-image.active {
  opacity: 1;
  transform: translateX(0);
}

.carousel-image {
  flex: 0 0 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0;
  transform: translateX(250px);
  transition: opacity 1.5s cubic-bezier(0.15, 0.85, 0.3, 1), transform 1.5s cubic-bezier(0.15, 0.85, 0.3, 1);
}

.carousel-image.show {
  opacity: 1;
  transform: translateX(0);
}

.mainTextContainer p {line-height:1.4}
.mainTextContainer ul li {line-height:1.4}
//.mainTextContainer p b{color:{{config('app.color1')}}}
//.mainTextContainer ul li b{color:{{config('app.color1')}}}
.mainTextContainer h3{font-size:30px; margin-bottom:5px; margin-top:0;}
.bottomLineRed{width:100%; height:2px; background:{{config('app.color1')}}; margin-bottom:30px; }
.bottomLineBlack{width:100%; height:2px; background:#000; margin-bottom:30px; }

.metric-value{
	position:relative;
	font-size:20px !important;
	
}
.metric-value::before {
	content: '';
	position: absolute;
	left: -25px;
	top: 4px;		  
	width: 12px;
	height: 12px;
	border-right: 2px solid #E73338;
	border-bottom: 2px solid #E73338;
	transform: rotate(-45deg);
}
.project-metrics {
	margin-left:15px !important;
	margin-bottom:15px;
}

@keyframes fadeZoomIn {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.img-fade-zoom {
  opacity: 0;
  transform: scale(0.8);
  transition: transform 0.8s ease, opacity 0.8s ease;
}

.img-fade-zoom.visible {
  opacity: 1;
  transform: scale(1);
}

@media screen AND (max-width:1127px){
	.carousel-track {
	  height: 455px;
	}
	.carousel-controls {
		padding-top:470px;
	}
}

/*
#detail-content {
	background: url(web/images/v_grigia_sfondo.png) no-repeat left top;
	background-size:contain;	
	position: relative;
	z-index: 1;
	overflow: hidden;
	
}*/

	#videoProgDesk { display: block; }
	#videoProgMob { display: none; }
	@media screen AND (max-width: 580px) {
		#videoProgDesk { display: none; }
		#videoProgMob { display: block; }
	}
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
			<video autoplay muted loop playsinline class="hero-video" id="videoProgDesk"  style="width:100%; height:100%; object-fit:cover; object-position: center center">
			  <source src="resarea/video/{{$query_dett[0]->video}}" type="video/mp4">
			  Il tuo browser non supporta il tag video.
			</video>
			@if ($video_mob && file_exists($video_path_mob))
				<video autoplay muted loop playsinline class="hero-video" id="videoProgMob" style="width:100%; height:100%; object-fit:cover; object-position: center center">
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
			@if(isset($query_dett[0]->sottotitolo1))
			  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo1}}</span>
			  @php $delay += 1; @endphp
			@endif
			@if(isset($query_dett[0]->sottotitolo2))
			  <span class="animate-on-scroll subtitle" class="barSubTitle">|</span>
			  <span class="gapSubtitle"><br/></span>
			  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo2}}</span>
			  @php $delay += 1; @endphp
			@endif
			@if(isset($query_dett[0]->sottotitolo3))
			  <span class="animate-on-scroll subtitle" class="barSubTitle"style="animation-delay: {{$delay}}s">|</span>
			  <span class="gapSubtitle"><br/></span>
			  <span class="animate-on-scroll subtitle" style="animation-delay: {{$delay}}s">{{$query_dett[0]->sottotitolo3}}</span>
			@endif
		  </div>
		</div>
		
	  </div>
  @endif
  <div class="detail-content" id="detail-content">
	<div class="mainTextContainer">
		<div style="padding:80px 0 50px 0">
			<div style="width:100%; display:flex; border-bottom:solid 1px #000; padding-bottom:50px; margin-bottom:50px;" class="boxFlexDett">
				<div style="flex:1;">
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
							</div>
							<div style="flex:1;  display:flex; flex-direction:column; gap:10px; line-height:1.2;" class="projTitCol2-{{ $query_dett[0]->id }}">
								@if(isset($query_dett[0]->tipologia))
									<div><span class="projTit">Tipologia di contratto</span>:<span class="gapProg"><br/></span> {{$query_dett[0]->tipologia }}<br/></div>
								@endif
								@if(isset($query_dett[0]->stato))
									<div><span class="projTit">Stato di lavorazione</span>:<span class="gapProg"><br/></span> {{ ucfirst(str_replace("Lavoro ","",$query_dett[0]->stato)); }}<br/></div>
								@endif
							</div>
						</div>
					</div>
					@if($dati==1 && $count_gal>0) 
						<div style="width:calc(100% - 20px); background:#F5F5F5; margin-top:25px;" class="projMetrics animate-on-scroll">
							<div style="padding:20px;">
								@if(isset($query_dett[0]->valore_dato_1) && $query_dett[0]->valore_dato_1!="")
									<div class="project-metrics">
									  <div class="metric-value">{{ $query_dett[0]->valore_dato_1 }}</div>
									  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_1 }}</div>
									</div>
								@endif
								@if(isset($query_dett[0]->valore_dato_2) && $query_dett[0]->valore_dato_2!="")
									<div class="project-metrics">
									  <div class="metric-value">{{ $query_dett[0]->valore_dato_2 }}</div>
									  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_2 }}</div>
									</div>
								@endif
								@if(isset($query_dett[0]->valore_dato_3) && $query_dett[0]->valore_dato_3!="")
									<div class="project-metrics">
									  <div class="metric-value">{{ $query_dett[0]->valore_dato_3 }}</div>
									  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_3 }}</div>
									</div>
								@endif
								@if(isset($query_dett[0]->valore_dato_4) && $query_dett[0]->valore_dato_4!="")
									<div class="project-metrics">
									  <div class="metric-value">{{ $query_dett[0]->valore_dato_4 }}</div>
									  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_4 }}</div>
									</div>
								@endif
								@if(isset($query_dett[0]->valore_dato_5) && $query_dett[0]->valore_dato_5!="")
									<div class="project-metrics">
									  <div class="metric-value">{{ $query_dett[0]->valore_dato_5 }}</div>
									  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_5 }}</div>
									</div>
								@endif
							</div>
						</div>
					@endif
					<div class="animate-on-scroll buttMapp" style="
						
						width:190px;
						height:auto;
						padding:10px 5px;
						background:#E30613;
						border-radius:26px;
						border:solid 1px #fff;
						cursor:pointer;
						margin-top:20px;
					">
					  <a href="mappa-interattiva.html?id={{$query_dett[0]->id}}" style="text-decoration:none"><div style="font-size:16px; color:#fff; width:100%; text-align:centeR;"><b>MAPPA INTERATTIVA</b></div></a>
					</div>
				</div>
				
				@if($count_gal>0 || $dati==1)
					<div style="flex:1;">
						@if($count_gal==0 && $dati==1)
							<div style="width:calc(100% - 20px); background:#F5F5F5; margin-top:25px;" class="projMetrics animate-on-scroll">
								<div style="padding:20px;">
									@if(isset($query_dett[0]->valore_dato_1))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_1 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_1 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_2))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_2 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_2 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_3))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_3 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_3 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_4))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_4 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_4 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_5))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_5 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_5 }}</div>
										</div>
									@endif
								</div>
							</div>
						@endif
						@if($count_gal>0)
							
							@if($count_gal==1)
								<div style="width:100%; min-height:400px;  position:relative; overflow:hidden">
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
											<img src="resarea/img_up/punti/{{ $value_gal->img }}" alt="{{ $query_dett[0]->titolo }} - Immagine {{$p}}" class="carousel-image">
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
							
						@endif
					</div>
				@endif
			</div>
			<div style="width:100%; font-size:20px;" class="animate-on-scroll project-body-content">
				<div  class="animate-on-scroll project-body-content">
					<h2>Spostamenti più veloci e rigenerazione urbana per Roma</h2>
					<p>
						La nuova Metro C di Roma, raddoppiando l’attuale estensione della rete metropolitana, risponde all’esigenza della Capitale, di migliorare la mobilità urbana riducendo le distanze tra il centro e le periferie e ampliando le connessioni per una efficace accoglienza. 
					</p>
					<p>
						Il progetto si configura come treno tra passato e futuro: dall’innovazione del primo treno driverless di Roma, alla valorizzazione del <b>patrimonio archeologico e monumentale</b> lungo il tracciato, passando attraverso nuovi spazi creati per la comunità. 
					</p>
					<p>
						Una linea lunga <b>26 km</b>, con <b>29 stazioni</b>, che <b>avvicinerà l’estremità sudorientale della città a quella occidentale</b>, trasformandone il modo di vivere e rendendola più sostenibile e vivibile.
					</p>
				</div>
				<div style="display:flex; gap:40px; padding:60px 0 60px 0; align-items: stretch;">
					<style>
						.imgMob{display:none;}
						
						@media screen AND (max-width:1024px){
							.imgMob{display:block;}
							#imgDett1{display:none !important;}
							#blocco1Img{display:none}
						}
					</style>
					<div style="flex:1; display: flex; " id="imgDett1">
						

					</div>
					<div style="flex:1 ; position:relative;" >
						<div style=""  class="animate-on-scroll project-body-content">
							<h3>I numeri del tracciato</h3>
							<div class="bottomLineBlack"></div>
							<p>
								La Metro C di Roma da <b>Monte Compatri</b> fino a <b>Clodio-Mazzini</b> costruisce un futuro condiviso: per i cittadini di Roma che la abitano e ci lavorano tutti i giorni, per i turisti nazionali e internazionali che vogliono vivere l’inestimabile patrimonio della Città Eterna e per le Istituzioni che ne hanno promosso e sostenuto la realizzazione.
							</p>
						</div>
						
						<img src="web/images/vianini-metro-c-roma-05.jpg" alt="" style="width:100%; margin:40px 0" class="img-fade-zoom imgMob" />
						
						<div style="margin-top:60px;"  class="animate-on-scroll project-body-content">
							<h3>Nuove occasioni di rigenerazione urbana</h3>
							<div class="bottomLineBlack"></div>
							<p>
								Metro C rappresenta anche un’importante occasione di <b>rigenerazione urbana</b>, tanto per le periferie come per il centro: restituisce <b>spazi riqualificati</b> alla cittadinanza e crea nuove opportunità di <b>fruizione del territorio urbano</b>. Terminate le opere nel sottosuolo, le aree in superficie interessate dai cantieri vengono restituite alla cittadinanza, rinnovate e ridisegnate per accogliere le nuove esigenze funzionali della città e del suo futuro.
							</p>
						</div>
						<div style="position:absolute; width:100%; height:100%; top:0; left:calc(-100% - 40px);" id="blocco1Img">
							<img src="web/images/vianini-metro-c-roma-05.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover;"  class="img-fade-zoom"/>
						</div>
					</div>
				</div>
				<style>
					
					#centerText {
						background: url(web/images/v_grigia.png) no-repeat top center;
						background-attachment: scroll;
						position: relative;
						z-index: 1;
						overflow: hidden;
					}
					
					#centerText::before {
					  content: '';
					  position: absolute;
					  top: 0;
					  left: 0;
					  width: 100%;
					  height: 100%;
					  background: url(web/images/v_grigia.png) no-repeat top center;
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
					
					#blocco2Img{display:none}
				
					@media screen AND (max-width:1024px){
						#blocco2Img{display:block;}
						#blocco2{
							flex-direction:column;
						}
					}
				</style>
				<div id="centerText"> 
					<div style="display:flex; gap:40px; padding:60px 0 0 0; align-items: stretch; height:100%;" id="blocco2"> 
						<div style="flex:1; position:relative;">
							<div style="" class="animate-on-scroll project-body-content">
								<h3>Metro C: Stazione Piazza Venezia,<br/>nel cuore di Roma</h3>
								<div class="bottomLineBlack"></div>
								<p>
									La Stazione Venezia della Linea C della Metropolitana sorge <b>nel cuore storico, culturale, turistico</b> e <b>politico</b> di Roma, circondata da testimonianze storiche e monumenti unici: il Vittoriano, Palazzo Venezia, il Palazzo delle Assicurazioni Generali, la Chiesa di Santa Maria in Loreto, in un’area ricca di reperti archeologici. 
								</p>
								<p>	
									Realizzare una stazione della Metropolitana in quest’area, scavando in profondità, conservando intatti i tesori circostanti e nel sottosuolo, preservando il ruolo di collegamento nevralgico della Piazza, è una sfida ingegneristica unica e insieme un’opportunità di raggiungere scavi mai esplorati e valorizzare il <b>patrimonio archeologico</b>. 
								</p>
								<p>	
									La Stazione Venezia della Linea C si configura come un’opera di grande valore, integrata con il contesto urbano e museale, importante snodo nel sistema di trasporti della Capitale. Un nuovo modo per coniugare cultura, innovazione e sostenibilità.
								</p>
							</div>					
							<div style="position:absolute; width:100%; height:100%; top:0; left:calc(100% + 40px);">
								<img src="web/images/vianini-metro-c-roma-04b.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover;"  class="img-fade-zoom"/>
							</div>
						</div>
						<div style="flex:1;">
							<img src="web/images/vianini-metro-c-roma-04b.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover;"  id="blocco2Img" class="img-fade-zoom"/>
						</div>
					</div>
					
					<style>
						#blocco3Imga{display:none}
						@media screen AND (max-width:1024px){
							#blocco3{flex-direction:column;}
							#blocco3Imga{display:block}
							#blocco3Imgb{display:none}
						}
					</style>
					<div style="display:flex; gap:40px; padding:60px 0 0 0; align-items: stretch;" id="blocco3"> 

						<div style="flex:1">
							
						</div>    
						<div style="flex:1; position:relative;">
							<div class="animate-on-scroll project-body-content">
								<h3>Il nuovo Polo Museale</h3>
								<div class="bottomLineBlack"></div>
								<p>
									La stazione di Piazza Venezia della Metropolitana di Roma si svilupperà su <b>otto livelli</b>, di cui <b>6 sotterranei</b>, collegati da <b>27 scale mobili</b>, <b>6 ascensori</b> e da <b>banchine di 110 metri</b>. Saranno tre gli accessi diretti alla piazza al servizio delle tre aree museali:
								</p>
								<ul>
									<li><b>sistema di Palazzo Venezia</b> tramite due scale mobili, una scala fissa e un ascensore; </li>
									<li><b>sistema dell’Ateneo di Adriano e Fori Imperiali</b>, tramite due scale mobili, una scala fissa e un ascensore vetrato; </li>
									<li><b>sistema del Vittoriano</b>, tramite una scala mobile e una fissa. Grazie alla sua posizione strategica, la Stazione Venezia sarà anche snodo museale...</li>
								</ul>
								<p>
									Una volta raggiunto il primo livello interrato, i viaggiatori potranno accedere direttamente a Palazzo Venezia, ai resti dell’Ateneo di Adriano, al Parco Archeologico, ai Fori Imperiali e al Vittoriano.
								</p>
								
								<img src="web/images/vianini-metro-c-roma-07.jpg" alt=""  id="blocco3Imga" style="width:100%;" class="img-fade-zoom"/>
								
								<div style="position:absolute; width:100%; height:100%; top:0; left:calc(-100% - 40px);">
									<img src="web/images/vianini-metro-c-roma-07.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover;"  id="blocco3Imgb" class="img-fade-zoom"/>
								</div>
							</div>					
						</div>
				</div>
			</div>
		</div>
	</div>  
	<style>
		#blocco4Imgb{display:none}
		@media screen AND (max-width:1024px){
			#blocco4{flex-direction:column;}
			#blocco4Img{display:none}
			#blocco4Imgb{display:block}
		}
	</style>
	<div style="width:100%; background:#F5F5F5;">
		
			<div style="display:flex; gap:40px; padding:60px; align-items: stretch; position:relative" id="blocco4">
				<div style="flex:1; position:relative;">
					<div style="" class="animate-on-scroll project-body-content">
						<h3>Il driverless</h3>
						<div class="bottomLineRed"></div>
						<p>
							La Metro C fa correre l’innovazione. Fra gli elementi tecnologici di rilievo rientra il sistema <b>driveless</b>, il Sistema di Automazione Integrale, gestisce tutti le funzioni del veicolo da remoto, senza la presenza del macchinista a bordo. Tutto viene gestito dalla <b>Direzione Centrale Operativa</b> (DCO), che rappresenta sia il cuore che il cervello di questo sistema. Dalla Centrale ai treni, un altro piccolo primato: <b>i treni driveless della Linea C sono treni ad alta automazione più lunghi d’Europa, con 109,4 mt di lunghezza</b>. 
						</p>
						<p>					
							Questa tecnologia è un sistema innovativo, già utilizzato per le Metropolitane di Hong Kong, Lile, Parigi e in particolar modo Copenaghen. In Italia, il sistema <b>driveless</b> è utilizzato dalla Metropolitane di Brescia e nella nuova Linea Lilla della Metropolitana di Milano.
						</p>
					</div>	
					<div style="position:absolute; width:100%; height:100%; top:0; left:calc(100% + 40px);">
						<img src="web/images/vianini-metro-c-roma-06.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover;"  id="blocco4Imga" class="img-fade-zoom"/>
					</div>
				</div>
				<div style="flex:1">
					<img src="web/images/vianini-metro-c-roma-06.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover;"  id="blocco4Imgb" class="img-fade-zoom"/>
				</div>
			</div>
		
	</div>
	
	<?php /*<style>
		#bottom-content {
			background: url(web/images/v_grigia_sfondo.png) no-repeat left center;
			background-size:cover;
			
			position: relative;
			z-index: 1;
			overflow: hidden;
		}

	  </style>*/?>
	
	<style>
		@media screen AND (max-width:1024px){
			#bottomText1, #bottomText2{
				flex-direction:column;
			}
			.bottomLineBlackMedium{display:none}
		}
	</style>
	<div style="width:100%;  padding:60px 0;" id="bottom-content">
			<div style="width:100%;">
				<div style="flex:1">
					<div style="" class="animate-on-scroll project-body-content">
						<h3>Roma verso un futuro sostenibile<br/>per le nuove generazioni</h3>
					</div>					
				</div>
				<div style="flex:1">
				
				</div>
			</div>
			<div style="display:flex; gap:40px;" id="bottomText1">
				<div style="flex:1">
					<div style="" class="animate-on-scroll project-body-content">
						<div class="bottomLineBlack"></div>
						<p>
							La linea C è anche una <b>grande infrastruttura di mobilità sostenibile</b> che aiuterà la città di Roma nel suo percorso di avvicinamento agli <b>obiettivi di sviluppo sostenibile</b> (SDG) fissati dalle Nazioni Unite.<br/>
							La Linea C consentirà il trasporto di circa <b>600.000 passeggeri al giorno</b>, con una capacità massima di 800.000, vale a dire potenzialmente <b>24.000 utenti all’ora</b> per senso di marcia, capaci di spostarsi più velocemente e con un minore inquinamento rispetto al passato. 
						</p>
						<p>							
							Grande impatto anche in termini di sostenibilità: per la sola tratta da San Giovanni al Colosseo Fori Imperiali, si stima <b>una riduzione di CO2 di circa 34.000 t all’anno</b>.
						</p>
					</div>					
				</div>
				<div style="flex:1" class="animate-on-scroll project-body-content">
					<div class="bottomLineBlack bottomLineBlackMedium"></div>
					<p>
						Fra gli obiettivi del progetto ci sono quelli di garantire accesso ad un <b>servizio di trasporto sempre più efficiente</b> per tutti i futuri eventi. La linea C punta a connettere le tante realtà del territorio attraversato. A partire dal capolinea di Pantano, a sud est nel Comune di Monte Compatri, la linea si sviluppa per 26 km (17 km in sotterraneo e circa 9 km in superficie), procedendo verso il centro ed il quadrante nord-ovest, attraversando quartieri storici e popolosi della città, a cui offre anche nuove opportunità di fruizione degli spazi. 
					</p>						
					<p>
						Di notevole impatto sarà la <b>riduzione del traffico locale</b>, dell’immissione nell’area di CO2 e dell’inquinamento acustico. Studi sviluppati in collaborazione con l’Università degli Studi di Roma Tor Vergata, stimano che dall’utilizzo della tratta che dal capolinea a Monte Compatri/Pantano arriva alla Stazione San Giovanni, derivi una <b>riduzione del trasporto</b> provato di 25 mila km/anno, oltre che una conseguente <b>riduzione di circa 1.800 incidenti all’anno</b>.
					</p>
				</div>
			</div>
		
			<div style="width:100%;">
				<div style="flex:1">
					<div style="" class="animate-on-scroll project-body-content">
						<h3>I benefici della Linea C<br/>della Metropolitana di Roma</h3>
					</div>					
				</div>
				<div style="flex:1">
				
				</div>
			</div>
			<div style="display:flex; gap:40px;" id="bottomText2">
				<div style="flex:1">
					<div style="" class="animate-on-scroll project-body-content">
						<div class="bottomLineBlack"></div>
						<p>
							La Metro C di Roma rappresenta un’opportunità di sviluppo, a cominciare dal contesto economico. Dall’inizio dei lavori, il progetto ha coinvolto circa 1.500 fornitori, con una filiera radicata nel nostro Paese: circa il <b>90% delle aziende coinvolte sono italiane</b>.<br/>
							L’opera contribuisce a rendere Roma più accessibile, avvicinando la periferia sud-orientale al centro, generando un “effetto rete” per la mobilità di Roma.<br/>
							Terminate le opere nel sottosuolo, le aree dei cantieri in superficie, vengono man mano restituire alla cittadinanza. Le sistemazioni esterne di stazioni e pozzi sono progettate per creare luoghi fruibili dai cittadini.
						</p>
					</div>					
				</div>
				<div style="flex:1">
					<div class="bottomLineBlack bottomLineBlackMedium"></div>
					<p class="animate-on-scroll project-body-content">
						La Metro C costruisce sostenibilità. già durante i lavori è stato dato ampio spazio al verde cittadino: nel progetto sono stati realizzati circa 90.000m2 di aree a verde e sono stati piantumati oltre 4.300 nuovi alberi. La linea avrà un grande impatto anche in termini di sostenibilità futura. Per l’intera Linea, si stima una riduzione di emissioni CO2 di circa 310.000 t l’anno.<br/>
						Alcune soluzioni impiegate nella realizzazione della Linea C della Metro potranno diventare un benchmark per l’ingegneria delle opere pubbliche in contesti complessi dal punto di vista antropico e culturale. Un’opera che, sotto tutti gli aspetti, è già capace di costruire il futuro.
					</p>
				</div>
			</div>
		
	</div>
  </div>
</div>

<!-- GLightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

@if ($img && file_exists($img_path))
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const detailContent = document.getElementById('detail-content');
		const carouselImages = document.querySelectorAll('.carousel-image');
		let hasAnimated = false;

		if (!detailContent || carouselImages.length === 0) return;

		const observer = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				if (entry.isIntersecting && !hasAnimated) {
					hasAnimated = true;

					carouselImages.forEach((img, i) => {
						img.style.transitionDelay = `${i * 0.1}s`; // delay crescente
						img.classList.add('active');
					});

					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.1 });

		observer.observe(detailContent);
	});	
</script>
@endif
<script>
function initCarousel(carouselContainer) {
  const track = carouselContainer.querySelector('.carousel-track');
  const images = track.querySelectorAll('.carousel-image');
  const nextBtn = carouselContainer.querySelector('.circleArrowProj:nth-of-type(2)');
  const prevBtn = carouselContainer.querySelector('.circleArrowProj:nth-of-type(1)');
  let currentIndex = 0;

  const slideWidth = carouselContainer.offsetWidth;

  const easeInOutQuint = t => 1 - Math.pow(1 - t, 4);

	const smoothScrollTo = (element, target, duration = 250) => {
	  const start = element.scrollLeft;
	  const change = target - start;
	  const startTime = performance.now();

	  const animateScroll = currentTime => {
		const timeElapsed = currentTime - startTime;
		const t = Math.min(timeElapsed / duration, 1);
		element.scrollLeft = start + change * easeInOutQuint(t);
		if (t < 1) {
		  requestAnimationFrame(animateScroll);
		}
	  };

	  requestAnimationFrame(animateScroll);
	};
	
  const scrollToSlide = (index) => {
    smoothScrollTo(track, index * slideWidth, 250);
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

  // Animate images
  images.forEach((img, i) => {
    img.style.transitionDelay = `${i * 0.1}s`;
    img.classList.add('active');
  });
}

@if ($img && file_exists($img_path))
	document.addEventListener('DOMContentLoaded', () => {
		updateHeaderMode(0);
		currentslide=0;
		
		const header = document.getElementById('header-wrapper');
		
		header.addEventListener('mouseenter', () => {
	  
			header.classList.add('hovered');
			logo.src = 'web/images/logo_vianini-trasp2.png';
			linkedin.src = 'web/images/linkedin_b.png';
			instagram.src = 'web/images/instagram_b.png';
			if(!mobileMenuOpen){
				mobMenuIcon.src = 'web/images/nav-bars.png';
			}
			
		  
		});
		header.addEventListener('mouseleave', () => {
		  if (!panelOpen) {	
				header.classList.remove('hovered');		  
				logo.src = 'web/images/logo_vianini-trasp_w.png';
				linkedin.src = 'web/images/linkedin_w.png';
				instagram.src = 'web/images/instagram_w.png';		  
		  }
		});
		
		const scrollY = window.scrollY;
		if (scrollY >= 100) {
			header.classList.add('hovered');		  
			logo.src = 'web/images/logo_vianini-trasp2.png';
			linkedin.src = 'web/images/linkedin_b.png';
			instagram.src = 'web/images/instagram_b.png';
			header.addEventListener('mouseleave', () => {
				header.classList.add('hovered');		  
				logo.src = 'web/images/logo_vianini-trasp2.png';
				linkedin.src = 'web/images/linkedin_b.png';
				instagram.src = 'web/images/instagram_b.png';
			});
		} else {
			header.classList.remove('hovered');		  
			logo.src = 'web/images/logo_vianini-trasp_w.png';
			linkedin.src = 'web/images/linkedin_w.png';
			instagram.src = 'web/images/instagram_w.png';	
			header.addEventListener('mouseleave', () => {
				header.classList.remove('hovered');		  
				logo.src = 'web/images/logo_vianini-trasp_w.png';
				linkedin.src = 'web/images/linkedin_w.png';
				instagram.src = 'web/images/instagram_w.png';	
			});
		}
		
		window.addEventListener('scroll', () => {
			const scrollY = window.scrollY;
			if (scrollY >= 100) {
				header.classList.add('hovered');		  
				logo.src = 'web/images/logo_vianini-trasp2.png';
				linkedin.src = 'web/images/linkedin_b.png';
				instagram.src = 'web/images/instagram_b.png';
				header.addEventListener('mouseleave', () => {
					header.classList.add('hovered');		  
					logo.src = 'web/images/logo_vianini-trasp2.png';
					linkedin.src = 'web/images/linkedin_b.png';
					instagram.src = 'web/images/instagram_b.png';
				});
			} else {
				header.classList.remove('hovered');		  
				logo.src = 'web/images/logo_vianini-trasp_w.png';
				linkedin.src = 'web/images/linkedin_w.png';
				instagram.src = 'web/images/instagram_w.png';	
				header.addEventListener('mouseleave', () => {
					header.classList.remove('hovered');		  
					logo.src = 'web/images/logo_vianini-trasp_w.png';
					linkedin.src = 'web/images/linkedin_w.png';
					instagram.src = 'web/images/instagram_w.png';	
				});
			}
		});
	});
@endif
	  
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

@if ($img && file_exists($img_path))	
document.addEventListener('DOMContentLoaded', () => {
	const options = {
		threshold: 0.1
	};

	const observer = new IntersectionObserver((entries) => {
		entries.forEach((entry, index) => {
			if (entry.isIntersecting) {
				const el = entry.target;

				if (el.classList.contains('title2') || el.classList.contains('subtitle2Container') || el.classList.contains('buttMapp') || el.classList.contains('project-body-content')) {
					el.style.animationDelay = `${index * 0.2}s`;
					el.classList.add('fade-slide-up');
					carousel = document.querySelector('.gallery-carousel');
					initCarousel(carousel); 
				} else if (el.classList.contains('projTits') || el.classList.contains('projMetrics')) {
					el.style.animationDelay = `${index * 0.4}s`;
					el.classList.add('fade-slide-right');
				}

				observer.unobserve(el);
			}
		});
	}, options);

	['.title2', '.subtitle2Container', '.projTits', '.projMetrics', '.buttMapp', '.project-body-content'].forEach(selector => {
		document.querySelectorAll(selector).forEach(el => {
			observer.observe(el);
		});
	});
});
@else
	document.addEventListener('DOMContentLoaded', () => {
		const elementsFadeSlideUp = document.querySelectorAll('.title2, .subtitle2Container, .buttMapp, .project-body-content');
		const elementsFadeSlideRight = document.querySelectorAll('.projTits, .projMetrics');

		elementsFadeSlideUp.forEach((el, index) => {
			el.style.animationDelay = `${index * 0.2}s`;
			el.classList.add('fade-slide-up');

			// Inizializza il carosello se presente
			if (el.classList.contains('project-body-content')) {
				const carousel = document.querySelector('.gallery-carousel');
				if (carousel) {
					initCarousel(carousel);
				}
			}
		});

		elementsFadeSlideRight.forEach((el, index) => {
			el.style.animationDelay = `${index * 0.4}s`;
			el.classList.add('fade-slide-right');
		});
	});

@endif
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const zoomImgs = document.querySelectorAll('.img-fade-zoom');

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.2
  });

  zoomImgs.forEach(img => observer.observe(img));
});
</script>



