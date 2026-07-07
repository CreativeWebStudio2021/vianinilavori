<style>
	/* Header */
	.header-wrapper {
	  width: 100%;
	  height: 106px;
	  transition: background-color 0.5s ease;
	  position: relative;
	  z-index: 999;
	}

	/* Quando hover */
	.header-wrapper.hovered {
	  background: white;
	}

	/* Quando pannello è aperto */
	.header-wrapper.panel-open {
	  background: white;
	}

	/* Logo */
	.header-logo {
	  width: 100%;
	  transition: all 0.5s ease;
	}

	/* -- MENU CONTAINER -- */
	.header-menu-container {
	  display: flex;
	}

	/* -- COLONNA SINISTRA LOGO -- */
	.header-menu-fixed-column {
	  width: 120px;
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  @if(!empty($natale))
		padding-left:10px !important;
      @endif
	}

	/* -- COLONNA DESTRA VOCI DI MENU -- */
	.header-menu-flexible-column {
	  flex-grow: 1;
	  display: flex;
	  flex-direction: column;
	  justify-content: center;
	}
	
	.header-menu-mob {
	  flex-grow: 1;
	  display: flex;
	  flex-direction: column;
	  justify-content: center;
	  text-align:right;
	  display:none;
	   @if(!empty($natale))
		padding-right:10px !important;
	  @endif
	}
	
	/* -- RIGHE DEL MENU -- */
	.header-menu-top-row,
	.header-menu-bottom-row {
	  display: flex;
	  justify-content: flex-end;
	}

	.header-menu-top-row {
	  margin-bottom: 10px;
	}

	/* -- ITEM DEL MENU -- */
	.header-menu-item {
	  margin-left: 30px;
	  cursor: pointer;
	}
	.header-menu-item-top {
	  margin-left: 15px !important;
	}

	/* Menu items */
	/* Stile generale voci menu header */
	.header-menu-item a {
	  position: relative;
	  font-size: 13px;
	  font-family: Arial, sans-serif;
	  color: white;
	  font-weight: bold;
	  text-decoration: none;
	  transition: color 0.5s ease;
	}

	/* Aggiungiamo l'effetto underline */
	.header-menu-item a::after {
	  content: '';
	  position: absolute;
	  bottom: -2px;
	  left: 0;
	  width: 0;
	  height: 1px;
	  background-color: #E73338;
	  transition: width 0.3s ease;
	}

	/* Hover effetto solo sulle voci di testo */
	.header-menu-item a:hover::after {
	  width: 100%;
	}

	/* Escludi youtube,instagram e linkedin (solo immagini) */
	.header-menu-item-top img + a::after {
	  content: none;
	}


	/* Testo nero se hover o pannello aperto */
	.header-wrapper.hovered .header-menu-item a,
	.header-wrapper.panel-open .header-menu-item a,
	.header-wrapper.header-wrapper-transparent .header-menu-item a {
	  color: black;
	}

	/* Icona LinkedIn e search */
	.header-wrapper.hovered .fa-search,
	.header-wrapper.panel-open .fa-search {
	  color: black;
	}

	.linkedin-circle {
	  display: inline-flex;
	  justify-content: center;
	  align-items: center;
	  width: 18px;
	  height: 18px;
	  border-radius: 50%;
	  background-color: white; /* Sfondo bianco di default */
	  font-size: 12px;
	  color: white;
	  -webkit-background-clip: text;
	  -webkit-text-fill-color: transparent;
	  border: 1px solid white;
	  transition: all 0.5s ease;
	}

	/* Quando hover o pannello aperto */
	.header-wrapper.hovered .linkedin-circle,
	.header-wrapper.panel-open .linkedin-circle {
	  background-color: black; /* Sfondo nero */
	  border-color: black; /* Bordo nero */
	}
	
	
	.header-wrapper.dark {
	  background-color: transparent;
	  color:#000;
	}

	.header-wrapper.dark.hovered {
	  background-color: white;
	}
	
	.header-wrapper.header-wrapper-transparent {
	  background-color: rgba(255,255,255,1);
	  color:#000;
	}
	
	.header-wrapper.header-wrapper-transparent.text-dark .header-menu-item a,
	.header-wrapper.header-wrapper-transparent.text-dark .fa-search,
	.header-wrapper.header-wrapper-transparent.text-dark .linkedin-circle {
	  color: black;
	  border-color: black;
	}

	.header-wrapper.header-wrapper-transparent.text-dark .linkedin-circle {
	  background-color: black;
	}

	.header-wrapper.header-wrapper-transparent.hovered {
	  background-color: white !important;
	}

	/* Pannello */
	#panel {
	  display: none;
	  position: absolute;
	  top: 106px;
	  left: 0;
	  width: 100%;
	   max-height: calc(100vh - 106px);
	   overflow-y: auto;
	   -webkit-overflow-scrolling: touch;
	  background: white;
	  padding: 60px 230px 40px 200px;
	  z-index: 990;
	  box-sizing: border-box;
	  transition: height 0.6s ease, opacity 0.6s ease;
	  opacity: 0;
	  scrollbar-width: none;
	}
	
	#panel::-webkit-scrollbar {
	  display: none;               /* Chrome, Safari */
	}

	.panel-columns {
	  display: flex;
	  opacity: 0;
	  transform: translateY(-20px);
	  transition: all 0.5s ease;
	  position:relative;
	}

	/* Colonne */
	.panel-ajax {
	  flex: 0 0 100%;
	}



	/* Bottone chiusura (X) */
	.close-panel {
	  position: absolute;
	  top: -55px;
	  right: -30px;
	  cursor: pointer;
	  width:22px;
	  height:22px;
	  z-index:2001;
	}
	
	#overlay {
	  position: fixed;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  background: rgba(255, 255, 255, 0.1); /* Quasi trasparente */
	  backdrop-filter: blur(12px); /* 🎯 Questo crea la sfocatura */
	  -webkit-backdrop-filter: blur(8px); /* Safari support */
	  opacity: 0;
	  visibility: hidden;
	  transition: all 0.5s ease;
	  z-index: 900; /* sotto al pannello */
	}

	/* Riga rossa fissa quando attivo */
	.header-menu-item a.active::after {
	  width: 100% !important;
	}
	
	.header-padding{
		padding:20px 200px
	}
	
	@media screen and (max-width: 1600px) {
	  #panel {
		padding: 60px 130px 40px 100px;
	  }
	  .header-padding{
			padding:20px 100px
		}
	}

	
	@media screen AND (max-width:1468px){
		.header-padding{
			padding:20px 50px
		}
		#panel {
		padding: 60px 80px 40px 50px;
	  }
	}
	
	@media screen AND (max-width:1169px){
		.header-menu-item a {
			font-size:12px;
		}
		.header-menu-item {
		  margin-left: 15px;
		  cursor: pointer;
		}
	}
	
	@media screen AND (max-width:1023px){
		.header-padding{
			padding:20px 40px;
		}
		.header-menu-flexible-column{
			display:none;
		}
		.header-menu-mob {
		  display:block;
		}
		.header-menu-mob i{
			font-size:2.5em;
			margin-top:15px;
			cursor:pointer;
		}
	}
	
	#mobile-menu-panel {
	  position: fixed;
	  top: 105px;
	  right: -300px;
	  width: 230px;
	  height: calc(100vh - 106px);
	  background-color: white;
	  transition: right 1s ease, opacity 1s ease;
	  opacity: 0;
	  z-index: 1001;
	  padding: 30px;
	  text-align:right;
	}

	#mobile-menu-panel.open {
	  right: 0;
	  opacity: 1;
	}
	
	#mobile-menu-panel2 {
	  position: fixed;
	  top: 104px;
	  right: -300px;
	  width: 250px;
	  height: calc(100vh - 110px);
	  background-color: white;
	  transition: right 1s ease, opacity 1s ease;
	  opacity: 0;
	  z-index: 1001;
	  padding: 40px 30px 40px 15px;
	  text-align:left;
	  overflow-y: auto;
      -webkit-overflow-scrolling: touch;
	}

	#mobile-menu-panel2.open {
	  right: 0;
	  opacity: 1;
	}

	#mobile-menu-panel ul {
	  list-style: none;
	  padding: 0;
	  margin: 0;
	}

	#mobile-menu-panel ul li {
	  margin-bottom: 20px;
	  transition: all 0.5s ease;
	}

	#mobile-menu-panel ul li a {
	  position: relative;
	  display: inline-block;
	  padding-left: 20px;
	  font-family: Arial, sans-serif;
	  color: black;
	  text-decoration: none;
	  background-color: transparent;
	  transition: background-color 0.3s ease;
	}

	/* Freccia inizialmente invisibile e a destra */
	#mobile-menu-panel ul li a::before {
	  content: '';
	  position: absolute;
	  left: 0;
	  top: 50%;
	  width: 8px;
	  height: 8px;
	  border-left: 2px solid #E73338;
	  border-bottom: 2px solid #E73338;
	  opacity: 0;
	  transform: translateY(-50%) translateX(10px) rotate(45deg); /* fuori posizione */
	  transition: all 0.4s ease;
	}

	/* Stato attivo */
	#mobile-menu-panel ul li.selected a {
	  background-color: #d9d9d9;
	}

	#mobile-menu-panel ul li.selected a::before {
	  opacity: 1;
	  transform: translateY(-50%) translateX(0) rotate(45deg); /* torna vicino al testo */
	}
	
	@media screen AND (max-width:699px){
		.header-padding{
			padding:20px 40px
		}
	}
	</style>

