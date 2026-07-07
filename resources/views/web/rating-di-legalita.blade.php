@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "MODELLO ORGANIZZATIVO<br/>ex D.lgs. 231/2001";
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

		.center {
			text-align: center;
		  }

		  .justify {
			text-align: justify;
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
		  padding-left: 25px;
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
			.mainTextContainer {	width:calc(100% - 100px) !important; }
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
	  
	  padding: 5px 10px 5px 5px;
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

		#linkModello{
			width:600px; 
			margin-left:0;
		}
		@media screen AND (max-width:800px){
			#linkModello{
				width:100%; 
			}
		}	
		
		.gapStar{display:none}
		@media screen AND (max-width:900px){			
			.gapStar{display:inline}
		}
	</style>	
	
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">	
		<section style="width:100%; margin-bottom:40px;">
			<div class="mainTextContainer mainTextContainer2" style="margin-bottom:30px;">	
				<div id="subMenuContainer">			  
				  <a href="modello-231.html" title="Modello organizzativo ex D.lgs. 231/2001" class="link-block">
						<span >Modello organizzativo ex D.lgs. 231/2001&nbsp;</span>
						<div class="freccia"></div>
				  </a>			  
				  <a href="codice-etico-e-di-condotta.html" title="Codice Etico" class="link-block">
						<span >Codice Etico e di Condotta&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a href="rating-di-legalita.html" title="Rating di Legalità" class="link-block active">
						<span >Rating di Legalità&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				  <a href="whistleblowing.html" title="Whistleblowing" class="link-block">
						<span >Whistleblowing&nbsp;</span>
						<div class="freccia"></div>
				  </a>
				</div>
			</div>
		</section>
		
		<section style="width:100%;">
			<div class="mainTextContainer mainTextContainer2 " style="position:relative; z-index:1;">
				<div class="expand-block__header">
					<div class="expand-block__bg-hover"></div>
					<div class="expand-block__title" style="margin-bottom:30px;">
						<span style="font-size:30px; font-weight:700">RATING DI LEGALITÀ 2024-2026 <span class="gapStar"><br/></span><i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i></span>
					</div>
				</div>
				@php
					$query_intro = DB::table('testi_introduttivi')
						->select('testo')
						->where('pagina','=','Rating di Legalità')
						->get();
				@endphp
				<div class="expand-block__content" style="margin-top:30px; margin-bottom:60px; border:none !important;">
					{!! $query_intro[0]->testo !!}
				</div>
			</div>
		</section>
	</div>	
  
    <script>
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
		
	});

	</script>
@endsection	