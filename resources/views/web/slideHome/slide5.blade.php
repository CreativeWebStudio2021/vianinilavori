<style>
	#slide5 {
	  height: calc(var(--vh, 1vh) * 100);
	  position:relative;
	  z-index: 6;
	  transition: all 1s ease;
	  background:url({{ asset('web/images/v_grigia_sfondo.png') }}) no-repeat;
	  background-size:contain;
	  background-position:top left;
	  top:100vh;
	 
	}
	
	/* Wrapper del carosello */
	.project-carousel-wrapper {
	  position: relative;
	  height: 100%;
	  overflow-x: hidden; /* Evitiamo scrollbar visibili */
	  width: 100%;
	}

	.project-carousel {
	  display: flex;
	  gap: 15px;
	  height: 100%;
	  width: max-content; /* Aggiungi questa riga */
	  will-change: transform;
	}



	/* Elementi del carosello */
	.project-item {
	  position: relative;
	  flex: 0 0 auto;
	  height: 100%;
	  overflow: hidden;
	  cursor: pointer;
	  transition: transform 0.3s ease;
	}

	.project-item img {
	  height: 100%;
	  width: 310px;
	  object-fit:cover;
	  display: block;
	  transition: transform 0.3s ease;
	}

	/* Overlay con titolo e freccia */
	.project-overlay {
	  position: absolute;
	  bottom: 50px;
	  left: 20px;
	  right: 20px;
	  color: #fff;
	  font-weight: bold;
	  font-size: 26px;
	  opacity: 1;
	  transform: translateY(20px);
	  transition: opacity 0.3s ease, transform 0.3s ease;
	  
	  align-items: center;
	  text-align:left
	}

	.project-arrow {
	  width: 30px;
	  height: 30px;
	  border-right: 2px solid #fff;
	  border-bottom: 2px solid #fff;
	  transform: rotate(-45deg);
	  transition: border-color 0.3s ease;
	}

	/* Effetto hover */
	.project-item:hover img {
	  transform: scale(1.1);
	}


	/* Controlli del carosello */
	.carousel-controls {
	  position: absolute;
	  bottom: 10px;
	  right: 10px;
	  display: flex;
	  gap: 10px;
	}

	.carousel-controls button {
	  background-color: #E30613;
	  color: #fff;
	  border: none;
	  padding: 10px;
	  border-radius: 50%;
	  cursor: pointer;
	  font-size: 18px;
	}
	.project-title{width:100%; }
	
	.project-arrow-container{
		position:absolute;
		bottom:-80px;
		width:68px; 
		height:68px; 
		border-radius:35px; 
		border:solid 1px #fff; 
		margin-top:15px;
		opacity: 0;
		transform: translateY(-20px);
		transition: opacity 0.5s ease, transform 0.5s ease;
	}
	
	.project-arrow{
		margin-top:17px; 
		width: 30px;
		height: 30px;
		margin-left:12px;
	}
	
	.project-item:hover .project-arrow-container {
		opacity: 1;
		transform: translateY(0px);
	}
	.project-item:hover .project-overlay {
	  opacity: 1;
	  transform: translateY(-40px);
	}
	
	.project-item {		
	  transform: translateX(120vw);
	  transition: transform 3s cubic-bezier(0.15, 0.85, 0.3, 1);
	}

	.project-item.entered {
	  transform: translateX(0);
	}
	
	.project-arrow-container:hover {
	  background-color: rgba(255, 255, 255, 0.8); /* sfondo bianco trasparente */
	  border: 1px solid #000; /* bordo nero */
	}

	.project-arrow-container:hover .project-arrow {
	  border-color: #000; /* freccia nera */
	}

	.circleArrow5{
		border:solid 1px #000;
		cursor:pointer;
		transition: all 0.3s ease;
	}
	.circleArrow5:hover{
		border:solid 1px #E30613;
		background:#E30613;
	}
	
	#nextBtn5-arrow{
		position:absolute; 
		width: 30px; 
		height: 30px; 
		top:17px; left:12px; 
		border-right: 2px solid #000; 
		border-bottom: 2px solid #000;
		transform: rotate(-45deg); 
	}
	#prevBtn5-arrow{
		position:absolute; 
		width: 30px; 
		height: 30px; 
		top:17px; 
		right:12px; 
		border-left: 2px solid #000; 
		border-top: 2px solid #000;
		transform: rotate(-45deg);
	}
	
	.circleArrow5:hover #nextBtn5-arrow{
		border-right: 2px solid #fff; 
		border-bottom: 2px solid #fff;
	}
	
	.circleArrow5:hover #prevBtn5-arrow{
		border-left: 2px solid #fff; 
		border-top: 2px solid #fff;
	}
	
	#projectList{
		position:absolute; 
		width:100%; 
		height:calc(100% - 370px); 
		top:250px; 
		left:0;
		overflow:hidden;
	}
	@media screen AND (max-height:750px){
		#projectList{height:calc(100% - 330px); }
		#nextBtn5, #prevBtn5{bottom:20px !important;}
	}
	.titlePositionSlide5{
		position:absolute; 
		width:calc(100% - 400px); 
		top:140px; 
		left:200px; 
		height:80px; 
		text-align:left;
	}
	
	@media screen AND (max-width:1600px){
		.titlePositionSlide5 { width:calc(100% - 200px);  left:100px; }
	}
	@media screen AND (max-width:1468px){
		.titlePositionSlide5 {	width:calc(100% - 100px); left:50px;  }
	}
	@media screen AND (max-width:1024px){
		.titlePositionSlide5 {	width:calc(100% - 80px); left:40px;  }
		.project-overlay{font-size:21px;}
		
		#slide5 {
		  background-size:cover;	
		  background-position: left top;
		}
		
		#projectList{top:220px; }
		.titlePositionSlide5{top:110px; }
	}
	@media screen AND (max-width:500px){
		.titlePositionSlide5 {	width:calc(100% - 60px); left:30px; }
		#slide5 {
		  background-position: -150px top;
		}
		.project-overlay{font-size:19px;}
	}
	@media screen AND (max-width:400px){
		.project-overlay{font-size:14px;}
	}
	/*@media screen AND (max-width:650px){
		.project-item img {
		  width: 205px;
		}
	}*/
	
	@media screen and (max-width: 1024px) {
	  .project-carousel-wrapper {
		overflow-x: auto;
		-webkit-overflow-scrolling: touch;
		scrollbar-width: none; /* Firefox */
	  }

	  .project-carousel-wrapper::-webkit-scrollbar {
		display: none; /* Chrome, Safari, Opera */
	  }
	}