<!-- HEADER -->

<div class="header-wrapper" id="header-wrapper" style="position:relative;">
  <div class="header-padding">
    <header class="header-menu-container">
      <div class="header-menu-fixed-column">
        <a href="{{ config('app.url') }}"><img src="{{ asset('web/images/logo_vianini-trasp_w.png') }}" id="header-logo" class="header-logo" alt="Vianini Lavori"/></a>
      </div>
      <div class="header-menu-mob">
		<img src="{{ asset('web/images/nav-bars-w.png') }}" id="mobileMenuIcon" style="width:30px; margin-top:20px; cursor:pointer;" alt=""/>
	  </div>
      <div class="header-menu-flexible-column">
        <div class="header-menu-top-row">
          <div class="header-menu-item header-menu-item-top" style="margin-right:22px">
			<a href="lavora-con-noi.html" title="Lavora con noi - {{ config('app.name') }}">
				LAVORA CON NOI
			</a>
		  </div>
          <div class="header-menu-item header-menu-item-top" style="margin-left: 6px !important;">
			<div style="width:18px; height:18px;">
				<a href="https://www.youtube.com/@vianinilavorispa"  target="_blank">
				  <img src="{{ asset('web/images/youtube_w.png') }}" style="width:100%;" alt="Youtube" id="header-youtube"/>
				</a>
			</div>
		  </div>
		  <div class="header-menu-item header-menu-item-top" style="margin-left: 6px !important;">
			<div style="width:18px; height:18px;">
				<a href="https://www.instagram.com/vianinilavorispa/"  target="_blank">
				  <img src="{{ asset('web/images/instagram_w.png') }}" style="width:100%;" alt="Instagram" id="header-instagram"/>
				</a>
			</div>
		  </div>
          <div class="header-menu-item header-menu-item-top" style="margin-left: 6px !important;">
            <div style="width:18px; height:18px;">
              <a href="https://www.linkedin.com/company/vianini-lavori-s-p-a-/" target="_blank">
				<img src="{{ asset('web/images/linkedin_w.png') }}" style="width:100%;" alt="Linkedin" id="header-linkedin"/>
			  </a>
            </div>
          </div>
        </div>
        <div class="header-menu-bottom-row">
          <div class="header-menu-item"><a href="#" class="panel-trigger" data-panel="chisiamo">CHI SIAMO</a></div>
          <div class="header-menu-item"><a href="#" class="panel-trigger" data-panel="ilgruppo">IL GRUPPO</a></div>
          <div class="header-menu-item"><a href="#" class="panel-trigger" data-panel="incosacrediamo">IN COSA CREDIAMO</a></div>
          <div class="header-menu-item"><a href="#" class="panel-trigger" data-panel="progetti">PROGETTI</a></div>
          <div class="header-menu-item"><a href="#" class="panel-trigger" data-panel="sostenibilita">SOSTENIBILITÀ</a></div>
          <div class="header-menu-item"><a href="#" class="panel-trigger" data-panel="newsemedia">NEWS E MEDIA</a></div>
          <div class="header-menu-item"><a href="https://portalefornitori-vianinilavori.geo.app.jaggaer.com/esop/geo-host/public/portalefornitori-vianinilavori/web/login.jst?_ncp=1736339707752.99097-1" target="_blank">E-PROCUREMENT</a></div>
          <div class="header-menu-item"><a href="contatti.html">CONTATTI</a></div>
        </div>
      </div>
    </header>
  </div>
