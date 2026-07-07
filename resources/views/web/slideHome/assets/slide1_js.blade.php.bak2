<script>	


	document.addEventListener('DOMContentLoaded', () => {
	  const slides = [
		document.getElementById('orizzontalSlideSlide1'),
		document.getElementById('orizzontalSlideSlide2'),
		document.getElementById('orizzontalSlideSlide3'),
		document.getElementById('orizzontalSlideSlide4'),
		document.getElementById('orizzontalSlideSlide5')
	  ];

	  const videos = [
		document.getElementById('background-video'),
		document.getElementById('background-video1'),
		document.getElementById('background-video2'),
		document.getElementById('background-video3'),
		document.getElementById('background-video4')
	  ];
	  
	  // 🔧 Autoplay fix per Safari
	  document.addEventListener('click', () => {
		const firstVideo = document.getElementById('background-video');
		if (firstVideo && firstVideo.paused) {
			firstVideo.play();
		}
	  }, { once: true });

	  let currentIndex = 0;
	  let isFirstLoad = true;
	  let timeoutId = null;
	  let isManual = false;

	  function showSlideOriz(index) {
		  if(index==0){
			  const firstVideo = document.getElementById('background-video');
				if (firstVideo) {
					firstVideo.muted = true;
					firstVideo.play().catch(() => {
						// fallback: show a play button or handle error
					});
				}

		  }
		  slides.forEach((slide, i) => {
			slide.style.opacity = i === index ? '1' : '0';
		  });

		  videos.forEach((video, i) => {
			if (video) {
			  if (i === index) {
				video.currentTime = 0;
				video.play();
			  } else {
				video.pause();
			  }
			}
		  });

		  updateTexts(index);
		  updateNavSlide(index);
		  currentIndex = index;
		  scheduleNext();
		}

		function updateTexts(index) {
		  const titles = [
			document.getElementById('titoloSlide1'),
			document.getElementById('titoloSlide2'),
			document.getElementById('titoloSlide3'),
			document.getElementById('titoloSlide4'),
			document.getElementById('titoloSlide5')
		  ];

		  const subtitles = [
			document.getElementById('sottotitoloSlide1'),
			document.getElementById('sottotitoloSlide2'),
			document.getElementById('sottotitoloSlide3'),
			document.getElementById('sottotitoloSlide4'),
			document.getElementById('sottotitoloSlide5')
		  ];

		  const links = [
			{ href: "dettaglio-progetto/arena_milano_santa_giulia-7.html", text: "Scopri MSG Arena" },
			{ href: "dettaglio-progetto/metro_c_di_roma-1.html", text: "Scopri la Metro C" },
			{ href: "dettaglio-progetto/tai_di__cadore-17.html", text: "Scopri Tai e Cadore" },
			{ href: "dettaglio-progetto/metropolitana_di_catanzaro-19.html", text: "Scopri Metro di Catanzaro" },
			{ href: "dettaglio-progetto/nodo_di_catania-16.html", text: "Scopri Nodo di Catania" }
		  ];

		  // Reset classi
		  titles.forEach(t => {
			t.classList.remove('visible');
			t.classList.add('hidden');
		  });

		  subtitles.forEach(s => {
			s.classList.remove('visible');
			s.classList.add('hidden');
		  });

		  // Link dinamico
		  const link = document.getElementById('scopriLink');
		  link.href = links[index].href;
		  //link.textContent = links[index].text;

		  const baseDelay = (isFirstLoad && index === 0) ? 1700 : 500;

		  setTimeout(() => {
			titles[index].classList.add('visible');
		  }, baseDelay);

		  setTimeout(() => {
			subtitles[index].classList.add('visible');
			isFirstLoad = false;
		  }, baseDelay + 200); // ritardo aggiuntivo sul sottotitolo
		}


		function scheduleNext() {
		  clearTimeout(timeoutId);

		  const sub2 = document.getElementById('sottotitoloSlide2');
		  const sub3 = document.getElementById('sottotitoloSlide3');
		  const sub4 = document.getElementById('sottotitoloSlide4');
		  const sub5 = document.getElementById('sottotitoloSlide5');
		  const img1 = document.getElementById('slide2Img1');
		  const img2 = document.getElementById('slide2Img2');
			

		  // Slide 1 → attende fine video
		  if (currentIndex === 0 && videos[0]) {
			videos[0].onended = () => {
			  showSlideOriz(1);
			};
		  }

		  /*// Slide 2 → cambia immagine + sottotitolo dopo 5s
		  else if (currentIndex === 1) {
			  img1.style.opacity = '1';
			  img2.style.opacity = '0';

			  const subtitle2 = document.getElementById('sottotitoloSlide2');
			  subtitle2.classList.remove('visible');
			  subtitle2.classList.add('hidden');
			  subtitle2.textContent = 'Roma si trasforma';

			  setTimeout(() => {
				img1.style.opacity = '0';
				img2.style.opacity = '1';

				subtitle2.classList.remove('visible');
				subtitle2.classList.add('hidden');
				setTimeout(() => {
				  subtitle2.textContent = '26 km di linea | 585.000 m3 Scavo con modalità archeologica';
				  subtitle2.classList.add('visible');
				}, 500); // leggerissimo delay per attivare transizione
			  }, 5000);

			  timeoutId = setTimeout(() => {
				showSlideOriz(2);
			  }, 10000);
			}*/
			
			else if (currentIndex === 1 && videos[1]) {
			  const subtitle2 = document.getElementById('sottotitoloSlide2');
			  subtitle2.classList.remove('visible');
			  subtitle2.classList.add('hidden');
			  subtitle2.textContent = 'Roma si trasforma';

			  setTimeout(() => {
				subtitle2.classList.remove('visible');
				subtitle2.classList.add('hidden');
				setTimeout(() => {
				  subtitle2.textContent = '26 km di linea | 585.000 m3 Scavo con modalità archeologica';
				  subtitle2.classList.add('visible');
				}, 500);
			  }, 5000);
				
			  videos[1].onended = () => {
				showSlideOriz(2);
			  };
			}
			
			// Slide 3 → cambio sottotitolo dopo 5s
			else if (currentIndex === 2 && videos[2]) {
			  const subtitle3 = document.getElementById('sottotitoloSlide3');
			  subtitle3.classList.remove('visible');
			  subtitle3.classList.add('hidden');
			  subtitle3.textContent = 'Tai e Valle di Cadore: più mobilità per le Olimpiadi Milano/Cortina 2026';

			  setTimeout(() => {
				subtitle3.classList.remove('visible');
				subtitle3.classList.add('hidden');
				setTimeout(() => {
				  subtitle3.textContent = '196ml galleria artificiale | oltre 1,4km galleria naturale';
				  subtitle3.classList.add('visible');
				}, 500);
			  }, 5000);
				
			  videos[2].onended = () => {
				showSlideOriz(3);
			  };
			}

			// Slide 4 → cambio sottotitolo dopo 5s
			else if (currentIndex === 3 && videos[3]) {
			  const subtitle4 = document.getElementById('sottotitoloSlide4');
			  subtitle4.classList.remove('visible');
			  subtitle4.classList.add('hidden');
			  subtitle4.textContent = 'Un progetto strategico per collegare Catanzaro Sala, Catanzaro Lido e Germaneto';

			  setTimeout(() => {
				subtitle4.classList.remove('visible');
				subtitle4.classList.add('hidden');
				setTimeout(() => {
				  subtitle4.textContent = 'Undici fermate complessive, con due Stazioni (Catanzaro Sala e Catanzaro Lido)';
				  subtitle4.classList.add('visible');
				}, 500);
			  }, 5000);
				
			  videos[3].onended = () => {
				showSlideOriz(4);
			  };
			}

			// Slide 5 → cambio sottotitolo dopo 5s
			else if (currentIndex === 4 && videos[4]) {
			  const subtitle5 = document.getElementById('sottotitoloSlide5');
			  subtitle5.classList.remove('visible');
			  subtitle5.classList.add('hidden');
			  subtitle5.textContent = '3 km di nuova infrastruttura sotterranea';

			  setTimeout(() => {
				subtitle5.classList.remove('visible');
				subtitle5.classList.add('hidden');
				setTimeout(() => {
				  subtitle5.textContent = '915 metri di galleria artificiale';
				  subtitle5.classList.add('visible');
				}, 500);
				
				  setTimeout(() => {
					subtitle5.classList.remove('visible');
					subtitle5.classList.add('hidden');
					setTimeout(() => {
					  subtitle5.textContent = '785 metri di trincee di approccio';
					  subtitle5.classList.add('visible');
					}, 500);
				  }, 7000);
			  }, 7000);
			  
				
			  videos[4].onended = () => {
				showSlideOriz(0);
			  };
			}
		}

		function updateNavSlide(index) {
		  const navSlides = document.querySelectorAll('.navSlide');
		  navSlides.forEach((el, i) => {
			if (i === index) {
			  el.classList.add('active');
			} else {
			  el.classList.remove('active');
			}
		  });
		}


	  // Pulsanti freccia
	  const nextBtn = document.getElementById('nextBtn');
	  const prevBtn = document.getElementById('prevBtn');

	  nextBtn.addEventListener('click', () => {
		isManual = true;
		showSlideOriz((currentIndex + 1) % 5);
	  });

	  prevBtn.addEventListener('click', () => {
		isManual = true;
		showSlideOriz((currentIndex - 1 + 5) % 5);
	  });


		// Rendi le navSlide cliccabili
		document.querySelectorAll('.navSlide').forEach((nav, index) => {
		  nav.style.cursor = 'pointer';
		  nav.addEventListener('click', () => {
			isManual = true;
			showSlideOriz(index);
		  });
		});

	  // Avvio iniziale
	  showSlideOriz(0);
	});
	
</script>