</style>
<section class="slide" id="slide5">
	<div class="titlePositionSlide5">
		<div style="font-size:44px; font-weight:bold; color:#E30613">
			Progetti
		</div>	
		<div style="font-size:20px; color:#000">
			Scopri i nostri principali cantieri in Italia.
		</div>	
	</div>
	<div style="" id="projectList">
		<div class="project-carousel-wrapper">
			@php
				$categorie = DB::table('categorie')
					->select('nome')
					->orderBy('ordine', 'DESC')
					->get();

				$categorieData = [
					'Ferrovie' => [
						'slug' => 'ferrovie',
						'image' => 'Progetto_Ferrovie.png',
						'alt' => 'FERROVIE',
						'title' => 'FERROVIE'
					],
					'Metropolitane' => [
						'slug' => 'metropolitane',
						'image' => 'Progetto_Metropolitane.png',
						'alt' => 'METROPOLITANE',
						'title' => 'METROPOLITANE'
					],
					'Strade' => [
						'slug' => 'strade',
						'image' => 'Progetto_Strade.png',
						'alt' => 'STRADE',
						'title' => 'STRADE'
					],
					'Opere Marittime' => [
						'slug' => 'opere_marittime',
						'image' => 'Progetto_Opere_Marittime.png',
						'alt' => 'OPERE MARITTIME',
						'title' => 'OPERE MARITTIME'
					],
					'Ciclo Idrico Integrato' => [
						'slug' => 'ciclo_idrico_integrato',
						'image' => 'Progetto_Ciclo_Idrico_Integrato.png',
						'alt' => 'CICLO IDRICO INTEGRATO',
						'title' => 'CICLO IDRICO<br/>INTEGRATO'
					],
					'Edilizia Civile, Industriale e Sportiva' => [
						'slug' => 'edilizia_civile_industriale_e_sportiva',
						'image' => 'Progetto_Edilizia_Civile_industriale.png',
						'alt' => 'EDILIZIA CIVILE, INDUSTRIALE E SPORTIVA',
						'title' => 'EDILIZIA CIVILE<br/>INDUSTRIALE E SPORTIVA'
					],
				];
			@endphp

			<div class="project-carousel" id="projectCarousel">
				@foreach ($categorie as $categoria)
					@php
						$nome = $categoria->nome;
						$data = $categorieData[$nome] ?? null;
					@endphp

					@if ($data)
						<div class="project-item" data-category="{{ $data['slug'] }}">
							<a href="progetti/{{ $data['slug'] }}.html">
								<img src="{{ asset('web/images/'.$data['image']) }}" alt="{{ $data['alt'] }}" />
								<div class="project-overlay">
									<div class="project-title">{!! $data['title'] !!}</div>
									<div class="project-arrow-container">
										<div class="project-arrow"></div>
									</div>
								</div>
							</a>
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>
	<style>
		#nextBtn5{
			position: absolute;
			right: 25px;
			bottom: 30px;
			width:68px;
			height:68px;
			border-radius:35px;
		}
		#prevBtn5{
			position: absolute;
			right: 120px;
			bottom: 30px;
			width:68px;
			height:68px;
			border-radius:35px;
		}
		@media screen AND (max-width:1024px){
			#nextBtn5,#prevBtn5{bottom: 60px;}
		}
	</style>
	<!-- BOTTONE NEXT -->
	<div id="nextBtn5" class="circleArrow5">
	  <div id="nextBtn5-arrow"></div>
	</div>
	
	<!-- BOTTONE PREV -->
	<div id="prevBtn5" class="circleArrow5">
	  <div id="prevBtn5-arrow"></div>				  
	</div>
