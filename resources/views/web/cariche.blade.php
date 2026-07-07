@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$categoria_carica = $id_carica;

		// 1 - Organismo di Vigilanza
		// 2 - Collegio Sindacale
		// 3 - Consiglio di Amministrazione
		$query_intro = DB::table('testi_introduttivi')
					->select('testo')
					->where('pagina','=','Organismo di Vigilanza')
					->get();
		$intro_text[1] = $query_intro[0]->testo;
		
		$query_intro = DB::table('testi_introduttivi')
					->select('testo')
					->where('pagina','=','Consiglio Sindacale')
					->get();
		$intro_text[2] = $query_intro[0]->testo;
		
		$query_intro = DB::table('testi_introduttivi')
					->select('testo')
					->where('pagina','=','Consiglio di Amministrazione')
					->get();
		$intro_text[3] = $query_intro[0]->testo;
		
		//$intro_text[1] = "Il <b>consiglio amministrativo</b> è l’organo direttivo incaricato della definizione delle strategie aziendali e della supervisione delle attività operative.";
		//$intro_text[2] = "Il <b>collegio sindacale</b> svolge un ruolo di vigilanza sulla corretta amministrazione della società, garantendo la conformità alle normative e ai principi contabili.";
		//$intro_text[3] = "Il <b>consiglio amministrativo</b> è l’organo direttivo incaricato della definizione delle strategie aziendali e della supervisione delle attività operative.";
		
		$page_title = "CONSIGLIO DI<br/>AMMINISTRAZIONE";
		$img_background="web/images/header_governance.jpg";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Chi Siamo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<style>
		.iso-list {
		  width: 100%;
		  margin-bottom: 40px;
		}

		.iso-wrapper {
		  position: relative;
		  padding-bottom: 0px;
		  border-bottom: 2px solid #000;
		  background: none;
		  overflow: hidden;
		  margin-bottom: 40px;
		}

		.iso-item {
		  position: relative;
		  padding: 15px 20px;
		  background-color: none;
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
		
		.iso-item.selected .icon-hover {
		  opacity: 1;
		}

		.iso-item.selected .icon-default {
		  opacity: 0;
		}
		
		.iso-item:hover .icon-hover {
		  opacity: 1;
		}

		.iso-item:hover .icon-default {
		  opacity: 0;
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
		

		.iso-right .icon-hover {
		  opacity: 0;
		}


		.iso-item:hover .icon-hover {
		  opacity: 1;
		}

		.iso-item:hover .icon-default {
		  opacity: 0;
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

		.iso-item.selected .arrow-down {
		  display: none;
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
		  background: none;
		  color: #000;
		}

		.scrollable-content {
		  height: 100%;
		  overflow-y: auto;
		  overflow-x: hidden;
		}
		
		
		.gallery-carousel{
			position:relative;
			min-height:350px; 
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
		   margin-left: auto;
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

		.link-block {
		  flex:  0 0 auto;
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
		
		.iso-content span{
			font-size:30px;
		}
		
		#subMenuContainer {
			padding:0; 
			display:flex;
			justify-content: wrap;
			gap: 20px;
		}
		
		#subMenuContainer .link-block{
			opacity:0;
		}
		
		#subMenuContainer a.link-block {
		  display: flex;
		  flex: 0 0 25%;
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
			#subMenuContainer {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			#subMenuContainer a.link-block {
			  flex: 0 0 48%;
			}
		}

		@media screen AND (max-width:700px){			
			#subMenuContainer a.link-block {
			  flex: 0 0 100%;
			}
		}
		
		@media screen AND (max-width:600px){
			.mainTextContainer2{width:calc(100% - 20px) !important}
			.iso-item {
			  padding: 10px 10px;
			}
			.iso-content span{font-size:25px;}
			.iso-pdf-preview {padding: 10px;}
		}
		
		//.mainTextContainer p strong{color:{{config('app.color1')}}}
		
		.dynamic-text {
		  font-size: 24px;
		  line-height: 1.4;
		  transition: text-align 0.3s ease;
		  opacity:0;
		}

		
		  
		#pageContainer {
			background: url(web/images/v_grigia_s.png) no-repeat top center;
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
		  background: url(web/images/v_grigia_s.png) no-repeat top center;
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
		
		.mainTextContainer ul {
			  list-style: none;
			  padding-left: 0;
			  margin-left: 0;
			}

		.mainTextContainer li {
		  margin-bottom: 30px;
		}
		
		.mainTextContainer {
			width:calc(100% - 600px) !important; 
			margin:0 auto;
		}
		
		.mainTextContainer ul {
		  list-style: none;
		  padding-left: 0;
		  margin-left: 0;
		}

		.mainTextContainer li {
		  position: relative;
		  margin-left:-10px;
		  opacity: 0;
		  transform: translateY(20px);
		  animation: fadeInUp 0.6s ease forwards;
		}

		.mainTextContainer li::before {
		  content: '';
		  position: absolute;
		  left: 0;
		  top: 0.3em;
		  width: 8px;
		  height: 8px;
		  border-right: 2px solid #000;
		  border-bottom: 2px solid #000;
		  transform: rotate(-45deg);
		  display:none;
		}
		@media screen AND (max-width:1600px){
			.mainTextContainer {	width:calc(100% - 400px) !important; }
		}
		@media screen AND (max-width:1468px){
			.mainTextContainer {	width:calc(100% - 200px) !important; }
		}
		@media screen AND (max-width:650px){
			.mainTextContainer {	width:calc(100% - 90px) !important; }
		}
		
		#subMenuContainer{width:100% !important;  margin:0 auto;}
		
		.linkList{display:flex; gap:120px; margin-bottom:60px; margin-top:60px;}

	.linkList ul li {
	  display: flex;
	  align-items: flex-start;
	  gap: 10px;
	  margin-bottom: 20px;
	}

	.link-block {
	  display: flex;
	  align-items: center;
	  
	  padding: 5px;
	  position: relative;
	  text-decoration: none;
	  color: #000;
	  border-bottom: 1px solid #D9D9D9;
	  transition: background 0.3s;
	  background: transparent;
	  box-sizing: border-box;
	}

	.link-block:hover {
	 // background: #d9d9d9;
	}

	.linkList li img.icon-li {
	  width: 40px;
	  height: 40px;
	  object-fit: contain;
	  flex-shrink: 0;
	  margin-top: 0px;
	  margin-left:-12px;
	}

	.link-texts {
	  display: flex;
	  flex-direction: column;
	  font-size: 28px;
	}

	.link-texts span {
	  font-weight: bold;
	}

	.link-texts .subtitle {
	  font-weight: normal;
	  font-size: 20px;
	  color: #555;
	}

	.link-block .freccia {
	  width: 12px;
	  height: 12px;
	  position: relative;
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
	
	.link-block:hover .freccia::after {
	  transform: translate(18px, -50%) rotate(-45deg);
	}
	
	@media screen AND (max-width:1024px){
			.linkList{flex-direction:column; gap:0px;}
		}
		
	@keyframes fadeSlideRight {
			from { opacity: 0; transform: translateX(-30px); }
			to { opacity: 1; transform: translateX(0); }
		}

		@keyframes fadeSlideUp {
			from { opacity: 0; transform: translateY(30px); }
			to { opacity: 1; transform: translateY(0); }
		}

		.fade-slide-right {
			animation: fadeSlideRight 0.8s ease forwards;
		}

		.fade-slide-up {
			animation: fadeSlideUp 0.8s ease forwards;
		}
		
		.datiCarica {
	opacity: 0;
	transform: translateY(30px);
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
		<section style="width:100%; margin-bottom:40px;">
			<div class="mainTextContainer" style="margin-bottom:30px;">	
				<div id="subMenuContainer">			  
				  <a href="consiglio-di-amministrazione.html" title="Consiglio di Amministrazione" class="link-block @if($categoria_carica==3) active @endif">
						<span >Consiglio di Amministrazione&nbsp;</span>
						<div class="freccia"></div>
				  </a>			  
				  <a href="collegio-sindacale.html" title="Collegio Sindacale" class="link-block @if($categoria_carica==2) active @endif">
						<span >Collegio Sindacale&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a href="organismo-di-vigilanza.html" title="Organismo di Vigilanza" class="link-block @if($categoria_carica==1) active @endif">
						<span >Organismo di Vigilanza&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a href="etica-compliance-whistleblowing.html" title="Etica, Compliance e Whistleblowing" class="link-block">
						<span >Etica, Compliance e Whistleblowing&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				</div>
			</div>
		</section>
		<style>
			.paddingBoxCariche{width:1024px; margin:0 auto; margin-bottom:40px;}
			.colSpan{flex:0 0 15%;}
			
			@media screen AND (max-width:1320px){
				.linkList{gap:0px;}
			}
			@media screen AND (max-width:1320px){
				.mainTextContainer2{width:1024px !important; margin:0 auto;}
			}
			@media screen AND (max-width:1024px){
				.mainTextContainer2{width:100% !important; margin:0 auto;}
				.paddingBoxCariche{width:100%; margin:0 auto; text-align:centeR; margin-bottom:0px;}
				#pageContainer{padding-bottom:0 !important;}
			}
			
			.caricaRow{
				position:absolute; top:0; left:50%; margin:0 auto; display: flex; align-items: center;
			}
			.secondRowMarginLeft1{transform:translateX(-80%)}
			.secondRowMarginLeft2{transform:translateX(-60%)}
			.secondRowMarginLeft3{transform:translateX(-70%)}
			.datiCarica{min-height:62px;}
			.secondRow{display:flex; justify-content: space-between;}
			.firstRow{display:flex; margin-bottom:20px; padding-top:20px;}
			@media screen AND (max-width:900px){
				.caricaRow{flex-direction:column !important; width:100% !important;}
				.secondRowMarginLeft1, .secondRowMarginLeft2, .secondRowMarginLeft3 {transform:translateX(-50%)}
				.subtitleCarica{font-size:18px !important;}
				.nomeCarica{font-size:18px !important;}
				.datiCarica{min-height:100px;}
				
			}
			@media screen AND (max-width:500px){
				.secondRow{flex-direction:column; justify-content: space-between;}
				.firstRow{flex-direction:column; justify-content: space-between;}
				.datiCarica{min-height:100px !important;}
			}
			@media screen AND (max-width:420px){
				.secondRow{flex-direction:column; justify-content: space-between;}
				.firstRow{flex-direction:column; justify-content: space-between;}
				.datiCarica{min-height:100px !important;}
			}
		</style>
		<section style="width:100%;">
			<div class="mainTextContainer " style="position:relative; z-index:1;">
				<div class="dynamic-text center"  id="textBlock" style="margin-top:60px;">
					{!! $intro_text[$categoria_carica] !!} 
				</div>
			</div>
				
			<div style="<?php /*background:#F5F5F5;*/?> " class=" mainTextContainer mainTextContainer2">
				<div  class="paddingBoxCariche">
					<div class="iso-list">		
						
						@php
							$query_visBio = DB::table('categorie_cariche')
								->select('bio_visibile')
								->where('id','=',$categoria_carica)
								->get();
							$visibile = $query_visBio[0]->bio_visibile;
						
							
							$query_car = DB::table('cariche')->where('categoria','=',$categoria_carica)->orderBy('ordine', 'DESC')->get();

							$cariche = $query_car->map(function($item) {
								return [
									'id' => $item->id,
									'nome' => $item->nome,
									'cognome' => $item->cognome,
									'carica' => $item->carica,
									'foto' => $item->img,
									'testo' => $item->testo,
									'sesso' => $item->sesso,
									'linkedin' => $item->linkedin,
									'instagram' => $item->instagram,
									'facebook' => $item->facebook,
								];
							})->all();
							
							if($categoria_carica==3){
								$half = ceil(count($cariche) / 2);
								$cariche_1 = array_slice($cariche, 0, 2);
								$cariche_2 = array_slice($cariche, 2, 3);
							}else{
								$third = ceil(count($cariche) / 3);
								$cariche_1 = array_slice($cariche, 0, $third);
								$cariche_2 = array_slice($cariche, $third, $third);
								$cariche_3 = array_slice($cariche, $third * 2);
							}
						@endphp
						
						
						@if($categoria_carica==3)
							<div class="linkList" style="display:block">
								<div style="flex:1;">
									<div class="firstRow">
										<?php $x=1;?>
										@foreach($cariche_1 as $item)
											<div style="flex:1;   margin-bottom: 24.2px; position:relative;" class="datiCarica">
											  <div class="caricaRow firstRowMarginLeft" style="position:absolute; top:0; left:50%; transform:translateX(-50%); margin:0 auto; display: flex; align-items: center;">
												  <img class="icon-li" src="{{ asset('web/images/business-'.$item['sesso'].'-b.png') }}" style="width:40px;" alt="{{ $item['nome'] }} {{ $item['cognome'] }} - {!! $item['carica'] !!}">
												  <a  class="link-block">
													<div class="link-texts">
													  <div class="subtitle subtitleCarica">{!! $item['carica'] !!}</div>
													  <span class="nomeCarica">{{ $item['nome'] }} <b>{{ $item['cognome'] }}</b></span>
													</div>
													<!-- <div class="freccia"></div>-->
												  </a>
											  </div>
											</div>
											<?php $x++;?>
										@endforeach
									</div>
								</div>
								<div style="flex:1;">
									<div class="secondRow">
										<?php $x=1; ?>
										@foreach($cariche_2 as $item)
											<div style="flex:1; position:relative; margin-bottom: 24.2px;" class="datiCarica">
											  <div class="caricaRow secondRowMarginLeft<?php echo $x;?>">
												  <img class="icon-li" src="{{ asset('web/images/business-'.$item['sesso'].'-b.png') }}" style="width:40px;" alt="{{ $item['nome'] }} {{ $item['cognome'] }} - {!! $item['carica'] !!}">
												  <a  class="link-block">
													<div class="link-texts">
													  <div class="subtitle subtitleCarica">{!! $item['carica'] !!}</div>
													  <span class="nomeCarica">{{ $item['nome'] }} <b>{{ $item['cognome'] }}</b></span>
													</div>
													<!-- <div class="freccia"></div>-->
												  </a>
											  </div>
											</div>
											<?php $x++;?>
										@endforeach
									</div>
								</div>
							</div>
						@else								
							<div class="linkList">
								<div style="flex:1;">
									<div class="secondRow">
										<?php $x=1; ?>
										@foreach($cariche_1 as $item)
											<div style="flex:1; position:relative; margin-bottom: 24.2px;" class="datiCarica">
											  <div class="caricaRow secondRowMarginLeft<?php echo $x;?>">
												  <img class="icon-li" src="{{ asset('web/images/business-'.$item['sesso'].'-b.png') }}" style="width:40px;" alt="{{ $item['nome'] }} {{ $item['cognome'] }} - {!! $item['carica'] !!}">
												  <a  class="link-block">
													<div class="link-texts">
													  <div class="subtitle subtitleCarica">{!! $item['carica'] !!}</div>
													  <span class="nomeCarica">{{ $item['nome'] }} <b>{{ $item['cognome'] }}</b></span>
													</div>
													<!-- <div class="freccia"></div>-->
												  </a>
											  </div>
											</div>
											<?php $x++;?>
										@endforeach
										@foreach($cariche_2 as $item)
											<div style="flex:1;   margin-bottom: 24.2px; position:relative;" class="datiCarica">
												  <div class="caricaRow firstRowMarginLeft" style="position:absolute; top:0; left:50%; transform:translateX(-50%); margin:0 auto; display: flex; align-items: center;">
													  <img class="icon-li" src="{{ asset('web/images/business-'.$item['sesso'].'-b.png') }}" style="width:40px;" alt="{{ $item['nome'] }} {{ $item['cognome'] }} - {!! $item['carica'] !!}">
													  <a  class="link-block">
														<div class="link-texts">
														  <div class="subtitle subtitleCarica">{!! $item['carica'] !!}</div>
														  <span class="nomeCarica">{{ $item['nome'] }} <b>{{ $item['cognome'] }}</b></span>
														</div>
														<!-- <div class="freccia"></div>-->
													  </a>
												</div>
											</div>
										@endforeach						
										@foreach($cariche_3 as $item)
											<div style="flex:1;   margin-bottom: 24.2px; position:relative;" class="datiCarica">
												  <div class="caricaRow firstRowMarginLeft" style="position:absolute; top:0; left:50%; transform:translateX(-50%); margin:0 auto; display: flex; align-items: center;">
													  <img class="icon-li" src="{{ asset('web/images/business-'.$item['sesso'].'-b.png') }}" style="width:40px;" alt="{{ $item['nome'] }} {{ $item['cognome'] }} - {!! $item['carica'] !!}">
													  <a  class="link-block">
														<div class="link-texts">
														  <div class="subtitle subtitleCarica">{!! $item['carica'] !!}</div>
														  <span class="nomeCarica">{{ $item['nome'] }} <b>{{ $item['cognome'] }}</b></span>
														</div>
														<!-- <div class="freccia"></div>-->
													  </a>
												</div>
											</div>
										@endforeach	
									</div>
								</div>
							</div>
						@endif
					</div>
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
		  
		  
     /* funzione applyDynamicTextAlign() in common/js_css_up.blade.php*/

	  const el = document.getElementById('textBlock');
	  applyDynamicTextAlign(el);

	  window.addEventListener('resize', () => applyDynamicTextAlign(el));

	document.addEventListener('DOMContentLoaded', () => {
		// 1️⃣ SubMenu animazione
		const submenuItems = document.querySelectorAll('#subMenuContainer .link-block');
		submenuItems.forEach((item, index) => {
			item.style.opacity = '0';
			item.style.animationDelay = `${index * 150}ms`;
			item.classList.add('fade-slide-right');
		});

		// 2️⃣ Testo principale
		const introText = document.querySelector('.mainTextContainer .dynamic-text');
		if (introText) {
			introText.style.opacity = '0';
			introText.style.animation = 'fadeSlideUp 0.8s ease forwards';
			introText.style.animationDelay = '400ms';
		}

		// 3️⃣ Link delle due colonne
		let delay = 800;

		// 1️⃣ Anima tutti gli <li> dentro .linkList
		document.querySelectorAll('.linkList ul li').forEach((li, i) => {
			const delayMs = delay + (i * 150);
			li.style.animationDelay = `${delayMs}ms`;
			li.classList.add('fade-slide-up');
		});

		// 2️⃣ Anima anche i <div.datiCarica> fuori da <ul> (es: primo blocco)
		document.querySelectorAll('.linkList > div > div > .datiCarica').forEach((div, i) => {
			const delayMs = delay + (i * 150);
			div.style.animationDelay = `${delayMs}ms`;
			div.classList.add('fade-slide-up');
		});

	});
	
	document.querySelectorAll('img.icon-li').forEach(img => {
		const srcOriginale = img.getAttribute('src');
		const srcRosso = srcOriginale.replace('-b.png', '-r.png');

		const parent = img.closest('div.datiCarica') || img.parentElement;

		parent.addEventListener('mouseenter', () => {
			img.setAttribute('src', srcRosso);
		});

		parent.addEventListener('mouseleave', () => {
			img.setAttribute('src', srcOriginale);
		});
	});

	</script>
@endsection	