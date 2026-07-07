@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$img_background="web/images/header_bilanci.jpg";
		$page_title = "BILANCI DI<br/>ESERCIZIO";
		$x=0;
	@endphp
	@include('web.common.page_title')
	
	<style>
	.iso-filter-wrapper {
	  display: flex;
	  justify-content: center;
	  align-items: center;
	  gap: 40px; /* 🔧 distanza regolabile tra voci */
	  margin: 20px 0;
	}

	.iso-filter-item a {
	  position: relative;
	  font-size: 20px;
	  font-family: Arial, sans-serif;
	  color: black;
	  font-weight: bold;
	  text-decoration: none;
	  transition: color 0.5s ease;
	}

	/* Effetto underline al passaggio */
	.iso-filter-item a::after {
	  content: '';
	  position: absolute;
	  bottom: -2px;
	  left: 0;
	  width: 0;
	  height: 1px;
	  background-color: #E73338;
	  transition: width 0.3s ease;
	}

	/* Hover */
	.iso-filter-item a:hover::after {
	  width: 100%;
	}

	/* Attivo: riga rossa visibile */
	.iso-filter-item a.active::after {
	  width: 100% !important;
	}

	
	
	.iso-list {
	  width: 100%;
	  margin-bottom:80px;
	}

	.iso-item {
	  position: relative;
	  padding: 5px 10px;
	  margin: 10px 0; /* spazio sopra e sotto */
	  overflow: hidden;
	  display: flex;
	  align-items: center;
	  cursor:pointer;
	}

	/* Sfondo in entrata animata */
	.iso-item .bg-hover {
	  transition: all 0.5s ease;
	}

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

	.iso-item:hover .bg-hover {
	  width: 100%;
	}

	.iso-item.selected .bg-hover {
	  width: 100%;
	}
	
	.iso-item.selected .icon-hover {
	  opacity: 1;
	}

	.iso-item.selected .icon-default {
	  opacity: 0;
	}


	/* Z-indices per layer sopra sfondo */
	.iso-left, .iso-content, .iso-right {
	  position: relative;
	  z-index: 2;
	}


	.iso-left img {
	  width: 62px;
	  height: 62px;
	  object-fit: contain;
	}

	.iso-content {
	  flex: 1;
	  padding: 0 30px;
	}

	.iso-title {
	  font-family: 'Srisakdi', sans-serif; /* o quello che usi */
	  //font-weight: bold;
	  font-size: 40px;
	  color: black;
	}

	.iso-subtitle {
	  font-family: 'Nunito', sans-serif;
	  font-size: 30px;
	  color: #565656;
	  margin-top: 5px;
	}

	.iso-right {
	  width: 55px;
	  height: 55px;
	  position: relative;
	}

	.iso-right img {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 55px;
	  height: 55px;
	  object-fit: contain;
	  transition: opacity 0.3s ease;
	}

	.iso-right .icon-hover {
	  opacity: 0;
	}
	
	.iso-right .icon-close {
		width: 45px;
		height: 45px;
		position: absolute;
		top: 0;
		left: 0;
		object-fit: contain;
		transition: opacity 0.3s ease;
	}


	.iso-item:hover .icon-hover {
	  opacity: 1;
	}

	.iso-item:hover .icon-default {
	  opacity: 0;
	}

	/* Transizione fade per filtraggio */
	.iso-item {
	  opacity: 1;
	  transform: translateY(0);
	  transition: all 0.4s ease;
	}

	.iso-item.hide {
	  opacity: 0;
	  transform: translateY(20px);
	  pointer-events: none;
	  height: 0;
	  padding: 0;
	  margin: 0;
	  border: none;
	  overflow: hidden;
	}
	.iso-wrapper {
	  padding-bottom: 0px;
	  border-bottom: 2px solid #000;
	}
	.iso-wrapper.hide {
		display: none !important;
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
	
	.iso-content{padding-left:5px;}
		
		.iso-title {
		  font-family: 'Arial';
		  font-size: 30px;
		}

		.iso-subtitle {
		  font-size: 25px;	  
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
		  font-weight: 600;
		  position: relative;
		  z-index: 2;
		}

		.expand-block__title .bold {
		  font-weight: bold;
		}

		.expand-block__content {
		  display: block;
		  padding: 20px 0;
		  text-align:justify;
		}
		.expand-block__title span {
		  font-weight: 600;
		  font-size:30px;
		}
		
		.project-metrics {
		  display: flex;
		  gap: 0px;
		  align-items: stretch;
		  height: auto;
		  margin-bottom:20px;
		  flex-direction: column;
		}

		.icon-arrow {
		  color: #E30613;
		  display: flex;
		  align-items: center;
		  font-size: 24px;
		}

		.metric-value {
		  font-size: 25px;
		  font-weight: bold;
		  display: flex;
		}

		.metric-label {
		  font-size: 20px;
		  display: flex;
		  align-items: flex-end;
		  transform: translateY(0px);
		  transform: translateX(5px);
		}
		
		.metric-value{
			position:relative;
		}
		.metric-value::before {
		  content: '';
		  position: absolute;
		  left: -20px;
		  top: 3px;		  
		  width: 12px;
		  height: 12px;
		  border-right: 2px solid #E73338;
		  border-bottom: 2px solid #E73338;
		  transform: rotate(-45deg);
		}
		
		.missionListContainer{width:calc(100% - 20px); padding-top:40px; margin-top:35px; margin-bottom:20px;}
		.missionList{display:flex; gap:50px}
		//.missionList{flex-direction:column; gap:0px;}
		//.missionListContainer{width:600px; margin:35px 0 20px; }
		
		@media screen AND (max-width:1024px){
			.missionList{flex-direction:column; gap:0px;}
		}
		@media screen AND (max-width:800px){
			.iso-title {
			  font-size: 25px;
			}

			.iso-subtitle {
			  font-size: 20px;
			}
		}
		
		@media screen AND (max-width:600px){
			.iso-left{display:none;}
			.iso-content{padding:0px 10px 0 0;}
		}
		
		@media screen AND (max-width:600px){
			.iso-right img {
				width: 45px;
				height: 45px;
			}
			.iso-item{padding:0};
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
	</style>	
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">
		<section style="width:100%;">
			<div class="mainTextContainer">
				<div class="expand-block__header" style="margin-bottom:40px;">
					<div class="expand-block__bg-hover"></div>
					<div class="expand-block__title">
						<span>Vianini Lavori chiude il 2025 con risultati in forte crescita</span>
					</div>
				</div>
				
				<style>
					.circles-wrapper {
						display: flex;
						justify-content: space-between;
						align-items: flex-start;
						width: 100%;
					  }

					  .circle-block {
						display: flex;
						flex-direction: column;
						align-items: center;
						justify-content: flex-start;
						text-align: center;
						flex: 1;
						min-width: 0;
					}



					  .circle-container {
						position: relative;
						width: 130px;
						height: 130px;
						text-align: center;
					  }

					  .inner-circle {
						width: 130px;
						height: 130px;
						background: #E4E4E4;
						border-radius: 50%;
						display: flex;
						flex-direction: column;
						justify-content: center;
						align-items: center;
						z-index: 2;
						position: relative;
					  }

					  .counter {
						font-family: Arial, sans-serif;
						font-weight: bold;
						font-size: 40px;
						color: #E30613;
						line-height: 1;
					  }

					  .subtext {
						font-family: Arial, sans-serif;
						font-weight: bold;
						font-size: 20px;
						color: #E30613;
						margin-top: 4px;
					  }

					  svg {
						  position: absolute;
						  top: -30px; /* (240 - 175) / 2 */
						  left: -30px;
						  width: 190px;
						  height: 190px;
						  z-index: 1;
						  transform: rotate(-180deg);
						}

						.progress-ring__circle {
						  stroke: #E30613;
						  stroke-width: 4;
						  fill: transparent;
						  stroke-dasharray: 584.34;
						  stroke-dashoffset: 584.34;
						}

					  .animate .progress-ring__circle {
						animation: drawCircle 2s ease-out forwards;
					  }

					  @keyframes drawCircle {
						to {
						  stroke-dashoffset: 172.75;
						}
					  }

					  .circle-label {
						text-align: center;
						font-family: Arial, sans-serif;
						font-weight: bold;
						font-size: 18px;
						color: #000;
						line-height: 1.2;
						margin-top:35px;
					  }
					  
					  .hidden-on-load {
						  opacity: 0;
						  transform: translateY(50px);
						}
						
					.fadeUpBlock {
					  opacity: 0;
					  transform: translateY(20px);
					  transition: opacity 1.2s ease-out, transform 1.2s ease-out;
					}

					.fadeUpBlock.visible {
					  opacity: 1;
					  transform: translateY(0);
					}
					.conf2{display:none}
					.conf3{display:none}
					@media screen AND (max-width:1200px){
						.conf1{display:none}
						.conf2{display:block}
					}
					@media screen AND (max-width:750px){
						.conf1{display:none}
						.conf2{display:none}
						.conf3{display:block}
					}
					@media screen AND (max-width:580px){
						.circle-block {
						  display: flex;
						  flex-direction: column;
						  align-items: center;
						  justify-content: flex-start;
						  text-align: center;
						  min-width: 0;
						  width: auto;
						  flex: 0 0 auto; /* questo è cruciale per evitare stretching */
						  margin: 0 auto;  /* centra orizzontalmente in colonna */
						  margin-bottom:40px;
						}

						.circles-wrapper{flex-direction:column;}
					}
					
					.linkList{display:flex; gap:80px; margin-bottom:80px;}
		@media screen AND (max-width:800px){
			#linkList {	flex-direction:column; gap:20px; margin-bottom:80px; }
		}
		
		.linkList ul li {
		  display: flex;
		  align-items: flex-start;
		  gap: 10px;
		  margin-bottom: 20px;
		}

		.link-block {
		  display: flex;
		  align-items: center;
		  justify-content: space-between;
		  flex-grow: 1;
		  width: 100%; /* 👈 fa occupare tutta la colonna */
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
		  //background: #d9d9d9;
		}

		.linkList li img.icon-li {
		  width: 30px;
		  height: 30px;
		  object-fit: contain;
		  flex-shrink: 0;
		  margin-top: 5px;
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
		
		.link-block span {		 
			  font-weight: bold;
			  transition: background 0.3s;
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
		  transform: translate(0px, -50%) rotate(-45deg);
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
		  transform: translate(7px, -50%) rotate(-45deg);
		}
		
		.mainTextContainer li {
			  margin-bottom:30px;
			  opacity:0;
			}
			
			.mainTextContainer li::before {
			  display:none !important;
			}
			
			ul li::before {
			  display:none !important;
			}

			.mainTextContainer li img.icon-li {
			  position: absolute;
			  left: 0;
			  top: -3px;
			  width: 30px;
			  height: 30px;
			  object-fit: contain;
			}
			
			#pageContainer {
				background: url(web/images/v_grigia_s.png) no-repeat top center;
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
			  background: url(web/images/v_grigia_s.png) no-repeat top center;
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
			</style>
		
				<div class="missionListContainer">
					<div style="padding:30px;" class="missionList fadeUpBlock conf1">
						
							<div class="circles-wrapper">
							  <?php /*<div class="circle-block">
								<div class="circle-container" data-start="0" data-end="2.7" data-decimals="1" data-sub="Mld">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">000.0</span>
									<div class="subtext">Mld</div>
								  </div>
								</div>
								<div class="circle-label">Ricavi operativi<br/>+ 137% sul 2023</div>
							  </div>*/?>
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="2.7" data-decimals="1" data-sub="Mld">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">000.0</span>
									<div class="subtext">Mld</div>
								  </div>
								</div>
								<div class="circle-label">Portafoglio lavori</div>
							  </div>

							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="590.2" data-decimals="1" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00.0</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Valore della produzione</div>
							  </div>

							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="33" data-decimals="0" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Utile</div>
							  </div>
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="26" data-decimals="0">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00</span>
								  </div>
								</div>
								<div class="circle-label">Commesse attive</div>
							  </div>

							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="154.5" data-decimals="1" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">000,0</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Posizione finanziaria netta</div>
							  </div>
							</div>

						
					</div>
					
					<div style="padding:30px;" class="missionList fadeUpBlock conf2">
							<div class="circles-wrapper" style="margin-bottom:40px;">						  
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="2.7" data-decimals="1" data-sub="Mld">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">000.0</span>
									<div class="subtext">Mld</div>
								  </div>
								</div>
								<div class="circle-label">Portafoglio lavori</div>
							  </div>

							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="590.2" data-decimals="1" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00.0</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Valore della produzione</div>
							  </div>

							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="33" data-decimals="0" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Utile</div>
							  </div>
							</div>
							<div class="circles-wrapper">
							  <div style="flex:0 0 16.5%;"></div>
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="26" data-decimals="0">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00</span>
								  </div>
								</div>
								<div class="circle-label">Commesse attive</div>
							  </div>

							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="154.5" data-decimals="1" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">000,0</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Posizione finanziaria netta</div>
							  </div>
								<div style="flex:0 0 16.5%;"></div>
							</div>
					</div>
					
					<div style="padding:50px 30px; 70px" class="missionList fadeUpBlock conf3">
						
							<div class="circles-wrapper">
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="2.7" data-decimals="1" data-sub="Mld">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">000.0</span>
									<div class="subtext">Mld</div>
								  </div>
								</div>
								<div class="circle-label">Portafoglio lavori</div>
							  </div>

							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="590.2" data-decimals="1" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00.0</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Valore della produzione</div>
							  </div>

							</div>
							<div class="circles-wrapper">
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="33" data-decimals="0" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Utile</div>
							  </div>
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="26" data-decimals="0">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">00</span>
								  </div>
								</div>
								<div class="circle-label">Commesse attive</div>
							  </div>
							</div>
							<div class="circles-wrapper">
							  <div class="circle-block">
								<div class="circle-container" data-start="0" data-end="154.5" data-decimals="1" data-sub="MIO">
								  <svg shape-rendering="geometricPrecision">
									<circle class="progress-ring__circle" cx="95" cy="95" r="93"/>
								  </svg>
								  <div class="inner-circle">
									<span class="counter">000,0</span>
									<div class="subtext">MIO</div>
								  </div>
								</div>
								<div class="circle-label">Posizione finanziaria netta</div>
							  </div>
							</div>
							</div>

					</div>
				</div>
				
				
				<div class="iso-list">					
					<div class="linkList" style="margin-top:20px !important;">
						<div style="flex:1;">
							<ul style="margin-top:0 !important">
								
								<li style="display: flex; align-items: center;  margin-bottom: 24.2px;">
								  <img class="icon-li" src="{{ asset('web/images/icon_pdf_b.png') }}" alt="Articolo de 'Il Sole 24 Ore' - Bilanci di Esercizio - {{ config('app.name') }}">
									  <a href="{{ mostra_pdf_url('CS_VIANINI_risultati2025_04032026_2.pdf', null, 'comunicati') }}" title="Articolo de 'Il Sole 24 Ore' - Bilanci di Esercizio - {{ config('app.name') }}" target="_blank" class="link-block">
									<div class="link-texts">
									  <span>Articolo de "Il Sole 24 Ore"</span>
									  <div class="subtitle"></div>
									</div>
									<div class="freccia"></div>
								  </a>
								</li>
								<li style="display: flex; align-items: center;  margin-bottom: 24.2px;">
								  <img class="icon-li" src="{{ asset('web/images/icon_pdf_b.png') }}" alt="Comunicato stampa - Bilanci di Esercizio - {{ config('app.name') }}">
									  <a href="{{ mostra_pdf_url('Risultati 2025_Comunicato Stampa_2.pdf', null, 'news') }}" title="Comunicato stampa - Bilanci di Esercizio - {{ config('app.name') }}" target="_blank" class="link-block">
									<div class="link-texts">
									  <span>Risultati 2025: Comunicato Stampa</span>
									  <div class="subtitle"></div>
									</div>
									<div class="freccia"></div>
								  </a>
								</li>
								<li style="display: flex; align-items: center;  margin-bottom: 24.2px;">
								  <img class="icon-li" src="{{ asset('web/images/icon_pdf_b.png') }}" alt="Bilancio di esercizio 2024 - Bilanci di Esercizio - {{ config('app.name') }}">
									<a href="https://www.vianinilavori.it/bilanci/VianiniLavori2025/index.html" title="Bilancio di esercizio 2024 - Bilanci di Esercizio - {{ config('app.name') }}" target="_blank" class="link-block">
									<div class="link-texts">
									  <span>Bilancio di esercizio 2025</span>
									  <div class="subtitle"></div>
									</div>
									<div class="freccia"></div>
								  </a>
								</li>
							</ul>
						</div>
						<div style="flex:1;">
							<ul style="margin-top:0 !important">
								@php
								$x=0;
								$query_bil = DB::table('bilanci')
									->select('*')
									->orderBy('ordine', 'DESC')
									->skip(1)
									->take(1000)
									->get();

								foreach ($query_bil as $value_bil) {
									$x++;
									$bilanci[$x] = [
										'titolo' => $value_bil->titolo,
										'pdf' => $value_bil->file,
										'link' => $value_bil->link
									];
								}

							@endphp
							@foreach($bilanci as $index => $item)
							  @php
								if(isset($item['pdf']) && $item['pdf']!="") $link = mostra_pdf_url($item['pdf'], $item['titolo'], 'bilanci');
								else $link = $item['link'];
							  @endphp
									<li style="display: flex; align-items: center;  margin-bottom: 24.2px;">
									  <img class="icon-li" src="{{ asset('web/images/icon_pdf_b.png') }}" alt="{!! $item['titolo'] !!} - Bilanci di Esercizio - {{ config('app.name') }}">
									  <a href="{{ $link }}" title="{!! $item['titolo'] !!} - Bilanci di Esercizio - {{ config('app.name') }}" target="_blank" class="link-block">
										<div class="link-texts">
										  <span>{!! $item['titolo'] !!}</span>
										  <div class="subtitle"></div>
										</div>
										<div class="freccia"></div>
									  </a>
									</li>
								@endforeach
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>	
	</div>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			function formatNumber(val, decimals, pad = false) {
				let fixed = val.toFixed(decimals);
				if (decimals === 1 && fixed.includes('.')) {
					fixed = fixed.replace('.', ',');
				}
				if (pad) {
					if (decimals === 0 && val < 10) {
						fixed = '0' + fixed;
					}
					if (decimals === 1 && val < 10) {
						fixed = '00' + fixed;
					} else if (decimals === 1 && val < 100) {
						fixed = '0' + fixed;
					}
				}
				return fixed;
			}

			const circleObserver = new IntersectionObserver((entries, observer) => {
				entries.forEach((entry, index) => {
					if (entry.isIntersecting) {
						const container = entry.target;

						// Applichiamo un ritardo in base all'indice
						const delay = 0;

						setTimeout(() => {
							container.classList.add('animate');
							const counter = container.querySelector('.counter');
							const start = parseFloat(container.getAttribute('data-start')) || 0;
							const end = parseFloat(container.getAttribute('data-end')) || 100;
							const decimals = parseInt(container.getAttribute('data-decimals')) || 0;

							let count = start;
							const steps = 100;
							const increment = (end - start) / steps;

							const update = () => {
								if (count < end) {
									count += increment;
									counter.textContent = formatNumber(count, decimals);
									requestAnimationFrame(update);
								} else {
									counter.textContent = formatNumber(end, decimals);
								}
							};

							update();
							observer.unobserve(container);
						}, delay);
					}
				});
			}, { threshold: 0.3 });

			document.querySelectorAll('.circle-container').forEach(container => {
				circleObserver.observe(container);
			});
		});
		
		
		// FadeIn+SlideUp blocchi di testo
		  const expandBlocks = document.querySelectorAll('.fadeUpBlock');

		  const observer = new IntersectionObserver((entries, obs) => {
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

		  expandBlocks.forEach(block => observer.observe(block));
	</script>
	
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

	// 3️⃣ Link delle due colonne
	const columns = document.querySelectorAll('.linkList ul');
	let delay = 800;

	columns.forEach((ul, colIndex) => {
	const items = ul.querySelectorAll('li');
		items.forEach((li, i) => {
			const delayMs = delay + (i * 150);
			li.style.animationDelay = `${delayMs}ms`;
			// 👇 attiva l'animazione con classe
			li.classList.add('fade-slide-up'); 
		});
	});

});
	
	document.querySelectorAll('.linkList li').forEach(li => {
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
</script>
@endsection	