</div>

<!-- PANNELLO -->
<div id="panel">
  <div class="panel-columns">
    <div class="panel-ajax" id="panel-ajax">panel-ajax</div>
      <div class="close-panel" id="close-panel">
		<img src="{{ asset('web/images/clode_panel.png') }}" style="width:100%;" alt="Chiudi"/>
	  </div>
  </div>
</div>

<div id="overlay"></div>

<!-- MOBILE MENU PANEL -->
<div id="mobile-menu-panel">
  <!-- Inserisci qui i link/menu desiderati -->
  <ul>
    <li data-panel="chisiamo"><a class="no-parent-action">CHI SIAMO</a></li>
    <li data-panel="ilgruppo"><a class="no-parent-action">IL GRUPPO</a></li>
    <li data-panel="incosacrediamo"><a class="no-parent-action">IN COSA CREDIAMO</a></li>
    <li data-panel="progetti"><a class="no-parent-action">PROGETTI</a></li>
    <li data-panel="sostenibilita"><a class="no-parent-action" >SOSTENIBILITÀ</a></li>
    <li data-panel="newsemedia"><a class="no-parent-action">NEWS E MEDIA</a></li>
    <li><a href="https://portalefornitori-vianinilavori.geo.app.jaggaer.com/esop/geo-host/public/portalefornitori-vianinilavori/web/login.jst?_ncp=1736339707752.99097-1" target="_blank">E-PROCUREMENT</a></li>
    <li><a href="contatti.html">CONTATTI</a></li>
    <li><a href="lavora-con-noi.html">LAVORA CON NOI</a></li>
  </ul>
</div>
<div id="mobile-menu-panel2">
	<div id="close-panel2" style="position:absolute; top:10px; right:30px; width:22px; height:22px; cursor:pointer; z-index:10">
	  <img src="{{ asset('web/images/back.png') }}" style="width:100%;" alt="Chiudi pannello sottomenù">
	</div>
	
	<div id="mobile-panel2-content"></div>
</div>

<script>
const header = document.getElementById('header-wrapper');
const logo = document.getElementById('header-logo');
const linkedin = document.getElementById('header-linkedin');
const instagram = document.getElementById('header-instagram');
const youtube = document.getElementById('header-youtube');
const panel = document.getElementById('panel');
const panelColumns = document.querySelector('.panel-columns');
const closePanelBtn = document.getElementById('close-panel');
const mobMenuIcon = document.getElementById('mobileMenuIcon');

let newsCarouselTimer = null;
let newsCurrentSlide = 0;

let panelOpen = false;


@if($cmd!="progetto_dett")
	// Hover solo se pannello NON aperto
	@if($cmd!="home") 
		currentSlide = 1; 
	@endif	
	
	header.addEventListener('mouseenter', () => {
	  
		header.classList.add('hovered');
		logo.src = 'web/images/logo_vianini-trasp2.png';
		linkedin.src = 'web/images/linkedin_b.png';
		instagram.src = 'web/images/instagram_b.png';
		youtube.src = 'web/images/youtube_b.png';
		if(!mobileMenuOpen){
			mobMenuIcon.src = 'web/images/nav-bars.png';
		}
		
	  
	});

	header.addEventListener('mouseleave', () => {
	  if (!panelOpen && !mobileMenuOpen) {
		header.classList.remove('hovered');
		   if (currentSlide === 0 || currentSlide === "0") {
			  updateHeaderMode(0);
		  } else {			  
				updateHeaderMode(1);
		  }
	  }else{
		  updateHeaderMode(1);
		  if(!mobileMenuOpen){
				mobMenuIcon.src = 'web/images/nav-bars.png';
			}else{
				mobMenuIcon.src = 'web/images/clode_panel.png';
			}
		  
	  }
	});


	const mobileMenuIcon = document.getElementById('mobileMenuIcon');
	const mobileMenuPanel = document.getElementById('mobile-menu-panel');
	const mobileMenuPanel2 = document.getElementById('mobile-menu-panel2');
	const logoVianini = document.getElementById('header-logo');	

	let mobileMenuOpen = false;


	mobileMenuIcon.addEventListener('click', () => {
	  const menuItems = mobileMenuPanel.querySelectorAll('ul li');
	  
	  if (!mobileMenuOpen) {
		// Apri il menu
		mobileMenuPanel.classList.add('open');
		mobileMenuIcon.src='web/images/clode_panel.png';
		logoVianini.src = 'web/images/logo_vianini-trasp2.png';
		mobileMenuOpen = true;
		header.classList.add('hovered');
		
		menuItems.forEach((item, index) => {
		  setTimeout(() => {
			item.style.opacity = '1';
			item.style.transform = 'translateX(0)';
		  }, index * 100); // delay tra gli elementi
		});
	  } else {
		// Chiudi il menu
		mobileMenuPanel.classList.remove('open');
		mobileMenuPanel2.classList.remove('open');
		document.querySelectorAll('#mobile-menu-panel ul li').forEach(li => {
		  li.classList.remove('selected');
		});
		if(currentSlide && currentSlide==0){
			header.classList.remove('hovered');
			logoVianini.src = 'web/images/logo_vianini-trasp_w.png';
			mobileMenuIcon.src='web/images/nav-bars-w.png';
		}else{
			@if($cmd=="progetto_dett")
				const scrollY = window.scrollY;
			
				if (scrollY >= 100){
					header.classList.add('hovered');
					logoVianini.src = 'web/images/logo_vianini-trasp2.png';
					mobileMenuIcon.src='web/images/nav-bars.png';
				}else{
					header.classList.remove('hovered');
					logoVianini.src = 'web/images/logo_vianini-trasp_w.png';
					mobileMenuIcon.src='web/images/nav-bars-w.png';
				}
			@else
				header.classList.add('hovered');
				logoVianini.src = 'web/images/logo_vianini-trasp2.png';
				mobileMenuIcon.src='web/images/nav-bars.png';
			@endif
		}
		
		mobileMenuOpen = false;
		
		menuItems.forEach(item => {
		  item.style.opacity = '0';
		  item.style.transform = 'translateX(-100px)';
		});
	  }
	});