</section>

<script>
function setViewportHeight() {
  const vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
}
window.addEventListener('resize', setViewportHeight);
setViewportHeight();


function initializeObserver() {
  const detailContent = document.getElementById('detail-content');
  const carouselImages = document.querySelectorAll('.carousel-track img');
  let hasAnimated = false;

  if (!detailContent || !carouselImages.length) return;

  const observerProj = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !hasAnimated) {
        hasAnimated = true;

        carouselImages.forEach((img, i) => {
          img.style.transitionDelay = `${i * 0.05}s`; // Ritardo crescente di 0.1s per immagine
          img.classList.add('active');
        });

        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });

  observerProj.observe(detailContent);
}




function showOverlay5(category){
	  const BASE_URL = "{{ url('/') }}";
	  
	  projectDett.classList.add('active');
	  
	  //fetch(`${BASE_URL}/projects/${category}.php`)
	  fetch(`${BASE_URL}/projects/ferrovie`)
		.then(res => res.text())
		.then(html => {
		  projectDett.innerHTML = html;
		  projectDett.style.display = 'block';
		  setTimeout(() => {
			projectDett.style.opacity = 1;
            setupScrollBehavior();
            initializeObserver();
			setupCarouselScroll(); 
		  }, 10);
		}); // Funzione che gestisce apertura AJAX
  }
  
function calculateImageWidths() {
  const images = document.querySelectorAll('.carousel-image');
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



function setupCarouselScroll() {
  const carouselTrack = document.getElementById('carousel-track');
  const nextBtn = document.getElementById('nextBtnProj');
  const prevBtn = document.getElementById('prevBtnProj');
  const imageWidths = calculateImageWidths();

  let currentIndex = 0;

  nextBtn.addEventListener('click', () => {
    if (currentIndex < imageWidths.length - 2) {
      currentIndex++;
      const newScrollLeft = imageWidths.slice(0, currentIndex).reduce((a, b) => a + b, 0);
	  smoothScrollTo(carouselTrack, newScrollLeft+(currentIndex * 15), 100);
    }
  });

  prevBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
      currentIndex--;
      const newScrollLeft = imageWidths.slice(0, currentIndex).reduce((a, b) => a + b, 0);
      smoothScrollTo(carouselTrack, newScrollLeft+(currentIndex * 15), 100);
    }
  });
}


function setupScrollBehavior() {
  const heroSection = document.querySelector('.hero');
  const detailSection = document.querySelector('.detail-content');
  const scrollDownBtn = document.querySelector('.scroll-down');
  const closeBtn = document.querySelector('.close-btn');
  const closeBtn2 = document.querySelector('.close-btn2');
  const projectDett = document.getElementById('projectDett');

  // Funzione per scorrere alla sezione dettagli
  function scrollToDetail() {
	detailSection.scrollIntoView({ behavior: 'smooth' });
  }

  // Funzione per scorrere alla sezione hero
  function scrollToHero() {
	heroSection.scrollIntoView({ behavior: 'smooth' });
  }

  // Gestione del click sulla freccia
  scrollDownBtn.addEventListener('click', scrollToDetail);

  // Gestione dello scroll del mouse
  let lastScrollTop = 0;
  window.addEventListener('wheel', (e) => {
	if (e.deltaY > 0) {
	  scrollToDetail();
	} else {
	  scrollToHero();
	}
  });

  // Gestione dei tasti freccia
  window.addEventListener('keydown', (e) => {
	if (e.key === 'ArrowDown') {
	  scrollToDetail();
	} else if (e.key === 'ArrowUp') {
	  scrollToHero();
	}
  });

  // Gestione del click sul pulsante di chiusura
  closeBtn.addEventListener('click', () => {
	closeOverlay();
  });
  closeBtn2.addEventListener('click', () => {
	closeOverlay();
  });
  
  window.addEventListener('keydown', (e) => {
	  if (e.key === 'Escape') {
		closeOverlay();
	  }
	});
	
	function closeOverlay() {
	  const projectDett = document.getElementById('projectDett');
	  projectDett.style.opacity = 0;
	  setTimeout(() => {
		projectDett.style.display = 'none';
		projectDett.innerHTML = ''; // svuota il contenuto
	  }, 1000); // deve combaciare con la durata della transizione
	}

}  
  
