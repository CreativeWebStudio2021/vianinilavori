@php
	$evidenza = DB::table('news_menu')
		->select('*')
		->where('visibile','=','1')
		->orderBy('ordine','DESC')
		->get();
	$num_evidenza = $evidenza->count();
@endphp

<style>

	.panel-columns-ajax{
	  display: flex;
	  opacity: 1;
	  transform: translateY(-20px);
	  transition: all 0.5s ease;
	  position:relative;
	  gap:25px;
	}

	/* Colonne */
	.panel-left {
	  flex: 0 0 40%;
	}

	.panel-right {
	  flex: 0 0 60%;
	}
	.boxPartner1 {
	  flex: 0 0 50%;
	}
	.boxPartner2 {
	  flex: 0 0 50%;
	}
	
	/* Il paragrafo rimane normale: impilato uno sotto l'altro */
	.panel-left p {
	  font-weight: 400;	  
	  cursor: pointer;
	  margin: 10px 0;
	  position:relative;
	  font-size:28px;
	  opacity: 1;
	}
	
	#boxPartners {
	  display: flex;
	  gap: 10px;
	  opacity: 0;
	  transform: translateX(250px);
	  transition: all 1.5s cubic-bezier(.28,.71,.17,.94);
	  padding-left:100px;
	}

	/* Lo span dentro controlla solo l'interno (testo + freccia) */
	.panel-left-text {
	  align-items: center;
	  height:10px; width:10px;
	  gap: 20px; /* spazio tra testo e freccia */
	  position: relative;
	  background:#fff;
	  padding:0 5px;
	  transition: all 0.3s ease;
	}

	/* Hover sul p (intero) */
	.panel-left p:hover {
	  font-weight: 700;
	}

	/* La freccia */
	.panel-left-text::after {
	  content: '';
	  position: absolute;
	  right: -10px;
	  top: 10px;
	  transform: translateY(-50%);
	  width: 12px;
	  height: 12px;
	  border-right: 2px solid #E73338;
	  border-bottom: 2px solid #E73338;
	  transform: rotate(-45deg);
	  opacity: 0;
	  transition: all 1.5s cubic-bezier(.28,.71,.17,.94);
	}

	/* Hover mostra la freccia */
	.panel-left p:hover .panel-left-text {
	  background:#d9d9d9;		
	}
	.panel-left p:hover .panel-left-text::after {
	  opacity: 1;
	  right: -30px;
	}
	
	.sub-items, .sub-sub-items {
	  margin-left: 30px;
	  display: none;
	  flex-direction: column;
	}

	.sub-sub-items {
	  margin-left: 30px;
	}

	.sub-items p, .sub-sub-items p {
	  font-size: 20px;
	  opacity: 0;
	  transform: translateX(-200px);
	  transition: transform 1.2s ease, opacity 1.2s ease;
	  cursor: pointer;
	}

	/* Effetto hover uguale a livello 1 */
	.sub-items p:hover .panel-left-text,
	.sub-sub-items p:hover .panel-left-text {
	  background: #d9d9d9;
	  font-weight: 700;
	}

	.sub-items p:hover .panel-left-text::after,
	.sub-sub-items p:hover .panel-left-text::after {
	  opacity: 1;
	  right: -30px;
	}
	
	
	/* Freccia più piccola nei sotto e sottosotto menù */
	.sub-items .panel-left-text::after,
	.sub-sub-items .panel-left-text::after {
	  width: 10px;
	  height: 10px;
	  border-right: 1.5px solid #E73338;
	  border-bottom: 1.5px solid #E73338;
	  right: -5px;
	  top: 4px;
	}
	#panel-left-text-1, #panel-left-text-2, #panel-left-text-3, #panel-left-text-4{		
	  transform: translateX(-200px);
	  opacity:0;
	  transition: transform 1.5s cubic-bezier(.28,.71,.17,.94), opacity 1.5s cubic-bezier(.28,.71,.17,.94);		
	}
	
	#inEvidenzaTxt{		
		transform: translateX(250px);
		opacity:0;
		transition: transform 1.5s cubic-bezier(.28,.71,.17,.94), opacity 1.5s cubic-bezier(.28,.71,.17,.94);
	}
	
	#imgNewseMedia {
		  opacity: 0;
		  transform: translateX(250px);
		  transition: all 1.5s cubic-bezier(.28,.71,.17,.94);
			width: 100%;
			height: auto;
		}
	
	.partnersLink{
		cursor:pointer;
	}
	.partnersLinkText{
		transition: all 0.3s ease;
	}
	.partnersLinkArrow{
		margin-top:7px; 
		width: 12px; height: 12px; 
		border-right: 2px solid #000; 
		border-bottom: 2px solid #000; 
		transform: rotate(-45deg);
		transition: all 0.3s ease;
	}
	.partnersLink:hover .partnersLinkText{
		font-weight:700;
		background:#d9d9d9;
	}
	.partnersLink:hover .partnersLinkArrow{
		border-right: 2px solid #E73338; 
		border-bottom: 2px solid #E73338; 
		margin-left:10px;
	}
	
	.circle-arrow{
		position:absolute; 
		bottom:15px; 
		right:10px; 
		width:37px; 
		height:37px; 
		border:solid 1px #fff;
		border-radius:20px
	}
	.circle-arrow-right{
		position:absolute; 
		width: 18px; 
		height: 18px; 
		top:8px; 
		left:5px; 
		border-right: 2px solid #fff; 
		border-bottom: 2px solid #fff; 
		transform: rotate(-45deg); 
	}
	
	.boxPartner1:hover .circle-arrow,
	.boxPartner2:hover .circle-arrow {
		background: rgba(255, 255, 255, 0.8); /* bianco con trasparenza */
		border: solid 1px #000; /* bordo nero */
	}
	
	.boxPartner1:hover .circle-arrow-right,
	.boxPartner2:hover .circle-arrow-right {
		border-right: 2px solid #000; /* freccia nera */
		border-bottom: 2px solid #000;
	}
	
	/* Primo livello */
	.panel-left > p .panel-left-text {
	  font-size: 28px;
	}

	/* Secondo e terzo livello */
	.sub-items .panel-left-text,
	.sub-sub-items .panel-left-text {
	  font-size: 20px;
	}
	
	.panel-left-text.open {
	  background: #d9d9d9;
	  font-weight: 700;
	}
	
	.panel-left-text.first{
		padding-bottom:2px;
		border-bottom:solid 1px;
		margin-bottom:30px;
	}
	
	#inEvidenzaTxt{
		@if($num_evidenza==0) 
			padding-left:100px; 
			top:-20px;			
		@else
			top:20px;			
		@endif
		position:absolute;
		left:0;
		font-size:12px; 
		width:100%; 
		height:20px;
	}
	
	@media screen AND (max-width:1350px) {
		#boxPartners{
			padding-left:0;
		}
		#inEvidenzaTxt{
			padding-left:0;
		}
	}
	
	@media screen AND (max-width:1199px) {
		.panel-left {
		  flex: 0 0 40%;
		}

		.panel-right {
		  flex: 0 0 60%;
		}
		
		.sub-items,
		  .sub-sub-items {
			margin-left: 20px;
		  }
	}
	
	@media screen AND (max-width:1024px) {
	  panel-left{
		  padding-bottom:150px;
	  }
	  .panel-columns-ajax {
		flex-direction: column-reverse;
	  }
	  #boxPartners{
		flex-direction: column;
		padding-left:0;
	  }
	  .boxPartner1 {
		  flex: 0 0 100%;
		}
		.boxPartner2 {
		  flex: 0 0 100%;
		}
	  
	  .panel-left,
	  .panel-right {
		position:relative;
		flex: 0 0 auto;
		width: 100%;
	  }
		
	  .panel-left-text {		  
		  background:rgba(255,255,255,0);
		}
		
	  .panel-left-text::after {
		  top: 4px;
		}
		
	   .panel-left p {
		  margin: 5px 0;
		}
		
	  
		
		.panel-left-text.first{
			font-size:18px !important;
			font-weight:700;
		}
		.panel-left-text.first span{
			font-size:18px !important;
		}
		
	  /* RIDUZIONE FONT E PADDING */
	  .panel-left > p .panel-left-text {
		font-size: 20px;
		padding: 0 3px;
	  }
	  
	  .panel-left p:hover .panel-left-text::after {
	  opacity: 1;
		  right: -20px;
		}
		
	  
	  .sub-items .panel-left-text,
	  .sub-sub-items .panel-left-text {
		font-size: 17px;
		padding: 0 3px;
	  }

	  /* RIENTRI RIDOTTI */
	  .sub-items,
	  .sub-sub-items {
		margin-left: 8px;
	  }
	  
	  #inEvidenzaTxt{
		padding-left:0px; 
	}
	  
	}
	.gapEtica{display:none}
	@media screen AND (max-width:1280px){
		.gapEtica{display:inline}
	}
	@media screen AND (max-width:1024px){
		.panel-right{margin-top:25px}
	}
	
	.carousel-wrapper {
	  position: relative;
	  width: 100%;
	  aspect-ratio: 786 / 203; /* proporzione desktop */
		max-height: 203px;
	  overflow: hidden;
	}
	
	@media screen and (max-width: 1024px) {
	  .carousel-wrapper {
		aspect-ratio: 480 / 200;
		max-height: 200px;
	  }
	}

	.carousel-container {
	  width: 100%;
	  height: 100%;
	  position: relative;
	}

	.carousel-img {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  object-fit: cover;
	  transition: transform 0.8s ease, opacity 0.8s ease;
	  z-index: 1;
	  opacity: 0;
	  transform: translateX(100%);
	}

	.carousel-img.active {
	  opacity: 1;
	  transform: translateX(0);
	  z-index: 2;
	}

	.carousel-img.exit-left {
	  opacity: 0;
	  transform: translateX(-100%);
	  z-index: 1;
	}

	.carousel-text {
	  position: absolute;
	  top: 10px;
	  left: 15px;
	  font-size: 18px;
	  background: rgba(255,255,255,0.85);
	  padding: 5px 10px;
	  font-weight: bold;
	  z-index: 4;
	  opacity: 0;
	  transition: opacity 0.5s ease;
	}

	.carousel-text.visible {
	  opacity: 1;
	}

	.carousel-arrow {
	  position: absolute;
	  top: 50%;
	  transform: translateY(-50%);
	  font-size: 2em;
	  background: rgba(255,255,255,0.8);
	  color: black;
	  padding: 10px;
	  cursor: pointer;
	  z-index: 4;
	  user-select: none;
	  opacity: 0;
	  transition: opacity 0.5s ease;
	  pointer-events: auto;
	}

	.carousel-arrow.left {
	  left: 15px;
	}

	.carousel-arrow.right {
	  right: 15px;
	}

	.carousel-arrow.visible {
	  opacity: 1;
	}
	
	.circle-arrow{
		position:absolute; 
		bottom:15px; 
		right:10px; 
		width:37px; 
		height:37px; 
		border:solid 1px rgba(0,0,0,0.7);
		background: rgba(255, 255, 255, 0.5);
		border-radius:20px;
		z-index:2;
		cursor:pointer;
		transition: all 0.5s ease;
	}
	.circle-arrow-right{
		position:absolute; 
		width: 18px; 
		height: 18px; 
		top:8px; 
		left:5px; 
		border-right: 2px solid rgba(0,0,0,0.7); 
		border-bottom: 2px solid rgba(0,0,0,0.7); 
		transform: rotate(-45deg); 
	}
	
	.circle-arrow-2{
		position:absolute; 
		bottom:15px; 
		left:10px; 
		width:37px; 
		height:37px; 
		border:solid 1px rgba(0,0,0,0.7);
		background: rgba(255, 255, 255, 0.5);
		border-radius:20px;
		z-index:2;
		cursor:pointer;
		transition: all 0.5s ease;
	}
	.circle-arrow-left{
		position:absolute; 
		width: 18px; 
		height: 18px; 
		top:8px; 
		right:5px; 
		border-right: 2px solid rgba(0,0,0,0.7); 
		border-bottom: 2px solid rgba(0,0,0,0.7); 
		transform: rotate(135deg); 
	}
	
	.circle-arrow:hover{
		background: rgba(255, 255, 255, 0.8); /* bianco con trasparenza */
		border: solid 1px rgba(0,0,0,1); /* bordo nero */
	}	
	.circle-arrow:hover .circle-arrow-right{
		border-right: 2px solid rgba(0,0,0,1); /* freccia nera */
		border-bottom: 2px solid rgba(0,0,0,1);
	}
	
	.circle-arrow-2:hover{
		background: rgba(255, 255, 255, 0.8); /* bianco con trasparenza */
		border: solid 1px rgba(0,0,0,1); /* bordo nero */
	}	
	.circle-arrow-2:hover .circle-arrow-left{
		border-right: 2px solid rgba(0,0,0,1); /* freccia nera */
		border-bottom: 2px solid rgba(0,0,0,1);
	}