@endif

let currentPanelType = null;

// Clic su menu
document.querySelectorAll('.panel-trigger').forEach(item => {
  item.addEventListener('click', (e) => {
    e.preventDefault();
    // Rimuovi classe "active" da tutti
    document.querySelectorAll('.header-menu-item a').forEach(link => {
      link.classList.remove('active');
    });

    // Aggiungi classe "active" all'attuale
    const link = item.closest('a');
    if (link) {
      link.classList.add('active');
    }

    const panelType = item.getAttribute('data-panel');

	// Se è già aperto, chiudilo
	if (panelOpen && panelType === currentPanelType) {
	  closePanel();
	  currentPanelType = null;
	  return;
	}

	// Altrimenti apri il nuovo
	currentPanelType = panelType;
	openPanel(panelType);

  });
});


function openPanel(type) {
  panel.style.display = 'block';
  
  // Reset
  panelColumns.style.opacity = 0;
  panelColumns.style.transform = 'translateY(-20px)';
  panel.style.height = '0px';
  panel.style.opacity = '0';

  // Forza repaint per far partire animazione
  void panel.offsetWidth;

  // Animazione iniziale di apertura (visiva, prima del contenuto)
  panel.style.height = '300px'; // Altezza temporanea visiva
  panel.style.opacity = '1';

  document.getElementById('overlay').style.opacity = 1;
  document.getElementById('overlay').style.visibility = 'visible';

  header.classList.add('panel-open');
  logo.src = 'web/images/logo_vianini-trasp2.png';
  linkedin.src = 'web/images/linkedin_b.png';
  instagram.src = 'web/images/instagram_b.png';
  youtube.src = 'web/images/youtube_b.png';
  mobMenuIcon.src = 'web/images/nav-bars.png'
  panelOpen = true;

  // Carica contenuto AJAX
  loadPanelContent(type);
}


function loadPanelContent(type) {
  const BASE_URL = "{{ url('/') }}";
  const panelAjax = document.getElementById('panel-ajax');
  panelAjax.innerHTML = "";
  
  fetch(`${BASE_URL}/content/${type}`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Errore nel caricamento del contenuto');
      }
      return response.text();
    })
    .then(html => {
      panelAjax.innerHTML = html;
      executePanelScript(type);
	  
	  setTimeout(() => {
		  // Misura altezza effettiva
		  const contentHeight = panelColumns.offsetHeight + 80; // extra padding
		  panel.style.height = contentHeight + 'px';

		  // Ora mostra il contenuto interno con animazione
		  panelColumns.style.opacity = 1;
		  panelColumns.style.transform = 'translateY(0)';
		}, 100); // leggera attesa dopo inserimento DOM

    })
    .catch(error => {
      panelAjax.innerHTML = "<p>Errore nel caricamento del contenuto.</p>";
      console.error('Errore AJAX:', error);
    });
}

