<style>
	#slidell3 {
	  width: 100%; height: auto;
	  z-index: 8;
	  transition: all 1s ease;
	  top:100%;
	}
	.v-rossa {
	  position: absolute;
	  width: 100%;
	  top: 0;
	  left:0;
	  opacity:0;
	  mix-blend-mode: multiply;
	  transition: opacity 4.5s ease-in-out;
	}
	.v-rossa-2 {
	  position: absolute;
	  width: 100%;
	  top: 0;
	  left:0;
	  opacity:0;
	  height:100%;
	  object-fit:cover;
	 object-position:40% center;
	  mix-blend-mode: multiply;
	  transition: opacity 4.5s ease-in-out;
	}

	.v-rossa.active { opacity: 1;}
	.v-rossa-2.active { opacity: 1;}
	
	.imgSlide3Mob{display:none;}

	@media screen AND (max-width:900px){
		.imgSlide3{display:none;}
		.imgSlide3Mob{display:block;}
	}
	
	.imgSlide3, .imgSlide3Mob {
	  opacity: 0;
	  transition: opacity 1s ease-in-out;
	}

	.imgSlide3.visible, .imgSlide3Mob.visible {
	  opacity: 1;
	}
</style>
<section class="slide" id="slidell3" style="z-index:2;">
	<img class="imgSlide3" src="{{ asset('web/images/operai.jpg') }}" alt="Chi siamo" style="width: 100%; height: auto; position:relative">
		<img src="{{ asset('web/images/v_rossa_operai.png') }}" class="v-rossa"/>
	</img>
	<img class="imgSlide3Mob" src="{{ asset('web/images/operai_mob.jpg') }}" alt="Chi siamo" style="width: 100%; height: auto; position:relative">
		<img src="{{ asset('web/images/v_rossa_operai.png') }}" class="v-rossa-2"/>
	</img>
	<div id="end-of-slide3"></div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', () => {
	  const redOverlay = document.querySelector('.v-rossa');
	  const redOverlay2 = document.querySelector('.v-rossa-2');
	  const targetSlide = document.getElementById('slidell3');

	  const observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
		  if (entry.isIntersecting) {
			redOverlay.classList.add('active');
			redOverlay2.classList.add('active');
		  }
		});
	  }, {
		threshold: 0.3
	  });

	  if (targetSlide) {
		observer.observe(targetSlide);
	  }
	});
	
	document.addEventListener('DOMContentLoaded', () => {
	  const imgSlide3 = document.querySelector('.imgSlide3');
	  const imgSlide3Mob = document.querySelector('.imgSlide3Mob');

	  setTimeout(() => {
		imgSlide3.classList.add('visible');
		imgSlide3Mob.classList.add('visible');
	  }, 1000); // 1 secondo dopo il load della pagina
	});
</script>