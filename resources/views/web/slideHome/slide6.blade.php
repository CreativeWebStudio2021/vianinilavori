<style>
	#slide6 {
	  height: 100vh;
	  position: relative;
	  z-index: 5;
	  transition: all 1s ease;
	  background: #fff;
	  overflow: hidden;
	  top:100vh;
	}

	#slide6-image {
	  position: absolute;
	  width: 50%;
	  height: 50%;
	  object-fit:cover;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%) scale(1);
	  transition: transform 1.5s ease-in-out, width 1.5s ease-in-out;
	  z-index: 1;
	}

	#slide6-image.fullscreen {
	  transform: translate(-50%, -50%) scale(2);
	}
	
	.slide6Txt1{
		position:absolute;
		width:100%;
		top: 50%;
		left: 50%;
		font-size:40px; color:#fff;
		transform: translate(-50%, -50%);
		z-index: 3;
	}
	
	.slide6Txt2{
		position:absolute;
		top: 50%;
		left: 50%;
		font-size:98px; color:#fff;
		transform: translate(-50%, 50%);
		z-index: 3;
		opacity:0;
		margin-top:30px;
		transition: transform 1.5s ease-in-out, opacity 1.5s ease-in-out;;
	}
	.slide6Txt1.dopo{
		transform: translate(-50%, -150%);
		transition: transform 1.5s ease-in-out;
	}
	.slide6Txt2.dopo{
		transform: translate(-50%, -10%);
		opacity:1;
	}
	
	.project-arrow-container-6{		
		width:70px; 
		height:70px; 
		border-radius:35px; 
		border:solid 1px #fff; 
		margin:0 auto;
		margin-top:15px;	
		cursor:pointer;
		transition: all 0.5s ease;		
	}
	
	.project-arrow-6 {
	  width: 30px;
	  height: 30px;
	  border-right: 2px solid #fff;
	  border-bottom: 2px solid #fff;
	  transform: rotate(-45deg);
	  margin-left:12px;
	  margin-top:18px;
	}
	
	.project-arrow-container-6:hover{		
		background:#E30613;
		border:solid 1px #E30613;
	}
	
	@media screen AND (max-width:800px){
		.slide6Txt1{
			top: 50%;
		}
		
		.slide6Txt2{
			top: 60%;
			font-size:70px;
		}
	}
	
	@media screen AND (max-width:550px){
		.slide6Txt1{
			top: 50%;
			font-size:25px; 
		}
		
		.slide6Txt2{
			top: 60%;
			font-size:50px;
		}
	}
	
	@media screen AND (max-width:400px){
		.slide6Txt1{
			top: 50%;
			font-size:20px; 
		}
		
		.slide6Txt2{
			top: 60%;
			font-size:40px;
		}
	}
</style>
<section class="slide" id="slide6">
	<img id="slide6-image" src="{{ asset('web/images/sostenibilita_home.jpg') }}" alt="Sostenibilità" />
	<div class="slide6Txt1" id="slide6Txt1">
		Per la <b>tutela delle risorse</b> naturali<br/>
		e la <b>riduzione dell’impatto ambientale</b>
	</div>
	<div class="slide6Txt2" id="slide6Txt2">
		<b>SOSTENIBILITÀ</b>
		<a href="strategia-di-sostenibilita.html">
		<div class="project-arrow-container-6">
			<div class="project-arrow-6"></div>
		 </div>
		 </a>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const slide6 = document.getElementById('slide6');
  const image = document.getElementById('slide6-image');
  const slide6Txt1 = document.getElementById('slide6Txt1');
  const slide6Txt2 = document.getElementById('slide6Txt2');
  let hasAnimated = false;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !hasAnimated) {
        hasAnimated = true;

        setTimeout(() => {
          image.classList.add('fullscreen');
          slide6Txt1.classList.add('dopo');
          slide6Txt2.classList.add('dopo');
        }, 0); // Delay dopo che la slide è visibile
      }
    });
  }, { threshold: 0.5 }); // attiva quando metà della slide è visibile

  observer.observe(slide6);
});
</script>
