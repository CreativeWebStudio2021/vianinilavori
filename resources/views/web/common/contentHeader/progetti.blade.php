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
	  #padding:0 5px;
	  line-height:0.8 !important;
	  transition: all 0.3s ease;
	   font-size:28px;
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
	
	#panel-left-text-1, #panel-left-text-2, #panel-left-text-3, #panel-left-text-4, #panel-left-text-5, #panel-left-text-6{		
	  transform: translateX(-200px);
	  opacity:0;
	  transition: transform 1.5s cubic-bezier(.28,.71,.17,.94), opacity 1.5s cubic-bezier(.28,.71,.17,.94);		
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

	.panel-left a {
	  color: #000;
	  text-decoration: none;
	}

	.panel-left a:hover {
	  color: #000;
	  text-decoration: none;
	}
	
	.panel-left-text-dyn {
	  transform: translateX(-200px);
	  opacity:0;
	  transition: transform 1.5s cubic-bezier(.28,.71,.17,.94), opacity 1.5s cubic-bezier(.28,.71,.17,.94);		
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
		transition:all 0.3s;
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
	
	#inEvidenzaTxt{
		padding-left:100px; 
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
		  padding-bottom:150px;	  }
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
		flex: 0 0 auto;
		width: 100%;
	  }
				
	  .panel-left-text {		  
		  background:rgba(255,255,255,0);
		  font-size:20px;
		}
		
	  .panel-left-text::after {
		  top: 4px;
		}
		
	   .panel-left p {
		  margin: 5px 0;
		}
		
	  .panel-right img {
		margin-top: 0px;
		width: 100%;
		height: auto;
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
	.gapProg{display:none}
	@media screen AND (max-width:1764px){
		.gapProg{display:inline}
	}
	@media screen AND (max-width:1280px){
		.gapEtica{display:inline}
	}
	@media screen AND (max-width:1180px){
		.gapProg{display:inline}
	}
	
	.buttMapHeader{
		width:220px;
		height:auto;
		padding:5px 10px;
		background:#E30613;
		border-radius:26px;
		border:solid 2px #E30613;
		cursor:pointer;
		margin-top:40px;
		font-size:20px;
		color:#fff;
		transition:all 0.3s;
	}
	
	.buttMapHeader:hover{
		background:#fff;
		border:solid 2px #E30613;
		color:#E30613;
	}
</style>

<div style="width:100%;" class="panel-columns-ajax">
	<div class="panel-left" id="panel-left" style="padding-bottom:60px">
		@php
			$categorie = DB::table('categorie')
				->select('nome')
				->orderBy('ordine','DESC')
				->get();
		@endphp
		@foreach($categorie as $index => $cat)
		  <a href="progetti/{{ str_replace(' ', '_', str_replace(',', '',strtolower($cat->nome))) }}.html" title="{{$cat->nome}} - Progetti - {{ config('app.name') }}">
			  <p id="panel-left-text-{{ $index }}" class="panel-left-text-dyn" style="opacity:0; padding:0 5px;" data-index="{{ $index }}">
				<span class="panel-left-text" style="lilne-height:0.8;">{{ $cat->nome }}</span>
			  </p>
		  </a>
		@endforeach
		<a href="mappa-interattiva.html" title="Mappa Interattiva" style="padding-top:20px;">
		  <p id="panel-left-text-6" class="panel-left-text-dyn" style="opacity:0; margin-top:15px;" data-index="6">
			<span class=" buttMapHeader">Mappa Interattiva</span>
		  </p>
	  </a>
	</div>
    <div class="panel-right" id="panel-right">
		<div id="inEvidenzaTxt">IN EVIDENZA</div>
		<div id="boxPartners">
			<div class="boxPartner1">
				<a href="progetti.html?stato=Lavori%20in%20corso" title="Lavori in corso - Progetti - {{ config('app.name') }}">
					<div style="position:relative; width:100%;">					
						<img src="{{ asset('web/images/header-progetti-in-corso.png') }}" alt="LAVORI IN CORSO" style="width:100%;"/>
						<div style="position:absolute; bottom:15px; left:10px; font-size:28px; font-weight:700; color:#fff">
							LAVORI <span class="gapProg"><br/></span>IN CORSO
						</div>
						<div class="circle-arrow">
							<div class="circle-arrow-right"></div>
						</div>

					</div>
				</a>
			</div>
			<div class="boxPartner2" >
				<a href="progetti.html?stato=Lavori%20completati" title="Tutti i progetti - Progetti - {{ config('app.name') }}">
					<div style="position:relative; width:100%;">
						<img src="{{ asset('web/images/header-progetti-in-tutti.png') }}" alt="TUTTI I PROGETTI" style="width:100%;"/>
						<div style="position:absolute; bottom:15px; left:10px; font-size:28px; font-weight:700; color:#fff">
							LAVORI <span class="gapProg"><br/></span>COMPLETATI
						</div>
						<div class="circle-arrow">
							<div class="circle-arrow-right"></div>
						</div>
					</div>
				</a>
			</div>
		</div>
    </div>
</div>
