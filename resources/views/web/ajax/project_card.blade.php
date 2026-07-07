@include('web.common.functions')
@php
	$query_dett = DB::table('punti_mappa')
		->select('*')
		->where('id', '=', $project_id)
		->get();

	$p=0;
	$query_gal = DB::table('punti_mappa_gallery')
		->select('*')
		->where('id_rife', '=', $query_dett[0]->id)
		->orderby('ordine', 'DESC')
		->get();
	$count_gal = $query_gal->count();

	$valori = 0;
	if(isset($query_dett[0]->valore_dato_1) || isset($query_dett[0]->valore_dato_2) || isset($query_dett[0]->valore_dato_3) || isset($query_dett[0]->valore_dato_4) || isset($query_dett[0]->valore_dato_5) )
		$valori = 1;
@endphp

<style>
	
		
	.metric-value{
		position:relative;
	}
	.metric-value::before {
	  content: '';
	  position: absolute;
	  left: -20px;
	  top: 7px;		  
	  width: 12px;
	  height: 12px;
	  border-right: 2px solid #E73338;
	  border-bottom: 2px solid #E73338;
	  transform: rotate(-45deg);
	}
	
	.projContainer{width:100%; display:flex;}
	@media screen AND (max-width:1300px){
		.projContainer{
			flex-direction: column; 
			gap:25px;
		}
	}
	
	@media screen AND (max-width:1024px){
		.project-metrics{flex-direction: column;}
	}
	
	.projDatiContainer{display:flex;}

	@if($count_gal!=0 || $valori == 1) 
		.projDatiContainer{flex-direction: column;}
	@endif
	
	@media screen AND (max-width:1300px){
		.projDatiContainer{flex-direction: column;)
	}


</style>



<div style="padding:30px;">
	<div style="width:100%; font-size:30px; font-family:Arial; font-weight:bold">				
		{{$query_dett[0]->titolo}} {{$query_dett[0]->titolo_bold}}
	</div>
	<div class="detail-content" id="detail-content">
		<div class="scrollable-content">
			<div style="padding:0px;">
				<div class="projContainer">
					<div style="flex:1;">
						<div style="width:100%; font-size:20px; color:#000; line-height:1.8;" class="projDatiContainer">
							<div style="flex:1">
								@if(isset($query_dett[0]->committente))
									<div><span class="projTit">Committente</span>: {{ $query_dett[0]->committente }}<br/></div>
								@endif
								@if(isset($query_dett[0]->ubicazione))
									<div><span class="projTit">Ubicazione</span>: {{$query_dett[0]->ubicazione }}<br/></div>
								@endif
							</div>
							<div style="flex:1">
								@if(isset($query_dett[0]->stato))
									<div><span class="projTit">Stato di lavorazione</span>: {{ ucfirst(str_replace("Lavoro ","",$query_dett[0]->stato));}}<br/></div>
								@endif
							</div>
						</div>
						
						@if($valori == 1 && $count_gal>0)
							<div style="width:calc(100% - 20px); background:#F5F5F5; margin-top:25px;">
								<div style="padding:20px;">
									@if(isset($query_dett[0]->valore_dato_1))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_1 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_1 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_2))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_2 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_2 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_3))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_3 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_3 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_4))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_4 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_4 }}</div>
										</div>
									@endif
									@if(isset($query_dett[0]->valore_dato_5))
										<div class="project-metrics">
										  <div class="metric-value">{{ $query_dett[0]->valore_dato_5 }}</div>
										  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_5 }}</div>
										</div>
									@endif
								</div>
							</div>
						@endif
						<div style="
							
							width:190px;
							height:auto;
							padding:10px 5px;
							background:#E30613;
							border-radius:26px;
							border:solid 1px #fff;
							cursor:pointer;
							margin-top:20px;
						">
						  <a href="dettaglio-progetto/{{to_htaccess_url($query_dett[0]->titolo." ".$query_dett[0]->titolo_bold,"")}}-{{$query_dett[0]->id}}.html" style="text-decoration:none"><div style="font-size:16px; color:#fff; width:100%; text-align:centeR;"><b>SCOPRI DI PIÙ</b></div></a>
						</div>
					</div>
					
					@if($count_gal>0 || $valori == 1)
						<div style="flex:1;">
							@if($count_gal>0)
								<div class="gallery-carousel">
								  <div class="carousel-track" id="carousel-track">
									
									@if(!empty($query_dett[0]->img_testata) && empty($query_dett[0]->video))
											<a href="resarea/img_up/punti/{{ $query_dett[0]->img_testata }}" class="glightbox image-wrapper">
												<img src="resarea/img_up/punti/{{ $query_dett[0]->img_testata }}" alt="{{ $query_dett[0]->titolo }} {{ $query_dett[0]->titolo_bold }} - Immagine 0" class="carousel-image">
											</a>
											@php $p++; @endphp
										@endif
									
									@foreach($query_gal AS $key_gal=>$value_gal)
										@php $p++ @endphp
										<a href="resarea/img_up/punti/{{ $value_gal->img }}" class="glightbox image-wrapper">
											<img src="resarea/img_up/punti/{{ $value_gal->img }}" alt="{{ $query_dett[0]->titolo }} {{ $query_dett[0]->titolo_bold }} - Immagine {{$p}}" class="carousel-image">
										</a>
									@endforeach
								  </div>
									@if($count_gal>1)
										<div class="carousel-controls ">
											<div class="circleArrowProj prevBtnProj">
											  <div class="circleArrowProjIcon " style="width: 20px; height:20px; top:17px; margin-left:7px; border-left: 2px solid; border-top: 2px solid; transform: rotate(-45deg);"></div>
											</div>
											<div class="circleArrowProj nextBtnProj">
											  <div class="circleArrowProjIcon" style="width: 20px; height:20px; margin-right:3px; border-right: 2px solid; border-bottom: 2px solid; transform: rotate(-45deg);"></div>
											</div>
										</div>
									@endif
								</div>
							@endif
							@if($count_gal==0 && $valori == 1) 
								<div style="width:calc(100% - 20px); background:#F5F5F5;">
									<div style="padding:20px;">
										@if(isset($query_dett[0]->valore_dato_1))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_1 }}</div>
											  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_1 }}</div>
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_2))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_2 }}</div>
											  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_2 }}</div>
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_3))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_3 }}</div>
											  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_3 }}</div>
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_4))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_4 }}</div>
											  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_4 }}</div>
											</div>
										@endif
										@if(isset($query_dett[0]->valore_dato_5))
											<div class="project-metrics">
											  <div class="metric-value">{{ $query_dett[0]->valore_dato_5 }}</div>
											  <div class="metric-label">{{ $query_dett[0]->descrizione_dato_5 }}</div>
											</div>
										@endif
									</div>
								</div>
							@endif
						</div>
					@endif
						
				</div>
			</div>
		</div>
	  </div>
</div>
