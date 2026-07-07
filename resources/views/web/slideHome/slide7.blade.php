<style>
  #slide7 {
	display: block; /* Assicura no-flex centering */
    align-items: flex-start !important;
    position: relative;
    z-index: 4;
    transition: all 1s ease;
	overflow-y:auto;
	height:100vh;
	overflow-x:hidden;
	//top:100vh;
  }
  
  .link-block-7 {
	  flex: 1;
	  font-size:16px;
	  display: flex;
	  align-items: center;
	  justify-content: space-between;
	  color: #000;
	  text-decoration: none;
	  transition: font-weight 0.3s;
	  position: relative;
	}

	.link-block-7 span {
	  transition: font-weight 0.3s;
	}

	.link-block-7 .freccia-7 {
	  width: 12px;
	  height: 12px;
	  position: relative;
	  transition: transform 0.4s ease;
	}

	.link-block-7 .freccia-7::after {
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

	.link-block-7:hover span {
	  font-weight: bold;
	  background:#d9d9d9;
	}

	.link-block-7:hover .freccia-7::after {
	  transform: translate(8px, -50%) rotate(-45deg);
	}
	
	.newsContainerSlide7{width:100%; display:flex;  margin-top:20px;}
	
	.slide1{align-items: normal !important;}
	
	.newsLineSlide7{padding:5px; display:flex; justify-content:space-between;}
	
	@media screen AND (max-width:1024px){
		.newsContainerSlide7{flex-direction:column; gap:40px;}
	}
	#scrollable-slide7-content{
		overflow-y: auto;
		height:100%;
	}
	.scopriSlide7mob{display:none}
	@media screen AND (max-width:550px){
		.newsLineSlide7{flex-direction:column; gap:20px;};
		.link-block-7 .link-block-7{font-weight:700 !important}
		.scopriSlide7mob{display:block}
		.scopriSlide7{display:none}
	}
	
	#slide7 .mainTextContainer {
	  opacity: 0;
	  transform: translateY(20px);
	  transition: all 0.8s ease;
	}

	#slide7.slide7-ready .mainTextContainer {
	  opacity: 1;
	  transform: translateY(0);
	}
</style>
<section class="slide" id="slide7">
	<div class=" slide7Container" id="scrollable-slide7-content">
		<div class="mainTextContainer" id="mainSlide7" style="padding-top:130px;">
			<div id="titoloNews" style="font-size:44px; font-weight:bold; color:#E30613; text-align:left;">
				<span id="innerHeight" ></span>News & Media
			</div>	
			<div style="font-size:20px; color:#000; text-align:left;">
				News, comunicati stampa e iniziative.
			</div>	
			<div class="newsContainerSlide7">
				<div style="flex:1; padding:0 10px 0 0; ">
					<div style="width:100%; font-size:30px; border-bottom:solid 1px #000; padding-bottom:5px; margin-bottom:20px;color:#000; background:#f0f0f0; text-align:left;">
						<div style="padding:10px; text-align:left;">
							News
						</div>
					</div>
				  
					@php
					$query_news = DB::table('news')
						->select('*')
						->where('visibile', '=', '1')
						->orderBy('data_news', 'DESC')
						->limit(4)
						->get();
					@endphp
					@foreach($query_news AS $key_news=>$value_news)
						<div style="width:100%; background:#F5F5F5; margin-bottom:10px; color:#000;">
						  <div class="newsLineSlide7">
							
							<div style="flex:1; display:flex; align-items:center;">
							  <div style="font-size:20px; padding-right:50px; text-align:left;">
								{{ $value_news->titolo }}
							  </div>
							</div>
							
							<div style="width:150px; display:flex; align-items:center; justify-content:flex-end; padding-right:10px;">
							  <a href="news.html" title="{{ $value_news->titolo }} - News - News & Media - {{ config('app.name') }}" class="link-block-7" style="display:inline-flex; align-items:center;">
								<span class="scopriSlide7">Scopri di più</span>
								<span class="scopriSlide7mob" style="font-weight:700">Scopri di più</span>
								<div class="freccia-7"></div>
							  </a>
							</div>
							
						  </div>
						</div>
					@endforeach
					
					<div style="text-align:left;">
						<a href="news.html" title="News - News & Media - {{ config('app.name') }}" class="link-block-7" style="display:inline-flex; align-items:center; justify-content: start;">
							<span>Tutte le news</span>
							<div class="freccia-7"></div>
						</a>
					</div>
				</div>
				<div style="width:1px; background:#000;"></div>
				<div style="flex:1; margin:0 0 20px 10px; background:#fff;">
					<div style="width:100%; font-size:30px; border-bottom:solid 1px #000; padding-bottom:5px; background:#f0f0f0; color:#000">
					  <div style="padding:10px; text-align:left;">
						Seguici su LinkedIn
					  </div>
					</div>	
					<div style="width:100%; margin-top:20px margin-bottom:20px;">
						<!-- Elfsight LinkedIn Feed | Untitled LinkedIn Feed -->
						<script src="{{ asset('https://static.elfsight.com/platform/platform.js') }}" async></script>
						<div class="elfsight-app-bed5741a-683c-401f-bd36-ee106dd16cc9" data-elfsight-app-lazy></div>
					</div>
				</div>
			</div>
		</div>
		@include('web.common.footer')
	</div>	
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const slide7 = document.getElementById('slide7');
  const header = document.getElementById('header-wrapper');
  const titoloNews = document.getElementById('titoloNews');
  const mainContent = document.getElementById('mainSlide7');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          const headerRect = header.getBoundingClientRect();
          const titoloRect = titoloNews.getBoundingClientRect();
          const distanza = titoloRect.top - headerRect.bottom;

          console.log("Distanza rilevata:", distanza + "px");

          if (distanza < 0) {
            // Sposta giù il contenuto
            const offset = Math.abs(distanza) + 60 + 130; // +60 per slide effetto
            mainContent.style.paddingTop = `${offset}px`;
			console.log("offset:", offset + "px");
          }

          // Aggiungi classe per far partire animazione
          slide7.classList.add('slide7-ready');
        }, 1000); // attende fine transizione
      }
    });
  }, {
    threshold: 0.5 // visibilità parziale sufficiente
  });

  observer.observe(slide7);
});
</script>


