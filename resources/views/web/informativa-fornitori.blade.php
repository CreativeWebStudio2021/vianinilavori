@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "INFORMATIVA FORNITORI";
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
		
		#basiMod{display:none;}				
		#basiDeck{display:flex;}	
		@media screen AND (max-width:800px){
			#basiMod{display:block;}					
			#basiDeck{display:none;}					
		}
	  </style>
		
	<div class="body-content-text">
		<div class="mainTextContainer" style="margin-bottom:100px; font-size:20px;">
			
			<h3>Informativa sul trattamento dei dati personali di clienti, fornitori e partner commerciali</h3>
			ai sensi dell’art. 13 Reg. Ue 679/2016 (“GDPR”)
			<br/><br/>
			
			<h4>1. Titolare del Trattamento</h4>
			Vianini Lavori S.p.A., con sede legale in Roma, Via Barberini 11, tel. 06374921, e-mail 
			<a href="mailto:privacy@vianinilavori.it">privacy@vianinilavori.it</a> (di seguito “Azienda” o “Titolare”) sarà Titolare del trattamento dei dati 
			personali da Voi conferiti, che avverrà nei termini e con le modalità appresso specificati. 
			<br/><br/>

			<h4>2. Modalità, finalità e base giuridica del trattamento</h4>
			Il trattamento dei dati personali conferiti da Clienti, Fornitori o Partner Commerciali avviene per 
			poter negoziare e/o eseguire il rapporto contrattuale tra Voi e il Titolare. I dati personali trattati 
			consistono nei dati anagrafici e di contratto del Cliente, Fornitore o Partner Commerciale 
			persona fisica, o delle persone fisiche che agiscono in rappresentanza o comunque 
			nell’interesse del Cliente, Fornitore o Partner Commerciale non persona fisica. Ulteriori dati 
			personali trattati possono riguardare situazioni soggettive delle persone fisiche, dalle quali 
			dipende l’idoneità alla stipula o al mantenimento di particolari tipologie di contratti (e quindi, 
			ad esempio, idoneità tecnico professionale o idoneità anticorruzione o antimafia).  <br/>
			I Vostri dati saranno conservati sia in formato cartaceo che digitale, nel rispetto della normativa 
			vigente e per le sole finalità previste dalla presente informativa. <br/>
			La base giuridica del trattamento è costituita da: legittimo interesse dell’Azienda, per 
			l'accertamento, l'esercizio o la difesa di un diritto in sede giudiziaria nonché al fine di verificare 
			la solidità e solvibilità di Clienti, Fornitori e Partner; adempimento degli obblighi contrattuali 
			nell’esercizio della sua attività, a concludere ed eseguire accordi per l’acquisto o la cessione di 
			beni e servizi; adempimento di obblighi di legge in tema di verifiche e/o comunicazioni 
			obbligatorie. Il conferimento dei dati richiesti per la stipula di contratti tra Voi e l’Azienda e per 
			adempiere agli obblighi scaturenti dal rapporto contrattuale, è condizione necessaria, ed in caso 
			di rifiuto il rapporto contrattuale non potrà iniziare o proseguire.
			<br/><br/>

			<h4>3. Soggetti ai quali sono comunicati i Vostri dati</h4>
			I Vostri dati possono essere comunicati, per il rispetto delle finalità di cui all’art. 2, alle seguenti 
			categorie di destinatari, basati nell’Unione Europea: Committenti principali in caso di 
			subappalto, Enti previdenziali ed assicurativi; Autorità di controllo; istituti bancari o di rating 
			creditizio; fornitori di servizi amministrativo‐contabili e legali; fornitori di servizi tecnici e di 
			assistenza su sistemi informativi. <br/>
			I destinatari dei dati che eseguono il trattamento nell’esclusivo interesse dell’Azienda verranno 			
			nominati da questa Responsabili Esterni del trattamento, ai sensi dell’art. 28 GDPR, e saranno 
			pertanto obbligati al rispetto della riservatezza e della protezione dei Vostri dati, ai sensi della 
			normativa di riferimento. 
			<br/><br/>

			<h4>4. Periodo di conservazione dei dati</h4>
			I dati personali necessari per finalità di tipo amministrativo, fiscale e legale, saranno conservati 
			per la durata di dieci anni dalla cessazione del rapporto contrattuale, salvo che la conservazione 
			per periodi più lunghi sia richiesta per la pendenza di procedure contenziose o di accertamenti 
			fiscali o previdenziali. 
			<br/><br/>

			<h4>5. I Vostri diritti in materia di dati personali </h4>
			Avete il diritto di accesso, rettifica/integrazione, cancellazione, limitazione, opposizione, 
			portabilità dei Vostri dati. Potete inoltre revocare o modificare eventuali consensi prestati.  
			Potete ottenere dal Titolare del Trattamento o dal Responsabile per la Protezione dei Dati 
			chiarimenti sulla presente Informativa o l’elenco aggiornato dei Responsabili Esterni a cui sono 
			comunicati i Vostri dati. <br/>
			Per l’esercizio di tali diritti, potete contattare il Titolare presso la sede legale o all’indirizzo e
			mail <a href="mailto:privacy@vianinilavori.it">privacy@vianinilavori.it</a> ed il Responsabile per la Protezione dei Dati all’indirizzo e-mail 
			<a href="mailto:dpo@vianinilavori.it">dpo@vianinilavori.it</a> <br/>
			Avete inoltre il diritto di rivolgervi al Garante per la Protezione dei Dati Personali, nei casi 
			previsti dalla legge. 
		</div>
	</div>
@endsection