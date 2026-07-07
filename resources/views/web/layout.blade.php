@php
	$test = 0;
	$host = $_SERVER['HTTP_HOST'];
	if($host=="test.vianinilavori.it") $test = 1;
	
	$oggi = new DateTime(); // data attuale
	$inizio = new DateTime('2025-12-08');
	$fine = new DateTime('2026-01-07'); // 9 gennaio escluso

	//if($_SERVER['REMOTE_ADDR']=="93.45.34.21"){
		if ($inizio <= $oggi && $oggi < $fine) {
			$natale = "1";
		}
	//}
	 //ANCHE IN common/footer.inc.php
	
@endphp
<!DOCTYPE html>
<html lang="it">
	<head>
		<!-- Basic -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8">
		<meta name="author" content="Creative Web Studio" />
		<title>{{ $test == 1 ? "TEST | " : "" }}{!! $metatag['title'] !!} | {{ config('app.name') }}</title>
		<meta name="description" content="{!! $metatag['description'] !!}"/>
		
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<base href="{{ Config::get('app.url') }}/" />
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		@php if(!isset($cmd)) $cmd=""; @endphp
		@include('web.common.css')
				
		@include('web.common.favicon')
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
		
		@if($cmd=="home")
			<script>
			  function updateViewportHeight() {
				const vh = window.innerHeight * 0.01;
				document.documentElement.style.setProperty('--vh', `${vh}px`);
			  }
			  window.addEventListener('resize', updateViewportHeight);
			  window.addEventListener('load', updateViewportHeight);
			  updateViewportHeight();
			</script>

		@endif
		@if($cmd=="la-nostra-storia")
			<script>
			  if (location.hash) {
				window.scrollTo(0, 0);
				document.body.style.scrollBehavior = 'auto';
			  }
			</script>
		@endif
			@if($test!=1)
				<?php /*<style>
					.floatable-wrapper{
					#	display:none !important;
						left:0 !important;
						top:50% !important;
					}
					svg {
						position: absolute;
						padding:10px 0 0 10px !important;
						top: 20px !important;
						left: 0px !important;
						width: 33px !important;
						height: 35px !important;
						background: #fff;
						border:solid 2px {{ config('app.color1') }};
						border-left:0;
						z-index: 1;
						transform: none !important;
						border-radius:0 5px 5px 0;
					}
					svg path {
						fill: {{ config('app.color1') }}
					  }
				</style>*/?>
				<style>
					.floatable-wrapper{
						display:none !important;
					}
				</style>
				<script type="text/javascript">
				var _iub = _iub || [];
				_iub.csConfiguration = {"siteId":4133683,"cookiePolicyId":35139349,"lang":"it","storage":{"useSiteId":true}};
				</script>
				<script type="text/javascript" src="https://cs.iubenda.com/autoblocking/4133683.js"></script>
				<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
				
			
				<!-- Google Tag Manager -->
				<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-WM29QBK2');</script>
				<!-- End Google Tag Manager -->
			@endif
	</head>
	<body>
		@if($test!=1)
			<!-- Google Tag Manager (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WM29QBK2"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
		@endif
		@include('web.common.js_css_up')
		{{-- overflow-x:hidden su .container impedisce position:sticky sui discendenti (es. nav gallery dett.) --}}
		<div class="container" style="position:relative; @if($cmd!="home" && $cmd!="gallery_dett" && $cmd!="rassegna-stampa" && $cmd!="progetto_dett" && $cmd!="progetti") overflow-x:hidden @endif">
			@if(!empty($natale))
				@include('web.common.natale')
			@endif
			
			<div style="position:fixed; width:100%; height:106px; top:-106px; opacity:0; left:0; z-index:1000;" id="header">
				@include('web.common.header')
			</div>			
			@yield('content') 
			@if($cmd!="home" && $cmd!="progetto_dett")
				@include('web.common.footer')
			@endif
			
			
			@if($_SERVER['REMOTE_ADDR']=="93.45.34.21")
				<!-- Elfsight Accessibility | Untitled Accessibility -->
				<script src="https://elfsightcdn.com/platform.js" async></script>
				<div class="elfsight-app-7cd7ae79-7964-4995-a504-054ebcdd9e0f" data-elfsight-app-lazy></div>
			@endif




		</div>
		
		@include('web.common.test')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
		@include('web.common.js')
	</body>
</html>
