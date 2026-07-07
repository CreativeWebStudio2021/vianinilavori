@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "COOKIE<br/>POLICY";
	@endphp
	@include('web.common.page_title')
	
	<style>
		.gapStar{display:none}
		.expand-block__title {
		  flex: 1;
		  font-size: 30px;
		  font-family: Arial, sans-serif;
		  display: flex;
		  gap: 10px;
		  color: #000;
		  font-weight: 600;
		  position: relative;
		  z-index: 2;
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
		
		
		.link-block.active span {		  
		  background:#d9d9d9;
		}
		.link-block:hover span {		  
		  background:#d9d9d9;
		}

		.link-block:hover .freccia::after {
		  transform: translate(18px, -50%) rotate(-45deg);
		}
		
		#subMenuContainer {
			padding:0; 
			display:flex;
		}
		@media screen AND (max-width:1024px){			
			#subMenuContainer {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			.link-block {
				flex: 0 0 50%; 
				box-sizing: border-box;
				padding: 0 10px;
				text-decoration: none;
			}
		}
		@media screen AND (max-width:900px){			
			.gapStar{display:inline}
		}
		.link-block{
			margin:0 60px 20px 0;
		}
	</style>
		
	<div class="mainTextContainer" style="margin-bottom:100px; text-align:justify">
		
		
		<style>
			.privacy-section-title {
				font-size: 25px;
				font-weight: bold;
				color: #000;
			}
		</style>

		<p class="privacy-section-title">1. Premessa</p>
		<p>Vianini Lavori S.p.a. (“Società” o “Titolare”) è titolare del trattamento dei dati personali dei visitatori del sito web della Società (“il Sito”). [...]</p>

		<p class="privacy-section-title">2. Tipologie di dati, finalità e base giuridica del trattamento</p>
		<p><strong>2.1 Dati di navigazione</strong><br>Il Sito acquisisce, nel corso del suo normale funzionamento, alcuni dei suoi Dati [...]</p>

		<p><strong>2.2 Dati identificativi</strong><br>Attraverso il Sito è possibile mettersi in contatto con la Società [...]</p>

		<p><strong>2.3 Finalità e basi giuridiche del trattamento dei Dati</strong></p>
		<ul>
			<li><span style="color: #E73338;"><strong>a) il legittimo interesse del Titolare</strong></span> [...]</li>
			<li><span style="color: #E73338;"><strong>b) l’adempimento di obblighi di legge</strong></span></li>
		</ul>

		<p><strong>2.4 Natura del conferimento</strong><br>Il trattamento dei Dati di navigazione è <span style="color: #E73338;"><strong>necessario</strong></span> [...]</p>

		<p class="privacy-section-title">3. Cookie</p>
		<p>[...] Il Sito utilizza esclusivamente <strong>cookie tecnici o essenziali</strong>; <span style="color: #E73338;"><strong>non utilizza cookie di profilazione</strong></span> [...]</p>

		<p class="privacy-section-title">4. Modalità di trattamento e conservazione dei Dati</p>
		<p>[...] I Dati sono conservati per <span style="color: #E73338;"><strong>tre anni</strong></span> [...]</p>

		<p class="privacy-section-title">5. Comunicazione dei Dati</p>
		<p>[...] I suoi Dati <span style="color: #E73338;"><strong>non saranno trasferiti fuori dall’area di applicazione del GDPR</strong></span>.</p>

		<p class="privacy-section-title">6. Diritti dell’interessato</p>
		<p>[...] Email Titolare: <span style="color: #E73338;">privacy@vianinilavori.it</span><br>
		Email DPO: <span style="color: #E73338;">dpo@vianinilavori.it</span></p>


	</div>
@endsection	