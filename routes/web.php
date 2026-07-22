<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

header('Content-Type: text/html; charset=utf-8');

Route::group(['middleware' => ['web']], function () {
	Route::get('general_error/{msg}', function($msg) {
		return view('errors.general_error', ['msg' => $msg]);
	});
		
	Route::get('/milano-cortina-2026-avanzano-in-cadore-i-cantieri-per-la-mobilita-oggi-abbattuto-il-diaframma-delle-gallerie-in-valle-e-tai-di-cadore/', function () { return redirect('/news.html', 301);});
	Route::get('/vianini-lavori-chiude-il-2024-con-una-forte-crescita-della-produzione/', function () { return redirect('/news.html', 301);});
	Route::get('/cantiere-stazione-venezia-linea-metro-c-completati-i-muri-perimetrali-della-prima-macrofase/', function () { return redirect('/news.html', 301);});
	Route::get('/attivita/ciclo-idrico-integrato/dighe-e-impianti-idroelettrici/', function () { return redirect('/progetti/ciclo_idrico_integrato.html', 301);});
	Route::get('/attivita/ciclo-idrico-integrato/canali-e-acquedotti/', function () { return redirect('/progetti/ciclo_idrico_integrato.html', 301);});
	Route::get('/attivita/partecipazioni-strategiche/', function () { return redirect('/progetti.html?stato=Lavori%20completati', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/uni-iso-37001-prevenzione-della-corruzione/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/la-societa/la-governance/', function () { return redirect('/consiglio-di-amministrazione.html', 301);});
	Route::get('/whistleblowing/', function () { return redirect('/whistleblowing.html', 301);});
	Route::get('/platinum-ecovadis-medal-per-vianini-lavori-s-p-a/', function () { return redirect('/home.html', 301);});
	Route::get('/ingegnere-senior-per-il-ruolo-di-responsabile-dellufficio-tecnico-del-cantiere-di-torino/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/attivita/ciclo-idrico-integrato/', function () { return redirect('/progetti/ciclo_idrico_integrato.html', 301);});
	Route::get('/ingegnere-strutturista-con-esperienza/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/la-societa/il-gruppo-caltagirone/', function () { return redirect('/il-gruppo.html', 301);});
	Route::get('/attivita/edilizia-civile-e-industriale/', function () { return redirect('/progetti/edilizia_civile_industriale_e_sportiva.html', 301);});
	Route::get('/bilanci-2/', function () { return redirect('/bilanci-di-esercizio.html', 301);});
	Route::get('/bilanci-2', function () { return redirect('/bilanci-di-esercizio.html', 301);});
	Route::get('/contact/', function () { return redirect('/contatti.html', 301);});
	Route::get('/sostenibilita/bilanci-di-sostenibilita/', function () { return redirect('/rendicontazione-di-sostenibilita.html', 301);});
	Route::get('/sostenibilita/rendicontazione-di-sostenibilita/', function () { return redirect('/rendicontazione-di-sostenibilita.html', 301);});
	Route::get('/bilanci-di-sostenibilita.html', function () { return redirect('/rendicontazione-di-sostenibilita.html', 301);});
	Route::get('/bilanci-di-sostenibilita', function () { return redirect('/rendicontazione-di-sostenibilita.html', 301);});
	Route::get('/sostenibilita/visione-della-sostenibilita/', function () { return redirect('/strategia-di-sostenibilita.html', 301);});
	Route::get('/la-societa/la-storia/', function () { return redirect('/un-viaggio-lungo-oltre-un-secolo.html', 301);});
	Route::get('/ingegnere-strutturista-neolaureato/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/politiche/', function () { return redirect('/politiche.html', 301);});
	Route::get('/attivita/infrastrutture-di-trasporto/metropolitane/', function () { return redirect('/progetti/metropolitane.html', 301);});
	Route::get('/contact/lavora-con-noi/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/home/', function () { return redirect('/home.html', 301);});
	Route::get('/la-societa/la-governance/organi-di-controllo/', function () { return redirect('/organismo-di-vigilanza.html', 301);});
	Route::get('/la-societa/mission/', function () { return redirect('/mission-e-vision.html', 301);});
	Route::get('/we-are-hiring/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/attivita/infrastrutture-di-trasporto/ferrovie/', function () { return redirect('/progetti/ferrovie.html', 301);});
	Route::get('/sostenibilita/rating-di-legalita/', function () { return redirect('/rating-di-legalita.html', 301);});
	Route::get('/sostenibilita/codice-etico/', function () { return redirect('/codice-etico-e-di-condotta.html', 301);});
	Route::get('/responsabile-cantiere-impianti-civili-elettroferroviari-attrezzaggio-canitere-di-torino/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/attivita/infrastrutture-di-trasporto/', function () { return redirect('/progetti/strade.html', 301);});
	Route::get('/project/warehousing/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/air-freight/', function () { return redirect('/progetti.html', 301);});
	Route::get('/sostenibilita/responsabilita-sociale/', function () { return redirect('/strategia-di-sostenibilita.html', 301);});
	Route::get('/attivita/', function () { return redirect('/progetti.html', 301);});
	Route::get('/bilanci/', function () { return redirect('/bilanci-di-esercizio.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/attestazione-soa/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/sa8000-responsabilita-sociale/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/project/volvo-truck/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/vehicle-service/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/affordable-air-freight/', function () { return redirect('/progetti.html', 301);});
	Route::get('/contact/lavora-con-noi-update/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/posizioni-aperte/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/progetti/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/page/2/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/railway-freight/', function () { return redirect('/progetti.html', 301);});
	Route::get('/attivita/infrastrutture-di-trasporto/strade/', function () { return redirect('/progetti/strade.html', 301);});
	Route::get('/sostenibilita/visione-della-sostenibilita/piano-di-sostenibilita/', function () { return redirect('/strategia-di-sostenibilita.html', 301);});
	Route::get('/project/vw-cargo-van/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/ford-compact-track/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/water-freight/', function () { return redirect('/progetti.html', 301);});
	Route::get('/itc/', function () { return redirect('/itc.html', 301);});
	Route::get('/news/', function () { return redirect('/news.html', 301);});
	Route::get('/stiamo-assumendo-ingegner-architett-con-esperienza-orientati-allo-sviluppo-grafico/', function () { return redirect('/lavora-con-noi.html', 301);});
	Route::get('/project/road-freight/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/tow-service/', function () { return redirect('/progetti.html', 301);});
	Route::get('/la-societa/', function () { return redirect('/il-gruppo.html', 301);});
	Route::get('/privacy-policy/', function () { return redirect('/privacy-policy.html', 301);});
	Route::get('/project/lorem-ipsum-truck/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/vw-passenger-van/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/summer-discounts/', function () { return redirect('/progetti.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/qualificazione-contraente-generale/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/uni-iso-39001-sicurezza-stradale/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/uni-iso-45001-salute-e-sicurezza/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/pdr-125-parita-di-genere/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/project/volvo-short-truck/', function () { return redirect('/progetti.html', 301);});
	Route::get('/sostenibilita/', function () { return redirect('/strategia-di-sostenibilita.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/iso-204002017-approvvigionamento-sostenibile/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/project/custom-brokerage/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/passenger-minivan/', function () { return redirect('/progetti.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/uni-iso-9001-qualita/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/project/partial-shipments/', function () { return redirect('/progetti.html', 301);});
	Route::get('/project/', function () { return redirect('/progetti.html', 301);});
	Route::get('/la-societa/la-governance/certificazioni-e-attestazioni/uni-iso-50001-sistema-di-gestione-energia/', function () { return redirect('/certificazioni-e-attestazioni.html', 301);});
	Route::get('/wp-content/uploads/2023/04/PRO_01_Rimedio-lavoro-minorile.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/wp-content/uploads/2023/04/Politica-MOD9.1-del-23.05.2024.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/wp-content/uploads/2023/04/POLITICA-DELLA-PREVENZIONE-DELLA-CORRUZIONE-30.10.2024.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/bilanci-sfogliabili/VianiniLavori2019/index.html', function () { return redirect('/bilanci-di-esercizio.html', 301);});
	Route::get('/bilanci-sfogliabili/VianiniLavori2020/index.html', function () { return redirect('/bilanci-di-esercizio.html', 301);});
	Route::get('/wp-content/uploads/2024/07/Politica-Sicurezza-Stradale.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/bilanci-sfogliabili/VianiniLavori2017/index.html', function () { return redirect('/bilanci-di-esercizio.html', 301);});
	Route::get('/bilanci-sfogliabili/VianiniLavori2018/index.html', function () { return redirect('/bilanci-di-esercizio.html', 301);});
	Route::get('/wp-content/uploads/2023/04/4.5.23-Politica-Acquisti-Sostenibili-Vianini-Lavori-sito.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/wp-content/uploads/2024/07/Politica-Parita-di-Genere-Rev.-0-del-30.05.2024.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/bilanci-sfogliabili/VianiniLavori2023/index.html', function () { return redirect('/bilanci/VianiniLavori2023/index.html', 301);});
	Route::get('/wp-content/uploads/2023/04/54MDI1-Politica-DI-Rev01-sito.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/wp-content/uploads/2023/04/Bilancio-di-sostenibilita-2022-Vianini-Lavori-web.pdf', function () { return redirect('/rendicontazione-di-sostenibilita.html', 301);});
	Route::get('/wp-content/uploads/2024/10/61MD5-Rev.-1-del-29.09.2023-Politica-della-Remunerazione.pdf', function () { return redirect('/politiche.html', 301);});
	Route::get('/bilanci-sfogliabili/VianiniLavori2022/index.html', function () { return redirect('/bilanci/VianiniLavori2022/index.html', 301);});
	Route::get('/bilanci-sfogliabili/VianiniLavori2024/index.html', function () { return redirect('/bilanci/VianiniLavori2024/index.html', 301);});
	
	
	Route::get('/', [IndexController::class, 'index']);
	
	
	Route::get('/content/{type}', function ($type) {
		$allowed = ['chisiamo', 'ilgruppo', 'incosacrediamo', 'newsemedia', 'progetti', 'sostenibilita'];
		if (!in_array($type, $allowed)) abort(404);
		return view("web.common.contentHeader.$type");
	});
	
	Route::get('/projects/{type}', function ($type) {
		$allowed = ['ferrovie', 'ciclo_idrico', 'edilizia', 'metropolitane', 'opere_marittime', 'strade'];
		if (!in_array($type, $allowed)) abort(404);
		return view("web.slideHome.$type");
	});
	
	Route::get('/foto_video_gallery/{slug_gallery}.html', [IndexController::class, 'galleryDett'])
		->where('slug_gallery', '[a-z0-9\-]+-\d+');

	Route::get('/dettaglio-progetto/{nome_prog}-{id_dett}.html', function ($nome_prog, $id_dett) {
		$progetto = DB::table('punti_mappa')->where('id', $id_dett)->first();
		
		 if (!$progetto) {
			abort(404);
		}
		
		 // Se lo stato non è "Lavoro in corso", redirect
		if ($progetto->stato !== 'Lavoro in corso' && $progetto->visibile_scheda !== '1') {
			$anchor = '#pdf-preview-' . $id_dett;
			return Redirect::to("progetti.html?stato=Lavori%20completati$anchor");
		}
		
		$descrizione_breve = !empty($progetto->descrizione_breve)
			? strip_tags($progetto->descrizione_breve)
			: (!empty($progetto->descrizione)
				? Str::limit(strip_tags($progetto->descrizione), 160)
				: null);

		$metatag = [
			'title' => $progetto->titolo . ' - Progetti',
			'description' => $descrizione_breve ?: ucfirst(str_replace('_', ' ', $nome_prog)) . ' Scopri di più sul progetto realizzato da Vianini Lavori.'
		];

		return view('web.progetto_dett', [
			'id_dett' => $id_dett,
			'cmd' => "progetto_dett",
			'metatag' => $metatag
		]);
	});
	
	Route::get('/progetti/{categoria}.html', function ($categoria) {
		$categorie_valide = ['ferrovie', 'ciclo_idrico_integrato', 'edilizia_civile_industriale_e_sportiva', 'metropolitane', 'opere_marittime', 'strade', 'tutti_i_progetti', 'lavori_in_corso'];
		if (!in_array($categoria, $categorie_valide)) abort(404);
		$metatag = [
			'title' => ucfirst(str_replace('_', ' ', $categoria)) . ' - Progetti',
			'description' => 'Scopri i progetti di ' . str_replace('_', ' ', $categoria) . ' realizzati da Vianini Lavori. Qualità, innovazione e sostenibilità nelle infrastrutture.'
		];
		return view('web.progetti', [
			'categoria' => $categoria,
			'cmd' => 'progetti',
			'metatag' => $metatag
		]);
	});
	
	Route::get('/la-nostra-storia.html', function () {
		return redirect('/un-viaggio-lungo-oltre-un-secolo.html');
	});
	
	Route::get('/test-invio', [IndexController::class, 'testInvio']);
	Route::post('/invia-contatto', [IndexController::class, 'inviaContatto'])
		->middleware('throttle:2,1'); // max 5 richieste al minuto per IP
	Route::post('/lavora-con-noi', [IndexController::class, 'inviaLavoraConNoi'])
		->middleware('throttle:2,1'); // max 5 richieste al minuto per IP

	
	Route::get('/{carica}.html', [IndexController::class, 'cariche'])
		->where('carica', 'consiglio-di-amministrazione|collegio-sindacale|organismo-di-vigilanza');
		
	Route::post('/get-project-card', [IndexController::class, 'getProjectCard']);
	Route::get('/get-project-card', [IndexController::class, 'getProjectCard']);
	
	Route::get('/{cmd}.html', [IndexController::class, 'index']);	
});
