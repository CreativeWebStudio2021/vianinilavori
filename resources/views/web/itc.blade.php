@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$img_background="web/images/header_default.jpg"; 
		$page_title = "ITC";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']='La società'; $breadcrumbs[$x]['link']='la-societa/'; 
		$x++; $breadcrumbs[$x]['titolo']='Governance'; $breadcrumbs[$x]['link']='la-societa/la-governance/'; 
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	<style>
	.iso-filter-wrapper {
	  display: flex;
	  justify-content: center;
	  align-items: center;
	  gap: 40px; /* 🔧 distanza regolabile tra voci */
	  margin: 20px 0;
	}

	.iso-filter-item a {
	  position: relative;
	  font-size: 20px;
	  font-family: Arial, sans-serif;
	  color: black;
	  font-weight: bold;
	  text-decoration: none;
	  transition: color 0.5s ease;
	}

	/* Effetto underline al passaggio */
	.iso-filter-item a::after {
	  content: '';
	  position: absolute;
	  bottom: -2px;
	  left: 0;
	  width: 0;
	  height: 1px;
	  background-color: #E73338;
	  transition: width 0.3s ease;
	}

	/* Hover */
	.iso-filter-item a:hover::after {
	  width: 100%;
	}

	/* Attivo: riga rossa visibile */
	.iso-filter-item a.active::after {
	  width: 100% !important;
	}

	
	
	.iso-list {
	  width: 100%;
	  margin-bottom:80px;
	}

	.iso-item {
	  position: relative;
	  padding: 5px 10px;
	  margin: 10px 0; /* spazio sopra e sotto */
	  background-color: white;
	  overflow: hidden;
	  display: flex;
	  align-items: center;
	  cursor:pointer;
	}

	/* Sfondo in entrata animata */
	.iso-item .bg-hover {
	  transition: all 0.5s ease;
	}

	.iso-item .bg-hover {
	  content: '';
	  position: absolute;
	  top: 5px;
	  bottom: 5px;
	  left: 0;
	  width: 0;
	  background: #D9D9D9;
	  z-index: 0;
	  transition: width 0.6s ease;
	}

	.iso-item:hover .bg-hover {
	  width: 100%;
	}

	.iso-item.selected .bg-hover {
	  width: 100%;
	}
	
	.iso-item.selected .icon-hover {
	  opacity: 1;
	}

	.iso-item.selected .icon-default {
	  opacity: 0;
	}


	/* Z-indices per layer sopra sfondo */
	.iso-left, .iso-content, .iso-right {
	  position: relative;
	  z-index: 2;
	}


	.iso-left img {
	  width: 62px;
	  height: 62px;
	  object-fit: contain;
	}

	.iso-content {
	  flex: 1;
	  padding: 0 30px;
	}

	.iso-title {
	  font-family: 'Arial';
	  font-weight: bold;
	  font-size: 30px;
	  color: black;
	}

	.iso-subtitle {
	  font-family: 'Nunito', sans-serif;
	  font-size: 25px;
	  color: #565656;
	  margin-top: 5px;
	}

	.iso-right {
	  width: 55px;
	  height: 55px;
	  position: relative;
	}

	.iso-right img {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 55px;
	  height: 55px;
	  object-fit: contain;
	  transition: opacity 0.3s ease;
	}

	.iso-right .icon-hover {
	  opacity: 0;
	}
	
	.iso-right .icon-close {
		width: 45px;
		height: 45px;
		position: absolute;
		top: 0;
		left: 0;
		object-fit: contain;
		transition: opacity 0.3s ease;
	}


	.iso-item:hover .icon-hover {
	  opacity: 1;
	}

	.iso-item:hover .icon-default {
	  opacity: 0;
	}
	.iso-item:hover .iso-left {
	  color: #E73338;
	}

	/* Transizione fade per filtraggio */
	.iso-item {
	  opacity: 1;
	  transform: translateY(0);
	  transition: all 0.4s ease;
	}

	.iso-item.hide {
	  opacity: 0;
	  transform: translateY(20px);
	  pointer-events: none;
	  height: 0;
	  padding: 0;
	  margin: 0;
	  border: none;
	  overflow: hidden;
	}
	.iso-wrapper {
	  padding-bottom: 0px;
	  border-bottom: 2px solid #000;
	  background: #fff;
	}
	.iso-wrapper.hide {
		display: none !important;
	}

	@keyframes fadeUp {
	  0% {
		opacity: 0;
		transform: translateY(40px);
	  }
	  100% {
		opacity: 1;
		transform: translateY(0);
	  }
	}

	.iso-wrapper.animate-in {
	  animation-name: fadeUp;
	  animation-duration: 0.6s;
	  animation-timing-function: ease-out;
	  animation-fill-mode: both;
	}
	
	.iso-title {
	  font-family: 'Arial';
	  font-size: 30px;
	}

	.iso-subtitle {
	  font-size: 25px;	  
	}
	.iso-subtitle a{color:#E73338;}
	
	@media screen AND (max-width:800px){
		.iso-title {
		  font-size: 25px;
		}

		.iso-subtitle {
		  font-size: 20px;
		}
	}
	
	@media screen AND (max-width:600px){
		.iso-left{display:none;}
		.iso-content{padding:0px 10px 0 0;}
	}
	
	@media screen AND (max-width:600px){
		.iso-right img {
			width: 45px;
			height: 45px;
		}
		.iso-item{padding:0};
	}
	</style>	
	
	
	<section style="width:100%;">
		<div class="mainTextContainer">
		
			<!-- Lista -->
			<div class="iso-list">
				@php
					$x=0;
					$query_cert = DB::table('itc')
						->select('*')
						->where('visibile', '=', '1')
						->orderBy('ordine', 'DESC')
						->get();

					foreach ($query_cert as $value_cert) {
						$x++;
						$certificati[$x] = [
							'icona' => $value_cert->icona,
							'titolo' => $value_cert->titolo,
							'testo' => $value_cert->testo
						];
					}

				@endphp
				@foreach($certificati as $index => $item)
				  <div class="iso-wrapper">
					
						<div class="iso-item"  data-index="{{ $index }}">
						  <div class="bg-hover"></div>
						  <div class="iso-left">
							<i class="{{$item['icona']}}" style="font-size:2.5em;"></i>
						  </div>
						  <div class="iso-content">
							<div class="iso-title">{!! $item['titolo'] !!}</div>
							<div class="iso-subtitle">{!! $item['testo'] !!}</div>
						  </div>
						  <div class="iso-right">
							
						  </div>
						</div>
				  </div>
				@endforeach


			</div>

		</div>
	</section>
		
@endsection	