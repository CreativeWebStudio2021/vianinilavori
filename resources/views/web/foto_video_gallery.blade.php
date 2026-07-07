@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "VIDEO E FOTO GALLERY";
		$img_background="web/images/testata_media_gallery_2.png";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='Chi Siamo'; $breadcrumbs[$x]['link']=''; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
		$rosso = config('app.rosso');
		$galleryCards = $galleryCards ?? [];
		$tagsCategoria = $tagsCategoria ?? collect();
		$tagsContenuto = $tagsContenuto ?? collect();
		/** Ordine priorità: primo tag presente sulla gallery che corrisponde → icona (categorie in media_tag) */
		$galleryTagIconOrder = [
			'Ferrovie' => 'ferrovie_b.jpg',
			'Metropolitane' => 'metro_b.jpg',
			'Strade' => 'strade_b.jpg',
			'Edilizia civile e industriale' => 'edilizia_b.jpg',
			'Ciclo idrico integrato' => 'idrico_b.jpg',
			'Canali e acquedotti' => 'canali_b.jpg',
			'Dighe e impianti idroelettrici' => 'dighe_b.jpg',
			'Infrastrutture di trasporti' => 'trasporti_b.jpg',
		];
		$tagNomeById = $tagsCategoria->merge($tagsContenuto)->keyBy('id');
	@endphp
	@include('web.common.page_title')

	<style>
		.page-header-section {
			height:400px;
		}
		.mainTextContainer {
			width: calc(100% - 600px) !important;
			margin: 0 auto;
		}
		@media screen and (max-width:1600px){
			.mainTextContainer { width:calc(100% - 400px) !important; }
		}
		@media screen and (max-width:1468px){
			.mainTextContainer { width:calc(100% - 200px) !important; }
		}
		@media screen and (max-width:650px){
			.mainTextContainer { width:calc(100% - 100px) !important; }
		}

		#pageContainer {
			background: url(web/images/v_grigia.png) no-repeat top center;
			background-attachment: scroll;
			position: relative;
			z-index: 1;
			overflow: hidden;
		}
		#pageContainer::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: url(web/images/v_grigia.png) no-repeat top center;
			transform-origin: top center;
			z-index: 0;
			pointer-events: none;
			opacity: 0;
			animation: bgPulse 4s ease-in-out infinite;
		}
		@keyframes bgPulse {
			0% { transform: scaleY(1) scaleX(1); opacity: .7; }
			100% { transform: scaleY(2) scaleX(1.75); opacity: 0; }
		}

		.gallery-page-container {
			width: 100%;
			margin: 0 auto 80px auto;
			position: relative;
			z-index: 2;
		}

		.gallery-grid {
			display: grid;
			grid-template-columns: repeat(3, minmax(0, 1fr));
			gap: 30px;
		}

		.gallery-card {
			grid-column: span 1;
			text-decoration: none;
			color: #111;
			--preview-scale: 1.05;
			--title-shift-x: 0px;
		}

		/* Slideup + fadein (riuso logica JS già presente) */
		.gallery-card.gallery-card-anim {
			opacity: 0;
			transform: translateY(16px);
			will-change: opacity, transform;
			transition: opacity 650ms ease, transform 700ms cubic-bezier(0.22, 1, 0.36, 1);
		}
		.gallery-card.gallery-card-anim--in {
			opacity: 1;
			transform: translateY(0);
		}
		@media (prefers-reduced-motion: reduce) {
			.gallery-card.gallery-card-anim {
				opacity: 1;
				transform: none;
				transition: none;
			}
		}

		.gallery-preview {
			position: relative;
			aspect-ratio: 3 / 2;
			overflow: hidden;
			background: #ececec;
			transition: transform 0.9s ease;
			transform-origin: center center;
		}

		.gallery-preview-image,
		.gallery-preview iframe {
			position: absolute;
			inset: 0;
			width: 100%;
			height: 100%;
		}

		.gallery-preview-image {
			object-fit: cover;
			transition: opacity 0.7s ease, transform 0.9s cubic-bezier(0.22, 1, 0.36, 1);
            opacity:1;
			z-index: 2;
			transform: scale(1);
			transform-origin: center center;
		}

		.gallery-preview-placeholder {
			position: absolute;
			inset: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			background: #d9d9d9;
			color: #666;
			font-size: 14px;
			font-weight: 600;
			letter-spacing: 0.04em;
		}

		.gallery-preview iframe {
			border: 0;
			pointer-events: none;
			z-index: 1;
		}

		/* Titolo + linea + città (+ icona categoria): spostamento hover unico */
		.gallery-card-meta {
			display: flex;
			flex-direction: row;
			align-items: start;
			gap: 10px;
			margin-top: 14px;
			transition: transform 0.9s ease;
			transform: translateX(0);
		}

		.gallery-card-cat-icon {
			flex-shrink: 0;
			display: block;
			width: auto;
			height: 40px;
			max-height: 40px;
			object-fit: contain;
			/* align-self: center; */
		}

		.gallery-card-meta-text {
			display: flex;
			flex-direction: column;
			gap: 5px;
			min-width: 0;
			flex: 1;
		}

		.gallery-card-title {
			margin-top: 0;
			line-height: 1;
			font-size: 28px;
			text-transform: uppercase;
			font-weight: 700;
			position: relative;
			display: inline-block;
			padding-bottom: 3px;
		}

		.gallery-card-luogo {
			margin-top: 0px;
			font-size: 14px;
			font-weight: 500;
			color: #666;
			text-transform: uppercase;
			position: relative;
			display: inline-block;
			padding-bottom: 8px;
		}

		.gallery-card-title::after {
			content: "";
			position: absolute;
			left: 0;
			bottom: 0;
			width: 0;
			height: 2px;
			background: #e30613;
			transition: width 0.5s ease;
		}

		.gallery-card:hover .gallery-preview {
			transform: scale(var(--preview-scale));
		}
		.gallery-card:hover .gallery-preview-image {
			transform: scale(1.06);
		}

		.gallery-card:hover .gallery-card-title::after {
			width: 100%;
		}

		.gallery-card:hover .gallery-card-meta {
			transform: translateX(var(--title-shift-x));
		}

        .gallery-card.is-video .gallery-preview img {
			opacity: 1;
		}
        .gallery-card.is-video:hover .gallery-preview img {
			opacity: 0;
		}

		/* 3 colonne → 2 colonne a 1024px */
		@media screen and (max-width: 1024px) {
			.gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 24px; }
			.gallery-card { grid-column: span 1; }
			.gallery-card-title { font-size: 20px; }
		}
		/* 2 colonne → 1 colonna a 560px */
		@media screen and (max-width: 560px) {
			.gallery-grid { grid-template-columns: 1fr; gap: 20px; }
		}

		.filtriGalleryContainer {
			position:relative;
			display:flex;
			width: fit-content;
			max-width: 450px;
			flex-wrap: wrap;
			margin:0 auto;
            justify-content:center;
            align-items:center;
            gap:30px;
            background:#fff;
            box-shadow:0 4px 4px 0 rgba(0, 0, 0, 0.25);
            z-index:100;
            margin-bottom:90px;
		}
        .filtriGalleryContainer h4{
            margin:0;
            padding:0;
            line-height:1;
            font-size:15px;
            font-weight:700;
            cursor:pointer;
        }

		.gallery-filter-pill {
			padding: 3px 5px;
			text-align: center;
			cursor: pointer;
			user-select: none;
			transition: background 0.2s, color 0.2s, opacity 0.2s;
		}
		.gallery-filter-pill.is-active {
			background: {{ $rosso }};
			color: #fff;
		}
		.gallery-filter-pill.is-disabled {
			opacity: 0.55;
			cursor: pointer;
        }

		.gallery-filter-icon-btn {
			cursor: pointer;
			user-select: none;
			transition: opacity 0.2s;
		}
		.gallery-filter-icon-btn:hover {
			opacity: 0.85;
		}

		.gallery-filter-backdrop {
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.45);
			z-index: 100100;
			opacity: 0;
			visibility: hidden;
			transition: opacity 0.3s ease, visibility 0.3s ease;
		}
		.gallery-filter-backdrop.is-open {
			opacity: 1;
			visibility: visible;
		}

		.gallery-filter-panel {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			/*height: 60vh;*/
			min-height: 420px;
			max-height: 90vh;
			background: #fff;
			box-shadow: 0 8px 24px rgba(0,0,0,0.18);
			z-index: 10000101;
			transform: translateY(-100%);
			transition: transform 1s ease;
			overflow: auto;
			display: flex;
			flex-direction: column;
		}
		.gallery-filter-panel.is-open {
			transform: translateY(0);
		}

		.gallery-filter-panel-inner {
			flex: 1;
			display: grid;
			/* 2 colonne principali + ricerca un po' più stretta */
			grid-template-columns: 0.7fr 1fr 1fr;
			gap: 30px;
			padding: 140px 0;
			align-items: start;
			background-image: url(web/images/v_grigia2.png);
			background-repeat: no-repeat;
			background-position: 89% top;
			/* Altezza visibile = altezza del pannello, max 665px (dimensione nativa); larghezza proporzionale (847×665) */
			background-size: auto min(97%, 665px);
		}
		@media screen and (max-width: 900px) {
			.gallery-filter-panel-inner {
				grid-template-columns: 1fr;
				gap: 20px;
			}
			/* In colonna: niente scroll interno, lascia crescere la checklist */
			.gallery-filter-checklist--scroll {
				min-height: 0;
				max-height: none;
				overflow: visible;
				padding-right: 0;
			}
			/* In colonna: ricerca allineata a sinistra e più stacco dal blocco sopra */
			.gallery-filter-col--search {
				padding-left: 0;
				margin-top: 30px;
				align-items: flex-start;
			}
			.gallery-filter-col--search > div:first-child {
				justify-content: flex-start;
				width: 100%;
			}
		}

		.gallery-filter-col h3 {
			margin: 0 0 14px 0;
			font-size: 28px;
			font-weight: 700;
			color: #000;
		}
		.gallery-filter-checklist {
			display: flex;
			flex-direction: column;
			gap: 10px;
			margin-top:40px;
		}
		/* lista tag lunga: scroll interno e min-height più generosa */
		.gallery-filter-checklist--scroll {
			min-height: 280px;
			max-height: calc(60vh - 260px);
			overflow: auto;
			padding-right: 10px;
		}
		/* categorie su 2 colonne */
		.gallery-filter-checklist--cols2 {
			column-count: 2;
			column-gap: 28px;
		}
		.gallery-filter-checklist--cols2 label {
			break-inside: avoid;
			-webkit-column-break-inside: avoid;
			page-break-inside: avoid;
		}
		.gallery-filter-checklist label {
			display: flex;
			align-items: center;
			gap: 10px;
			cursor: pointer;
			font-size: 28px;
			font-weight: 500;
		}
		.gallery-filter-checklist label span{			
			font-size: 28px;
			font-weight: 500;
		}
		.gallery-filter-col--search {
			display: flex;
			flex-direction: column;
			min-height: 100%;
			padding-left:50px;
		}
		/* MOBILE: quando i filtri si incolonnano (override finale) */
		@media screen and (max-width: 900px) {
			.gallery-filter-panel .gallery-filter-checklist--scroll {
				min-height: 0;
				max-height: none;
				overflow: visible;
				padding-right: 0;
			}
			.gallery-filter-panel .gallery-filter-col--search {
				padding-left: 0;
				margin-top: 30px;
				align-items: flex-start;
			}
			.gallery-filter-panel .gallery-filter-col--search > div:first-child {
				justify-content: flex-start;
				width: 100%;
			}
		}
		.gallery-filter-search {
			width: 100%;
			padding: 0;
			font-size: 20px;
			font-weight: 500;
			border:none;
			border-bottom:solid 1px #000;
			background:none;
		}
		.gallery-filter-col-actions {
			margin-top: auto;
			padding-top: 20px;
			display: flex;
			flex-wrap: wrap;
			gap: 12px;
			align-items: center;
		}
		.gallery-filter-btn {
			padding: 10px 20px;
			font-size: 14px;
			font-weight: 700;
			cursor: pointer;
			border: none;
			border-radius: 25px;
		}
		.gallery-filter-btn--primary {
			background: {{ $rosso }};
			color: #fff;
			font-weight: 700;
			font-size: 16px;
		}
		.gallery-filter-btn--ghost {
			background: #eee;
			color: #111;
			font-weight: 700;
			font-size: 16px;
		}
	</style>

    <div class="gallery-filter-backdrop" id="galleryFilterBackdrop" aria-hidden="true"></div>
	<div class="gallery-filter-panel" id="galleryFilterPanel" aria-hidden="true">
		<div class="mainTextContainer gallery-filter-panel-inner">
			<div class="gallery-filter-col">
				<h3>Contenuti</h3>
				<div class="gallery-filter-checklist gallery-filter-checklist--scroll gallery-filter-checklist--cols2">
					@foreach($tagsContenuto as $t)
						<label>
							<input type="checkbox" class="gallery-filter-cb" data-tag-id="{{ $t->id }}" value="{{ $t->id }}">
							<span>{{ $t->nome }}</span>
						</label>
					@endforeach
				</div>
			</div>
			<div class="gallery-filter-col">
				<h3>Categorie</h3>
				<div class="gallery-filter-checklist gallery-filter-checklist--scroll gallery-filter-checklist--cols2">
					@forelse($tagsCategoria as $t)
						<label>
							<input type="checkbox" class="gallery-filter-cb" data-tag-id="{{ $t->id }}" value="{{ $t->id }}">
							<span>{{ $t->nome }}</span>
						</label>
					@empty
						<p style="font-size:14px;color:#666;margin:0;">Nessun tag disponibile.</p>
					@endforelse
				</div>
			</div>
			<div class="gallery-filter-col gallery-filter-col--search">
				<div style="display:flex; gap:10px; align-items:center;">	
					<img src="web/images/lente.png" alt="Cerca" style="width:32px; height:32px;">
					<input type="search" class="gallery-filter-search" id="galleryFilterSearchPanel" placeholder="Cerca per titolo, sottotitolo o testo…" autocomplete="off">
				</div>
				<div class="gallery-filter-col-actions">
					<button type="button" class="gallery-filter-btn gallery-filter-btn--primary" id="galleryFilterApply">FILTRA</button>
					<button type="button" class="gallery-filter-btn gallery-filter-btn--ghost" id="galleryFilterClose">CHIUDI</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Filtri avanzati -->
	<div style="width:100%; margin-top:-60px; padding-top:60px;" id="pageContainer">
		<div class="mainTextContainer" style="position:relative; z-index:100;font-size:25px; font-weight:700; text-align:center; line-height:1.5; margin:0 auto;">
			<h3>Un racconto fatto di parole, immagini e voci</h3>
		</div>	
		<div class="mainTextContainer filtriGalleryContainer" style="padding:10px 20px;">
            <div class="gallery-filter-pill gallery-filter-tutti is-active" id="filterTutti" role="button" tabindex="0">
                <h4 style="text-align:center;">Tutti</h4>
            </div>
            <div style="background:#000; padding:3px 0; width:1px; height:100%;">
                &nbsp;
            </div>
			@foreach($tagsContenuto as $t)
				<div class="gallery-filter-pill gallery-filter-quick" data-tag-id="{{ $t->id }}" role="button" tabindex="0">
					<h4>{{ $t->nome }}</h4>
				</div>
			@endforeach
            <div style="background:#000; padding:3px 0; width:1px; height:100%;">
                &nbsp;
            </div>
            <span class="gallery-filter-icon-btn" id="filterOpenPanel" title="Filtri avanzati">
				<img src="web/images/IconFiltro.png" alt="Filtri">
			</span>
        </div>

		
        
        <div class="mainTextContainer gallery-page-container">
			<div class="gallery-grid" id="galleryGrid">
			@foreach($galleryCards as $card)
				@php
					$searchBlob = mb_strtolower((string)($card['titolo'] ?? '').' '.($card['sottotitolo'] ?? '').' '.($card['testo'] ?? ''), 'UTF-8');
					$cardIconFile = null;
					foreach ($galleryTagIconOrder as $labelNorm => $iconFile) {
						$want = mb_strtolower(trim($labelNorm), 'UTF-8');
						foreach ($card['tag_ids'] ?? [] as $tid) {
							$row = $tagNomeById->get((int) $tid);
							if (!$row) {
								continue;
							}
							$got = mb_strtolower(trim((string) ($row->nome ?? '')), 'UTF-8');
							if ($got === $want) {
								$cardIconFile = $iconFile;
								break 2;
							}
						}
					}
				@endphp
				<a href="foto_video_gallery/{{ $card['slug'] }}.html" class="gallery-card {{ $card['is_video'] ? 'is-video' : '' }}"
					data-gallery-id="{{ $card['id'] }}"
					data-original-index="{{ $card['original_index'] }}"
					data-tag-ids="{{ json_encode($card['tag_ids']) }}"
					data-search="{{ e($searchBlob) }}"
					data-video-id="{{ $card['youtube_id'] }}">
					<div class="gallery-preview">
						@if(!empty($card['thumb']))
							<img
								class="gallery-preview-image"
								src="{{ $card['thumb'] }}"
								alt="{{ $card['titolo'] }}"
								@if($card['is_video'] && !empty($card['youtube_id']))
									onerror="this.onerror=null;this.src='https://i.ytimg.com/vi/{{ $card['youtube_id'] }}/sddefault.jpg';"
								@endif
							>
						@else
							<div class="gallery-preview-placeholder">NO PREVIEW</div>
						@endif
						@if($card['is_video'] && !empty($card['youtube_id']))
							<iframe
								class="gallery-video-frame"
                                loading="lazy"
								allow="autoplay; encrypted-media; picture-in-picture"
								allowfullscreen
								src="https://www.youtube.com/embed/{{ $card['youtube_id'] }}?autoplay=1&mute=1&controls=0&playsinline=1&modestbranding=1&rel=0&loop=1&playlist={{ $card['youtube_id'] }}&enablejsapi=1"
							></iframe>
						@endif
					</div>
					<div class="gallery-card-meta">
						@if($cardIconFile)
							<img
								class="gallery-card-cat-icon"
								src="{{ asset('web/images/icone/' . $cardIconFile) }}"
								alt=""
								loading="lazy"
								decoding="async"
							>
						@endif
						<div class="gallery-card-meta-text">
							<div class="gallery-card-title">{{ $card['titolo'] }}</div>
							@if($card['luogo']!="")
								<div class="gallery-card-luogo">{{ $card['luogo'] }}</div>
							@endif
						</div>
					</div>
				</a>
			@endforeach
			</div>
		</div>
	</div>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const grid = document.getElementById('galleryGrid');
			const cards = () => Array.from(document.querySelectorAll('.gallery-card'));
			(function () {
				const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
				const items = Array.from(document.querySelectorAll('.gallery-card'));
				if (!items.length) return;

				if (prefersReduced) {
					items.forEach((el) => el.classList.add('gallery-card-anim--in'));
					return;
				}

				function applyDelays() {
					const rowMap = new Map();
					items.forEach((el) => {
						const key = Math.round((el.offsetTop || 0) / 22);
						if (!rowMap.has(key)) rowMap.set(key, []);
						rowMap.get(key).push(el);
					});
					Array.from(rowMap.keys()).sort((a, b) => a - b).forEach((rowKey) => {
						const rowEls = rowMap.get(rowKey).sort((a, b) => (a.offsetLeft || 0) - (b.offsetLeft || 0));
						rowEls.forEach((el, idx) => {
							if (el.classList.contains('gallery-card-anim--in')) return;
							el.style.transitionDelay = `${idx * 90}ms`;
						});
					});
				}

				items.forEach((el) => el.classList.add('gallery-card-anim'));
				applyDelays();
				const observer = new IntersectionObserver((entries) => {
					entries.forEach((entry) => {
						if (!entry.isIntersecting) return;
						entry.target.classList.add('gallery-card-anim--in');
						observer.unobserve(entry.target);
					});
				}, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });

				items.forEach((el) => observer.observe(el));
				window.addEventListener('resize', applyDelays, { passive: true });
			})();
			const tuttiEl = document.getElementById('filterTutti');
			const quickPills = document.querySelectorAll('.gallery-filter-quick');
			const checkboxes = document.querySelectorAll('.gallery-filter-cb');
			const searchPanel = document.getElementById('galleryFilterSearchPanel');
			const backdrop = document.getElementById('galleryFilterBackdrop');
			const panel = document.getElementById('galleryFilterPanel');
			const btnOpen = document.getElementById('filterOpenPanel');
			const btnClose = document.getElementById('galleryFilterClose');
			const btnApply = document.getElementById('galleryFilterApply');

			const selectedTagIds = new Set();

			const getSearchQuery = () => {
				const q = (searchPanel && searchPanel.value) ? searchPanel.value.trim().toLowerCase() : '';
				return q;
			};

			const cardMatches = (card) => {
				const tagIds = JSON.parse(card.getAttribute('data-tag-ids') || '[]');
				for (const id of selectedTagIds) {
					if (!tagIds.includes(Number(id))) return false;
				}
				const q = getSearchQuery();
				if (q) {
					const blob = (card.getAttribute('data-search') || '').toLowerCase();
					if (!blob.includes(q)) return false;
				}
				return true;
			};

			const syncCheckboxes = () => {
				checkboxes.forEach((cb) => {
					const id = Number(cb.getAttribute('data-tag-id'));
					cb.checked = selectedTagIds.has(id);
				});
			};

			const syncQuickPills = () => {
				quickPills.forEach((pill) => {
					const id = Number(pill.getAttribute('data-tag-id'));
					pill.classList.toggle('is-active', selectedTagIds.has(id));
				});
			};

			const syncTutti = () => {
				const empty = selectedTagIds.size === 0;
				tuttiEl.classList.toggle('is-active', empty);
				tuttiEl.classList.toggle('is-disabled', !empty);
			};

			const applyLayout = () => {
				cards().forEach((c) => {
					c.style.display = cardMatches(c) ? '' : 'none';
				});

				const applyTitleShift = () => {
					cards().forEach((card) => {
						if (card.style.display === 'none') return;
						const preview = card.querySelector('.gallery-preview');
						if (!preview) return;
						const scale = parseFloat(getComputedStyle(card).getPropertyValue('--preview-scale')) || 1.05;
						const shift = (preview.offsetWidth * (scale - 1)) / 2;

						card.style.setProperty('--title-shift-x', `-${shift}px`);
					});
				};
				applyTitleShift();

				// aggiorna i delay asincroni per le card visibili dopo i filtri
				window.requestAnimationFrame(() => {
					const visible = cards().filter((c) => c.style.display !== 'none');
					const rowMap = new Map();
					visible.forEach((el) => {
						const key = Math.round((el.offsetTop || 0) / 22);
						if (!rowMap.has(key)) rowMap.set(key, []);
						rowMap.get(key).push(el);
					});
					Array.from(rowMap.keys()).sort((a, b) => a - b).forEach((rowKey) => {
						const rowEls = rowMap.get(rowKey).sort((a, b) => (a.offsetLeft || 0) - (b.offsetLeft || 0));
						rowEls.forEach((el, idx) => {
							if (el.classList.contains('gallery-card-anim--in')) return;
							el.style.transitionDelay = `${idx * 90}ms`;
						});
					});
				});
			};

			const applyFilters = () => {
				syncCheckboxes();
				syncQuickPills();
				syncTutti();
				applyLayout();
			};

			const toggleTag = (id) => {
				const n = Number(id);
				if (selectedTagIds.has(n)) selectedTagIds.delete(n);
				else selectedTagIds.add(n);
				applyFilters();
			};

			const clearTags = () => {
				selectedTagIds.clear();
				applyFilters();
			};

			tuttiEl.addEventListener('click', () => {
				if (selectedTagIds.size === 0) return;
				clearTags();
			});
			tuttiEl.addEventListener('keydown', (e) => {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					tuttiEl.click();
				}
			});

			quickPills.forEach((pill) => {
				pill.addEventListener('click', () => {
					const id = pill.getAttribute('data-tag-id');
					toggleTag(id);
				});
				pill.addEventListener('keydown', (e) => {
					if (e.key === 'Enter' || e.key === ' ') {
						e.preventDefault();
						pill.click();
					}
				});
			});

			checkboxes.forEach((cb) => {
				cb.addEventListener('change', () => {
					const id = Number(cb.getAttribute('data-tag-id'));
					if (cb.checked) selectedTagIds.add(id);
					else selectedTagIds.delete(id);
					applyFilters();
				});
			});

			searchPanel.addEventListener('input', () => applyFilters());

			const openPanel = () => {
				backdrop.classList.add('is-open');
				panel.classList.add('is-open');
				backdrop.setAttribute('aria-hidden', 'false');
				panel.setAttribute('aria-hidden', 'false');
				document.body.style.overflow = 'hidden';
			};
			const closePanel = () => {
				backdrop.classList.remove('is-open');
				panel.classList.remove('is-open');
				backdrop.setAttribute('aria-hidden', 'true');
				panel.setAttribute('aria-hidden', 'true');
				document.body.style.overflow = '';
			};

			btnOpen.addEventListener('click', () => openPanel());
			btnClose.addEventListener('click', () => closePanel());
			btnApply.addEventListener('click', () => {
				applyFilters();
				closePanel();
			});
			backdrop.addEventListener('click', () => closePanel());

			document.addEventListener('keydown', (e) => {
				if (e.key === 'Escape' && panel.classList.contains('is-open')) {
					closePanel();
				}
			});

			const applyTitleShiftAll = () => {
				cards().forEach((card) => {
					if (card.style.display === 'none') return;
					const preview = card.querySelector('.gallery-preview');
					if (!preview) return;
					const scale = parseFloat(getComputedStyle(card).getPropertyValue('--preview-scale')) || 1.05;
					const shift = (preview.offsetWidth * (scale - 1)) / 2;
					card.style.setProperty('--title-shift-x', `-${shift}px`);
				});
			};

			applyFilters();
			window.addEventListener('resize', applyTitleShiftAll);
		});
	</script>
@endsection