document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.getElementById('projectCarousel');
  const carouselWrapper = document.querySelector('.project-carousel-wrapper');
  const slide5 = document.getElementById('slide5');
    const prevBtn = document.getElementById('prevBtn5');
	const nextBtn = document.getElementById('nextBtn5');
	const carouselLoop = document.getElementById('projectCarousel');
	const carouselWrapperLoop = document.querySelector('.project-carousel-wrapper');
	let currentIndex = 0;
	
	const viewportWidth = window.innerWidth || document.documentElement.clientWidth;
	if (viewportWidth > 1600) {
		var gapitemWidth = 15;
		var itemWidth = (viewportWidth-(15*5))/6; // larghezza + gap
	}else if (viewportWidth > 1400 && viewportWidth <= 1600) {
		var gapitemWidth = 15;
		var itemWidth = (viewportWidth-(15*4))/5;
	}else if (viewportWidth > 1024 && viewportWidth <= 1400) {
		var gapitemWidth = 15;
		var itemWidth = (viewportWidth-(15*3))/4;
	}else if (viewportWidth > 900 && viewportWidth <= 1024) {
		var gapitemWidth = 15;
		var itemWidth = (viewportWidth-(15*3))/4;
	}else if (viewportWidth > 750 && viewportWidth <= 900) {
		var gapitemWidth = 15;
		var itemWidth = (viewportWidth-(15*2))/3;
	}else if (viewportWidth <= 500) {
		var gapitemWidth = 15;
		var itemWidth = (viewportWidth-(15*1))/2;
	}
	
	const images = document.querySelectorAll('.project-item img');
	images.forEach(img => {
	  img.style.width = itemWidth + "px";
	});

	let items = Array.from(carouselLoop.querySelectorAll('.project-item'));
	const isMobile = window.innerWidth < 1024;

	// 🔒 Se mobile, limita all'originale
	if (isMobile) {
	  items = items.slice(0, items.length);
	}

	// 🔁 Duplica solo su desktop
	function cloneItemsAtEnd() {
	  if (isMobile) return;

	  const clones = items.map(item => {
		const clone = item.cloneNode(true);
		carouselLoop.appendChild(clone);
		return clone;
	  });
	  items.push(...clones);
	}

	function cloneItemsAtStart() {
	  if (isMobile) return;

	  const clones = items.slice().reverse().map(item => {
		const clone = item.cloneNode(true);
		carouselLoop.insertBefore(clone, carouselLoop.firstChild);
		return clone;
	  });
	  items.unshift(...clones);
	  carouselWrapperLoop.scrollLeft += clones.length * itemWidth;
	  currentIndex += clones.length;
	}

	// 👉 Funzione centralizzata per lo scroll
	function scrollToIndex(index) {
	  const targetScroll = index * (itemWidth + gapitemWidth);
	  smoothScrollTo(carouselWrapperLoop, targetScroll, 400);
	}

	// ▶️ Next
	nextBtn.addEventListener('click', () => {
	  if (isMobile) {
		if (currentIndex < items.length - 1) {
		  currentIndex++;
		  scrollToIndex(currentIndex);
		}
	  } else {
		currentIndex++;
		if (currentIndex >= items.length - 3) {
		  cloneItemsAtEnd();
		}
		scrollToIndex(currentIndex);
	  }
	});

	// ◀️ Prev
	prevBtn.addEventListener('click', () => {
	  if (isMobile) {
		if (currentIndex > 0) {
		  currentIndex--;
		  scrollToIndex(currentIndex);
		}
	  } else {
		if (currentIndex <= 1) {
		  cloneItemsAtStart();
		}
		currentIndex--;
		scrollToIndex(currentIndex);
	  }
	});




  const scrollSpeed = 1;
  let animationFrameId;
  let hasAnimated = false;

  const originalItems = Array.from(carousel.children);

  // STEP 1: animazione in ingresso dei project-item uno alla volta
  function animateEntry(index = 0) {
	  if (index >= originalItems.length) {
		if (!isMobile) {
		  originalItems.forEach(item => carousel.appendChild(item.cloneNode(true)));
		}
		return;
	  }
	  originalItems[index].classList.add('entered');
	  setTimeout(() => animateEntry(index + 1), 250);
	}


  // Swipe touch
  let startX;
  carouselWrapper.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
    //cancelAnimationFrame(animationFrameId);
  });

  // STEP 4: osservo la slide 5 per far partire l'animazione solo quando è visibile
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !hasAnimated) {
        hasAnimated = true; // Evita ripetizioni
        animateEntry();
      }
    });
  }, { threshold: 0.3 }); // parte quando almeno il 30% della slide è visibile

  observer.observe(slide5);
});
</script>