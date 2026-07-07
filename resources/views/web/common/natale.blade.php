@if ($natale=="1" || $natale=="2")
	<style>
		.addobboImg {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			transition: opacity 0.8s ease;
			opacity: 0;
			z-index: 1001;
			pointer-events:none;
		}
		.addobboImg2 {
			position: absolute;
			top: 0;
			right: 0;
			width: 100%;
			height: 100%;
			transition: opacity 0.8s ease;
			opacity: 0;
			z-index: 1001; 
			pointer-events:none;
		}
		
		.addobboContainer{
			position:absolute; 
			width:100%; 
			height:100%; 
			border-bottom:solid 5px rgba(235,172,93,0.6); 
			top:0; 
			left:0; 
			z-index:10001; 
			display:flex; 
			justify-content:space-between; 
			pointer-events:none;
			scrollbar-width: none;
		}
		.addobboContainer::-webkit-scrollbar {
		  display: none;             /* Chrome, Safari */
		}
	</style>
	<div id="addobboContainer">
		<img  src="web/images/solo_rami_left.png" id="rami" style="position:fixed; top:0; left:0; width:auto; height:100vh; opacity:0; transition:opacity 0.8s ease;">
		<img  src="web/images/solo_rami_right.png" id="rami_right" style="position:fixed; top:0; right:0; width:auto; height:100vh; opacity:0; transition:opacity 0.8s ease;">
		
		<img class="addobboImg" id="addobbo1" src="web/images/2025_Vianini_Sito-Natalizio_Anim_1.png" style="position:fixed; top:0; left:0; width:auto; height:100vh; opacity:0; transition:opacity 0.8s ease;">
		<img class="addobboImg" id="addobbo2" src="web/images/2025_Vianini_Sito-Natalizio_Anim_2.png" style="position:fixed; top:0; left:0; width:auto; height:100vh; opacity:0; transition:opacity 0.8s ease;">
		
		<img class="addobboImg2" id="addobbo1_right" src="web/images/2025_Vianini_Sito-Natalizio_Anim_Right_1.png" style="position:fixed; top:0; right:0; width:auto; height:100vh; opacity:0; transition:opacity 0.8s ease;">
		<img class="addobboImg2" id="addobbo2_right" src="web/images/2025_Vianini_Sito-Natalizio_Anim_Right_2.png" style="position:fixed; top:0; right:0; width:auto; height:100vh; opacity:0; transition:opacity 0.8s ease;">
	</div>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const images = [
				'web/images/2025_Vianini_Sito-Natalizio_Fisso.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_1.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_2.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_3.png'
			];
			
			const images_right = [
				'web/images/2025_Vianini_Sito-Natalizio_Right_Fisso.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_Right_1.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_Right_2.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_Right_3.png'
			];

			const rami = document.getElementById('rami');
			const rami_right = document.getElementById('rami_right');
			const img1 = document.getElementById('addobbo1');
			const img2 = document.getElementById('addobbo2');
			const img1_right = document.getElementById('addobbo1_right');
			const img2_right = document.getElementById('addobbo2_right');

			let current = 0;
			let next = 1;
			let current_right = 0;
			let next_right = 1;

			// Inizializza prima immagine ma invisibile
			img1.src = images[current];
			img1_right.src = images_right[current];

			// Dopo 2 secondi, avvia il fade-in iniziale e il ciclo
			setTimeout(() => {
				rami.style.opacity = 1;
				rami_right.style.opacity = 1;
				
				img1.style.opacity = 1;
				img1_right.style.opacity = 1;

				setInterval(() => {
					const fadeOutImg = current % 2 === 0 ? img1 : img2;
					const fadeInImg = current % 2 === 0 ? img2 : img1;
					const fadeOutImg_right = current_right % 2 === 0 ? img1_right : img2_right;
					const fadeInImg_right = current_right % 2 === 0 ? img2_right : img1_right;

					fadeInImg.src = images[next];
					fadeInImg.style.zIndex = 1002;
					fadeOutImg.style.zIndex = 1001;								
					fadeInImg_right.src = images_right[next_right];
					fadeInImg_right.style.zIndex = 1002;
					fadeOutImg_right.style.zIndex = 1001;

					fadeOutImg.style.opacity = 0;
					fadeInImg.style.opacity = 1;
					fadeOutImg_right.style.opacity = 0;
					fadeInImg_right.style.opacity = 1;

					current = next;
					next = (next + 1) % images.length;
					current_right = next_right;
					next_right = (next_right + 1) % images_right.length;
				}, 2000);
			}, 2000); // 🔥 Delay iniziale prima apparizione
		});
	</script>
@endif

