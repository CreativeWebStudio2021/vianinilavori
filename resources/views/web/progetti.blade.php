@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		if(isset($categoria)){
			$imgPath = 'web/images/header_' . $categoria . '_2.jpg';		
			if (file_exists(public_path($imgPath))) {
				$img_background = $imgPath;
			} else {
				$img_background = 'web/images/header_edilizia_civile_e_industriale_2.jpg';
			}
		}else{
			$img_background = 'web/images/header_edilizia_civile_e_industriale_2.jpg';			
		}
		
		if(isset($categoria))
			$page_title = str_replace('_', ' ', $categoria);
		else
			$page_title = "Progetti";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Progetti'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo'] = ucfirst($page_title); $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<style>
		.layout-split-container {
		  width: calc(100% - 240px);
		  margin: 0 auto;
		  display: flex;
		  gap: 20px; 
		  margin-bottom:100px;
		}

		.layout-split-block {
		  flex: 1;
		  display: flex;
		  flex-direction: column;
		  align-items: center;
		  justify-content: center;
		  font-family: sans-serif;
		}

		.layout-split-left {
		  
		}

		.layout-split-right {
		 
		}
		
		.expand-block {
		  position: relative;
		  background: #fff;
		  overflow: hidden;
		  margin-bottom: 20px;
		}

		.expand-block__header {
		  position: relative;
		  padding: 15px 10px;
		  background-color: white;
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

		.expand-block__content {
		  display: block;
		  text-align:justify;
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
		    position: sticky;
		    z-index: 5;
			position:relative;		
		    transition: margin-top 0.5s ease;
		}

		.carousel-controls {
		  display: flex;
		  gap: 20px;
		  padding-left: 10px;
		 padding-top:370px;
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
		  height: 350px;
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
		  justify-content: center;
		}
		
		@media screen and (max-width: 768px) {
		  .layout-split-block {
			flex: 1 1 100%; /* ora prendono tutta la riga */
			padding: 0 5px;
		  }
		}
	
	
		.iso-list {
		  width: 100%;
		  margin-bottom: 80px;
		}

		.iso-wrapper {
		  position: relative;
		  padding-bottom: 0px;
		  border-bottom: 2px solid #000;
		  background: #fff;
		  overflow: hidden;
		}

		.iso-item {
		  position: relative;
		  padding: 15px 20px;
		  background-color: white;
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
		  background: #fff;
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
		  background:#fff;
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
		  min-width: 210px;
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
			background:#FFF;
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

		.iso-item:hover .categoria-pill {
		  background: #f0f0f0;
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
		
		.iso-content span{
		  font-size: 30px;
		}
		
		@media screen AND (max-width:800px){
			.iso-content span{
			  font-size: 25px;
			}	
			.iso-item{padding:10px 5px};			
		}
		
		.filterContainer{
			padding:0; 
			display:flex;
		}
		@media screen AND (max-width:600px){
			.filterContainer{
				flex-direction: column;
			}
			
			.rimuovi-filtri{
				margin-left:0px; margin-bottom:20px;
			}
			.link-block{margin:0 20px 20px 0}
		}
		
		.progLine{
			width:100%; 
			display:flex; 
			gap:20px;
		}
		.dettButt{
			display:flex; gap:15px;
		}
		.buttMap{
			width:190px;
			height:auto;
			padding:10px 5px;
			background:#E30613;
			border-radius:26px;
			border:solid 1px #fff;
			cursor:pointer;
			margin-top:40px;
		}
		.buttDett{
			width:190px;
			height:auto;
			padding:10px 5px;
			background:#E30613;
			border-radius:26px;
			border:solid 1px #fff;
			cursor:pointer;
			margin-top:40px;
		}
		.gapProg{display:none}
		
		.fade-in-slide-left {
		  opacity: 0;
		  transform: translateX(100px);
		  transition: opacity 1.5s ease, transform 1.5s ease;
		}

		.fade-in-slide-left.show {
		  opacity: 1;
		  transform: translateX(0);
		}
		
		@media screen AND (max-width:1024px){
			
			.progLine{
				flex-direction: column;
				gap:40px;
			}
			
			.buttMap{				
				margin-top:10px;
			}
			.buttDett{				
				margin-top:10px;
			}
		}
		@media screen AND (max-width:600px){
			.gapProg{display:inline;}
		}
		@media screen AND (max-width:500px){
			.dettButt{
				flex-direction: column;
				gap:0px;
			}
		}
	</style>	
	
	<section style="width:100%;">
		<div class="mainTextContainer">
			<div class="filterContainer">
				  <div class="link-block" data-type="categoria" style="z-index:10">
					<span @php if(request('categoria')){@endphp style="background:#d9d9d9" @php }@endphp>&nbsp;Categoria&nbsp;</span>
					<div class="freccia"></div>
					<div class="filter-panel" id="categoria-panel">
						@php								
							$categorie = DB::table('categorie')
								->select('*')
								->orderBy('ordine','DESC')
								->get();
						@endphp
						@foreach($categorie as $index => $cat)
						<a 
							href="{{ url('progetti/' . to_htaccess_url($cat->nome, '')) }}.html{{ request('stato') ? '?stato=' . request('stato') : '' }}" 
							class="filter-link {{ (isset($categoria) && $categoria == to_htaccess_url($cat->nome, '')) ? 'active' : '' }}">
							{{ $cat->nome }} <span class="arrow-small" style="background:#fff"></span>
						</a>
					@endforeach

					</div>
				  </div>
				  <div class="link-block" data-type="stato">
					<span @if(request('stato'))style="background:#d9d9d9"  @endif>&nbsp;Stato Progetto&nbsp;</span>
					<div class="freccia"></div>
					<div class="filter-panel" id="stato-panel">
					  
						<a href="{{ url()->current() }}?stato=Lavori in corso"
						   class="filter-link <?php if(request('stato') == 'Lavori in corso'){?> active <?php }?>">
							Lavori in corso <span class="arrow-small" style="background:#fff"></span>
						</a>
						
						<a href="{{ url()->current() }}?stato=Lavori completati"
						   class="filter-link <?php if(request('stato') == 'Lavori completati'){?> active <?php }?>">
							Lavori completati <span class="arrow-small" style="background:#fff"></span>
						</a>
					</div>
				  </div>
				
				 
				  
				  @if(request('stato') || request('categoria'))
					<div style="margin-top:-3px;">
						<a href="progetti.html">
							<div class="rimuovi-filtri">						 
								RIMUOVI FILTRI
							</div>
						</a>
					</div>
				@endif
			</div>
			
			<div class="iso-list">			
				@php
					if(request('stato')==null) {
						$stati = ['Lavoro in corso', 'Lavoro completato'];
					}else{
						if(request('stato')=='Lavori in corso') {
							$stati = ['Lavoro in corso'];
						}elseif(request('stato')=='Lavori completati') {
							$stati = ['Lavoro completato'];
						}
					}
					
					$lavori_in_corso=0;
					$lavori_completati=0;
				@endphp
				
				@foreach($stati as $stato_corrente)
					@php
						$p=0;
						$query = DB::table('punti_mappa')->select('*')->where('visibile', '=', '1');
						$query->where('stato', '=', $stato_corrente);

						if(isset($categoria)){
							$nome_cat_db = str_replace("_"," ",$categoria);
							if($nome_cat_db == "edilizia civile industriale e sportiva") $nome_cat_db = "Edilizia Civile, Industriale e Sportiva";
							$query_cat = DB::table('categorie')->select('id')->where('nome','=',$nome_cat_db)->first();
							if($query_cat){
								$query->where('categoria', '=', $query_cat->id);
							}
						}

						if(isset($categoria)){
							$query->orderby('ordine_categoria', 'DESC');
						} else {
							$query->orderby('ordine', 'DESC');
						}

						$query_punti = $query->get();
					@endphp

					@foreach($query_punti as $key_punti => $value_punti)
						@php 
							$index = $value_punti->id; 
							if($stato_corrente=="Lavoro in corso") $lavori_in_corso++;
							elseif($stato_corrente="Lavoro completato") $lavori_completati++
						@endphp
						@if(($stato_corrente=="Lavoro in corso" && $lavori_in_corso==1) || ($stato_corrente=="Lavoro completato" && $lavori_completati==1)) 
						<div style="width:100%; padding:0px; background:#F5F5F5; border-bottom:solid 2px #000; margin-top:50px;">
							<div style="padding:10px 20px">
								@php
									$nomeStato = str_replace("Lavoro","Lavori",$stato_corrente);
									$nomeStato = str_replace("Completato","Completati",$nomeStato);
									$nomeStato = str_replace("in corso",'<span style="color:'.config('app.rosso').'; font-size:30px; font-weight:700;">in corso</span>',$nomeStato);
									$nomeStato = str_replace("completato",'<span style="color:'.config('app.rosso').'; font-size:30px; font-weight:700;">completati</span>',$nomeStato);
									$nomeStato = strtoupper($nomeStato);
								@endphp
								<h2 style="font-size:30px;">{!! $nomeStato !!}</h2> 
							</div>
						</div>
						@endif

						<div class="iso-wrapper">
							<div class="iso-item" data-index="{{ $index }}">
							<div class="bg-hover"></div>
							<div class="iso-content">
								<span>{{ $value_punti->titolo }}</span>
							</div>
							<div class="iso-right">
								<div class="arrow-down"></div>
								<img src="web/images/clode_panel.png" class="icon-close-img" style="display:none; width: 30px; height: 30px;" alt="Close Icon">
							</div>
						</div>
						
						@php
							$p=0;
							$query_gal = DB::table('punti_mappa_gallery')
								->select('*')
								->where('id_rife', '=', $value_punti->id)
								->orderby('ordine', 'DESC')
								->get();
							$count_gal = $query_gal->count();
							if(isset($value_punti->img_testata) && $value_punti->img_testata!="") $count_gal++;
						@endphp
						
						<style>
							.projTitCol-{{ $value_punti->id }}{width:100%; font-size:20px; color:#000;}
							@if($count_gal==0)
								.projTitCol-{{ $value_punti->id }}{
									width:75%;
									display:flex; 
									gap:100px;
								}
								@media screen AND (max-width:1024px){
									.projTitCol-{{ $value_punti->id }}{
										gap:0px;
										flex-direction:column;
									}
								}
							@endif
						</style>
						<div class="iso-pdf-preview" id="pdf-preview-{{ $index }}">
							<div class="detail-content" id="detail-content">
								<div class="scrollable-content">
									<div style="padding:0px;">
										<div class="progLine">
											<div style="flex:1;" >
												<div class="projTitCol-{{ $value_punti->id }}">
													<div style="flex:1; display:flex; flex-direction:column; gap:10px; line-height:1.2; margin-bottom:10px; text-align:justify;" class="projTitCol1-{{ $value_punti->id }}">
														@if(isset($value_punti->committente))
															<div><span class="projTit">Committente</span>:<span class="gapProg"><br/></span> {{ $value_punti->committente }} <br/></div>
														@endif
														@if(isset($value_punti->ubicazione))
															<div><span class="projTit">Ubicazione</span>:<span class="gapProg"><br/></span> {{ $value_punti->ubicazione }} <br/></div>
														@endif
													</div>
													<div style="flex:1;  display:flex; flex-direction:column; gap:10px; line-height:1.2;" class="projTitCol2-{{ $value_punti->id }}">
														@if(isset($value_punti->stato))
															<div><span class="projTit">Stato di lavorazione</span>:<span class="gapProg"><br/></span> {{ ucfirst(str_replace("Lavoro ","",$value_punti->stato)); }}<br/></div>
														@endif
													</div>
												</div>
												<div style="margin-top:25px;">
													<div style=" font-size:20px;" class="project-body-content">
														@if($value_punti->stato=="Lavoro in corso")
															{!! $value_punti->descrizione_breve !!}
														@else
															{!! $value_punti->descrizione !!}
														@endif
													</div>
												</div>
												@if($value_punti->stato=="Lavoro in corso")
														<div class="dettButt">
															<div class="buttMap">
															<a href="mappa-interattiva.html?id={{ $value_punti->id }}" style="text-decoration:none"><div style="font-size:16px; color:#fff; width:100%; text-align:centeR;"><b>MAPPA INTERATTIVA</b></div></a>
															</div>
															<div  class="buttDett">
															<a href="dettaglio-progetto/{{to_htaccess_url($value_punti->titolo." ".$value_punti->titolo_bold,"")}}-{{$value_punti->id}}.html" style="text-decoration:none"><div style="font-size:16px; color:#fff; width:100%; text-align:centeR;"><b>SCOPRI DI PIÙ</b></div></a>
															</div>
														</div>	
												@elseif($value_punti->visibile_scheda=="1")
													<div class="buttDett">
														<a href="dettaglio-progetto/{{to_htaccess_url($value_punti->titolo." ".$value_punti->titolo_bold,"")}}-{{$value_punti->id}}.html" style="text-decoration:none"><div style="font-size:16px; color:#fff; width:100%; text-align:centeR;"><b>SCOPRI DI PIÙ</b></div></a>
													</div>
												@endif
											</div>
											@if($count_gal>0)
												<div style="flex:1;">
													
													<div class="gallery-carousel "  id="gallery-carousel-{{ $index }}">
														<div class="carousel-track"  id="carousel-track">
															@php $p = 1; @endphp

															@if(!empty($value_punti->img_testata) && empty($value_punti->video))
																<a href="resarea/img_up/punti/{{ $value_punti->img_testata }}" class="glightbox" data-gallery="gallery-{{ $index }}">
																	<img src="resarea/img_up/punti/{{ $value_punti->img_testata }}" alt="{{ $value_punti->titolo }} {{ $value_punti->titolo_bold }} - Immagine 1" class="carousel-image">
																</a>
																@php $p++; @endphp
															@endif
															
															@foreach($query_gal AS $key_gal=>$value_gal)
																<a href="resarea/img_up/punti/{{ $value_gal->img }}" class="glightbox" data-gallery="gallery-{{ $index }}">
																	<img src="resarea/img_up/punti/{{ $value_gal->img }}" alt="{{ $value_punti->titolo }} {{ $value_punti->titolo_bold }} - Immagine {{$p}}" class="carousel-image">
																</a>
															@endforeach
														</div>
														<div class="carousel-controls ">
														@if($count_gal>1)
																<div id="prevBtnProj" class="circleArrowProj" data-track="1">
																  <div class="circleArrowProjIcon " style="top:17px; right:12px; border-left: 2px solid; border-top: 2px solid; transform: rotate(-45deg);"></div>
																</div>
																<div id="nextBtnProj" class="circleArrowProj" data-track="1">
																  <div class="circleArrowProjIcon" style="top:17px; left:12px; border-right: 2px solid; border-bottom: 2px solid; transform: rotate(-45deg);"></div>
																</div>
														@endif
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
				@endforeach	
			</div>
		</div>
	</section>
	
	
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- GLightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
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




document.querySelectorAll('.iso-item').forEach(item => {
  item.addEventListener('click', () => {
    const index = item.getAttribute('data-index');
    const preview = document.getElementById('pdf-preview-' + index);
    const isAlreadyOpen = item.classList.contains('selected');

    document.querySelectorAll('.iso-item').forEach(i => {
      i.classList.remove('selected');
      i.querySelector('.arrow-down').style.display = 'block';
      i.querySelector('.icon-close-img').style.display = 'none';
    });

    document.querySelectorAll('.iso-pdf-preview').forEach(pre => $(pre).slideUp());

    if (isAlreadyOpen) return;

    item.classList.add('selected');
    $(preview).slideDown({
      duration: 400,
      complete: function () {
        const carousel = preview.querySelector('.gallery-carousel');
        if (carousel) initCarousel(carousel); // 👈 inizializzazione post-espansione
      }
    });

    item.querySelector('.arrow-down').style.display = 'none';
    item.querySelector('.icon-close-img').style.display = 'block';
  });
});

const panels = {
	categoria: document.getElementById('categoria-panel'),
	stato: document.getElementById('stato-panel')
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

document.addEventListener('DOMContentLoaded', () => {
  // GLightbox
  const lightbox = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
  });

  // FadeIn+SlideUp blocks
  const expandBlocks = document.querySelectorAll('.expand-block');
  const blockObserver = new IntersectionObserver((entries, obs) => {
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

  expandBlocks.forEach(block => blockObserver.observe(block));
});

document.addEventListener("DOMContentLoaded", function () {
    const hash = window.location.hash;
    if (hash && hash.startsWith("#pdf-preview-")) {
        const id = hash.replace("#pdf-preview-", "");
        const targetItem = document.querySelector(`.iso-item[data-index="${id}"]`);
        if (targetItem) {
            targetItem.click();
            setTimeout(() => {
                const offsetTop = targetItem.getBoundingClientRect().top + window.scrollY - 100;
                window.scrollTo({ top: offsetTop, behavior: 'smooth' });
            }, 500);
        }
    }
});


</script>


@endsection	