function executePanelScript(type) {
  if (type === 'chisiamo') {
    // Qui metti il JS specifico per il pannello "Chi Siamo"
    const img = document.querySelector('.panel-right img');
	img.src = (window.innerWidth <= 1199)
	  ? 'web/images/header-chi-siamo-mob.jpg'
	  : 'web/images/header-chi-siamo.png';
    const text1 = document.getElementById('panel-left-text-1');	
    const text2 = document.getElementById('panel-left-text-2');	
    const text3 = document.getElementById('panel-left-text-3');	
    const text4 = document.getElementById('panel-left-text-4');	

    setTimeout(() => {
      setTimeout(() => {
        img.style.opacity = 1;
        img.style.transform = 'translateX(0)';
      }, 300); 

      setTimeout(() => {
        text1.style.opacity = 1;
        text1.style.transform = 'translateX(0)';
      }, 100);
      setTimeout(() => {
        text2.style.opacity = 1;
        text2.style.transform = 'translateX(0)';
      }, 250);
      setTimeout(() => {
        text3.style.opacity = 1;
        text3.style.transform = 'translateX(0)';
      }, 400);
      setTimeout(() => {
        text4.style.opacity = 1;
        text4.style.transform = 'translateX(0)';
      }, 550);
    }, 300);
  }

  if (type === 'ilgruppo') {
    // Qui metti il JS specifico per il pannello "Chi Siamo"
    const partners = document.getElementById('boxPartners');
    const text1 = document.getElementById('panel-left-text-1');	

    setTimeout(() => {
      setTimeout(() => {
        partners.style.opacity = 1;
        partners.style.transform = 'translateX(0)';
      }, 300); 

      setTimeout(() => {
        text1.style.opacity = 1;
        text1.style.transform = 'translateX(0)';
      }, 100);
    }, 300);
  }

  
  if (type === 'incosacrediamo' || type === 'sostenibilita') {
    // Qui metti il JS specifico per il pannello "Chi Siamo"
    const img = document.querySelector('.panel-right img');
    const text1 = document.getElementById('panel-left-text-1');	
    const text2 = document.getElementById('panel-left-text-2');	

    setTimeout(() => {
      setTimeout(() => {
        img.style.opacity = 1;
        img.style.transform = 'translateX(0)';
      }, 300); 

      setTimeout(() => {
        text1.style.opacity = 1;
        text1.style.transform = 'translateX(0)';
      }, 100);
      setTimeout(() => {
        text2.style.opacity = 1;
        text2.style.transform = 'translateX(0)';
      }, 250);      
    }, 300);
  }
  
  if (type === 'newsemedia') {
	@php
		$evidenza = DB::table('news_menu')
			->select('*')
			->where('visibile','=','1')
			->orderBy('ordine','DESC')
			->get();
		$num_evidenza = $evidenza->count();
	@endphp

	@if(isset($num_evidenza) && $num_evidenza>0)
		resetNewsCarousel();
		// Qui metti il JS specifico per il pannello "Chi Siamo"
		const text1 = document.getElementById('panel-left-text-1');	
		const text2 = document.getElementById('panel-left-text-2');	
		const text3 = document.getElementById('panel-left-text-3');	
		const text4 = document.getElementById('panel-left-text-4');	
		
		const inEvidenzaTxt = document.getElementById('inEvidenzaTxt');	
		
		
		const carouselWrapper = document.getElementById('carouselWrapper');
		carouselWrapper.querySelectorAll('img').forEach(img => {
		  img.style.opacity = 0;
		  img.style.transform = 'translateX(100%)';
		});
		

		setTimeout(() => {
		 
		  setTimeout(() => {
			  const firstImage = carouselWrapper.querySelector('img.carousel-img');
			  if (firstImage) {
				firstImage.style.opacity = 1;
				firstImage.style.transform = 'translateX(0)';
			  }
			}, 300); 
			
		  
		  setTimeout(() => {
			inEvidenzaTxt.style.opacity = 1;
			inEvidenzaTxt.style.transform = 'translateX(0)';
		  }, 300); 

		  setTimeout(() => {
			text1.style.opacity = 1;
			text1.style.transform = 'translateX(0)';
		  }, 100);
		  setTimeout(() => {
			text2.style.opacity = 1;
			text2.style.transform = 'translateX(0)';
		  }, 250);
		  setTimeout(() => {
			text3.style.opacity = 1;
			text3.style.transform = 'translateX(0)';
		  }, 400);
		  setTimeout(() => {
			text4.style.opacity = 1;
			text4.style.transform = 'translateX(0)';
		  }, 550);
		}, 300);
		
		
		const newsCarouselSlides = [
		  @foreach($evidenza as $index => $ev)
		  {
			src: window.innerWidth <= 1199
			  ? 'resarea/img_up/news/{{$ev->img_mob}}'
			  : 'resarea/img_up/news/{{$ev->img}}',
			label: '{{$ev->titolo}}',
			link: '{{$ev->link}}',
		  },
		  @endforeach
		];


		function renderNewsSlide(index) {
		  const container = document.getElementById('carouselContainer');
		  const labelBox = document.getElementById('carouselText');
		  const arrows = document.querySelectorAll('.carousel-arrow');

		  // Rimuove l'immagine corrente con uscita animata
		  const currentImg = container.querySelector('img.carousel-img.active');
		  if (currentImg) {
			currentImg.classList.remove('active');
			currentImg.classList.add('exit-left');
			setTimeout(() => currentImg.remove(), 800);
		  }

		  labelBox.classList.remove('visible');

		  const img = document.createElement('img');
		  img.src = newsCarouselSlides[index].src;
		  img.alt = 'Slide ' + (index + 1);
		  img.className = 'carousel-img';
		  
		  let wrapper;
		  if (newsCarouselSlides[index].link) {
				wrapper = document.createElement('a');
				wrapper.href = newsCarouselSlides[index].link;
				wrapper.className = 'carousel-link';
				wrapper.appendChild(img);
		  }else{
			wrapper = img;
		  }
		  
		  container.appendChild(wrapper);

		  void img.offsetWidth;
		  img.classList.add('active');

		  setTimeout(() => {
			labelBox.textContent = newsCarouselSlides[index].label;
			labelBox.classList.add('visible');
		  }, 800);

		  arrows.forEach(a => a.classList.add('visible'));
		}



		function goToNextNewsSlide() {
		  newsCurrentSlide = (newsCurrentSlide + 1) % newsCarouselSlides.length;
		  renderNewsSlide(newsCurrentSlide);
		}

		function goToPreviousNewsSlide() {
		  newsCurrentSlide = (newsCurrentSlide - 1 + newsCarouselSlides.length) % newsCarouselSlides.length;
		  renderNewsSlide(newsCurrentSlide);
		}

		function startNewsCarouselAutoplay() {
		  newsCarouselTimer = setInterval(goToNextNewsSlide, 4000);
		}

		function resetNewsCarouselTimer() {
		  clearInterval(newsCarouselTimer);
		  startNewsCarouselAutoplay();
		}

		document.getElementById('carouselNext').addEventListener('click', () => {
		  goToNextNewsSlide();
		  resetNewsCarouselTimer();
		});
		document.getElementById('carouselPrev').addEventListener('click', () => {
		  goToPreviousNewsSlide();
		  resetNewsCarouselTimer();
		});

		renderNewsSlide(newsCurrentSlide);
		startNewsCarouselAutoplay();
	@else
		const partners = document.getElementById('boxPartners');
		const text1 = document.getElementById('panel-left-text-1');	
		const text2 = document.getElementById('panel-left-text-2');	
		const text3 = document.getElementById('panel-left-text-3');	

		const inEvidenzaTxt = document.getElementById('inEvidenzaTxt');

		setTimeout(() => {
		  setTimeout(() => {
			partners.style.opacity = 1;
			partners.style.transform = 'translateX(0)';
		  }, 300); 
			setTimeout(() => {
			inEvidenzaTxt.style.opacity = 1;
			inEvidenzaTxt.style.transform = 'translateX(0)';
		  }, 300); 
		  
		  setTimeout(() => {
			text1.style.opacity = 1;
			text1.style.transform = 'translateX(0)';
		  }, 100);
		  setTimeout(() => {
			text2.style.opacity = 1;
			text2.style.transform = 'translateX(0)';
		  }, 250);
		  setTimeout(() => {
			text3.style.opacity = 1;
			text3.style.transform = 'translateX(0)';
		  }, 400);
		}, 300);
	@endif

  }
  
  if (type === 'progetti') {
		const partners = document.getElementById('boxPartners');

		setTimeout(() => {
			// Mostra partner
			setTimeout(() => {
				partners.style.opacity = 1;
				partners.style.transform = 'translateX(0)';
			}, 300);

			// Mostra dinamicamente i testi
			document.querySelectorAll('.panel-left-text-dyn').forEach(el => {
				const delay = (parseInt(el.dataset.index) + 1) * 100;
				setTimeout(() => {
					el.style.opacity = 1;
					el.style.transform = 'translateX(0)';
				}, delay);
			});
		}, 300);
	}

  
  setupSubmenuListeners();
}

