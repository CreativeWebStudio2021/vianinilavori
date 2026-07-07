@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		/**
		 * layout_toggle: 1 = barra Mosaico/Griglia + localStorage; 2 = layout “vivace” (righe 1–3, varianti asimmetriche);
		 * assente/0 = griglia classica senza barra.
		 */
		$rawLayoutToggle = request()->query('layout_toggle');
		// Default: layout vivace anche senza parametri in URL.
		$galleryLayoutMode = 2;
		if ($rawLayoutToggle !== null && $rawLayoutToggle !== '') {
			if ($rawLayoutToggle === '2' || (int) $rawLayoutToggle === 2) {
				$galleryLayoutMode = 2;
			} elseif ($rawLayoutToggle === '1' || (int) $rawLayoutToggle === 1 || filter_var($rawLayoutToggle, FILTER_VALIDATE_BOOLEAN)) {
				$galleryLayoutMode = 1;
			} else {
				$galleryLayoutMode = 0;
			}
		}
		$showGalleryLayoutToggle = ($galleryLayoutMode === 1);
		$showGalleryVivace = ($galleryLayoutMode === 2);
		/** Accetta array o Collection (es. $block['media'] dal controller). */
		$galleryDettVivacePartition = static function ($items, int $seed): array {
			$list = collect($items)->values()->all();
			$rows = [];
			$n = count($list);
			if ($n === 0) {
				return $rows;
			}
			$i = 0;
			$state = max(1, $seed & 0x7fffffff);
			while ($i < $n) {
				$rem = $n - $i;
				if ($rem <= 3) {
					$rows[] = array_slice($list, $i, $rem);
					break;
				}
				$state = ($state * 1103515245 + 12345) & 0x7fffffff;
				$pick = $state % 100;
				if ($i === 0 && $rem >= 2) {
					// Prima riga dopo hero: evita il blocco singolo.
					$k = ($rem >= 3 && $pick >= 45) ? 3 : 2;
				} else {
					if ($pick < 36) {
						$k = 2;
					} elseif ($pick < 74) {
						$k = 3;
					} else {
						$k = 1;
					}
				}
				if ($k > $rem) {
					$k = $rem;
				}
				if ($rem - $k === 1) {
					$k = $rem >= 3 ? 2 : $rem;
				}
				$rows[] = array_slice($list, $i, $k);
				$i += $k;
			}
			return $rows;
		};
		/** Variante layout riga (colonne asimmetriche / fascia singola) da seed stabile. */
		$galleryDettVivaceRowVariant = static function (int $nc, int $rowSeed): string {
			$s = abs($rowSeed);
			if ($nc <= 0) {
				return 'solo-auto';
			}
			if ($nc === 1) {
				return 'solo-auto';
			}
			if ($nc === 2) {
				$opts = [
					'duo-wide-left', 'duo-wide-right', 'duo-golden-left', 'duo-golden-right',
					'duo-58-42', 'duo-62-38', 'duo-55-45', 'duo-70-30', 'duo-30-70', 'duo-65-35',
				];

				return $opts[$s % count($opts)];
			}
			$opts = [
				'trio-narrow-mid', 'trio-narrow-first', 'trio-narrow-last',
				'trio-weight-right', 'trio-weight-left', 'trio-equal', 'trio-golden-flank',
				'trio-rail', 'trio-magazine', 'trio-40-35-25',
			];

			return $opts[$s % count($opts)];
		};
		/**
		 * Slot per cella: wide = predisposto a panoramiche, narrow = verticali, mid = equilibrato.
		 * w = peso colonna (più alto = più largo in griglia → preferire foto più orizzontali).
		 */
		$galleryDettVivaceRowSlotDefs = static function (string $vRow, int $nc): array {
			if ($nc === 1) {
				return [['slot' => 'wide', 'w' => 3]];
			}
			if ($nc === 2) {
				switch ($vRow) {
					case 'duo-wide-right':
					case 'duo-golden-right':
						return [['slot' => 'mid', 'w' => 2], ['slot' => 'wide', 'w' => 4]];
					case 'duo-30-70':
						return [['slot' => 'narrow', 'w' => 2], ['slot' => 'wide', 'w' => 4]];
					case 'duo-70-30':
					case 'duo-65-35':
						return [['slot' => 'wide', 'w' => 4], ['slot' => 'narrow', 'w' => 2]];
					case 'duo-wide-left':
					case 'duo-golden-left':
					case 'duo-62-38':
					case 'duo-58-42':
					case 'duo-55-45':
					default:
						return [['slot' => 'wide', 'w' => 4], ['slot' => 'mid', 'w' => 2]];
				}
			}
			switch ($vRow) {
				case 'trio-narrow-mid':
				case 'trio-golden-flank':
					return [
						['slot' => 'wide', 'w' => 3],
						['slot' => 'narrow', 'w' => 1],
						['slot' => 'wide', 'w' => 3],
					];
				case 'trio-narrow-first':
					return [
						['slot' => 'narrow', 'w' => 1],
						['slot' => 'wide', 'w' => 3],
						['slot' => 'wide', 'w' => 3],
					];
				case 'trio-narrow-last':
					return [
						['slot' => 'wide', 'w' => 3],
						['slot' => 'wide', 'w' => 3],
						['slot' => 'narrow', 'w' => 1],
					];
				case 'trio-weight-right':
					return [['slot' => 'mid', 'w' => 2], ['slot' => 'mid', 'w' => 2], ['slot' => 'wide', 'w' => 4]];
				case 'trio-weight-left':
					return [['slot' => 'wide', 'w' => 4], ['slot' => 'mid', 'w' => 2], ['slot' => 'mid', 'w' => 2]];
				case 'trio-rail':
					return [
						['slot' => 'narrow', 'w' => 1],
						['slot' => 'wide', 'w' => 4],
						['slot' => 'narrow', 'w' => 1],
					];
				case 'trio-magazine':
					return [['slot' => 'wide', 'w' => 3], ['slot' => 'mid', 'w' => 2], ['slot' => 'narrow', 'w' => 2]];
				case 'trio-40-35-25':
					return [['slot' => 'wide', 'w' => 3], ['slot' => 'mid', 'w' => 2], ['slot' => 'narrow', 'w' => 2]];
				case 'trio-equal':
				default:
					return [
						['slot' => 'mid', 'w' => 2],
						['slot' => 'mid', 'w' => 2],
						['slot' => 'mid', 'w' => 2],
					];
			}
		};
		/** Con ?sezioni=1 si mostrano menu sticky ancore + titoli e blocchi per sezione; senza parametro tutta la gallery in un’unica griglia */
		// Default: sezioni attive se presenti (quando non specificato in URL).
		$showGallerySezioni = request()->has('sezioni') ? request()->boolean('sezioni') : true;
		$galleryDettQueryParts = [];
		foreach (['layout_toggle', 'sezioni'] as $galleryDettQk) {
			if (request()->has($galleryDettQk)) {
				$galleryDettQueryParts[$galleryDettQk] = request()->query($galleryDettQk);
			}
		}
		$galleryDettQuerySuffix = $galleryDettQueryParts !== [] ? '?' . http_build_query($galleryDettQueryParts) : '';
	@endphp

	<style>
		.gallery-dett-hero {
			width: 100%;
			margin-left: 0;
			margin-bottom: 48px;
			background: #ececec;
			position: relative;
		}
		.gallery-dett-hero-inner {
			position: relative;
			width: 100%;
			margin: 0 auto;
			overflow: hidden;
		}
		.gallery-dett-hero-inner--image {
			/* Immagine hero: full width, altezza proporzionale (nessun crop) */
			overflow: visible;
		}
		.gallery-dett-hero-img {
			display: block;
			width: 100%;
			height: auto;
		}
		.gallery-dett-hero-inner--image .gallery-dett-hero-img {
			max-height: none;
			object-fit: contain;
		}
		/* Hero video: riempie il box 16:9 come "cover" (ritaglia i bordi) per ridurre le bande nere del player su video non 16:9 */
		.gallery-dett-hero-inner--video {
			background: #000;
			/* Il crop è assoluto: serve un'altezza definita */
			aspect-ratio: 16 / 9;
			max-height: min(90vh, 1000px);
			/* Zoom del player (1 = nessun zoom). Aumentare se restano bande su video verticali; diminuire se si taglia troppo un 16:9 classico */
			--gallery-hero-video-zoom: 1.45;
		}
		.gallery-dett-hero-video-crop {
			position: absolute;
			inset: 0;
			overflow: hidden;
		}
		.gallery-dett-hero-inner--video .gallery-dett-hero-video {
			position: absolute;
			top: 50%;
			left: 50%;
			width: 100%;
			height: 100%;
			border: 0;
			transform: translate(-50%, -50%) scale(var(--gallery-hero-video-zoom));
			transform-origin: center center;
		}

		.gallery-dett-headline {
			margin-bottom: 28px;
		}
		.gallery-dett-title {
			font-size: 40px;
			font-weight: 700;
			color: #000;
			line-height: 1.15;
			margin: 0 0 12px 0;
		}
		.gallery-dett-sub {
			font-size: 26px;
			font-weight: 500;
			color: #000;
			margin: 0 0 8px 0;
		}
		.gallery-dett-luogo {
			font-size: 15px;
			font-weight: 600;
			color: {{ config('app.rosso') }};
			text-transform: uppercase;
			letter-spacing: 0.04em;
			margin: 0;
		}

		.gallery-dett-body {
			font-size: 17px;
			line-height: 1.65;
			color: #222;
			margin-bottom: 32px;
		}
		.gallery-dett-body p:first-child { margin-top: 0; }
		.gallery-dett-body p:last-child { margin-bottom: 0; }
		/* Liste da backoffice: blocco centrato, testo lista allineato a sinistra
		   per tenere vicino il marker (freccia) ai contenuti anche con layout centrato. */
		.gallery-dett-body ul,
		.gallery-dett-body ol {
			display: table;
			max-width: 100%;
			margin: 0 auto 1em auto;
			text-align: left;
			padding-left: 28px;
		}
		.gallery-dett-body li {
			text-align: left;
		}
		.gallery-dett-body ul li::before,
		.gallery-dett-body ol li::before {
			top: 0.45em;
		}

		.gallery-dett-cta {
			display: inline-block;
			padding: 9px 20px;
			background: {{ config('app.rosso') }};
			color: #fff !important;
			font-weight: 700;
			font-size: 16px;
            text-transform: uppercase;
			text-decoration: none;
			border-radius: 25px;
			border: 2px solid {{ config('app.rosso') }};
			margin-bottom: 56px;
			transition: background-color 0.2s, color 0.2s, border-color 0.2s;
		}
		.gallery-dett-cta:hover {
			background: #fff;
			color: {{ config('app.rosso') }} !important;
			border-color: {{ config('app.rosso') }};
			opacity: 1;
		}
		.gallery-dett-cta--back {
			position: relative;
			display: inline-flex;
			align-items: center;
			gap: 0;
		}
		.gallery-dett-cta--back::before {
			content: '';
			width: 10px;
			height: 10px;
			border-left: 2px solid #fff;
			border-bottom: 2px solid #fff;
			transform: rotate(45deg);
			opacity: 1;
			margin-right: 8px;
			transition: margin-right 0.25s ease;
		}
		.gallery-dett-cta--back:hover::before {
			margin-right: 12px;
		}
		.gallery-dett-cta--back:hover {
			background: {{ config('app.rosso') }};
			color: #fff !important;
			border-color: {{ config('app.rosso') }};
			opacity: 1;
		}

		.gallery-dett-section {
			margin-bottom: 48px;
		}
		.gallery-dett-gruppo-head {
			margin-bottom: 24px;
		}
		.gallery-dett-gruppo-nome {
			font-size: 30px;
			font-weight: 700;
			color: #111;
			line-height: 1.2;
			margin: 0;
		}
		.gallery-dett-gruppo-line {
			width: 100%;
			height: 1px;
			background: #9D9D9D;
			border: 0;
			margin: 5px 0 0 0;
			padding: 0;
		}
		.gallery-dett-gruppo-sub {
			font-size: 18px;
			font-weight: 400;
			color: #333;
			line-height: 1.45;
			margin: 5px 0 0 0;
			color: #9D9D9D;
		}
		.gallery-dett-grid {
			display: flex;
			flex-wrap: wrap;
			gap: 24px;
			justify-content: left;
			align-items: center;
		}

		/* Toggle vista (Masonry / Griglia) */
		.gallery-dett-viewbar {
			display: flex;
			justify-content: flex-end;
			margin: 10px 0 18px;
		}
		.gallery-dett-view-toggle {
			display: inline-flex;
			gap: 10px;
			align-items: center;
			background: rgba(0, 0, 0, 0.04);
			border-radius: 999px;
			padding: 6px;
		}
		.gallery-dett-view-btn {
			border: 0;
			background: transparent;
			cursor: pointer;
			padding: 8px 14px;
			border-radius: 999px;
			font-weight: 700;
			font-size: 14px;
			letter-spacing: 0.02em;
			color: #111;
			margin-top:0 !important;
		}
		.gallery-dett-view-btn[aria-pressed="true"] {
			background: {{ config('app.rosso') }};
			color: #fff;
		}

		/* Masonry: prioritaria (compatta gli spazi orizzontalmente).
		   Implementazione: CSS Grid + `grid-auto-flow: dense`, row-span calcolato via JS. */
		#pageContainer.view-masonry .gallery-dett-grid {
			/*--masonry-row: 8px;*/
			display: grid;
			grid-template-columns: repeat(3, minmax(0, 1fr));
			gap: 24px;
			grid-auto-rows: var(--masonry-row);
			grid-auto-flow: dense;
			align-items: start;
		}
		@media (max-width: 980px) {
			#pageContainer.view-masonry .gallery-dett-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
		}
		@media (max-width: 620px) {
			#pageContainer.view-masonry .gallery-dett-grid { grid-template-columns: 1fr; }
		}
		#pageContainer.view-masonry .gallery-dett-cell-container {
			width: auto;
			margin: 0;
			aspect-ratio: auto;
			overflow: hidden;
			transform: none;
		}
		#pageContainer.view-masonry .gallery-dett-cell-container:hover {
			transform: none;
		}
		#pageContainer.view-masonry .gallery-dett-cell.glightbox {
			aspect-ratio: auto;
		}
		#pageContainer.view-masonry .gallery-dett-cell.glightbox img {
			height: auto;
			object-fit: initial;
			transition: transform 0.5s ease;
			transform: none;
		}
		#pageContainer.view-masonry .gallery-dett-cell-container:hover .gallery-dett-cell.glightbox img {
			transform: scale(1.05);
		}
		/* in masonry i video NON devono essere zoommati di default */
		#pageContainer.view-masonry .gallery-dett-cell--video {
			transform: none;
		}

		.gallery-dett-cell.glightbox {
			position: relative;
			display: block;
			aspect-ratio: 3 / 2;
			overflow: hidden;
			background: #ececec;
			text-decoration: none;
			color: inherit;
			padding: 0;
			cursor: zoom-in;
		}
		.gallery-dett-cell.glightbox img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}
		.gallery-dett-cell--video{
			transform: scale(1.1);
		}
		.gallery-dett-cell--video .gallery-dett-cell-play {
			position: absolute;
			inset: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			background: rgba(0, 0, 0, 0.2);
			pointer-events: none;
		}
		.gallery-dett-cell-play::after {
			content: '';
			width: 0;
			height: 0;
			border-style: solid;
			border-width: 14px 0 14px 24px;
			border-color: transparent transparent transparent #fff;
			margin-left: 6px;
		}

		/* Nav orizzontale gruppi (sticky + scroll) */
		html.gallery-dett-page {
			scroll-behavior: smooth;
		}
		/* Evitiamo overflow-x sugli antenati: può rompere position: sticky. */
		@media (prefers-reduced-motion: reduce) {
			html.gallery-dett-page { scroll-behavior: auto; }
		}
		.gallery-dett-section[id] {
			scroll-margin-top: min(280px, 38vh);
		}

		.gallery-dett-gruppi-nav-sticky {
			position: sticky;
			top: 106px;
			z-index: 998;
			background: #fff;
			padding: 20px 0 28px;
			margin-bottom: 40px;
			box-shadow: none;
			transition: box-shadow 0.2s ease;
			width: 100%;
			max-width: 100%;
			margin-left: 0;
			box-sizing: border-box;
		}
		.gallery-dett-gruppi-nav-sticky.is-stuck {
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
		}
		.gallery-dett-gruppi-nav-scroll {
			position: relative;
			overflow-x: auto;
			overflow-y: hidden;
			-webkit-overflow-scrolling: touch;
			touch-action: pan-x;
			cursor: grab;
			padding-bottom: 4px;
			scrollbar-width: thin;
			scrollbar-color: #9D9D9D #eee;
		}
		.gallery-dett-gruppi-nav-scroll.is-dragging {
			cursor: grabbing;
			user-select: none;
		}
		.gallery-dett-gruppi-nav-scroll::-webkit-scrollbar {
			height: 6px;
		}
		.gallery-dett-gruppi-nav-scroll::-webkit-scrollbar-thumb {
			background: #c5c5c5;
			border-radius: 3px;
		}
		.gallery-dett-gruppi-nav-items {
			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			align-items: flex-start;
			justify-content: center;
			gap: clamp(24px, 4vw, 56px);
			width: max-content;
			/*min-width: 100%;*/
			margin: 0 auto;
			padding: 0 8px;
			position: relative;
			box-sizing: border-box;
		}
		.gallery-dett-gruppi-nav-items::before {
			content: '';
			position: absolute;
			left: 0;
			right: 0;
			top: 8px;
			height: 1px;
			background: #9D9D9D;
			pointer-events: none;
			z-index: 0;
		}
		.gallery-dett-gruppi-nav-item {
			position: relative;
			z-index: 1;
			flex: 0 0 auto;
			display: flex;
			flex-direction: column;
			align-items: center;
			text-align: center;
			max-width: 220px;
			min-width: 120px;
			text-decoration: none;
			color: #000;
			padding: 0 4px;
		}
		.gallery-dett-gruppi-nav-square {
			width: 16px;
			height: 16px;
			background: #9D9D9D;
			flex-shrink: 0;
			transition: background 0.2s ease;
		}
		.gallery-dett-gruppi-nav-name {
			font-size: 22px;
			font-weight: 700;
			color: #000;
			line-height: 1.2;
			margin-top: 14px;
			display: block;
		}
		.gallery-dett-gruppi-nav-divider {
			width: 100%;
			height: 0;
			margin: 6px 0;
			transition: height 0.2s ease, background 0.2s ease;
		}
		.gallery-dett-gruppi-nav-sub {
			font-size: 16px;
			font-weight: 400;
			color: #000;
			line-height: 1.35;
			margin: 0;
			display: block;
			min-height: 1.35em;
		}
		.gallery-dett-gruppi-nav-item:hover .gallery-dett-gruppi-nav-square,
		.gallery-dett-gruppi-nav-item.is-active .gallery-dett-gruppi-nav-square {
			background: {{ config('app.rosso') }};
		}
		.gallery-dett-gruppi-nav-item:hover .gallery-dett-gruppi-nav-divider,
		.gallery-dett-gruppi-nav-item.is-active .gallery-dett-gruppi-nav-divider {
			height: 1px;
			background: {{ config('app.rosso') }};
		}
		.gallery-dett-cell-container{
			width:calc(33.333% - 24px);
			aspect-ratio: 3 / 2;
			overflow:hidden;
			transition: transform 0.5s ease;
		}
		.gallery-dett-cell-container:hover{
			transform: scale(1.05);
		}
		/* layout_toggle=2: slideup + fadein per i box in viewport */
		#pageContainer.layout-toggle-2-anim .gallery-dett-cell-container{
			opacity: 0;
			transform: translateY(30px) !important;
			will-change: opacity, transform;
			transition: opacity 650ms ease, transform 700ms cubic-bezier(0.22, 1, 0.36, 1);
		}
		#pageContainer.layout-toggle-2-anim .gallery-dett-cell-container.gallery-dett-anim--in{
			opacity: 1;
			transform: translateY(0px) !important;
		}
		#pageContainer.layout-toggle-2-anim .gallery-dett-cell-container:hover{
			transform: translateY(0) scale(1.05);
		}
		@media (prefers-reduced-motion: reduce) {
			#pageContainer.layout-toggle-2-anim .gallery-dett-cell-container{
				opacity: 1;
				transform: none;
				transition: none;
			}
		}

		/* Didascalie GLightbox (titolo + testo dal CMS; markup in body quando il lightbox è aperto) */
		.glightbox-clean .gslide-description{
			background: rgba(0, 0, 0, 0) !important;

		}
		.glightbox-clean .gdesc-inner{
			padding:0 !important;
		}
		html.gallery-dett-page .gslide-title {
			font-size: 1.15rem;
			font-weight: 600;
			color: #fff;
			margin-bottom: 0.35em;
			margin:5px 0 0 0 !important;
		}
		html.gallery-dett-page .gslide-desc {
			font-size: 0.95rem;
			line-height: 1.5;
			color: #333;
		}

		.video-container {
			width: 100%;            /* Prende tutta la larghezza del genitore */
			aspect-ratio: 16 / 9;   /* Mantiene le proporzioni classiche dei video */
			}

			.video-container iframe {
			width: 100%;
			height: 100%;
			display: block;
			}

		/* ─── layout_toggle=2: righe 1–3, larghezza piena, varianti asimmetriche ─── */
		#pageContainer.view-vivace .gallery-dett-grid--vivace {
			display: flex;
			flex-direction: column;
			gap: clamp(18px, 2.8vw, 12px);
			align-items: stretch;
		}
		.gallery-dett-vivace-row {
			display: grid;
			gap: clamp(12px, 1.8vw, 22px);
			width: 100%;
			align-items: stretch;
			min-height: var(--vivace-row-min, clamp(200px, 28vw, 340px));
			transition: transform 0.45s ease, margin 0.45s ease, width 0.45s ease;
		}
		.gallery-dett-vivace-row[data-vh="0"] { --vivace-row-min: clamp(185px, 24vw, 300px); }
		.gallery-dett-vivace-row[data-vh="1"] { --vivace-row-min: clamp(220px, 30vw, 360px); }
		.gallery-dett-vivace-row[data-vh="2"] { --vivace-row-min: clamp(200px, 26vw, 320px); }

		/* Righe “spezzate”: leggero offset per ritmo editoriale */
		/* Default a tre colonne uguali se manca data-vivace-row (fallback) */
		.gallery-dett-vivace-row:not([data-vivace-row]) {
			grid-template-columns: repeat(3, minmax(0, 1fr));
		}

		/* ─── Tre immagini ─── */
		.gallery-dett-vivace-row[data-vivace-row="trio-narrow-mid"] {
			grid-template-columns: minmax(0, 1.25fr) minmax(0, 0.72fr) minmax(0, 1.25fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="trio-narrow-first"] {
			grid-template-columns: minmax(0, 0.62fr) minmax(0, 1.22fr) minmax(0, 1.16fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="trio-narrow-last"] {
			grid-template-columns: minmax(0, 1.16fr) minmax(0, 1.22fr) minmax(0, 0.62fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="trio-weight-right"] {
			grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(0, 1.38fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="trio-weight-left"] {
			grid-template-columns: minmax(0, 1.38fr) minmax(0, 1fr) minmax(0, 1fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="trio-equal"] {
			grid-template-columns: repeat(3, minmax(0, 1fr));
		}
		.gallery-dett-vivace-row[data-vivace-row="trio-golden-flank"] {
			grid-template-columns: minmax(0, 1.32fr) minmax(0, 1fr) minmax(0, 1.32fr);
		}
		/* “Binari” stretti ai lati + centro panoramico */
		.gallery-dett-vivace-row[data-vivace-row="trio-rail"] {
			grid-template-columns: minmax(0, 0.38fr) minmax(0, 1.85fr) minmax(0, 0.38fr);
		}
		/* Editoriale: grande a sinistra, centro, colonna più stretta a destra */
		.gallery-dett-vivace-row[data-vivace-row="trio-magazine"] {
			grid-template-columns: minmax(0, 1.35fr) minmax(0, 1.1fr) minmax(0, 0.72fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="trio-40-35-25"] {
			grid-template-columns: minmax(0, 40fr) minmax(0, 35fr) minmax(0, 25fr);
		}

		/* ─── Due immagini ─── */
		.gallery-dett-vivace-row[data-vivace-row="duo-wide-left"] {
			grid-template-columns: minmax(0, 1.9fr) minmax(0, 1fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-wide-right"] {
			grid-template-columns: minmax(0, 1fr) minmax(0, 1.9fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-golden-left"] {
			grid-template-columns: minmax(0, 1.618fr) minmax(0, 1fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-golden-right"] {
			grid-template-columns: minmax(0, 1fr) minmax(0, 1.618fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-58-42"] {
			grid-template-columns: minmax(0, 58fr) minmax(0, 42fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-62-38"] {
			grid-template-columns: minmax(0, 62fr) minmax(0, 38fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-55-45"] {
			grid-template-columns: minmax(0, 55fr) minmax(0, 45fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-70-30"] {
			grid-template-columns: minmax(0, 70fr) minmax(0, 30fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-30-70"] {
			grid-template-columns: minmax(0, 30fr) minmax(0, 70fr);
		}
		.gallery-dett-vivace-row[data-vivace-row="duo-65-35"] {
			grid-template-columns: minmax(0, 65fr) minmax(0, 35fr);
		}

		/* ─── Una immagine: solo-auto → JS imposta panorama / portrait / neutral ─── */
		.gallery-dett-vivace-row[data-vivace-row="solo-auto"] {
			--vivace-row-min: clamp(280px, 36vw, 440px);
		}
		.gallery-dett-vivace-row[data-vivace-row="solo-panorama"] {
			--vivace-row-min: clamp(260px, 28vw, 380px);
			max-height: clamp(300px, 32vw, 420px);
		}
		.gallery-dett-vivace-row[data-vivace-row="solo-portrait"] {
			--vivace-row-min: clamp(360px, 44vw, 500px);
			max-height: 500px;
		}
		.gallery-dett-vivace-row[data-vivace-row="solo-neutral"] {
			--vivace-row-min: clamp(320px, 38vw, 460px);
			max-height: 480px;
		}

		.gallery-dett-vivace-cell {
			min-width: 0;
			min-height: 0;
			display: flex;
			background: linear-gradient(145deg, #f4f4f4 0%, #e8e8e8 100%);
			box-shadow:
				0 4px 14px rgba(0, 0, 0, 0.07),
				0 1px 0 rgba(255, 255, 255, 0.65) inset;
			transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.4s ease;
		}
		/*.gallery-dett-vivace-cell--shape-0 { border-radius: 20px 8px 20px 8px; }
		.gallery-dett-vivace-cell--shape-1 { border-radius: 8px 20px 8px 20px; }
		.gallery-dett-vivace-cell--shape-2 { border-radius: 14px 14px 4px 14px; }
		.gallery-dett-vivace-cell--shape-3 { border-radius: 4px 14px 14px 14px; }*/

		.gallery-dett-vivace-cell:hover {
			transform: none;
			box-shadow:
				0 14px 36px rgba(0, 0, 0, 0.12),
				0 1px 0 rgba(255, 255, 255, 0.5) inset;
		}
		/* Alcune card leggermente ruotate per ritmo visivo */
		.gallery-dett-vivace-cell[data-vivace-spin="1"] {
			transform: rotate(-0.65deg);
		}
		.gallery-dett-vivace-cell[data-vivace-spin="1"]:hover {
			transform: rotate(0deg);
		}

		#pageContainer.view-vivace .gallery-dett-vivace-cell .gallery-dett-cell-container {
			width: 100%;
			flex: 1;
			min-height: 0;
			aspect-ratio: unset;
			margin: 0;
			overflow: hidden;
			transform: none;
			border-radius: inherit;
		}
		#pageContainer.view-vivace .gallery-dett-vivace-cell .gallery-dett-cell-container:hover {
			transform: none;
		}
		#pageContainer.view-vivace .gallery-dett-vivace-cell .gallery-dett-cell.glightbox {
			width: 100%;
			height: 100%;
			min-height: 100%;
			aspect-ratio: unset;
			border-radius: inherit;
		}
		#pageContainer.view-vivace .gallery-dett-vivace-cell .gallery-dett-cell--video {
			transform: none;
		}
		#pageContainer.view-vivace .gallery-dett-vivace-row:not([data-vivace-row^="solo-"]) .gallery-dett-cell img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			object-position: center center;
			display: block;
			transform: scale(1);
			transition: transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
		}
		#pageContainer.view-vivace .gallery-dett-vivace-row:not([data-vivace-row^="solo-"]) .gallery-dett-vivace-cell:hover .gallery-dett-cell img {
			transform: scale(1.09);
		}
		/* Singola: zoom leggero fisso = “finestra” sulla parte centrale dell’immagine */
		#pageContainer.view-vivace .gallery-dett-vivace-row[data-vivace-row^="solo-"] .gallery-dett-cell img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			object-position: center center;
			display: block;
			transform: scale(1.14);
			transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
		}
		#pageContainer.view-vivace .gallery-dett-vivace-row[data-vivace-row^="solo-"] .gallery-dett-vivace-cell:hover .gallery-dett-cell img {
			transform: scale(1.24);
		}

		@media (max-width: 720px) {
			#pageContainer.view-vivace .gallery-dett-vivace-row {
				grid-template-columns: 1fr !important;
				margin-left: 0 !important;
				width: 100% !important;
				max-height: none !important;
			}
			#pageContainer.view-vivace .gallery-dett-vivace-cell[data-vivace-spin="1"] {
				transform: none;
			}
			#pageContainer.view-vivace .gallery-dett-vivace-cell[data-vivace-spin="1"]:hover {
				transform: none;
			}
			.gallery-dett-grid{
				gap: 12px;
			}
			.gallery-dett-cell-container{
				width:calc(50% - 12px);
			}
		}
	</style>

	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer" data-gallery-layout-toggle="{{ $showGalleryLayoutToggle ? '1' : '0' }}" data-gallery-layout-mode="{{ (int) $galleryLayoutMode }}">
		<div class="mainTextContainer" style="margin-bottom:20px; margin-top:120px; text-align:center;">
            <h1 class="gallery-dett-title">{{ $gallery->nome ?? '' }}</h1>
            @if(!empty($gallery->sottotitolo))
                <p class="gallery-dett-sub">{{ $gallery->sottotitolo }}</p>
            @endif
            @if(!empty($gallery->luogo))
                <p class="gallery-dett-luogo">{{ $gallery->luogo }}</p>
            @endif
        </div>
        @if($heroMedia)
			<div class="gallery-dett-hero">
				@if(($heroMedia->tipo ?? '') === 'video' && !empty($heroMedia->img))
					<div class="video-container">
						<iframe 
							src="https://www.youtube.com/embed/{{ $heroMedia->img }}?autoplay=1&mute=1&controls=1&fs=1&playsinline=1&modestbranding=1&rel=0&enablejsapi=1" 
							title="YouTube video player" 
							frameborder="0" 
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
							referrerpolicy="strict-origin-when-cross-origin" 
							allowfullscreen>
						</iframe>
					</div>
					<?php /*<div class="gallery-dett-hero-inner gallery-dett-hero-inner--video">
						<div class="gallery-dett-hero-video-crop">
							<iframe
								class="gallery-dett-hero-video"
								src="https://www.youtube.com/embed/{{ $heroMedia->img }}?autoplay=1&mute=1&controls=1&fs=1&playsinline=1&modestbranding=1&rel=0&enablejsapi=1"
								title="{{ e($gallery->nome ?? 'Video') }}"
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
								allowfullscreen
								loading="eager"
							></iframe>
						</div>
					</div>*/?>
				@elseif(!empty($heroMedia->img))
					<div class="gallery-dett-hero-inner gallery-dett-hero-inner--image">
						<img
							class="gallery-dett-hero-img"
							src="{{ asset('resarea/img_up/media/' . $heroMedia->img) }}"
							alt="{{ e($gallery->nome ?? '') }}"
						>
					</div>
				@endif
			</div>
		@endif

		<div class="mainTextContainer" style="margin-bottom:48px; text-align:center;">			

			@if(!empty($gallery->testo))
				<div class="gallery-dett-body">
					{!! $gallery->testo !!}
				</div>
			@endif

			@if($pulsanteHref && $pulsanteTesto)
				<a class="gallery-dett-cta" href="{{ $pulsanteHref }}">{{ $pulsanteTesto }}</a>
			@endif
		</div>

		@php
			// Evita duplicazione: il media usato nell'hero non viene ripetuto nella griglia sottostante.
			$gruppiWithMediaRender = $gruppiWithMedia;
			if (!empty($heroMedia)) {
				$heroId = (int) ($heroMedia->id ?? 0);
				$heroTipo = (string) ($heroMedia->tipo ?? '');
				$heroImg = (string) ($heroMedia->img ?? '');
				$heroRemoved = false;
				foreach ($gruppiWithMediaRender as $gk => $blk) {
					$mediaList = collect($blk['media'] ?? [])->values()->all();
					$filtered = [];
					foreach ($mediaList as $mItem) {
						$isHeroMatch = false;
						if (!$heroRemoved) {
							$mId = (int) ($mItem->id ?? 0);
							if ($heroId > 0 && $mId > 0) {
								$isHeroMatch = ($mId === $heroId);
							} else {
								$isHeroMatch = ((string) ($mItem->tipo ?? '') === $heroTipo) && ((string) ($mItem->img ?? '') === $heroImg);
							}
						}
						if ($isHeroMatch) {
							$heroRemoved = true;
							continue;
						}
						$filtered[] = $mItem;
					}
					$gruppiWithMediaRender[$gk]['media'] = $filtered;
				}
			}

			$showGruppiNav = false;
			foreach ($gruppiWithMediaRender as $blkNav) {
				$grp = $blkNav['gruppo'] ?? null;
				if (!$grp) { continue; }
				if (empty($blkNav['media'] ?? [])) { continue; }
				$nomeNorm = mb_strtolower(trim(preg_replace('/\s+/u', ' ', (string) ($grp->nome ?? ''))), 'UTF-8');
				$isDefault = ((int) ($grp->is_default ?? 0) === 1) || ($nomeNorm === 'media senza sezione');
				if (!$isDefault) { $showGruppiNav = true; break; }
			}
		@endphp

		@if($showGruppiNav && $showGallerySezioni)
			<div class="gallery-dett-gruppi-nav-sticky" id="galleryGruppiNavSticky">
				<div class="mainTextContainer" style="margin:0 auto;">
					<div class="gallery-dett-gruppi-nav-scroll" id="galleryGruppiNavScroll" role="navigation" aria-label="Sezioni gallery">
						<div class="gallery-dett-gruppi-nav-items">
							@foreach($gruppiWithMediaRender as $blockNav)
								@if(empty($blockNav['media'] ?? []))
									@continue
								@endif
								@php 
									$gn = $blockNav['gruppo']; 
									$slugGallery = Str::slug($gallery->nome ?? 'gallery', '-', 'it');
									$slugGruppo = Str::slug($gn->nome ?? 'gruppo', '-', 'it');
								@endphp
								<a
									class="gallery-dett-gruppi-nav-item"
									href="/foto_video_gallery/{{ $slugGallery }}-{{ $gallery->id }}.html{{ $galleryDettQuerySuffix }}#{{ $slugGruppo }}-{{ $gn->id }}"
									data-gruppo-id="{{ $gn->id }}"
								>
									<span class="gallery-dett-gruppi-nav-square" aria-hidden="true"></span>
									<span class="gallery-dett-gruppi-nav-name">{{ $gn->nome ?? 'Media' }}</span>
									<span class="gallery-dett-gruppi-nav-divider" aria-hidden="true"></span>
									<span class="gallery-dett-gruppi-nav-sub">{{ $gn->sottotitolo ?? '' }}</span>
								</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		@endif

		<div class="mainTextContainer" style="margin-bottom:100px;">
			@if($showGalleryLayoutToggle)
				<div class="gallery-dett-viewbar" aria-label="Vista anteprime">
					<div class="gallery-dett-view-toggle" role="group" aria-label="Seleziona vista">
						<button type="button" class="gallery-dett-view-btn" data-view="masonry" aria-pressed="false" title="Vista mosaico" aria-label="Vista mosaico">Mosaico</button>
						<button type="button" class="gallery-dett-view-btn" data-view="grid" aria-pressed="true" title="Vista griglia" aria-label="Vista griglia">Griglia</button>
					</div>
				</div>
			@endif

			@php $lbGallery = 'gallery-dett-' . (int) ($gallery->id ?? 0); @endphp
			@if($showGalleryVivace)
				@if($showGallerySezioni)
					@foreach($gruppiWithMediaRender as $block)
						@if(empty($block['media'] ?? []))
							@continue
						@endif
						@php
							$g = $block['gruppo'];
							$nomeGruppoNorm = mb_strtolower(trim(preg_replace('/\s+/u', ' ', (string) ($g->nome ?? ''))), 'UTF-8');
							$nascondiTitoloGruppoDefault = ((int) ($g->is_default ?? 0) === 1) || ($nomeGruppoNorm === 'media senza sezione');
							$slugGruppo = Str::slug($g->nome ?? 'gruppo', '-', 'it');
							$vivaceSeed = (int) (crc32((string) ($gallery->id ?? 0) . '-' . ($g->id ?? 0) . '-dett-vivace') & 0x7fffffff);
							$vivaceRows = $galleryDettVivacePartition($block['media'] ?? [], $vivaceSeed);
						@endphp
						<section id="{{ $slugGruppo }}-{{ $g->id }}" class="gallery-dett-section">
							@if(!$nascondiTitoloGruppoDefault)
								<header class="gallery-dett-gruppo-head">
									<div class="gallery-dett-gruppo-nome">{{ $g->nome ?? 'Media' }}</div>
									<hr class="gallery-dett-gruppo-line" />
									@if(!empty($g->sottotitolo))
										<p class="gallery-dett-gruppo-sub">{{ $g->sottotitolo }}</p>
									@endif
								</header>
							@endif
							<div class="gallery-dett-grid gallery-dett-grid--vivace">
								@foreach($vivaceRows as $rIndex => $row)
									@php
										$nc = count($row);
										$rowSeed = (int) (crc32((string) ($gallery->id ?? 0) . '-' . ($g->id ?? 0) . '-r' . $rIndex) & 0x7fffffff);
										$vh = $rowSeed % 3;
										$vRow = $galleryDettVivaceRowVariant($nc, $rowSeed);
										$slotDefs = $galleryDettVivaceRowSlotDefs($vRow, $nc);
									@endphp
									<div class="gallery-dett-vivace-row" data-vivace-row="{{ $vRow }}" data-vh="{{ $vh }}">
										@foreach($row as $ci => $m)
											@php
												$spin = (($rowSeed + $ci * 17) % 11 === 0) ? '1' : '0';
												$sd = $slotDefs[$ci] ?? ['slot' => 'mid', 'w' => 2];
											@endphp
											<div
												class="gallery-dett-vivace-cell"
												data-vivace-spin="{{ $spin }}"
												data-vivace-slot="{{ $sd['slot'] }}"
												data-vivace-slot-w="{{ (int) ($sd['w'] ?? 2) }}"
											>
												@include('web.partials.gallery_dett_media_cell', ['m' => $m, 'lbGallery' => $lbGallery])
											</div>
										@endforeach
									</div>
								@endforeach
							</div>
						</section>
					@endforeach
				@else
					@php
						$flatMedia = [];
						foreach ($gruppiWithMediaRender as $blockF) {
							foreach ($blockF['media'] ?? [] as $mF) {
								$flatMedia[] = $mF;
							}
						}
						$vivaceSeedFlat = (int) (crc32((string) ($gallery->id ?? 0) . '-dett-vivace-flat') & 0x7fffffff);
						$vivaceRowsFlat = $galleryDettVivacePartition($flatMedia, $vivaceSeedFlat);
					@endphp
					<div class="gallery-dett-grid gallery-dett-grid--vivace">
						@foreach($vivaceRowsFlat as $rIndex => $row)
							@php
								$nc = count($row);
								$rowSeed = (int) (crc32((string) ($gallery->id ?? 0) . '-flat-r' . $rIndex) & 0x7fffffff);
								$vh = $rowSeed % 3;
								$vRow = $galleryDettVivaceRowVariant($nc, $rowSeed);
								$slotDefs = $galleryDettVivaceRowSlotDefs($vRow, $nc);
							@endphp
							<div class="gallery-dett-vivace-row" data-vivace-row="{{ $vRow }}" data-vh="{{ $vh }}">
								@foreach($row as $ci => $m)
									@php
										$spin = (($rowSeed + $ci * 17) % 11 === 0) ? '1' : '0';
										$sd = $slotDefs[$ci] ?? ['slot' => 'mid', 'w' => 2];
									@endphp
									<div
										class="gallery-dett-vivace-cell"
										data-vivace-spin="{{ $spin }}"
										data-vivace-slot="{{ $sd['slot'] }}"
										data-vivace-slot-w="{{ (int) ($sd['w'] ?? 2) }}"
									>
										@include('web.partials.gallery_dett_media_cell', ['m' => $m, 'lbGallery' => $lbGallery])
									</div>
								@endforeach
							</div>
						@endforeach
					</div>
				@endif
			@elseif($showGallerySezioni)
				@foreach($gruppiWithMediaRender as $block)
					@if(empty($block['media'] ?? []))
						@continue
					@endif
					@php
						$g = $block['gruppo'];
						$nomeGruppoNorm = mb_strtolower(trim(preg_replace('/\s+/u', ' ', (string) ($g->nome ?? ''))), 'UTF-8');
						$nascondiTitoloGruppoDefault = ((int) ($g->is_default ?? 0) === 1) || ($nomeGruppoNorm === 'media senza sezione');
						$slugGruppo = Str::slug($g->nome ?? 'gruppo', '-', 'it');
					@endphp
					<section id="{{ $slugGruppo }}-{{ $g->id }}" class="gallery-dett-section">
						@if(!$nascondiTitoloGruppoDefault)
							<header class="gallery-dett-gruppo-head">
								<div class="gallery-dett-gruppo-nome">{{ $g->nome ?? 'Media' }}</div>
								<hr class="gallery-dett-gruppo-line" />
								@if(!empty($g->sottotitolo))
									<p class="gallery-dett-gruppo-sub">{{ $g->sottotitolo }}</p>
								@endif
							</header>
						@endif
						<div class="gallery-dett-grid">
							@foreach($block['media'] as $m)
								@include('web.partials.gallery_dett_media_cell', ['m' => $m, 'lbGallery' => $lbGallery])
							@endforeach
						</div>
					</section>
				@endforeach
			@else
				<div class="gallery-dett-grid">
					@foreach($gruppiWithMediaRender as $block)
						@foreach($block['media'] as $m)
							@include('web.partials.gallery_dett_media_cell', ['m' => $m, 'lbGallery' => $lbGallery])
						@endforeach
					@endforeach
				</div>
			@endif
		</div>
	</div>
	
	<div style="position:fixed; bottom:-40px; right:10px; z-index:1000;">
	    <a class="gallery-dett-cta gallery-dett-cta--back" href="foto_video_gallery.html" title="Torna Indietro">INDIETRO</a>
	</div>

	<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.documentElement.classList.add('gallery-dett-page');

		// layout_toggle=2: slideup + fadein progressivi sui box.
		(function () {
			const page = document.getElementById('pageContainer');
			if (!page) return;
			// Attiva anche con URL “pulito” quando il layout effettivo è vivace.
			const layoutMode = parseInt(page.getAttribute('data-gallery-layout-mode') || '0', 10);
			if (layoutMode !== 2) return;

			const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			page.classList.add('layout-toggle-2-anim');

			const items = Array.from(page.querySelectorAll('.gallery-dett-cell-container'));
			if (!items.length) return;

			if (prefersReduced) {
				items.forEach((el) => el.classList.add('gallery-dett-anim--in'));
				return;
			}

			function applyDelays() {
				const rowMap = new Map();
				items.forEach((el) => {
					const key = Math.round((el.offsetTop || 0) / 220);
					if (!rowMap.has(key)) rowMap.set(key, []);
					rowMap.get(key).push(el);
				});
				Array.from(rowMap.keys()).sort((a, b) => a - b).forEach((rowKey) => {
					const rowEls = rowMap.get(rowKey).sort((a, b) => (a.offsetLeft || 0) - (b.offsetLeft || 0));
					rowEls.forEach((el, idx) => {
						el.style.transitionDelay = `${idx * 80}ms`;
					});
				});
			}

			applyDelays();
			const observer = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) return;
					entry.target.classList.add('gallery-dett-anim--in');
					observer.unobserve(entry.target);
				});
			}, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });

			items.forEach((el) => observer.observe(el));
			window.addEventListener('resize', applyDelays, { passive: true });
		})();

		// layout_mode 1 = barra Mosaico/Griglia; 2 = vivace; 0 = griglia fissa senza barra
		(function () {
			const container = document.getElementById('pageContainer');
			if (!container) return;

			const layoutMode = parseInt(container.getAttribute('data-gallery-layout-mode') || '0', 10);
			const KEY = 'gallery_dett_view';
			const btns = Array.from(container.querySelectorAll('.gallery-dett-view-btn[data-view]'));
			const allowed = new Set(['masonry', 'grid']);
			const grids = () => Array.from(container.querySelectorAll('.gallery-dett-grid'));

			function clearAllMasonrySpans() {
				document.querySelectorAll('.gallery-dett-cell-container').forEach(function (item) {
					item.style.gridRowEnd = '';
				});
			}

			if (layoutMode !== 1) {
				container.classList.toggle('view-vivace', layoutMode === 2);
				container.classList.add('view-grid');
				container.classList.remove('view-masonry');
				clearAllMasonrySpans();
				return;
			}
			container.classList.remove('view-vivace');

			function getSpanForHeight(gridEl, itemHeight) {
				const cs = window.getComputedStyle(gridEl);
				const row = parseFloat(cs.getPropertyValue('grid-auto-rows')) || 8;
				const gap = parseFloat(cs.getPropertyValue('row-gap')) || parseFloat(cs.getPropertyValue('grid-row-gap')) || 24;
				return Math.max(1, Math.ceil((itemHeight + gap) / (row + gap)));
			}

			function layoutMasonry() {
				if (!container.classList.contains('view-masonry')) return;
				grids().forEach((gridEl) => {
					const items = Array.from(gridEl.querySelectorAll(':scope > .gallery-dett-cell-container'));
					items.forEach((item) => {
						const anchor = item.querySelector('.gallery-dett-cell.glightbox');
						const h = anchor ? anchor.getBoundingClientRect().height : item.getBoundingClientRect().height;
						const span = getSpanForHeight(gridEl, h);
						item.style.gridRowEnd = `span ${span}`;
					});
				});
			}

			function clearMasonry() {
				grids().forEach((gridEl) => {
					const items = Array.from(gridEl.querySelectorAll(':scope > .gallery-dett-cell-container'));
					items.forEach((item) => {
						item.style.gridRowEnd = '';
					});
				});
			}

			let rafId = 0;
			function scheduleLayout() {
				if (!container.classList.contains('view-masonry')) return;
				if (rafId) cancelAnimationFrame(rafId);
				rafId = requestAnimationFrame(() => {
					rafId = 0;
					layoutMasonry();
				});
			}

			function setView(view) {
				const v = allowed.has(view) ? view : 'grid';
				container.classList.toggle('view-masonry', v === 'masonry');
				container.classList.toggle('view-grid', v === 'grid');
				btns.forEach((b) => b.setAttribute('aria-pressed', b.getAttribute('data-view') === v ? 'true' : 'false'));
				try { localStorage.setItem(KEY, v); } catch (e) {}
				if (v === 'masonry') {
					scheduleLayout();
				} else {
					clearMasonry();
				}
			}

			let initial = 'grid';
			try {
				const stored = localStorage.getItem(KEY);
				if (stored && allowed.has(stored)) initial = stored;
			} catch (e) {}
			setView(initial);

			// ricalcola quando le immagini finiscono di caricare
			container.querySelectorAll('.gallery-dett-grid img').forEach((img) => {
				if (img.complete) return;
				img.addEventListener('load', scheduleLayout, { passive: true });
			});

			let resizeT = 0;
			window.addEventListener('resize', function () {
				if (!container.classList.contains('view-masonry')) return;
				window.clearTimeout(resizeT);
				resizeT = window.setTimeout(scheduleLayout, 120);
			}, { passive: true });

			btns.forEach((b) => {
				b.addEventListener('click', function () {
					setView(b.getAttribute('data-view'));
				});
			});
		})();

		(function galleryDettVivaceAspectFit() {
			const container = document.getElementById('pageContainer');
			if (!container) return;
			const layoutMode = parseInt(container.getAttribute('data-gallery-layout-mode') || '0', 10);
			if (layoutMode !== 2) return;

			const grids = container.querySelectorAll('.gallery-dett-grid--vivace');
			if (!grids.length) return;

			function cellAspectRatio(cell) {
				const img = cell.querySelector('.gallery-dett-cell img');
				if (!img || !img.naturalWidth || !img.naturalHeight) {
					return null;
				}
				return img.naturalWidth / img.naturalHeight;
			}

			function layoutVivaceRow(row) {
				const cells = Array.from(row.querySelectorAll(':scope > .gallery-dett-vivace-cell'));
				if (!cells.length) {
					return;
				}

				const rowKind = row.getAttribute('data-vivace-row') || '';
				if (cells.length === 1 && rowKind === 'solo-auto') {
					const r = cellAspectRatio(cells[0]);
					let next = 'solo-neutral';
					if (r != null) {
						if (r >= 1.38) {
							next = 'solo-panorama';
						} else if (r <= 0.88) {
							next = 'solo-portrait';
						}
					}
					row.setAttribute('data-vivace-row', next);
					return;
				}

				const slotStrs = cells.map((c) => c.getAttribute('data-vivace-slot') || 'mid');
				if (!slotStrs.some((s) => s === 'wide' || s === 'narrow')) {
					return;
				}

				const items = cells.map((cell, i) => ({
					cell,
					slot: cell.getAttribute('data-vivace-slot') || 'mid',
					w: parseInt(cell.getAttribute('data-vivace-slot-w') || '2', 10) || 2,
					ratio: cellAspectRatio(cell),
					i,
				}));

				if (items.some((it) => it.ratio == null)) {
					return;
				}

				let pool = items.slice().sort((a, b) => a.ratio - b.ratio);
				const assignment = new Array(cells.length);

				items.forEach((it, idx) => {
					if (it.slot === 'narrow') {
						assignment[idx] = pool.shift();
					}
				});

				const wideOrder = items
					.map((it, idx) => ({ idx, w: it.w, slot: it.slot }))
					.filter((x) => x.slot === 'wide')
					.sort((a, b) => b.w - a.w || a.idx - b.idx);

				wideOrder.forEach(({ idx }) => {
					assignment[idx] = pool.pop();
				});

				items.forEach((it, idx) => {
					if (it.slot === 'mid') {
						assignment[idx] = pool.shift();
					}
				});

				if (pool.length) {
					return;
				}

				const ordered = assignment.map((x) => x.cell);
				const frag = document.createDocumentFragment();
				ordered.forEach((c) => frag.appendChild(c));
				row.appendChild(frag);
			}

			function runVivaceFit() {
				grids.forEach((g) => {
					g.querySelectorAll(':scope > .gallery-dett-vivace-row').forEach(layoutVivaceRow);
				});
			}

			const vivaceImgs = container.querySelectorAll('.gallery-dett-grid--vivace img');
			let pending = 0;
			vivaceImgs.forEach((img) => {
				if (img.complete && img.naturalWidth > 0) {
					return;
				}
				pending++;
				const done = function () {
					pending--;
					if (pending <= 0) {
						runVivaceFit();
					}
				};
				img.addEventListener('load', done, { once: true });
				img.addEventListener('error', done, { once: true });
			});
			if (pending === 0) {
				runVivaceFit();
			}
			window.addEventListener('load', function () {
				runVivaceFit();
			}, { once: true });
		})();

		if (typeof GLightbox === 'undefined') return;
		if (!document.querySelector('#pageContainer .glightbox')) return;
		GLightbox({
			selector: '#pageContainer .glightbox',
			touchNavigation: true,
			loop: true,
		});
	});
	</script>

	@if($showGruppiNav && $showGallerySezioni)
	<script>
	(function () {
		const scrollEl = document.getElementById('galleryGruppiNavScroll');
		const navSticky = document.getElementById('galleryGruppiNavSticky');
		const sections = document.querySelectorAll('#pageContainer .gallery-dett-section[id]');
		const links = document.querySelectorAll('.gallery-dett-gruppi-nav-item');
		/** Allineato a .gallery-dett-gruppi-nav-sticky { top } (sotto header fisso) */
		const STICKY_TOP_PX = 106;

		function hashFromHref(href) {
			if (!href) return '';
			const s = String(href);
			const i = s.indexOf('#');
			return i >= 0 ? decodeURIComponent(s.slice(i + 1)) : '';
		}

		function setActiveById(id) {
			if (!id) return;
			links.forEach(function (a) {
				a.classList.toggle('is-active', hashFromHref(a.getAttribute('href')) === id);
			});
		}

		function updateActiveFromScroll() {
			if (!navSticky || !sections.length) return;
			const thresholdY = navSticky.getBoundingClientRect().bottom + 20;
			let current = sections[0].id;
			sections.forEach(function (sec) {
				if (sec.getBoundingClientRect().top <= thresholdY) {
					current = sec.id;
				}
			});
			setActiveById(current);
		}

		function updateStickyPinnedState() {
			if (!navSticky) return;
			const r = navSticky.getBoundingClientRect();
			var pinned = r.top <= STICKY_TOP_PX + 0.75 && r.bottom > STICKY_TOP_PX + 24;
			navSticky.classList.toggle('is-stuck', pinned);
		}

		let scrollTick = false;
		window.addEventListener('scroll', function () {
			if (scrollTick) return;
			scrollTick = true;
			requestAnimationFrame(function () {
				scrollTick = false;
				updateActiveFromScroll();
				updateStickyPinnedState();
			});
		}, { passive: true });

		window.addEventListener('resize', function () {
			updateStickyPinnedState();
		}, { passive: true });

		updateActiveFromScroll();
		updateStickyPinnedState();

		function syncActiveFromHash() {
			const h = hashFromHref(window.location.href);
			if (h && document.getElementById(h)) {
				setActiveById(h);
			}
		}
		window.addEventListener('hashchange', syncActiveFromHash);

		let dragMoved = false;
		let isDown = false;
		let startX = 0;
		let scrollLeftStart = 0;

		if (scrollEl) {
			scrollEl.addEventListener('mousedown', function (e) {
				if (e.button !== 0) return;
				isDown = true;
				dragMoved = false;
				startX = e.pageX;
				scrollLeftStart = scrollEl.scrollLeft;
				scrollEl.classList.add('is-dragging');
			});
			window.addEventListener('mouseup', function () {
				isDown = false;
				scrollEl.classList.remove('is-dragging');
			});
			scrollEl.addEventListener('mouseleave', function () {
				isDown = false;
				scrollEl.classList.remove('is-dragging');
			});
			scrollEl.addEventListener('mousemove', function (e) {
				if (!isDown) return;
				const dx = e.pageX - startX;
				if (Math.abs(dx) > 6) dragMoved = true;
				scrollEl.scrollLeft = scrollLeftStart - dx;
				e.preventDefault();
			});
			scrollEl.addEventListener('click', function (e) {
				const a = e.target.closest('.gallery-dett-gruppi-nav-item');
				if (!a) return;
				if (dragMoved) {
					e.preventDefault();
					e.stopPropagation();
					return;
				}
				const fragment = hashFromHref(a.getAttribute('href'));
				if (!fragment) return;
				const target = document.getElementById(fragment);
				if (!target) return;
				e.preventDefault();
				const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
				target.scrollIntoView({ behavior: prefersReduced ? 'auto' : 'smooth', block: 'start' });
				if (history.replaceState) {
					const path = window.location.pathname + window.location.search + '#' + fragment;
					history.replaceState(null, '', path);
				}
				setActiveById(target.id);
			});
		}
	})();
	</script>
	@endif
@endsection
