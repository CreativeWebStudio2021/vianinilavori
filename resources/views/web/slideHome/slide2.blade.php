<style>	  
	

	#slide2 {
	  height: 100%;
	  background: #fff;
	  z-index: 9;
	  top:100%;
	  transition: all 1s ease;
	  background: url('{{asset('web/images/v_grigia.png') }}') no-repeat top center;	  
	}
		
		#slide2::before {
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
  
	
	
	
	.circles-wrapper {
		display: flex;
		gap: 60px;
		justify-content: center;
		align-items: flex-start;
	  }

	  .circle-block {
		display: flex;
		flex-direction: column;
		align-items: center;
		width: 250px;
		text-align: center;
	  }


	  .circle-container {
		position: relative;
		width: 175px;
		height: 175px;
		text-align: center;
	  }

	  .inner-circle {
		width: 175px;
		height: 175px;
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
		font-size: 60px;
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

	  .circle-container svg {
		  position: absolute;
		  top: -32.5px; /* (240 - 175) / 2 */
		  left: -32.5px;
		  width: 240px;
		  height: 240px;
		  z-index: 1;
		  transform: rotate(-180deg);
		}

		.progress-ring__circle {
		  stroke: #E30613;
		  stroke-width: 4;
		  fill: transparent;
		  stroke-dasharray: 691;
		  stroke-dashoffset: 691;
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
	#slide2Title{
		width:100%; 
		margin-top:200px; 
		height:150px; 
		z-index:6; 
		display:flex; 
		justify-content: center; 
		align-items: center;
	}
	.titleContainerSlide2{
		display: flex; 
		gap: 20px;
		justify-content: center;
		align-items: flex-start;
	}
	.gapTitleSlide2{display:none}	
	@media screen AND (max-width:1024px){
		#slide2Title{
			margin-top:250px;
		}
		.titleContainerSlide2{
			flex-direction:column;
		}
		.title2Slide2{margin-left:10px;}
	}
	@media screen AND (max-width:900px){
		.circles-wrapper{
			flex-direction:column;
		}
		.linkSlide2{
			flex-direction:column;
		}
	}
	@media screen AND (max-width:490px){
		#slide2Title{
			margin-top:260px;
		}
		.title1Slide2{margin-left:30px;}
		.gapTitleSlide2{display:inline}	
	}
	@media screen AND (max-width:450px){
		.linkSlide2 .link-block{
			margin:20px 20px;
		}
	}