function resetNewsCarousel() {
  clearInterval(newsCarouselTimer);
  newsCurrentSlide = 0;

  const container = document.getElementById('carouselContainer');
  const labelBox = document.getElementById('carouselText');

  if (container) container.innerHTML = ''; // reset immagini
  if (labelBox) {
    labelBox.textContent = '';
    labelBox.classList.remove('visible');
  }

  document.querySelectorAll('.carousel-arrow').forEach(arrow => {
    arrow.classList.remove('visible');
  });
}
  

function setupSubmenuListeners() {
  // Listener per ogni <p> che ha un sottomenu subito dopo
  document.querySelectorAll('#panel-left p').forEach(item => {
    item.addEventListener('click', () => {
      const next = item.nextElementSibling;
      const textSpan = item.querySelector('.panel-left-text');

      // Verifica se è un contenitore di sotto-voci
      if (next && next.classList.contains('sub-items')) {
        const isOpen = next.style.display === 'block';

        // Chiudi tutti gli altri sottomenù (opzionale se vuoi 1 aperto alla volta)
        document.querySelectorAll('.sub-items').forEach(sub => {
          sub.style.display = 'none';
        });
        document.querySelectorAll('.panel-left-text.open').forEach(el => {
          el.classList.remove('open');
        });

        if (!isOpen) {
		  next.style.display = 'block';
		  textSpan.classList.add('open');

		  next.querySelectorAll('p').forEach((sub, i) => {
			sub.style.opacity = 0;
			sub.style.transform = 'translateX(-100px)';
			setTimeout(() => {
		      updatePanelHeight(); // 🔄 aggiorna quando completata l'espansione
			  sub.style.opacity = 1;
			  sub.style.transform = 'translateX(0)';
			}, i * 100);
		  });
		} else {
		  updatePanelHeight(); // anche quando si richiude
		}

      }
    });
  });

  // Gestione sottosottomenù (stessa logica)
  document.querySelectorAll('.sub-expandable').forEach(item => {
    item.addEventListener('click', (e) => {
      e.stopPropagation();
      const container = item.closest('p');
      const next = container.nextElementSibling;
      const textSpan = item;

      if (next && next.classList.contains('sub-sub-items')) {
        const isOpen = next.style.display === 'block';

        // Chiudi altri sotto-sotto-menù a questo livello
        container.parentElement.querySelectorAll('.sub-sub-items').forEach(sub => {
          sub.style.display = 'none';
        });
        container.parentElement.querySelectorAll('.panel-left-text.open').forEach(el => {
          el.classList.remove('open');
        });

        if (!isOpen) {
		  next.style.display = 'block';
		  textSpan.classList.add('open');

		  next.querySelectorAll('p').forEach((sub, i) => {
			sub.style.opacity = 0;
			sub.style.transform = 'translateX(-100px)';
			setTimeout(() => {
			  updatePanelHeight(); // 🔄 aggiorna quando completata l'espansione
			  sub.style.opacity = 1;
			  sub.style.transform = 'translateX(0)';
			}, i * 100);
		  });
		} else {
		  updatePanelHeight(); // anche quando si richiude
		}
      }
    });
  });
}



function closePanel() {
  panel.style.height = '0px';
  panel.style.opacity = '0';

  panelColumns.style.opacity = 0;
  panelColumns.style.transform = 'translateY(-20px)';

  document.getElementById('overlay').style.opacity = 0;
  document.getElementById('overlay').style.visibility = 'hidden';

  header.classList.remove('panel-open');
  panelOpen = false;

  document.querySelectorAll('.header-menu-item a').forEach(link => {
    link.classList.remove('active');
  });

  // Chiudi anche il pannello mobile sinistro
  document.getElementById('mobile-menu-panel2').classList.remove('open');

  // Dopo animazione, svuota e nascondi
  setTimeout(() => {
    panel.style.display = 'none';
    const panelAjax = document.getElementById('panel-ajax');
    if (panelAjax) panelAjax.innerHTML = '';
    //document.getElementById('mobile-menu-panel2').innerHTML = '';
  }, 600);
}



// Clic X per chiudere
document.addEventListener('click', (e) => {
  if (e.target.closest('#close-panel')) { 
    closePanel();
  }
});

// Chiudi cliccando fuori
document.addEventListener('click', (e) => {
  if (panelOpen && !e.target.closest('#panel') && !e.target.closest('.panel-trigger')) {
    closePanel();
  }
});

