<style>
	#slide5 {
	  height:100vh;
	  position:relative;
	  z-index: 2;
	  transition: all 1s ease;
	  background:url(images/v_grigia_sfondo.png) no-repeat;
	  background-size:contain;
	  background-position:top left;
	 
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
	  width: auto;
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
	  transition: transform 1.5s cubic-bezier(0.15, 0.85, 0.3, 1);
	}

	.project-item.entered {
	  transform: translateX(0);
	}

</style>
<section class="slide" id="slide5">
	<div style="position:absolute; width:calc(100% - 100px); top:150px; left:50px; height:80px; text-align:left;">
		<div style="font-size:44px; font-weight:bold; color:#E30613">
			Progetti
		</div>	
		<div style="font-size:20px; color:#000">
			Scopri i nostri principali cantieri in Italia.
		</div>	
	</div>
	<div style="position:absolute; width:100%; height:600px; top:280px; left:0;" id="projectList">
		<div class="project-carousel-wrapper">
			<div class="project-carousel" id="projectCarousel">
			  <!-- Esempio di 7 immagini -->
			  <div class="project-item">
				<img src="images/Progetto_Ferrovie.png" alt="FERROVIE" />
				<div class="project-overlay">
				  <div class="project-title">FERROVIE</div>
				  <div class="project-arrow-container">
					<div class="project-arrow"></div>
				  </div>
				</div>
			  </div>
			  
			  <div class="project-item">
				<img src="images/Progetto_Metropolitane.png" alt="METROPOLITANE" />
				<div class="project-overlay">
				  <div class="project-title">METROPOLITANE</div>
				  <div class="project-arrow-container">
					<div class="project-arrow"></div>
				  </div>
				</div>
			  </div>
			  
			  <div class="project-item">
				<img src="images/Progetto_Strade.png" alt="STRADE" />
				<div class="project-overlay">
				  <div class="project-title">STRADE</div>
				  <div class="project-arrow-container">
					<div class="project-arrow"></div>
					</div>					
				</div>
			  </div>
			  
			  <div class="project-item">
				<img src="images/Progetto_Ferrovie.png" alt="OPERE MARITTIME" />
				<div class="project-overlay">
				  <div class="project-title">OPERE MARITTIME</div>
				  <div class="project-arrow-container">
					<div class="project-arrow"></div>
				   </div>
				</div>
			  </div>
			  
			  <div class="project-item">
				<img src="images/Progetto_Metropolitane.png" alt="CICLO IDRICO INTEGRATO" />
				<div class="project-overlay">
				  <div class="project-title">CICLO IDRICO<br/>INTEGRATO</div>
				  <div class="project-arrow-container">
					<div class="project-arrow"></div>
				   </div>
				</div>
			  </div>
			  
			  <div class="project-item">
				<img src="images/Progetto_Strade.png" alt="EDILIZIA CIVILE E INDUSTRIALE" />
				<div class="project-overlay">
				  <div class="project-title">EDILIZIA CIVILE<br/>E INDUSTRIALE</div>
				  <div class="project-arrow-container">
					<div class="project-arrow"></div>
				   </div>
				</div>
			  </div>
			</div>
			<?/*<div class="carousel-controls">
			  <button id="prevBtn">&#10094;</button>
			  <button id="nextBtn">&#10095;</button>
			</div>*/?>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.getElementById('projectCarousel');
  const carouselWrapper = document.querySelector('.project-carousel-wrapper');
  const slide5 = document.getElementById('slide5');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const scrollSpeed = 1;
  let animationFrameId;
  let hasAnimated = false;

  const originalItems = Array.from(carousel.children);

  // STEP 1: animazione in ingresso dei project-item uno alla volta
  function animateEntry(index = 0) {
    if (index >= originalItems.length) {
      // Dopo l'ultima animazione, duplichiamo gli item per il loop
      originalItems.forEach(item => {
        carousel.appendChild(item.cloneNode(true));
      }, 2800);
      startScroll(); // Avvia lo scroll infinito
      return;
    }

    originalItems[index].classList.add('entered');

    setTimeout(() => {
      animateEntry(index + 1);
    }, 100); // intervallo tra un item e l'altro
  }

  // STEP 2: scroll infinito fluido
  function startScroll() {
    function scroll() {
      carouselWrapper.scrollLeft += scrollSpeed;

      if (carouselWrapper.scrollLeft >= carousel.scrollWidth / 2) {
        carouselWrapper.scrollLeft = 0;
      }

      animationFrameId = requestAnimationFrame(scroll);
    }
    scroll();
  }

  // STEP 3: interazioni utente
  carouselWrapper.addEventListener('mouseenter', () => cancelAnimationFrame(animationFrameId));
  carouselWrapper.addEventListener('mouseleave', () => startScroll());

  prevBtn.addEventListener('click', () => {
    carouselWrapper.scrollLeft -= 300;
  });

  nextBtn.addEventListener('click', () => {
    carouselWrapper.scrollLeft += 300;
  });

  // Swipe touch
  let startX;
  carouselWrapper.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
    cancelAnimationFrame(animationFrameId);
  });

  carouselWrapper.addEventListener('touchend', (e) => {
    const endX = e.changedTouches[0].clientX;
    if (startX - endX > 50) {
      carouselWrapper.scrollLeft += 300;
    } else if (endX - startX > 50) {
      carouselWrapper.scrollLeft -= 300;
    }
    startScroll();
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



