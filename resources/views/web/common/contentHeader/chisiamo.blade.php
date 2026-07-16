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
	  padding:0;
	  line-height:1.25;
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
	
	.sub-items, .sub-sub-items {
	  margin-left: 30px;
	  display: none;
	  flex-direction: column;
	}

	.sub-sub-items {
	  margin-left: 30px;
	}

	.sub-items p, .sub-sub-items p {
	  font-size: 20px;
	  opacity: 0;
	  transform: translateX(-200px);
	  transition: transform 1.2s ease, opacity 1.2s ease;
	  cursor: pointer;
	}

	/* Effetto hover uguale a livello 1 */
	.sub-items p:hover .panel-left-text,
	.sub-sub-items p:hover .panel-left-text {
	  background: #d9d9d9;
	  font-weight: 700;
	}

	.sub-items p:hover .panel-left-text::after,
	.sub-sub-items p:hover .panel-left-text::after {
	  opacity: 1;
	  right: -30px;
	}
	
	#panel-left-text-sub-1,
	#panel-left-text-sub-2 {
	  transform: translateX(-200px);
	  opacity: 0;
	  transition: transform 1.5s cubic-bezier(.28,.71,.17,.94), opacity 1.5s cubic-bezier(.28,.71,.17,.94);
	}
	.panel-left-text.open {
	  background: #d9d9d9;
	  font-weight: 700;
	}

	.panel-left-text.open::after {
	  opacity: 1;
	  right: -30px;
	}
	
	/* Freccia più piccola nei sotto e sottosotto menù */
	.sub-items .panel-left-text::after,
	.sub-sub-items .panel-left-text::after {
	  width: 10px;
	  height: 10px;
	  border-right: 1.5px solid #E73338;
	  border-bottom: 1.5px solid #E73338;
	  right: -10px;
	  top: 4px;
	}

	.panel-left a {
	  color: #000;
	  text-decoration: none;
	}

	.panel-left a:hover {
	  color: #000;
	  text-decoration: none;
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
	
	.panel-left-text.first{
		padding-bottom:2px;
		border-bottom:solid 1px;
		margin-bottom:30px;
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
		  padding-bottom:150px;
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
	@media screen AND (max-width:1450px){
		.gapEtica{display:inline}
	}
</style>

<div style="width:100%;" id="chisiamoDesk" class="panel-columns-ajax">
	<div class="panel-left" id="panel-left">
		<p id="panel-left-text-1"><span class="panel-left-text">La nostra Storia</span></p>
		<div class="sub-items" id="sub-storia">
			<p><a href="un-viaggio-lungo-oltre-un-secolo.html" title="Un viaggio lungo oltre un secolo - Etica, Compliance e Whistelblowing - La Storia - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Un viaggio lungo oltre un secolo</span></a></p>
			<p><a href="vianini-lavori-oggi.html" title="Vianini Lavori oggi - La Storia - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Vianini Lavori oggi</span></a></p>
		</div>
		<p id="panel-left-text-2"><span class="panel-left-text">Governance</span></p>
		<div class="sub-items" id="sub-governance">
			
			<p><a href="consiglio-di-amministrazione.html" title="Consiglio di Amministrazione - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Consiglio di Amministrazione</span></a></p>
			<p><a href="collegio-sindacale.html" title="Collegio Sindacale - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Collegio Sindacale</span></a></p>
			<p><a href="organismo-di-vigilanza.html" title="Organismo di Vigilanza - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Organismo di Vigilanza</span></a></p>
			<p><span class="panel-left-text sub-expandable">Etica, Compliance<span class="gapEtica"><br/></span> e Whistleblowing&nbsp;&nbsp;</span></p>
			<div class="sub-sub-items" id="sub-etica">
				<p id="panel-left-text-sub-1"><a href="modello-231.html" title="Modello organizzativo ex D.lgs. 231/2001 - Etica, Compliance e Whistelblowing - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Modello organizzativo<span class="gapEtica"><br/></span> ex D.lgs. 231/2001&nbsp&nbsp&nbsp&nbsp&nbsp</span></a></p>
				<p id="panel-left-text-sub-2"><a href="codice-etico-e-di-condotta.html" target="_blank" title="Codice Etico e di Condotta - Etica, Compliance e Whistelblowing - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Codice Etico e di Condotta</span></a></p>
				<p id="panel-left-text-sub-2"><a href="rating-di-legalita.html" title="Rating di Legalità - Etica, Compliance e Whistleblowing - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Rating di Legalità</span></a></p>
				<p id="panel-left-text-sub-2"><a href="whistleblowing.html" title="Whistelblowing - Etica, Compliance e Whistleblowing - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Whistleblowing</span></a></p>
				<p id="panel-left-text-sub-2"><a href="segnalazioni.html" title="Segnalazioni - Etica, Compliance e Whistleblowing - Governance - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Segnalazioni</span></a></p>
			</div>
		</div>
		
		<p id="panel-left-text-3"><a href="{{ url('certificazioni-e-attestazioni.html') }}" data-fullreload="true" title="Certificazioni e Attestazioni - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Certificazioni e Attestazioni</span></a></p>
		<p id="panel-left-text-4"><a href="bilanci-di-esercizio.html" data-fullreload="true" title="Bilanci di esercizio - Chi Siamo - {{ config('app.name') }}"><span class="panel-left-text">Bilanci di esercizio</span></a></p>

	</div>

    <div class="panel-right" id="panel-right">
      <img src="{{ asset('web/images/header-chi-siamo.png') }}" style='width:100%;'>
    </div>
</div>

<script>
	

document.querySelectorAll('.sub-items a').forEach(link => {
	link.addEventListener('click', (e) => {
		// Se ha attributo data-fullreload, lascia fare al browser
		if (link.hasAttribute('data-fullreload')) return;

		e.preventDefault(); 
		// altrimenti fai il tuo caricamento ajax...
	});
});


</script>