@if ($natale=="3")
	<style>
		.addobboLeft{
			position:absolute; 
			top:-200px; 
			opacity:0;
			left:0; 
			width:172px; 
			height:200px;
			transition: all 1s ease;
			z-index:1001;
		}
		.campanellaLeft{
			position:absolute; 
			//top:-0px; 
			top:-200px; 
			opacity:0;
			left:0; 
			width:172px; 
			height:200px;
			transition: all 1s ease;
			z-index:1002;
		}
	</style>
	<div id="addobboContainer" style="position:absolute; width:100%; height:100%; border-bottom:solid 5px rgba(235,172,93,0.6); top:0; left:0; z-index:10010; display:flex; justify-content:space-between">
		<img class="addobboLeft" src="web/images/rami_left_HD2_senza_campanella.png" alt=""/>
		<img class="campanellaLeft" src="web/images/campanella_left_1.png" alt=""/>
	</div>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
		const addobboLeft = document.querySelector('.addobboLeft');
		const campanellaLeft = document.querySelector('.campanellaLeft');
		
		setTimeout(() => {
			$( addobboLeft ).css({
				"opacity": "1",
				"top": "0px"
			});
			$( campanellaLeft ).css({
				"opacity": "1",
				"top": "0px"
			});
		
		}, 2000);
		
		function startCampanellaAnimation() {
			const img = document.querySelector('.campanellaLeft');

			function animateCycle() {
				const times = Math.floor(Math.random() * 4) + 3; // da 3 a 6 rintocchi
				let count = 0;
				let toggle = false;

				const shakeInterval = setInterval(() => {
					toggle = !toggle;
					img.src = toggle 
						? 'web/images/campanella_left_2.png' 
						: 'web/images/campanella_left_1.png';

					count++;
					if (count >= times * 2) { // ogni toggle = mezzo rintocco
						clearInterval(shakeInterval);

						// Tempo di pausa prima del prossimo ciclo
						const pauseTime = Math.floor(Math.random() * 6000) + 4000; // 1s – 4s
						setTimeout(animateCycle, pauseTime);
					}
				}, 100); // velocità singolo scampanellio (100ms)
			}

			// Avvio iniziale
			animateCycle();
		}

		// Avvia animazione dopo la comparsa della campanella
		setTimeout(() => {
			startCampanellaAnimation();
		}, 5000);

	});
	</script>
@endif

@if ($natale=="4")
	<style>
		.addobboLeft{
			position:absolute; 
			top:-200px; 
			opacity:0;
			left:0; 
			width:172px; 
			height:200px;
			transition: all 1s ease;
			z-index:1001;
		}
		.campanellaLeft{
			position:absolute; 
			//top:-0px; 
			top:-200px; 
			opacity:0;
			left:0; 
			width:172px; 
			height:200px;
			transition: all 1s ease;
			z-index:1002;
		}
		
		.addobboImg {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			transition: opacity 0.8s ease;
			opacity: 0;
			z-index: 1001;
		}
	</style>
	<div id="addobboContainer" style="position:absolute; width:100%; height:100%; border-bottom:solid 5px rgba(235,172,93,0.6); top:0; left:0; z-index:10001; display:flex; justify-content:space-between">
		<img class="addobboLeft" src="web/images/rami_left_HD2_senza_campanella.png" alt=""/>
		<img class="campanellaLeft" src="web/images/campanella_left_1.png" alt=""/>
		
		<img class="addobboImg" id="addobbo1" src="web/images/2025_Vianini_Sito-Natalizio_Anim_1_B.png" style="position:absolute; top:0; left:0; width:auto; height:100%; opacity:0; transition:opacity 0.8s ease;">
		<img class="addobboImg" id="addobbo2" src="web/images/2025_Vianini_Sito-Natalizio_Anim_2_B.png" style="position:absolute; top:0; left:0; width:auto; height:100%; opacity:0; transition:opacity 0.8s ease;">
	</div>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const images = [
				'web/images/2025_Vianini_Sito-Natalizio_Fisso_B.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_1_B.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_2_B.png',
				'web/images/2025_Vianini_Sito-Natalizio_Anim_3_B.png'
			];

			const img1 = document.getElementById('addobbo1');
			const img2 = document.getElementById('addobbo2');

			let current = 0;
			let next = 1;

			// Inizializza prima immagine ma invisibile
			img1.src = images[current];

			// Dopo 2 secondi, avvia il fade-in iniziale e il ciclo
			setTimeout(() => {
				img1.style.opacity = 1;

				setInterval(() => {
					const fadeOutImg = current % 2 === 0 ? img1 : img2;
					const fadeInImg = current % 2 === 0 ? img2 : img1;

					fadeInImg.src = images[next];
					fadeInImg.style.zIndex = 1002;
					fadeOutImg.style.zIndex = 1001;

					fadeOutImg.style.opacity = 0;
					fadeInImg.style.opacity = 1;

					current = next;
					next = (next + 1) % images.length;
				}, 2000);
			}, 3000); // 🔥 Delay iniziale prima apparizione
			
			const addobboLeft = document.querySelector('.addobboLeft');
			const campanellaLeft = document.querySelector('.campanellaLeft');
			
			setTimeout(() => {
				$( addobboLeft ).css({
					"opacity": "1",
					"top": "0px"
				});
				$( campanellaLeft ).css({
					"opacity": "1",
					"top": "0px"
				});
			
			}, 2000);
			
			function startCampanellaAnimation() {
				const img = document.querySelector('.campanellaLeft');

				function animateCycle() {
					const times = Math.floor(Math.random() * 4) + 3; // da 3 a 6 rintocchi
					let count = 0;
					let toggle = false;

					const shakeInterval = setInterval(() => {
						toggle = !toggle;
						img.src = toggle 
							? 'web/images/campanella_left_2.png' 
							: 'web/images/campanella_left_1.png';

						count++;
						if (count >= times * 2) { // ogni toggle = mezzo rintocco
							clearInterval(shakeInterval);

							// Tempo di pausa prima del prossimo ciclo
							const pauseTime = Math.floor(Math.random() * 6000) + 4000; // 1s – 4s
							setTimeout(animateCycle, pauseTime);
						}
					}, 100); // velocità singolo scampanellio (100ms)
				}

				// Avvio iniziale
				animateCycle();
			}

			// Avvia animazione dopo la comparsa della campanella
			setTimeout(() => {
				startCampanellaAnimation();
			}, 5000);

		});
	</script>
@endif