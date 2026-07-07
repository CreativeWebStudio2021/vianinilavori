@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "INFORMATIVA CANDIDATI";
	@endphp
	@include('web.common.page_title')
	
	<style>
		h1, h2, h3 {
		  margin-top: 2em;
		  font-weight: bold;
		}
		h1 {
		  font-size: 2em;
		  border-bottom: 2px solid #aaa;
		  padding-bottom: 5px;
		}
		h2 {
		  font-size: 1.5em;
		  margin-top: 1.5em;
		}
		h3 {
		  font-size: 25px;
		  margin-top: 1em;
		  text-transform:uppercase;
		}
		h4 {
		  text-transform:uppercase;
		  font-size: 22px;
		}
		p {
		  margin: 1em 0;
		}
		ul {
		  margin: 1em 0;
		  padding-left: 1.2em;
		}
		strong {
		  font-weight: bold;
		}
		
		.body-content-text {
		  text-align: justify !important;
		}

		.body-content-text h3,
		.body-content-text h4,
		.body-content-text p,
		.body-content-text div,
		.body-content-text span,
		.body-content-text li {
		  text-align: justify !important;
		}
		@media screen AND (max-width:650px){
			.body-content-text {
			  text-align: left !important;
			}
			
			.body-content-text h3,
			.body-content-text h4,
			.body-content-text p,
			.body-content-text div,
			.body-content-text span,
			.body-content-text li {
			  text-align: left !important;
			}
		}
	  </style>
		
	<div class="body-content-text">
		<div class="mainTextContainer" style="margin-bottom:100px; font-size:20px;">
			

			<h3>INFORMATIVA CANDIDATI</h3>
			<br/><br/>
			Ai sensi degli articoli 13 e seguenti del Regolamento UE 679/2016 in materia di protezione dei dati personali (“GDPR”) La informiamo in merito al trattamento dei dati personali da Lei forniti.
			<br/><br/>
			<h4>Titolare del Trattamento</h4>
			Il Titolare del trattamento è Vianini Lavori S.p.A. (“Titolare”), con sede in Roma, Via Barberini 11.
			<br/><br/>
			<h4>Data Protection Officer</h4>
			Il Data Protection Officer (DPO) è il Responsabile della protezione dei dati personali ed è designato dal Titolare per assolvere alle funzioni espressamente previste dal GDPR. I recapiti del DPO designato dal Titolare sono i seguenti: dpo@vianinilavori.it.
			<br/><br/>
			<h4>Dati trattati</h4>
			I dati comprendono, a titolo esemplificativo e non esaustivo, nome, cognome, luogo e data di nascita, codice fiscale, residenza, sesso, contatti telefonici, titolo di studio, esperienze lavorative ed eventuali ulteriori dati da Lei inseriti nel CV e/o nella Lettera di presentazione e/o nel questionario compilato via web.
			<br/><br/>
			La informiamo inoltre che il Titolare potrà trattare “categorie particolari di dati personali” ove necessario ai sensi dell’art. 9, par.2, lett. b) e h) del GDPR, quali dati idonei a rivelare uno stato di salute come l’appartenenza a categorie protette, eventualmente contenuti nel CV o in eventuale ulteriore documentazione da Lei trasmessa. Categorie particolari di dati personali potranno essere trattati esclusivamente per valutare la candidatura per posizioni lavorative rientranti nell’ambito del collocamento mirato. Se necessario per la valutazione di conformità alle normative anticorruzione ed antimafia cui il Titolare è soggetto, potrà essere richiesto di esaminare, nei casi permessi dalla legge, dati relativi a procedimenti o condanne penali. In assenza di tale casistica nonché in assenza delle condizioni di cui all’art. 10 del GDPR, tali dati non saranno presi in considerazione e immediatamente cancellati.
			<br/><br/>
			I suddetti dati vengono raccolti direttamente presso di Lei quale interessato e/o presso fonti pubblicamente accessibili quali il Suo profilo professionale nell’ambito dei social network di natura professionale (nei limiti di cui alla presente informativa).
			<br/><br/>
			<h4>Finalità e modalità del trattamento</h4>
			I dati personali saranno trattati dal Titolare esclusivamente per l’attività di ricerca e selezione del personale, per posizioni aperte attuali e future, con il supporto di mezzi cartacei, informatici o telematici comunque idonei a garantire la sicurezza e la riservatezza del relativo trattamento.
			<br/><br/>
			Le operazioni di trattamento saranno effettuate da incaricati designati dal Titolare direttamente o per il tramite dei delegati e opereranno sotto la loro diretta autorità nel rispetto delle istruzioni ricevute. Il conferimento dei dati stessi è facoltativo, tuttavia il Suo rifiuto a fornirli determinerà per il Titolare l’impossibilità di trattare i Suoi dati e conseguentemente, l’impossibilità di perfezionare l’invio del curriculum e/o della candidatura di Suo interesse e quindi di dar corso alla eventuale selezione.
			<br/><br/>
			I dati personali da Lei volontariamente inseriti, sia mediante la compilazione di maschere on-line, sia mediante l’invio spontaneo del curriculum vitae, in occasione della Sua richiesta di candidatura, saranno conservati in un applicativo gestionale esclusivamente per gli scopi sopra indicati e per il tempo massimo appresso indicato.
			<br/><br/>
			I dati personali dei candidati che vengono selezionati potranno, altresì, essere registrati in una banca dati elettronica del Titolare e/o utilizzati per la partecipazione ad eventi di virtual recruiting attraverso piattaforme di videoconferenza. Il trattamento dei Suoi dati personali sarà effettuato in modo da garantire un’adeguata sicurezza e riservatezza e da impedire l’accesso o l’utilizzo non autorizzato dei dati personali. Pertanto, i Suoi dati personali saranno trattati e conservati nel pieno rispetto dei principi di necessità, minimizzazione dei dati e limitazione del periodo di conservazione, mediante l’adozione di misure tecniche ed organizzative adeguate al livello di rischio dei trattamenti.
			<br/><br/>
			<h4>Basi giuridiche del trattamento</h4>
			Basi giuridiche del trattamento sono:
			
			<style>
				#basiMod{display:none;}				
				#basiDeck{display:flex;}	
				@media screen AND (max-width:800px){
					#basiMod{display:block;}					
					#basiDeck{display:none;}					
				}
			</style>
			<div id="basiMod">
				<h5 style="margin-bottom:10px;">FINALITA’</h5>
				<b>a.</b> Attività strumentali alla selezione e ricerca di personale.<br/>
				<b>b.</b> Esercizio dei diritti del Titolare in sede giudiziale.<br/>
				<b>c.</b> Condivisione dei Suoi dati con società partner del Titolare, operanti nel medesimo settore, interessate a profili professionali corrispondenti al Suo.
				<h5 style="margin-bottom:10px;">BASE GIURIDICA</h5>
				<b>a.</b> Esecuzione di misure precontrattuali adottate su Sua richiesta (art. 6.1 lett. b GDPR).<br/>
				<b>b.</b> Legittimo interesse del Titolare (art. 6.1 lett. f GDPR).<br/>
				<b>c.</b> Consenso dell’interessato (art. 6.1 lett. a GDPR).
			</div>
			
			<div style="flex-direction:column; gap:15px" id="basiDeck">
				<div style="display:flex; gap:40px;">
					<div style="flex:1;">
						<h5 style="margin-bottom:0;">FINALITA’</h5>
					</div>
					<div style="flex:1;">
						<h5 style="margin-bottom:0;">BASE GIURIDICA</h5>
					</div>
				</div>
				
				<div style="display:flex; gap:40px;">
					<div style="flex:1;">
						<b>a.</b> Attività strumentali alla selezione e ricerca di personale.
					</div>
					<div style="flex:1;">
						<b>a.</b> Esecuzione di misure precontrattuali adottate su Sua richiesta (art. 6.1 lett. b GDPR).
					</div>
				</div>
				
				<div style="display:flex; gap:40px;">
					<div style="flex:1;">
						<b>b.</b> Esercizio dei diritti del Titolare in sede giudiziale.
					</div>
					<div style="flex:1;">
						<b>b.</b> Legittimo interesse del Titolare (art. 6.1 lett. f GDPR).
					</div>
				</div>
				
				<div style="display:flex; gap:40px;">
					<div style="flex:1;">
						<b>c.</b> Condivisione dei Suoi dati con società partner del Titolare, operanti nel medesimo settore, interessate a profili professionali corrispondenti al Suo.
					</div>
					<div style="flex:1;">
						<b>c.</b> Consenso dell’interessato (art. 6.1 lett. a GDPR).
					</div>
				</div>
			</div>

			<br/><br/>
			<h4>Trattamento di categorie particolari di dati personali</h4>
			Le chiediamo di indicare nel suo curriculum solo i dati necessari a valutare la Sua candidatura, astenendosi dall’inserire altri dati appartenenti alle c.d. “categorie particolari”, quali, ad esempio, i dati che rivelino le Sue convinzioni religiose, opinioni politiche, ecc., oppure i dati relativi a condanne o procedimenti penali, da indicare solo ove strettamente necessario e previa richiesta del Titolare.
			<br/><br/>
			<h4>Comunicazione a soggetti terzi</h4>
			I dati personali da Lei forniti potranno essere comunicati a responsabili del trattamento designati dal Titolare. In particolare, i dati potranno essere comunicati a società che prestano i seguenti servizi: servizi di selezione del personale; servizi di gestione e manutenzione di sistemi telematici.
			<br/><br/>
			I Responsabili del trattamento designati saranno vincolati alla riservatezza e sicurezza dei dati attraverso un contratto conforme alle previsioni di legge e l’elenco aggiornato dei Responsabili al Trattamento potrà sempre essere richiesto al Titolare del Trattamento.
			<br/><br/>
			Inoltre, i Suoi dati potranno essere condivisi con società controllate o partecipate dal Titolare o, con il Suo consenso, da Società partner del Titolare, operanti nel settore dell’edilizia.
			<br/><br/>
			Tali società, agendo quali autonomi titolari del trattamento, se interessate alla Sua candidatura potranno contattarla per la suddetta finalità.
			<br/><br/>
			<h4>Trasferimento dati a Paesi terzi</h4>
			In caso di trasferimento dei dati al di fuori dello spazio dell’Unione Europea, sarà garantito un livello di protezione equivalente sulle base delle clausole approvate dalla Commissione Europea.
			<br/><br/>
			<h4>Tempo di conservazione dei dati</h4>
			I dati forniti verranno conservati per un periodo massimo di due anni, salvo che l’interessato esprima il consenso alla conservazione per ulteriori periodi definiti.
			<br/><br/>
			<h4>Diritti dell’Interessato</h4>
			Lei ha il diritto di ottenere dal Titolare l’accesso alle seguenti informazioni: le finalità del trattamento, le categorie di dati personali, i destinatari o le categorie di destinatari a cui i dati personali sono stati o saranno comunicati (compresi destinatari di paesi terzi o organizzazioni internazionali), il periodo di conservazione dei dati personali previsto oppure, se non è possibile, i criteri utilizzati per determinare tale periodo, l’origine dei dati personali, l’esistenza di un processo di profilazione e informazioni sulla logica utilizzata.
			<br/><br/>
			Inoltre, ha il diritto di:
			<ul>
				<li>ottenere la rettifica dei dati personali inesatti;</li>

				<li>ottenere l’integrazione dei dati personali incompleti;</li>

				<li>ottenere la limitazione del trattamento dei dati personali (in tal caso, i dati sono trattati soltanto con il Suo consenso, salvo che per la necessaria conservazione degli stessi);</li>

				<li>opporsi al loro trattamento;</li>

				<li>ottenere la cancellazione («diritto all’oblio»).</li>
			</ul>
			Per esercitare i Suoi diritti, può contattare il Titolare ai seguenti recapiti: <b><a href="mailto:privacy@vianinilavori.it">privacy@vianinilavori.it</a></b>
			<br/><br/>
			<h4>Reclami</h4>
			Qualora ritenesse che i trattamenti effettuati dal Titolare possano aver violato le norme del Regolamento europeo in materia di protezione dei dati personali, ha diritto di proporre reclamo all’Autorità Garante per la protezione dei dati personali ai sensi dell’art. 77 del GDPR.
		</div>
	</div>
@endsection	