</style>

<div style="width:100%;" class="panel-columns-ajax">
	<div class="panel-left" id="panel-left">
		<p id="panel-left-text-1"><a href="news.html" title="News - News & Media - {{ config('app.name') }}"><span class="panel-left-text">News</span></a></p>
		<p id="panel-left-text-2"><a href="foto_video_gallery.html" title="Video e Foto Gallery - News & Media - {{ config('app.name') }}"><span class="panel-left-text">Video e Foto Gallery</span></a></p>
		<p id="panel-left-text-3"><span class="panel-left-text">Social Media</span></p>
		<div class="sub-items" id="sub-social-media">
			<p><a href="https://www.linkedin.com/company/vianini-lavori-s-p-a-/" target="_blank" title="Linkedin"><span class="panel-left-text">Linkedin</span></a></p>
			<p><a href="https://www.instagram.com/vianinilavorispa/" target="_blank" title="Instagram"><span class="panel-left-text">Instagram</span></a></p>
			<p><a href="https://www.youtube.com/@vianinilavorispa" target="_blank" title="YouTube"><span class="panel-left-text">YouTube</span></a></p>
		</div>
		<p id="panel-left-text-4"><a href="rassegna-stampa.html" title="Rassegna Stampa - News & Media - {{ config('app.name') }}"><span class="panel-left-text">Rassegna Stampa</span></a></p>
		
	</div>
    <div class="panel-right" id="panel-right" style="position:relative;">
		@if($num_evidenza>0)
			<div id="inEvidenzaTxt" style="position:absolute; top:-30px;">IN EVIDENZA</div>
			<div id="carouselWrapper" class="carousel-wrapper">
			  <div class="carousel-container" id="carouselContainer">
				<!-- immagini inserite via JS -->
			  </div>
			  <div class="carousel-text" id="carouselText">Titolo immagine</div>
			  <div class="circle-arrow-2" id="carouselPrev" style="display:none">
				<div class="circle-arrow-left"></div>
			  </div>
			  <div class="circle-arrow" id="carouselNext" style="display:none">
					<div class="circle-arrow-right"></div>
				</div>
			</div>
		@else
			<div id="inEvidenzaTxt">IN EVIDENZA</div>
			<div id="boxPartners">
				<div class="boxPartner1">
					<a href="news.html" title="News - News & Media - {{ config('app.name') }}">
						<div style="position:relative; width:100%;">
							<img src="{{ asset('web/images/header-news-video.png') }}" alt="News" style="width:100%;"/>
							<div style="position:absolute; bottom:15px; left:10px; font-size:28px; font-weight:700; color:#fff">
								NEWS
							</div>
							<div class="circle-arrow">
								<div class="circle-arrow-right"></div>
							</div>
						</div>		
					</a>				
				</div>
				<div class="boxPartner2" >
					<a href="rassegna-stampa.html" title="Rassegna Stampa - News & Media - {{ config('app.name') }}">
						<div style="position:relative; width:100%;">
							<img src="{{ asset('web/images/header-news-stampa.png') }}" alt="Rassegna Stampa" style="width:100%;"/>
							<div style="position:absolute; bottom:15px; left:10px; font-size:28px; font-weight:700; color:#fff">
								RASSEGNA<br/>STAMPA
							</div>
							<div class="circle-arrow">
								<div class="circle-arrow-right"></div>
							</div>
						</div>
					</a>
				</div>
			</div>
		@endif
    </div>
</div>