</style>
<section class="slide hidden-on-load" id="slide2">
	
	
	<div id="scrollable-slide2-content" style="width:100%; height:100%; position:absolute; top:0; left:0; z-index:10; overflow-Y:scroll">
		<div style="width:100%;">
			<div id="start-of-slide3"></div>
			
			<div style="width:100%; height:calc(100vh - 200px); ">
				<div style="" id="slide2Title">
					<div class="titleContainerSlide2">
						<div style="font-size:44px; color:#000; font-weight:bold;"  class="title1Slide2 anim-step"  data-anim="slide-down" data-delay="500" data-duration="1500">
							<span style="color:#E30613; font-size:44px; font-weight:700">INNOVIAMO</span> <span class="gapTitleSlide2"><br/></span><span style="font-size:44px; font-weight:500">il presente,</span>
						</div>
						<div style="font-size:44px; color:#000; font-weight:bold;"  class="title2Slide2 anim-step"  data-anim="slide-down" data-delay="800" data-duration="1500">
							<span style="color:#E30613; font-size:44px; font-weight:700">COSTRUIAMO</span> <span class="gapTitleSlide2"><br/></span><span style="font-size:44px; font-weight:500">il futuro.</span>
						</div>
					</div>
				</div>
				<div style="width:60%;  z-index:6; display:flex; justify-content: center; align-items: center; margin:0 auto;">
					<div class="circles-wrapper">
					  <div class="circle-block">
						<div class="circle-container" data-start="0" data-end="2.7" data-decimals="1" data-sub="Mld">
						  <svg shape-rendering="geometricPrecision">
							<circle class="progress-ring__circle" cx="120" cy="120" r="110"/>
						  </svg>
						  <div class="inner-circle">
							<span class="counter">0.0</span>
							<div class="subtext">Mld</div>
						  </div>
						</div>
						<div class="circle-label">PORTAFOGLIO<br/>LAVORI 2025</div>
					  </div>

					  <div class="circle-block">
						<div class="circle-container" data-start="0" data-end="26" data-decimals="0">
						  <svg shape-rendering="geometricPrecision">
							<circle class="progress-ring__circle" cx="120" cy="120" r="110"/>
						  </svg>
						  <div class="inner-circle">
							<span class="counter">00</span>
						  </div>
						</div>
						<div class="circle-label">COMMESSE<br/>ATTIVE</div>
					  </div>

					  <div class="circle-block">
						<div class="circle-container" data-start="0" data-end="590.2" data-decimals="1" data-sub="MIO">
						  <svg shape-rendering="geometricPrecision">
							<circle class="progress-ring__circle" cx="120" cy="120" r="110"/>
						  </svg>
						  <div class="inner-circle">
							<span class="counter">000,0</span>
							<div class="subtext">MIO</div>
						  </div>
						</div>
						<div class="circle-label">VALORE<br/>DELLA PRODUZIONE 2025</div>
					  </div>
					</div>
				</div>
				<style>
					.link-block {
					  flex: 1;
					  margin: 20px 50px;
					  border-bottom: solid 1px #D9D9D9;
					  font-size: 30px;
					  display: flex;
					  align-items: center;
					  justify-content: space-between;
					  color: #000;
					  text-decoration: none;
					  transition: font-weight 0.3s;
					  position: relative;
					}

					.link-block span {
					  transition: font-weight 0.3s;
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
					  transform: translate(8px, -50%) rotate(-45deg);
					}

					.linkSlide2Container{
						z-index:6; width:100%; height:100px; left:0; margin-top:160px; 
					}
					
					@media screen AND (max-width:1024px){
						.linkSlide2Container{padding-bottom:250px}
					}
				</style>
				<div class="linkSlide2Container">
				  <div style="display:flex; align-items:center;" class="mainTextContainer">
					<div style="display: flex; width: 100%;" class="linkSlide2">
					  <a href="un-viaggio-lungo-oltre-un-secolo.html" title="La Nostra Storia - {{ config('app.name') }}" class="link-block">
						<span>Storia</span>
						<div class="freccia"></div>
					  </a>
					  <a href="mission-e-vision.html" title="Mission & Vision -  {{ config('app.name') }}" class="link-block">
						<span>Mission & Vision</span>
						<div class="freccia"></div>
					  </a>
					  <a target="_blank" href="{{ mostra_pdf_url('VL_Company Profile_31.03.2025_rev1.pdf', 'Company Profile - Vianini Lavori', 'doc') }}" title="Company Profile - {{ config('app.name') }}" class="link-block">
						<span>Company Profile</span>
						<div class="freccia"></div>
					  </a>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>


</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
	// ANIMAZIONI .anim-step
	const steps = document.querySelectorAll('.anim-step');
	const observerSteps = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
		  if (entry.isIntersecting) {
			const el = entry.target;
			const animType = el.dataset.anim || 'fade';
			const delay = parseInt(el.dataset.delay) || 0;
			const hideDelay = parseInt(el.dataset.hide);
			const duration = parseInt(el.dataset.duration) || 1000;
			
			el.style.transitionDuration = `${duration}ms`;

			setTimeout(() => {
			  el.classList.add(animType, 'visible');

			  if (hideDelay) {
				setTimeout(() => {
				  el.classList.add('disappear');
				}, hideDelay);
			  }
			}, delay);

			observerSteps.unobserve(el);
		  }
		});
	}, { threshold: 0.2 });

	steps.forEach(step => observerSteps.observe(step));





	// FUNZIONE GENERALE PER FORMATTAZIONE NUMERI
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


	// ANIMAZIONE CERCHI
	const circleObserver = new IntersectionObserver((entries, observer) => {
		entries.forEach(entry => {
		  if (entry.isIntersecting) {
			const container = entry.target;
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
		  }
		});
	}, { threshold: 0.3 });

	document.querySelectorAll('.circle-container').forEach(container => {
		circleObserver.observe(container);
	});
	
	// Evita che la slide2 appaia prima del previsto
	const slide2 = document.getElementById('slide2');
	slide2.classList.add('hidden-on-load'); // applichiamo subito la classe
	const slide2Title = document.getElementById('slide2Title');
	
	const slide2Observer = new IntersectionObserver((entries, observer) => {
	  entries.forEach(entry => {
		if (entry.isIntersecting) {
		  slide2.classList.remove('hidden-on-load');
		  observer.unobserve(entry.target);
		}
	  });
	}, { threshold: 0.2 });

	slide2Observer.observe(slide2Title);
	
	
});
</script>




