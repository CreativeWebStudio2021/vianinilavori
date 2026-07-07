<style>
	#slide4 {
	  width:100vw;
	  height:100%;
	  position:relative;
	  z-index: 7;
	  top:100vh;
	  transition: all 1s ease;
	}

	.mappaPos{
		margin-top:50px;
		opacity:0;
		transition: all 2s ease;
	}
	.mappaTop{
		margin-top:0;
		opacity:1;
		//filter: blur(1.5px);
	}
	
	#svgRing {
	  overflow: visible;
	  transition: all 2s ease;
	}

	#ring.expand {
	  animation: growRing 5s ease forwards;
	}

	@keyframes growRing {
	  from {
		r: 40;
	  }
	  to {
		r: 2000;
	  }
	}
	
	#nextBtnMap {
	  width: 68px;
	  height: 68px;
	  margin: 0 auto;
	  margin-top: 20px;
	  border-radius: 35px;
	  border: solid 1px #000;
	  background: none;
	  transform:translateY(-100px);
	  transition: all 0.3s ease;
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  //transform: translateY(-100px);
	}

	.circleArrowMap {
	  width: 30px;
	  height: 30px;
	  border-right: 2px solid #000;
	  border-bottom: 2px solid #000;
	  transform: rotate(-45deg);
	  margin-left:-12px;
	  transition: border-color 0.3s ease;
	}

	#nextBtnMap:hover {
	  background: #E30613;
	  border-color: #fff;
	}

	#nextBtnMap:hover .circleArrowMap {
	  border-right-color: #fff;
	  border-bottom-color: #fff;
	}
	
	.text-with-border {
	  text-shadow:
		-1px -1px 0 white,
		 1px -1px 0 white,
		-1px  1px 0 white,
		 1px  1px 0 white;
	}
	
	#introMaskSvg {
	  position: fixed;
	  top: 0;
	  left: 0;
	  width: 100vw;
	  height: 100vh;
	  z-index: 3;
	  pointer-events: none;
	  visibility: visible;
	}
	
	.titleContainerSlide4{
		position:absolute; width:100%; text-align:center; top:220px; left:0;
	}
	
	.titleSlide4{font-size:78px; font-weight:bold; color:#E30613}
	.title2Slide4{font-size:60px; font-weight:bold; color:#E30613}
	.testi2ConatainerSlide4{position:absolute; width:100%; text-align:center; bottom:-30px; left:0;}
	.textSlide4{font-size:26px; color:#000}
	.text2Slide4{font-size:20px; color:#000}
	.textContainerSlide4{position:absolute; width:100%; text-align:center; top:55%; left:0;} 
	
	.gapTextSlide4{display:none}
	
	#redRing {
	  opacity: 0;
	  transition: opacity 0.3s ease;
	}
	.mappaPos{
		width: 100%; height: 100%; object-fit: cover; object-position: center;
	}

	@media screen AND (max-width:900px){
		.titleSlide4{font-size:60px;}
		.title2Slide4{font-size:50px;}
		.textSlide4{font-size:22px;}
		.text2Slide4{font-size:18px;}
		.mappaPos{object-position: 57% center;}
	}
	@media screen AND (max-width:650px){
		.titleContainerSlide4{top:230px;}
		.testi2ConatainerSlide4{bottom:0px;}
		.titleSlide4{font-size:45px;}
		.title2Slide4{font-size:35px;}
		.textSlide4{font-size:21px;}
		.text2Slide4{font-size:17px;}
		.textContainerSlide4{top:50%;}
	}
	@media screen AND (max-width:370px){
		.gapTextSlide4{display:inline}
		.gap2TextSlide4{display:none}
	}
</style>
<section class="slide" id="slide4" style="overflow:hidden; position:relative; width:100%; height:100vh;">
	<img src="{{ asset('web/images/mappa_estesa2.jpg') }}" alt="Mappa" id="mappaHome" class="mappaPos" />

	
	<div  class="titleContainerSlide4">
		<div   class="titleSlide4 anim-step text-with-border"  data-anim="slide-down" data-delay="500" data-duration="1000">
			MAPPA INTERATTIVA
		</div>
	</div>
	
	<div class="textContainerSlide4">
		<div  class="textSlide4 anim-step text-with-border"  data-anim="slide-down" data-delay="500" data-duration="1000">
			L’Italia si muove e cresce <span class="gapTextSlide4"><br/></span><b>ogni giorno,<span class="gap2TextSlide4"><br/></span>
			da oltre cent’anni</b> siamo al suo fianco.
		</div>
	</div>
	<div style="" class="testi2ConatainerSlide4">
		<div class="title2Slide4 anim-step text-with-border"  data-anim="slide-down" data-delay="500" data-duration="1000">
			LAVORI IN CORSO
		</div>
		<div  class="text2Slide4 anim-step text-with-border"  data-anim="slide-down" data-delay="500" data-duration="1000">
			Entra e scopri tutti i dettagli sui nostri progetti.
		</div>
		<a href="mappa-interattiva.html">
			<div id="nextBtnMap" class="anim-step" data-delay="1000" data-duration="1000">
			  <div class="circleArrowMap"></div>
			</div>
		</a>

	</div>
	
	
	<svg id="introMaskSvg"
	  xmlns="http://www.w3.org/2000/svg"
	  style="position: fixed; top: 0; left: 0; z-index: 9999; pointer-events: none; visibility: visible;"
	  preserveAspectRatio="xMidYMid slice"
	>
	  <defs>
		<mask id="holeMask">
		  <rect id="maskRect" fill="white" />
		  <circle id="hole" fill="black" />
		</mask>
	  </defs>

	  <rect id="whiteOverlay" fill="white" mask="url(#holeMask)" />
	  
	  <circle id="redRing" cx="100" cy="100" r="10" fill="none" stroke="#E30613" stroke-width="4" />
	</svg>


</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const mappaHome = document.getElementById('mappaHome');
  const svgOverlay = document.getElementById('introMaskSvg');
  const maskRect = document.getElementById('maskRect');
  const hole = document.getElementById('hole');
  const redRing = document.getElementById('redRing');
  const whiteOverlay = document.getElementById('whiteOverlay');

  // Imposta dinamicamente il viewBox e centra i cerchi
  const updateDimensions  = () => {
    const width = window.innerWidth;
    const height = window.innerHeight;

    svgOverlay.setAttribute('viewBox', `0 0 ${width} ${height}`);
    svgOverlay.setAttribute('width', `${width}`);
    svgOverlay.setAttribute('height', `${height}`);
	
	maskRect.setAttribute('width', width);
    maskRect.setAttribute('height', height);

    whiteOverlay.setAttribute('width', width);
    whiteOverlay.setAttribute('height', height);

    const cx = width / 2;
    const cy = height / 2;

    hole.setAttribute('cx', cx);
    hole.setAttribute('cy', cy);
    hole.setAttribute('r', 3);
	
    redRing.setAttribute('cx', width / 2);
    redRing.setAttribute('cy', height / 2);
  };

  updateDimensions();
  window.addEventListener('resize', updateDimensions);

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        mappaHome.classList.add('mappaTop');

       if (svgOverlay && hole && redRing) {
          svgOverlay.style.visibility = 'visible';

          const maxRadius = Math.sqrt(window.innerWidth ** 2 + window.innerHeight ** 2);

          hole.animate([{ r: 2 }, { r: maxRadius }], {
            duration: 2000,
            fill: 'forwards'
          });

          redRing.animate([
            { r: 100, strokeWidth: 20, opacity: 0 },
            { r: ( maxRadius + 15 ), strokeWidth: 100, opacity: 1 }
          ], {
            duration: 2000,
            fill: 'forwards'
          });

          setTimeout(() => {
            svgOverlay.remove();
          }, 2200);
        }

        observer.unobserve(entry.target);
      } else {
        mappaHome.classList.remove('mappaTop');
      }
    });
  }, {
    threshold: 0.6
  });

  observer.observe(document.getElementById('slide4'));
});

</script>