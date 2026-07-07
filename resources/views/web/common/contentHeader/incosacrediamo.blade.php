<style>
	.panel-columns-ajax{
	  display: flex;
	  opacity: 1;
	  transform: translateY(-20px);
	  transition: all 0.5s ease;
	  position:relative;
	  gap:30px;
	}

	/* Colonne */
	.panel-left {
	  flex: 0 0 34%;
	}

	.panel-right {
	  flex: 0 0 66%;
	}
	
	/* Il paragrafo rimane normale: impilato uno sotto l'altro */
	.panel-left p {
	  font-weight: 400;	  
	  cursor: pointer;
	  margin: 10px 0;
	  position:relative;
	  font-size:28px;
	  opacity: 1;
	}
	
	.panel-right img {
	  opacity: 0;
	  transform: translateX(250px);
	  transition: all 1.5s cubic-bezier(.28,.71,.17,.94);
	}

	/* Lo span dentro controlla solo l'interno (testo + freccia) */
	.panel-left-text {
	  align-items: center;
	  height:10px; width:10px;
	  gap: 20px; /* spazio tra testo e freccia */
	  position: relative;
	  background:#fff;
	  padding:0 5px;
	  transition: all 0.3s ease;
	}

	/* Hover sul p (intero) */
	.panel-left p:hover {
	  font-weight: 700;
	}

	/* La freccia */
	.panel-left-text::after {
	  content: '';
	  position: absolute;
	  right: -10px;
	  top: 10px;
	  transform: translateY(-50%);
	  width: 12px;
	  height: 12px;
	  border-right: 2px solid #E73338;
	  border-bottom: 2px solid #E73338;
	  transform: rotate(-45deg);
	  opacity: 0;
	  transition: all 1.5s cubic-bezier(.28,.71,.17,.94);
	}

	/* Hover mostra la freccia */
	.panel-left p:hover .panel-left-text {
	  background:#d9d9d9;		
	}
	.panel-left p:hover .panel-left-text::after {
	  opacity: 1;
	  right: -30px;
	}
	
	#panel-left-text-1, #panel-left-text-2, #panel-left-text-3, #panel-left-text-4{		
	  transform: translateX(-200px);
	  opacity:0;
	  transition: transform 1.5s cubic-bezier(.28,.71,.17,.94), opacity 1.5s cubic-bezier(.28,.71,.17,.94);		
	}
	
	/* Primo livello */
	.panel-left > p .panel-left-text {
	  font-size: 28px;
	}

	/* Secondo e terzo livello */
	.sub-items .panel-left-text,
	.sub-sub-items .panel-left-text {
	  font-size: 20px;
	}
	
	@media screen AND (max-width:1199px) {
		.panel-left {
		  flex: 0 0 45%;
		}

		.panel-right {
		  flex: 0 0 55%;
		}
		
		.sub-items,
		  .sub-sub-items {
			margin-left: 20px;
		  }
	}
	
	@media screen AND (max-width:1024px) {
	  panel-left{
		  padding-bottom:150px; background:Red;
	  }
	  .panel-columns-ajax {
		flex-direction: column-reverse;
	  }

	  .panel-left,
	  .panel-right {
		flex: 0 0 auto;
		width: 100%;
	  }
		
	  .panel-left-text {		  
		  background:rgba(255,255,255,0);
		}
		
	  .panel-left-text::after {
		  top: 4px;
		}
		
	  .panel-right img {
		margin-top: 30px;
		width: 100%;
		height: auto;
	  }
		
		.panel-left-text.first{
			font-size:18px !important;
			font-weight:700;
		}
		.panel-left-text.first span{
			font-size:18px !important;
		}
		
	  /* RIDUZIONE FONT E PADDING */
	  .panel-left > p .panel-left-text {
		font-size: 20px;
		padding: 0 3px;
	  }
	  
	  .panel-left p:hover .panel-left-text::after {
	  opacity: 1;
		  right: -20px;
		}
		
	  
	  .sub-items .panel-left-text,
	  .sub-sub-items .panel-left-text {
		font-size: 17px;
		padding: 0 3px;
	  }

	  /* RIENTRI RIDOTTI */
	  .sub-items,
	  .sub-sub-items {
		margin-left: 8px;
	  }
	  
	}
	
	.gapEtica{display:none}
	@media screen AND (max-width:1280px){
		.gapEtica{display:inline}
	}
</style>

<div  style="width:100%;" class="panel-columns-ajax">
	<div class="panel-left" id="panel-left">
		<p id="panel-left-text-1"><a href="mission-e-vision.html" title="Mission & Vision - In Cosa Crediamo - {{ config('app.name') }}"><span class="panel-left-text">Mission & Vision</span></a></p>
		<p id="panel-left-text-2"><a href="sicurezza-sul-lavoro.html" title="Sicurezza sul lavoro - In Cosa Crediamo - {{ config('app.name') }}"><span class="panel-left-text">Sicurezza sul lavoro</span></a></p>
	</div>
    <div class="panel-right" id="panel-right">
      <img src="{{ asset('web/images/header-in-cosa-crediamo2.jpg') }}" style='width:100%;'>
    </div>
</div>