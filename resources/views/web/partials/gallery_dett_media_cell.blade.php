{{--
	Cella media gallery dettaglio: foto (GLightbox) o video YouTube (thumb + lightbox).
	@param object|array $m      Riga media (tipo, img, titolo, testo, …)
	@param string      $lbGallery  Valore data-gallery per GLightbox (es. gallery-dett-123)
--}}
@php
	$tipo = (string) ($m->tipo ?? '');
	$imgFile = (string) ($m->img ?? '');
	$isVideo = $tipo === 'video' && $imgFile !== '';

	$fullImg = $isVideo ? '' : ($imgFile !== '' ? asset('resarea/img_up/media/' . $imgFile) : '');
	$ytId = $isVideo ? $imgFile : '';
	$thumbVideo = $isVideo ? 'https://i.ytimg.com/vi/' . $ytId . '/sddefault.jpg' : '';
	$ytWatchUrl = $isVideo ? 'https://www.youtube.com/watch?v=' . $ytId : '';

	$mediaTitolo = trim((string) ($m->titolo ?? ''));
	$mediaTestoPlain = trim(preg_replace('/\s+/u', ' ', strip_tags((string) ($m->testo ?? ''))));
	if ($mediaTestoPlain !== '') {
		$mediaTestoPlain = Str::limit($mediaTestoPlain, 1200, '…');
	}

	$imgAlt = $mediaTestoPlain !== '' ? $mediaTestoPlain : ($mediaTitolo !== '' ? $mediaTitolo : 'Media');
	$lbGallery = (string) ($lbGallery ?? 'gallery-dett');
@endphp

<div class="gallery-dett-cell-container">
	@if($isVideo)
		<a
			href="{{ $ytWatchUrl }}"
			class="gallery-dett-cell gallery-dett-cell--video glightbox"
			data-gallery="{{ e($lbGallery) }}"
			data-type="video"
			data-title="{{ e($mediaTestoPlain) }}"
			@if($mediaTestoPlain !== '')
				data-description="{{ e($mediaTestoPlain) }}"
			@endif
		>
			<img
				src="{{ $thumbVideo }}"
				alt="{{ e($imgAlt) }}"
				loading="lazy"
				decoding="async"
				onerror="this.onerror=null;this.src='https://i.ytimg.com/vi/{{ $ytId }}/hqdefault.jpg'"
			>
			<span class="gallery-dett-cell-play" aria-hidden="true"></span>
		</a>
	@elseif($fullImg !== '')
		<a
			href="{{ $fullImg }}"
			class="gallery-dett-cell glightbox"
			data-gallery="{{ e($lbGallery) }}"
			data-title="{{ e($mediaTestoPlain) }}"
			@if($mediaTestoPlain !== '')
				data-description="{{ e($mediaTestoPlain) }}"
			@endif
		>
			<img
				src="{{ $fullImg }}"
				alt="{{ e($imgAlt) }}"
				loading="lazy"
				decoding="async"
			>
		</a>
	@endif
</div>
