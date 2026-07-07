
@if(!isset($img_background))
	@php 
		$img_background="web/images/header_all.jpg"; 
	@endphp
@endif
@if(!isset($img_position))
	@php 
		$img_position="top center"; 
	@endphp
@endif

<style>
	.page-header.page-header-modern.page-header-background.page-header-background-md{padding:50px 0 100px 0;}
	
	.page-header-title {
	  opacity: 0;
	  transform: translateX(-10px);
	  transition: opacity 1.2s ease-out, transform 1.2s ease-out;
	  font-size:50px; 
	  font-weight:bold; 
	  font-family:Arial; 
	  color:#fff
	}

	.page-header-title.visible {
	  opacity: 1;
	  transform: translateX(0);
	}
	
	.page-header-section {
	  width:100%; 
	  height:300px; 
	  margin-bottom:60px; 
	  <?php if($img_background=="color"){?>
		  background:#E30613;
	  <?php }else{?>
		  background-image: url({{ $img_background }}); 
		  background-repeat: no-repeat; 
		  background-size: cover; 
		  background-position: {{ $img_position }}; 
		  filter: brightness(1.4) saturate(1.4); /* più accesa all'inizio */
		  transition: filter 2.5s ease;
	  <?php }?>
	  position:relative;	
	}

	.page-header-section.dimmed {
	  filter: brightness(1) saturate(1); /* tono finale */
	}
	
	#pageTitle{
		position:absolute; 
		width:calc(100% - 400px); 
		top:50%; 
		left:50%; 
		transform: translate(-50%, -50%);
	}
	
	@media screen and (max-width: 1600px) {
		#pageTitle{
			width:calc(100% - 200px); 
		}
	}
	
	@media screen AND (max-width:1468px){
		#pageTitle {
			width:calc(100% - 100px); 
		}
	}
	
	@media screen AND (max-width:1100px){
		.page-header-title{
			font-size:6vw; 
		}
	}
	
	@media screen AND (max-width:700px){
		.page-header-section {
		  height:200px; 
		}
	}
	
	@media screen AND (max-width:500px){
		.page-header-title{
			font-size:8vw; 
		}
	}
</style>
<div style="width:100%; height:105px;"></div>
<section class="page-header-section">
	@php
		$titolo_pagina = $page_title;
		if($titolo_pagina == "ciclo idrico integrato") $titolo_pagina = "ciclo idrico<br/>integrato";
		if($titolo_pagina == "edilizia civile industriale e sportiva") $titolo_pagina = "edilizia civile,<br/>industriale e sportiva";
		if($titolo_pagina == "opere marittime") $titolo_pagina = "opere<br/>marittime";
	@endphp
	<div id="pageTitle" >
	  <div class="page-header-title">
		{!! strtoupper($titolo_pagina) !!}
	  </div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const title = document.querySelector('.page-header-title');
  const section = document.querySelector('.page-header-section');

  // Delay per transizione soft
  setTimeout(() => {
    title.classList.add('visible');
    section.classList.add('dimmed');
  }, 300); // puoi modificare il delay
});
</script>