function updatePanelHeight() {
  const panel = document.getElementById('panel');
  const columns = document.querySelector('.panel-columns');

  if (panel && columns) {
    const newHeight = columns.offsetHeight + 80; // +80 per padding
    panel.style.height = newHeight + 'px';
  }
}


document.querySelectorAll('#mobile-menu-panel ul li').forEach(item => {
  item.addEventListener('click', () => {
    const panelType = item.getAttribute('data-panel');
    if (!panelType) return;

    const isOpen = mobileMenuPanel2.classList.contains('open');

    // Deseleziona tutti
    document.querySelectorAll('#mobile-menu-panel ul li').forEach(li => li.classList.remove('selected'));
    item.classList.add('selected');

    // Se già aperto, chiudi e riapri per ri-triggerare animazione
    if (isOpen) {
      mobileMenuPanel2.classList.remove('open');

      // Riapertura dopo breve timeout per forzare il reflow e far ripartire la transizione
      setTimeout(() => {
        mobileMenuPanel2.classList.add('open');
        loadMobilePanelContent(panelType);
      }, 10); // Delay breve per permettere il "reset"
    } else {
		mobileMenuPanel.classList.remove('open');
		setTimeout(() => {
			mobileMenuPanel2.classList.add('open');
			loadMobilePanelContent(panelType);
		 }, 200);
    }
  });
});




function loadMobilePanelContent(type) {
  const BASE_URL = "{{ url('/') }}";
  const contentBox = document.getElementById('mobile-panel2-content');
  contentBox.innerHTML = "<p style='margin-top:50px;'></p>";

  fetch(`${BASE_URL}/content/${type}`)
    .then(res => {
      if (!res.ok) throw new Error("Errore nel caricamento");
      return res.text();
    })
    .then(html => {
      contentBox.innerHTML = html;
      executePanelScriptMob(type);
    })
    .catch(() => {
      contentBox.innerHTML = "<p>Errore nel caricamento.</p>";
    });
}

