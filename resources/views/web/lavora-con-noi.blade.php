@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$img_background="web/images/header_Lavora_con_noi.png"; 
		$img_position="bottom center"; 
		$page_title = "LAVORA CON NOI";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Chi Siamo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<style>
		.layout-split-container {
		  width: calc(100% - 200px);
		  background:{{ config('app.rosso') }};
		  margin: 0 auto;
		  display: flex;
		  gap: 50px; 
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
		
		.layout-split-pre {
		  flex: 1;
		}
		
		.layout-split-left {
		  flex: 2;
		}

		.layout-split-right {
		 flex: 1;
		}
		
		.expand-block {
		  position: relative;
		  overflow: hidden;
		  margin-bottom: 20px;
		}

		.expand-block__header {
		  position: relative;
		  padding: 15px 10px;
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
		  width:800px;
		  margin:0 auto; 
		  margin-bottom:50px;
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
			
		
		
	.linkedin-banner {
       
        align-items: center;
        background-color: #E30613;
        border-radius: 15px;
        padding: 10px 30px;
        color: #fff;
        text-decoration: none;
        margin-bottom: 30px;
        margin-top: 20px;
        position: relative;
    }

    .linkedin-banner i {
        font-size: 25px;
		float:left; width:50px; margin-top:3px;
    }

    .linkedin-banner-text {
		text-align:center;
        font-size: 25px;
        font-weight: bold;
        text-transform: uppercase;
        pointer-events: none; /* fa sì che il testo non interferisca con l'hover */
		width:calc(100% - 100px); margin-left:50px;
    }

    .arrow-hover {
        width: 12px;
        height: 12px;
        border-right: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: rotate(-45deg);
        transition: all 0.3s ease;
        display: inline-block;
    }

    .linkedin-banner:hover .arrow-hover {
        transform: translate(8px, 0%) rotate(-45deg);
		 width: 15px;
        height: 15px;
		border-right: 3px solid #fff;
        border-bottom: 3px solid #fff;
    }
	
	.linedin-banner-right{
		float:right; text-align:right; width:50px; margin-top:-20px;
	}
	.candidatura{font-size:30px !important}
	.boxForm{padding:10px 30px}
	.riga1,.riga2,.riga3,.riga1{gap:30px}
	@media screen AND (max-width:850px){
		.expand-block{
			width:calc(100% - 200px);
		}
		.linkedin-banner-text {
			font-size: 22px;
			width:calc(100% - 60px); 
			margin-left:30px;
			top:2px;
		}
		 .linkedin-banner i {width:30px;}
		 .linedin-banner-right{width:30px;}
		 .allegati{flex-direction:column;}
	}
	@media screen AND (max-width:620px){
		.expand-block{
			width:calc(100% - 100px);
		}
		.linkedin-banner-text {
			font-size: 22px;
			width:calc(100% - 60px); 
			margin-left:30px;
			top:2px;
		}
		 .linkedin-banner i {font-size:30px; margin-top:10px;}
		 .linedin-banner-right{margin-top:-30px;}
		 
		 .riga1,.riga2,.riga3,.riga4{flex-direction:column; gap:0px}
		 
	}
	@media screen AND (max-width:500px){
		.expand-block{
			width:calc(100% - 50px);
		}
	}
	@media screen AND (max-width:400px){
		.linkedin-banner-text {font-size: 17px;}
		.linkedin-banner i {font-size:25px; margin-top:10px;}
		.candidatura{font-size:25px !important}
		.boxForm{padding:10px 15px}
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
		@media screen AND (max-width:650px){
			.mainTextContainer {	width:calc(100% - 100px) !important; }
		}
		
		.textLCN{text-align:center;}
		@media screen AND (max-width:850px){
			.textLCN{text-align:justify;}
		}
		@media screen AND (max-width:650px){
			.textLCN{text-align:left;}
		}
	</style>
	
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">	
		<div class="expand-block">
			<div style="padding:0px  0px;">					
				<div class="textLCN">
					<p>
						<b>Costruiamo insieme opere straordinarie, con persone straordinarie.</b>
					</p>
					<p>
						In Vianini Lavori valorizziamo il talento, premiamo la determinazione e crediamo nella forza della professionalità. Unisciti a noi!
						<br/><br/>
					</p>
					<a href="https://it.linkedin.com/company/vianini-lavori-s-p-a-/jobs" target="_blank">
						<div class="linkedin-banner">
							<div><i class="fab fa-linkedin"></i></div>
							<div class="linkedin-banner-text">Scopri tutte le posizioni aperte</div>
							<div class="linedin-banner-right" ><div class="arrow-hover"></div></div>
						</div>
					</a>
				</div>
			</div>
			<div style="background:rgba(245,245,245,0.5);">
				<div class="boxForm">				
					<div class="expand-block__header" style="padding-left:0;">
						<div class="expand-block__bg-hover"></div>
						<div class="expand-block__title">
							<span class="candidatura">Invia la tua candidatura spontanea</span>
						</div>
					</div>
					<div class="expand-block__content">
						<div style="width:98%;">
							<form action="{{ url('/lavora-con-noi') }}" method="POST" name="candidaturaForm" id="candidaturaForm" autocomplete="off" enctype="multipart/form-data">
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
								
								<input type="hidden" value="true" name="candidaturaInvio" id="candidaturaInvio">

								<div style="display:flex;" class="riga1">
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Nome </span>
										<input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
									</div>
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Cognome</span>
										<input type="text" name="cognome" class="form-control" value="{{ old('cognome') }}" required>
									</div>
								</div>

								<div style="display:flex; margin-top: 15px;" class="riga2">
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>E-mail</span>
										<input type="text" name="email" class="form-control" value="{{ old('email') }}" required>
									</div>
								</div>
								
								<input type="text" name="fax_number" style="display:none" autocomplete="off">
								
								<div style="display:flex; margin-top: 15px;" class="riga3">
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Ruolo attuale</span>
										<input type="text" name="ruolo_attuale" class="form-control" value="{{ old('ruolo_attuale') }}" required>
									</div>
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Mansione specifica</span>
										<input type="text" name="mansione_specifica" class="form-control" value="{{ old('mansione_specifica') }}" required>
									</div>
								</div>

								<div style="display:flex; margin-top: 15px;" class="riga4">
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Sede lavorativa preferita</span>
										<select name="sede_lavorativa" class="form-control" required>
											<option value="">Seleziona una sede...</option>
											<option value="Milano" {{ old('sede_lavorativa') == 'Milano' ? 'selected' : '' }}>Milano</option>
											<option value="Roma" {{ old('sede_lavorativa') == 'Roma' ? 'selected' : '' }}>Roma</option>
											<option value="Torino" {{ old('sede_lavorativa') == 'Torino' ? 'selected' : '' }}>Torino</option>
											<option value="Disponibile a trasferte" {{ old('sede_lavorativa') == 'Disponibile a trasferte' ? 'selected' : '' }}>Disponibile a trasferte</option>
										</select>
									</div>

									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Area di interesse</span>
										<div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
											@foreach(['Tecnica', 'Ingegneria', 'Amministrazione', 'Logistica', 'Sicurezza'] as $area)
												<label style="display: inline-flex; align-items: center; background: #f0f0f0; border-radius: 20px; padding: 6px 14px; cursor: pointer; transition: background 0.3s;">
													<input type="checkbox" name="area_interesse[]" value="{{ $area }}" style="margin-right:8px;" {{ is_array(old('area_interesse')) && in_array($area, old('area_interesse')) ? 'checked' : '' }}>
													<span>{{ $area }}</span>
												</label>
											@endforeach
										</div>
									</div>
								</div>

								<div style="display:flex; gap:30px; margin-top: 15px;" class="allegati">
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Allega il tuo CV</span>
										<input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx" required>
									</div>
									<div style="display: flex; flex:1; flex-direction: column;">
										<span>Lettera di presentazione (facoltativa)</span>
										<input type="file" name="lettera_presentazione" class="form-control" accept=".pdf">
									</div>
								</div>

								<div class="row" style="margin-top: 15px;">
									<div class="form-group col-md-12">
										<?php /*<p class="mb-2">Accetta Trattamento dei dati <span style="color:{{ config('app.color1') }}">*</span></p>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="privacy" type="checkbox" required> Accetto
											</label>
										</div>
										<p class="mb-2"><strong>Prima dell’invio</strong> consulta l’<a href="privacy-policy.html" style="color:#E30613;" target="_blank">Informativa Privacy</a>.</p> */?>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="privacy" type="checkbox" required>
												Dichiaro di aver preso visione dell'<a href="informativa-candidati.html" target="_blank" style="text-decoration:underline">informativa privacy</a> resa ai sensi dell'art. 13 GDPR.
											</label>
										</div>
										
										<div class="form-check form-check-inline" style="margin-top:10px;">
											<label class="form-check-label">
												<input class="form-check-input" name="privacy" type="checkbox" required>
												Acconsento alla condivisione dei miei dati con società partner del Titolare, operanti nel medesimo settore, interessate a profili professionali corrispondenti al Suo, così come previsto all'interno dell'informativa della privacy.
											</label>
										</div>
									</div>
								</div>
								
								<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

								<button type="submit" style="
									width: 250px;
									padding: 12px 5px;
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
								">INVIA LA CANDIDATURA</button>
							</form>
							<script src="https://www.google.com/recaptcha/api.js?render={{ config('app.google_recaptcha_public_key') }}"></script>
							<script>
								grecaptcha.ready(function() {
									grecaptcha.execute('{{ config('app.google_recaptcha_public_key') }}', {action: 'invia_lavora_con_noi'}).then(function(token) {
										document.getElementById('g-recaptcha-response').value = token;
									});
								});
							</script>

						</div>
					</div>
				</div>
			</div>

		</div>	
	</div>	

	

<script>
document.addEventListener('DOMContentLoaded', () => {
	document.getElementById('candidaturaForm').addEventListener('submit', function(e) {
        const checkboxes = document.querySelectorAll('input[name="area_interesse[]"]');
        const oneChecked = Array.from(checkboxes).some(cb => cb.checked);
        
        if (!oneChecked) {
            alert('Seleziona almeno un\'area di interesse.');
            e.preventDefault();
        }
    });
    
	
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
@endsection	