function executePanelScriptMob(type) {
  if (type === 'chisiamo') {
    // Qui metti il JS specifico per il pannello "Chi Siamo"
    const img = document.querySelector('.panel-right img');
	img.src = (window.innerWidth <= 1199)
	  ? 'web/images/header-chi-siamo-mob.jpg'
	  : 'web/images/header-chi-siamo.png';
    const text1 = document.getElementById('panel-left-text-1');	
    const text2 = document.getElementById('panel-left-text-2');	
    const text3 = document.getElementById('panel-left-text-3');	
    const text4 = document.getElementById('panel-left-text-4');	

    setTimeout(() => {
      setTimeout(() => {
        img.style.opacity = 1;
        img.style.transform = 'translateX(0)';
      }, 300); 

      setTimeout(() => {
        text1.style.opacity = 1;
        text1.style.transform = 'translateX(0)';
      }, 100);
      setTimeout(() => {
        text2.style.opacity = 1;
        text2.style.transform = 'translateX(0)';
      }, 250);
      setTimeout(() => {
        text3.style.opacity = 1;
        text3.style.transform = 'translateX(0)';
      }, 400);
      setTimeout(() => {
        text4.style.opacity = 1;
        text4.style.transform = 'translateX(0)';
      }, 550);
    }, 300);
  }

  if (type === 'ilgruppo') {
    // Qui metti il JS specifico per il pannello "Chi Siamo"
    const partners = document.getElementById('boxPartners');
    const text1 = document.getElementById('panel-left-text-1');	

    setTimeout(() => {
      setTimeout(() => {
        partners.style.opacity = 1;
        partners.style.transform = 'translateX(0)';
      }, 300); 

      setTimeout(() => {
        text1.style.opacity = 1;
        text1.style.transform = 'translateX(0)';
      }, 100);
    }, 300);
  }

  
  if (type === 'incosacrediamo' || type === 'sostenibilita') {
    // Qui metti il JS specifico per il pannello "Chi Siamo"
    const img = document.querySelector('.panel-right img');
	if (type === 'incosacrediamo'){
		img.src = (window.innerWidth <= 1199)
		  ? 'web/images/header-in-cosa-crediamo2-mod.jpg'
		  : 'web/images/header-in-cosa-crediamo2.jpg';
	}
	if (type === 'sostenibilita'){
		img.src = (window.innerWidth <= 1199)
		  ? 'web/images/header-sostenibilita-2-mob.jpg'
		  : 'web/images/header-sostenibilita-2.jpg';
	}
    const text1 = document.getElementById('panel-left-text-1');	
    const text2 = document.getElementById('panel-left-text-2');	

    setTimeout(() => {
      setTimeout(() => {
        img.style.opacity = 1;
        img.style.transform = 'translateX(0)';
      }, 300); 

      setTimeout(() => {
        text1.style.opacity = 1;
        text1.style.transform = 'translateX(0)';
      }, 100);
      setTimeout(() => {
        text2.style.opacity = 1;
        text2.style.transform = 'translateX(0)';
      }, 250);      
    }, 300);
  }
  
  if (type === 'newsemedia') {
		@if(isset($num_evidenza) && $num_evidenza>0)
			resetNewsCarousel();
			// Qui metti il JS specifico per il pannello "Chi Siamo"
			const carouselPrev = document.getElementById('carouselPrev');	
			const carouselNext= document.getElementById('carouselNext');	
			const cWrapper = document.querySelector('.carousel-wrapper');	
			cWrapper.style.overflow = 'visible';
			carouselPrev.style.bottom = '-45px';
			carouselNext.style.bottom = '-45px';
			
			const panelLeft = document.getElementById('panel-left');
			//panelLeft.style.marginTop = '30px';
			
			const carouselText = document.querySelector('.carousel-text');
			carouselText.style.padding = '2px 5px';
			carouselText.style.fontSize = '12px';
			
			const text1 = document.getElementById('panel-left-text-1');	
			const text2 = document.getElementById('panel-left-text-2');	
			const text3 = document.getElementById('panel-left-text-3');	
			
			const inEvidenzaTxt = document.getElementById('inEvidenzaTxt');	
			
			
			const carouselWrapper = document.getElementById('carouselWrapper');
			carouselWrapper.querySelectorAll('img').forEach(img => {
			  img.style.opacity = 0;
			  img.style.transform = 'translateX(100%)';
			});
			

			setTimeout(() => {
			 
			  setTimeout(() => {
				  const firstImage = carouselWrapper.querySelector('img.carousel-img');
				  if (firstImage) {
					firstImage.style.opacity = 1;
					firstImage.style.transform = 'translateX(0)';
				  }
				}, 300); 
				
			  
			  setTimeout(() => {
				inEvidenzaTxt.style.opacity = 1;
				inEvidenzaTxt.style.transform = 'translateX(0)';
			  }, 300); 

			  setTimeout(() => {
				text1.style.opacity = 1;
				text1.style.transform = 'translateX(0)';
			  }, 100);
			  setTimeout(() => {
				text2.style.opacity = 1;
				text2.style.transform = 'translateX(0)';
			  }, 250);
			  setTimeout(() => {
				text3.style.opacity = 1;
				text3.style.transform = 'translateX(0)';
			  }, 400);
			}, 300);
			
			
			const newsCarouselSlides = [
			  @foreach($evidenza as $index => $ev)
			  {
				src: window.innerWidth <= 1199
				  ? 'resarea/img_up/news/{{$ev->img_mob}}'
				  : 'resarea/img_up/news/{{$ev->img}}',
				label: '{{$ev->titolo}}',
				link: '{{$ev->link}}',
			  },
			  @endforeach
			];


			function renderNewsSlide(index) {
			  const container = document.getElementById('carouselContainer');
			  const labelBox = document.getElementById('carouselText');
			  const arrows = document.querySelectorAll('.carousel-arrow');

			  // Rimuove l'immagine corrente con uscita animata
			  const currentImg = container.querySelector('img.carousel-img.active');
			  if (currentImg) {
				currentImg.classList.remove('active');
				currentImg.classList.add('exit-left');
				setTimeout(() => currentImg.remove(), 800);
			  }

			  labelBox.classList.remove('visible');

			  const img = document.createElement('img');
			  img.src = newsCarouselSlides[index].src;
			  img.alt = 'Slide ' + (index + 1);
			  img.className = 'carousel-img';
			  
			  let wrapper;
			  if (newsCarouselSlides[index].link) {
					wrapper = document.createElement('a');
					wrapper.href = newsCarouselSlides[index].link;
					wrapper.className = 'carousel-link';
					wrapper.appendChild(img);
			  }else{
				wrapper = img;
			  }
			  
			  container.appendChild(wrapper);

			  void img.offsetWidth;
			  img.classList.add('active');

			  setTimeout(() => {
				labelBox.textContent = newsCarouselSlides[index].label;
				labelBox.classList.add('visible');
			  }, 800);

			  arrows.forEach(a => a.classList.add('visible'));
			}



			function goToNextNewsSlide() {
			  newsCurrentSlide = (newsCurrentSlide + 1) % newsCarouselSlides.length;
			  renderNewsSlide(newsCurrentSlide);
			}

			function goToPreviousNewsSlide() {
			  newsCurrentSlide = (newsCurrentSlide - 1 + newsCarouselSlides.length) % newsCarouselSlides.length;
			  renderNewsSlide(newsCurrentSlide);
			}

			function startNewsCarouselAutoplay() {
			  newsCarouselTimer = setInterval(goToNextNewsSlide, 4000);
			}

			function resetNewsCarouselTimer() {
			  clearInterval(newsCarouselTimer);
			  startNewsCarouselAutoplay();
			}

			document.getElementById('carouselNext').addEventListener('click', () => {
			  goToNextNewsSlide();
			  resetNewsCarouselTimer();
			});
			document.getElementById('carouselPrev').addEventListener('click', () => {
			  goToPreviousNewsSlide();
			  resetNewsCarouselTimer();
			});

			renderNewsSlide(newsCurrentSlide);
			startNewsCarouselAutoplay();
		@else
		  const partners = document.getElementById('boxPartners');
			const text1 = document.getElementById('panel-left-text-1');	
			const text2 = document.getElementById('panel-left-text-2');	
			const text3 = document.getElementById('panel-left-text-3');	

			setTimeout(() => {
			  setTimeout(() => {
				partners.style.opacity = 1;
				partners.style.transform = 'translateX(0)';
			  }, 300); 

			  setTimeout(() => {
				text1.style.opacity = 1;
				text1.style.transform = 'translateX(0)';
			  }, 100);
			  setTimeout(() => {
				text2.style.opacity = 1;
				text2.style.transform = 'translateX(0)';
			  }, 250);
			  setTimeout(() => {
				text3.style.opacity = 1;
				text3.style.transform = 'translateX(0)';
			  }, 400);
			}, 300);
	  @endif
	}

  
  if (type === 'progetti') {
		const partners = document.getElementById('boxPartners');

		setTimeout(() => {
			// Mostra partner
			setTimeout(() => {
				partners.style.opacity = 1;
				partners.style.transform = 'translateX(0)';
			}, 300);

			// Mostra dinamicamente i testi
			document.querySelectorAll('.panel-left-text-dyn').forEach(el => {
				const delay = (parseInt(el.dataset.index) + 1) * 100;
				setTimeout(() => {
					el.style.opacity = 1;
					el.style.transform = 'translateX(0)';
				}, delay);
			});
		}, 300);
	}

  
  setupSubmenuListeners();
}

document.addEventListener('click', function(e) {
  const closePanel2Btn = e.target.closest('#close-panel2');
  if (closePanel2Btn) {
		mobileMenuPanel2.classList.remove('open');
		setTimeout(() => {
			mobileMenuPanel.classList.add('open');
		 }, 200);

    // Deseleziona voce evidenziata
    document.querySelectorAll('#mobile-menu-panel ul li').forEach(li => {
      li.classList.remove('selected');
    });
  }
});




</script>
