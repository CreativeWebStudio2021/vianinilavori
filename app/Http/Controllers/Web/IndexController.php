<?php
namespace App\Http\Controllers\Web;

use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\News;
use App\Models\Web\Order;
use App\Models\Web\Products;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Lang;
use View;
use Cookie;
use Session;
use Config;
use App;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminControllers\AdminCustomController;
use App\Helpers\MailHelper;

class IndexController extends Controller
{

    /*public function __construct(Index $index) 
	{
        $this->index = $index;
    }*/
	
	public function index(Request $request, $cmd="home", $pag_att="1", $pag_dett="", $id_dett="", $variables="")
    {	
		$result = array();
		$pag="";
		
		if(isset($_GET['ric_reg'])) $ric_reg=$_GET['ric_reg']; else $ric_reg="";
		if(isset($_GET['ric_prov'])) $ric_prov=$_GET['ric_prov']; else $ric_prov="";
		if(isset($_GET['ric_citta'])) $ric_citta=$_GET['ric_citta']; else $ric_citta="";
		if($pag_att=="1"){
			if(isset($_GET['pag_att'])) $pag_att=$_GET['pag_att']; else $pag_att="1";
		}
		
		$metatag = array();
		
		if($cmd=="home" || $cmd==""){
			$pagina = "home";
			$bladeView="web.index";
		}
			
		elseif($cmd=="news"){
			$pagina = "news";
			$bladeView="web.".$pagina;		
			
			$nomiCategorie = DB::table('categorie_news')
				->join('news', 'categorie_news.id', '=', 'news.categoria')
				->where('news.visibile', '1')
				->select('categorie_news.nome')
				->distinct()
				->orderByDesc('categorie_news.ordine')
				->pluck('nome');
				
			$anni = DB::table('news')
			->where('visibile', '1')
			->whereNotNull('data_news')
			->selectRaw('YEAR(data_news) as anno')
			->distinct()
			->orderByDesc('anno')
			->pluck('anno');
			
			$categoriaFiltro = $request->query('categoria');
			$annoFiltro = $request->query('anno');

			$query = DB::table('news')->where('visibile', '1');

			if ($categoriaFiltro) {
				$query->join('categorie_news', 'news.categoria', '=', 'categorie_news.id')
					  ->where('categorie_news.nome', $categoriaFiltro)
					  ->select('news.*');
			}

			if ($annoFiltro) {
				$query->whereYear('data_news', $annoFiltro);
			}

			$query->orderBy('data_news', 'DESC');
			$newsFiltrate = $query->paginate(10)->appends($request->query());
			

			
			$metatag['title'] = "News";
			$metatag['description'] = "News";	
							
						
		}	
		elseif($cmd=="foto_video_gallery"){
			$pagina = "foto_video_gallery";
			$bladeView="web.".$pagina;

			$listaCat = DB::table('categorie_media')
				->orderBy('ordine', 'DESC')
				->get();

			$galleryIds = $listaCat->pluck('id')->all();

			$tagsByGallery = [];
			if (!empty($galleryIds)) {
				$tagRows = DB::table('media_gallery_tag as mgt')
					->join('media_tag as mt', 'mt.id', '=', 'mgt.id_tag')
					->whereIn('mgt.id_gallery', $galleryIds)
					->where('mt.stato', 1)
					->select('mgt.id_gallery', 'mgt.id_tag')
					->get();
				foreach ($tagRows as $row) {
					$tagsByGallery[$row->id_gallery][] = (int) $row->id_tag;
				}
			}

			$allMediaTags = DB::table('media_tag')
				->where('stato', 1)
				->where('visibile', 1)
				->orderBy('ordine', 'DESC')
				->get();

			$contentNames = ['Foto', 'Video', 'Articoli'];
			$tagsContenuto = $allMediaTags->filter(function ($t) use ($contentNames) {
				return in_array($t->nome, $contentNames, true);
			})->values();
			$orderContenuto = ['Video' => 1, 'Foto' => 2, 'Articoli' => 3];
			$tagsContenuto = $tagsContenuto->sortBy(function ($t) use ($orderContenuto) {
				return $orderContenuto[$t->nome] ?? 99;
			})->values();
			$tagsCategoria = $allMediaTags->filter(function ($t) use ($contentNames) {
				return !in_array($t->nome, $contentNames, true);
			})->values();

			$gruppiByGallery = [];
			if (!empty($galleryIds)) {
				$gruppiRows = DB::table('media_gruppi')
					->whereIn('id_gallery', $galleryIds)
					->orderBy('ordine', 'DESC')
					->orderBy('id')
					->get();
				foreach ($gruppiRows as $g) {
					if (!isset($gruppiByGallery[$g->id_gallery])) {
						$gruppiByGallery[$g->id_gallery] = $g;
					}
				}
			}

			$mediaByGallery = [];
			if (!empty($galleryIds)) {
				$mediaRows = DB::table('media')
					->whereIn('id_rife', $galleryIds)
					->orderBy('ordine', 'DESC')
					->orderBy('id')
					->get();
				foreach ($mediaRows as $m) {
					$mediaByGallery[$m->id_rife][] = $m;
				}
			}

			$galleryCards = [];
			$idx = 0;
			foreach ($listaCat as $gallery) {
				$gid = $gallery->id;
				$firstSection = $gruppiByGallery[$gid] ?? null;
				$previewMedia = null;
				if ($firstSection && !empty($mediaByGallery[$gid])) {
					foreach ($mediaByGallery[$gid] as $m) {
						if ((int) $m->id_gruppo === (int) $firstSection->id) {
							$previewMedia = $m;
							break;
						}
					}
				}
				if (!$previewMedia && !empty($mediaByGallery[$gid])) {
					$previewMedia = $mediaByGallery[$gid][0];
				}

				$thumb = '';
				$isVideo = false;
				$youtubeId = '';
				if ($previewMedia && ($previewMedia->tipo ?? '') === 'video') {
					$isVideo = true;
					$youtubeId = (string) ($previewMedia->img ?? '');
				}
				$anteprima = trim((string) ($gallery->anteprima ?? ''));
				if ($anteprima !== '') {
					$thumb = asset("resarea/img_up/media/{$anteprima}");
				} elseif ($previewMedia) {
					if (($previewMedia->tipo ?? '') === 'video') {
						$thumb = "https://i.ytimg.com/vi/{$youtubeId}/sddefault.jpg";
					} else {
						$file = $previewMedia->img ?? '';
						$thumb = !empty($file) ? asset("resarea/img_up/media/{$file}") : '';
					}
				}

				$titolo = $gallery->nome ?? '';
				$sottotitolo = $gallery->sottotitolo ?? '';
				$luogo = $gallery->luogo ?? '';
				$testo = strip_tags($gallery->testo ?? '');

				$slugBase = Str::slug($titolo !== '' ? $titolo : 'gallery', '-', 'it');
				if ($slugBase === '') {
					$slugBase = 'gallery';
				}

				$galleryCards[] = [
					'id' => $gid,
					'titolo' => $titolo,
					'sottotitolo' => $sottotitolo,
					'luogo' => $luogo,
					'testo' => $testo,
					'thumb' => $thumb,
					'is_video' => $isVideo,
					'youtube_id' => $youtubeId,
					'tag_ids' => $tagsByGallery[$gid] ?? [],
					'original_index' => $idx,
					'slug' => $slugBase . '-' . $gid,
				];
				$idx++;
			}

			$metatag['title'] = "Video e Foto Gallery";
			$metatag['description'] = "Video e Foto Gallery";
		}
		else{
			$pagina = $cmd;
			$bladeView="web.".$pagina;		
		}
		
		if($cmd=="etica-compliance-whistleblowing"){
			$metatag['title'] = "Etica, Compliance e Whistleblowing";
			$metatag['description'] = $metatag['title'];
		}

		if($cmd=="rendicontazione-di-sostenibilita"){
			$metatag['title'] = "Rendicontazione di Sostenibilità";
			$metatag['description'] = $metatag['title'];
		}
		
		
		if(!isset($metatag['title'])) {
			$title=str_replace("_"," ",$cmd);
			$title=str_replace("-"," ",$title);
			$title=ucfirst($title);
			$metatag['title'] = $title;
			$metatag['description'] = $metatag['title'];
		}
		
		
		if(!isset($bladeView)){
			$bladeView = "web.404";
			$cmd="404";
		
			$metatag['title'] = "Error 404 - Page not Found";
			$metatag['description'] = "Error 404 - Page not Found";
			
		}
		
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		if(isset($id_dett)) $view = $view->with('id_dett', $id_dett);
		if(isset($pag_dett)) $view = $view->with('pag_dett', $pag_dett);
		if (isset($nomiCategorie)) { $view = $view->with('nomiCategorie', $nomiCategorie); }
		if (isset($anni)) { $view = $view->with('anni', $anni); }
		if (isset($newsFiltrate)) { $view = $view->with('query_news', $newsFiltrate); }
		if (isset($listaCat)) { $view = $view->with('listaCat', $listaCat); }
		if (isset($galleryCards)) { $view = $view->with('galleryCards', $galleryCards); }
		if (isset($tagsCategoria)) { $view = $view->with('tagsCategoria', $tagsCategoria); }
		if (isset($tagsContenuto)) { $view = $view->with('tagsContenuto', $tagsContenuto); }
		$view = $view->with('variables', $variables);
		
		return $view;		
    }

	/**
	 * Dettaglio singola gallery: URL foto_video_gallery/{slug-titolo}-{id}.html
	 */
	public function galleryDett(string $slug_gallery)
	{
		if (!preg_match('/-(\d+)$/', $slug_gallery, $m)) {
			abort(404);
		}
		$id = (int) $m[1];

		$gallery = DB::table('categorie_media')->where('id', $id)->first();
		if (!$gallery) {
			abort(404);
		}
		if (isset($gallery->visibile) && (string) $gallery->visibile !== '1') {
			abort(404);
		}

		$nome = (string) ($gallery->nome ?? '');
		$slugBase = Str::slug($nome !== '' ? $nome : 'gallery', '-', 'it');
		if ($slugBase === '') {
			$slugBase = 'gallery';
		}
		$canonical = $slugBase . '-' . $id;
		if ($slug_gallery !== $canonical) {
			return redirect()->to(url('foto_video_gallery/' . $canonical . '.html'), 301);
		}

		$gruppi = DB::table('media_gruppi')
			->where('id_gallery', $id)
			->where('stato', 1)
			->where('visibile', 1)
			->orderBy('ordine', 'DESC')
			->orderBy('id')
			->get();

		$allMedia = DB::table('media')
			->where('id_rife', $id)
			->orderBy('ordine', 'DESC')
			->orderBy('id')
			->get();

		$firstSection = $gruppi->first();
		
		$heroMedia = null;
		if ($firstSection) {
			$heroMedia = $allMedia->first(function ($row) use ($firstSection) {
				return (int) $row->id_gruppo === (int) $firstSection->id;
			});
		}
		if (!$heroMedia) {
			$heroMedia = $allMedia->first();
		}

		$heroId = $heroMedia ? (int) $heroMedia->id : null;

		$gruppiWithMedia = [];
		foreach ($gruppi as $gruppo) {
			$items = $allMedia->filter(function ($row) use ($gruppo, $heroId) {
				if ((int) $row->id_gruppo !== (int) $gruppo->id) {
					return false;
				}
				/*if ($heroId !== null && (int) $row->id === $heroId) {
					return false;
				}*/
				return true;
			})->values();
			if ($items->isNotEmpty()) {
				$gruppiWithMedia[] = ['gruppo' => $gruppo, 'media' => $items];
			}
		}

		$pulsanteHref = null;
		$pulsanteTesto = trim((string) ($gallery->pulsante_testo ?? ''));
		if ($pulsanteTesto !== '') {
			if (($gallery->pulsante_tipo ?? 'libero') === 'progetto' && !empty($gallery->progetto)) {
				$prog = DB::table('punti_mappa')->where('id', (int) $gallery->progetto)->first();
				if ($prog) {
					$nomeProg = str_replace('-', '_', Str::slug($prog->titolo ?? 'progetto', '-', 'it'));
					if ($nomeProg === '') {
						$nomeProg = 'progetto';
					}
					$pulsanteHref = url('dettaglio-progetto/' . $nomeProg . '-' . $prog->id . '.html');
				} else {
					$pulsanteHref = url('progetti.html');
				}
			} else {
				$link = trim((string) ($gallery->pulsante_link ?? ''));
				if ($link !== '') {
					$pulsanteHref = preg_match('#^https?://#i', $link) ? $link : url(ltrim($link, '/'));
				}
			}
		}

		$desc = strip_tags((string) ($gallery->sottotitolo ?? ''));
		if ($desc === '') {
			$desc = Str::limit(strip_tags((string) ($gallery->testo ?? '')), 160);
		}
		$metatag = [
			'title' => ($nome !== '' ? $nome : 'Gallery') . ' - Foto/Video Gallery',
			'description' => Str::limit($desc, 160),
		];

		$variables = [];

		return view('web.gallery_dett', [
			'cmd' => 'gallery_dett',
			'metatag' => $metatag,
			'gallery' => $gallery,
			'heroMedia' => $heroMedia,
			'gruppiWithMedia' => $gruppiWithMedia,
			'pulsanteHref' => $pulsanteHref,
			'pulsanteTesto' => $pulsanteTesto,
			'variables' => $variables,
		]);
	}
	
	public function cariche(Request $request, $carica){
		$bladeView="web.cariche";	
		$cmd=$carica;
		
		if($carica=="organismo-di-vigilanza"){
			$id_carica=1;
			$metatag['title'] = "Organismo di Vigilanza - Governance";
			$metatag['description'] = "Organismo di Vigilanza - Governance";
		}
		if($carica=="collegio-sindacale") {
			$id_carica=2;
			$metatag['title'] = "Collegio Sindacale - Governance";
			$metatag['description'] = "Collegio Sindacale - Governance";
		}
		if($carica=="consiglio-di-amministrazione") {
			$id_carica=3;
			$metatag['title'] = "Consiglio di Amministrazione - Governance";
			$metatag['description'] = "Consiglio di Amministrazione - Governance";
		}
		
		
		$view = view($bladeView);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('id_carica', $id_carica);
		$view = $view->with('cmd', $cmd);
		
		return $view;
	}
	
	public function progetti(Request $request, $macro="", $cat="", $dett="")
	{
		$bladeView="web.progetti";	
		$cmd="progetti";
					
		$id_dett="";
		
		if($dett!=""){
			$temp = explode("-",$dett);
			if(isset($temp[1])){
				$id_dett = $temp[1];
				$query_dett=DB::table('punti_mappa')
					->select('*')
					->where('id','=',$id_dett)
					->where('visibile','=','1')
					->get();
				$num_dett=$query_dett->count();
				if($num_dett<1){
					$bladeView = "web.404";
					$cmd="404";
				}
			}
		}
		
		$nome_macro = ucfirst(str_replace("-"," ",$macro));
		$nome_cat = strtoupper(str_replace("-"," ",$cat));
		$titolo = $query_dett[0]->titolo;
		
		$metatag['title'] = $titolo." - ".$nome_macro;
		$metatag['description'] = $titolo." - ".$nome_macro;
		if($nome_cat!=""){
			$metatag['title'] .= " - ".$nome_cat;
			$metatag['description'] .= " - ".$nome_cat;
		}
		$metatag['title'] .= " - Area di Business | ".config('app.name');
		$metatag['description'] .= " - Area di Business | ".config('app.name');
		
		$view = view($bladeView);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('macro', $macro);
		$view = $view->with('nome_macro', $nome_macro);
		$view = $view->with('cat', $cat);
		$view = $view->with('nome_cat', $nome_cat);
		$view = $view->with('id_dett', $id_dett);
		
		return $view;
		
	}
	
	public function indexError(Request $request, $cmd)
	{
		return $this->index($request, $cmd="404");
	}
	
	public function testInvio(Request $request)
	{
		//$from_email = env('APP_EMAIL');
		$from_email = "web@vianinilavori.it";
		$from_name = env('APP_NAME');
		$to_email = env('APP_EMAIL');
		$to_name = env('APP_NAME');
		
		$body_azienda_raw = "Prova";
		
		$body_azienda = view('emails.email_template', [
			'contenuto' => $body_azienda_raw
		])->render();
		
		$esito_azienda = MailHelper::sendMail($from_email, $from_name, "f.denegri@cwstudio.it", "Flavio De Negri", "Mail test", $body_azienda);
		
		return response($esito_azienda);
	}
	
	public function inviaContatto(Request $request)
	{
		/*
		// Controllo campi obbligatori lato server
		$request->validate([
		    'nome'       => 'required|string|max:100',
			'cognome'    => 'required|string|max:100',
			'email'      => 'required|email',
			'messaggio'  => 'required|string',
			'privacy'    => 'accepted',
		]);*/
		
		// Controllo Captcha
		$verify   = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
		  'secret'   => config('app.google_recaptcha_secret_key'),
		  'response' => $request->input('g-recaptcha-response'),
		  'remoteip' => $request->ip(),
		]);
		
		$resp     = $verify->json();		

        // LOG PER DEBUG (score, action, ecc.)
        Log::debug('reCAPTCHA v3 response', [
            'success' => $resp['success'] ?? null,
            'action'  => $resp['action']  ?? null,
            'score'   => $resp['score']   ?? null,
            'email'   => $request->input('email')   ?? null,
            'ip'   => $request->ip()   ?? null,
        ]);
		
		if (!($resp['success'] 
			  && ($resp['action'] ?? '') === 'invia_contatto' 
			  && ($resp['score']  ?? 0) >= 0.7)) {
		  return back()->with('error', 'Verifica reCAPTCHA fallita. Riprova!');
		}
		
		// COntrollo campo Honeypoy (campo trappola)
		if ($request->filled('fax_number')) {
		  // bot catturato
		  abort(419);
		}
		
		//Controllo provenienza
		if ($request->header('origin') !== config('app.url')) {
		  abort(403);
		}

		
		$nome = $request->input('nome');
		$cognome = $request->input('cognome');
		$email = $request->input('email');
		$messaggio = $request->input('messaggio');
		
		$timestamp = Carbon::now()->addHours(2);
		
		DB::table('contatti')->insert([
            'nome'                   => $nome,
            'cognome'                => $cognome,
            'email'                  => $email,
            'messaggio'  			 => $messaggio,
            'created_at'             => $timestamp,
            'updated_at'             => $timestamp,
        ]);
		
		/*
		$from_email = "no-reply@vianinilavori.com";
		$from_name = env('APP_NAME');
		$to_email = "info@vianinilavori.it";
		$to_name = env('APP_NAME');

		$body_azienda_raw = "
			<p>Nuovo messaggio da <b>$nome $cognome</b></p>
			<p>Email: $email</p>
			<p>Messaggio:<br/>
			$messaggio</p>
		";

		$body_cliente_raw = "
			<p>Gentile <b>$nome $cognome</b>,</p>
			<p>Grazie per averci contattato. Abbiamo ricevuto il tuo messaggio:</p>
			<p>$messaggio</p>
			<p>Le risponderemo al più presto.</p>
		";

		// ⬇️ Avvolgi il contenuto con la maschera Blade
		$body_azienda = view('emails.email_template', [
			'contenuto' => $body_azienda_raw
		])->render();

		$body_cliente = view('emails.email_template', [
			'contenuto' => $body_cliente_raw
		])->render();

		$attachments = [];
		if ($request->hasFile('allegato1')) {
			$attachments[] = [
				'path' => $request->file('allegato1')->getRealPath(),
				'name' => $request->file('allegato1')->getClientOriginalName()
			];
		}
		if ($request->hasFile('allegato2')) {
			$attachments[] = [
				'path' => $request->file('allegato2')->getRealPath(),
				'name' => $request->file('allegato2')->getClientOriginalName()
			];
		}

		$esito_azienda = MailHelper::sendMail($from_email, $from_name, $to_email, $to_name, "Nuovo contatto dal sito", $body_azienda, $attachments);
		$esito_cliente = MailHelper::sendMail($from_email, $from_name, $email, "$nome $cognome", "Conferma ricezione messaggio", $body_cliente);
		*/
		return back()->with('success', 'Messaggio inviato con successo.');
	}
	
	public function inviaLavoraConNoi(Request $request)
	{	
		// Controllo campi obbligatori lato server
		$request->validate([
		  'nome'                => 'required|string|max:100',
		  'cognome'             => 'required|string|max:100',
		  'email'               => 'required|email',
		  'ruolo_attuale'       => 'required|string',
		  'mansione_specifica'  => 'required|string',
		  'sede_lavorativa'     => 'required|string',
		  'area_interesse'      => 'required|array|min:1',
		  'cv'                  => 'required|file|mimes:pdf,doc,docx|max:2048',
		  'privacy'             => 'accepted',
		]);
		
		// Controllo Captcha
		$verify   = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
		  'secret'   => config('app.google_recaptcha_secret_key'),
		  'response' => $request->input('g-recaptcha-response'),
		  'remoteip' => $request->ip(),
		]);
		
		$resp     = $verify->json();		

        // LOG PER DEBUG (score, action, ecc.)
        Log::debug('reCAPTCHA v3 response', [
            'success' => $resp['success'] ?? null,
            'action'  => $resp['action']  ?? null,
            'score'   => $resp['score']   ?? null,
            'email'   => $request->input('email')   ?? null,
            'ip'   => $request->ip()   ?? null,
        ]);
		
		if (!($resp['success'] 
			  && ($resp['action'] ?? '') === 'invia_lavora_con_noi' 
			  && ($resp['score']  ?? 0) >= 0.7)) {
		  return back()->with('error', 'Verifica reCAPTCHA fallita. Riprova!');
		}
		
		// COntrollo campo Honeypoy (campo trappola)
		if ($request->filled('fax_number')) {
		  // bot catturato
		  abort(419);
		}
		
		//Controllo provenienza
		if ($request->header('origin') !== config('app.url')) {
		  abort(403);
		}
		
		$nome = $request->input('nome');
		$cognome = $request->input('cognome');
		$email = $request->input('email');
		$ruolo_attuale = $request->input('ruolo_attuale');
		$mansione_specifica = $request->input('mansione_specifica');
		$area_interesse = $request->input('area_interesse');
		$sede_lavorativa = $request->input('sede_lavorativa');
		
		// Loop per avere un codice non ancora usato
		do {
            $codice = Str::random(16); // 16 caratteri alfanumerici
            $folderPath = public_path("resarea/files/lavora_con_noi/{$codice}");
        } while (File::exists($folderPath));
		
		// Creazione ricorsiva della cartella (se non esiste)
        // lettura/esecuzione per tutti, scrittura solo owner
		File::makeDirectory($folderPath, 0755, true);
		
		/*
		// Contenuto del .htaccess per bloccare l’accesso esterno
        $htaccess = <<<'HTACCESS'
					<IfModule mod_authz_core.c>
						# Apache 2.4+
						Require all denied
					</IfModule>

					<IfModule !mod_authz_core.c>
						# Apache 2.2
						Order allow,deny
						Deny from all
					</IfModule>
					HTACCESS;
		
		// Scrive il .htaccess dentro la nuova cartella
        File::put($folderPath . DIRECTORY_SEPARATOR . '.htaccess', $htaccess);*/
		
		$nomeCv                   = null;
        $nomeLetteraPresentazione = null;
		
		if ($request->hasFile('cv')) {
			$file = $request->file('cv');
            $nomeCv = $file->getClientOriginalName();
            $file->move($folderPath, $nomeCv);
		}
		if ($request->hasFile('lettera_presentazione')) {
			$file = $request->file('lettera_presentazione');
            $nomeLetteraPresentazione = $file->getClientOriginalName();
            $file->move($folderPath, $nomeLetteraPresentazione);
		}
		
		$area = $request->input('area_interesse');
		if (is_array($area)) {
			$area = implode(', ', $area);
		}
		
		$timestamp = Carbon::now()->addHours(2);
		
		DB::table('lavora_con_noi')->insert([
            'codice'                 => $codice,
            'nome'                   => $nome,
            'cognome'                => $cognome,
            'email'                  => $email,
            'ruolo_attuale'          => $ruolo_attuale,
            'mansione_specifica'     => $mansione_specifica,
            'area_interesse'         => $area,
            'sede_lavorativa'        => $sede_lavorativa,
            'cv'                     => $nomeCv,
            'lettera_presentazione'  => $nomeLetteraPresentazione,
            'created_at'             => $timestamp,
            'updated_at'             => $timestamp,
        ]);
		
		/*$from_email = "no-reply@vianinilavori.com";
		$from_name = env('APP_NAME');
		$to_email = "job@vianinilavori.it";
		$to_name = env('APP_NAME');

		// Costruzione del corpo email per l'azienda
		$body_azienda_raw = "
			<p>Nuova candidatura da <strong>$nome $cognome</strong></p>
			<p><b>Email:</b> $email</p>
			" . ($ruolo_attuale ? "<p><b>Ruolo Attuale:</b> $ruolo_attuale</p>" : '') . "
			" . ($mansione_specifica ? "<p><b>Mansione Specifica:</b> $mansione_specifica</p>" : '') . "
			" . ($sede_lavorativa ? "<p><b>Sede Lavorativa Preferita:</b> $sede_lavorativa</p>" : '') . "
			" . (count($area_interesse) ? "<p><b>Aree di Interesse:</b> " . implode(', ', $area_interesse) . "</p>" : '') . "
		";

		// Corpo email per il candidato
		$body_cliente_raw = "
			<p>Gentile <b>$nome $cognome</b>,</p>
			<p>Grazie per averci inviato la tua candidatura. Abbiamo ricevuto i seguenti dati:</p>
			" . ($ruolo_attuale ? "<p><b>Ruolo Attuale:</b> $ruolo_attuale</p>" : '') . "
			" . ($mansione_specifica ? "<p><b>Mansione Specifica:</b> $mansione_specifica</p>" : '') . "
			" . ($sede_lavorativa ? "<p><b>Sede Lavorativa Preferita:</b> $sede_lavorativa</p>" : '') . "
			" . (count($area_interesse) ? "<p><b>Aree di Interesse:</b> " . implode(', ', $area_interesse) . "</p>" : '') . "
			<p>Ti ricontatteremo appena possibile.</p>
		";

		$body_azienda = view('emails.email_template', [
			'contenuto' => $body_azienda_raw
		])->render();

		$body_cliente = view('emails.email_template', [
			'contenuto' => $body_cliente_raw
		])->render();

		$attachments = [];
		if ($request->hasFile('cv')) {
			$attachments[] = [
				'path' => $request->file('cv')->getRealPath(),
				'name' => $request->file('cv')->getClientOriginalName()
			];
		}
		if ($request->hasFile('lettera_presentazione')) {
			$attachments[] = [
				'path' => $request->file('lettera_presentazione')->getRealPath(),
				'name' => $request->file('lettera_presentazione')->getClientOriginalName()
			];
		}

		$esito_azienda = MailHelper::sendMail($from_email, $from_name, $to_email, $to_name, "Nuova candidatura dal sito", $body_azienda, $attachments);
		$esito_cliente = MailHelper::sendMail($from_email, $from_name, $email, "$nome $cognome", "Conferma ricezione candidatura", $body_cliente);

		if ($esito_azienda === "OK" && $esito_cliente === "OK") {
			return back()->with('success', 'Messaggio inviato con successo.');
		} else {
			return back()->with('error', "Errore: $esito_azienda | $esito_cliente");
		}*/

		return back()->with('success', 'Candidatura inviata con successo!');
	}

	
	public function invioRichieste(Request $request)
    {   
		$result = array();
		
		$CustomController = new CustomController();
		
        $cmd = "richieste-amministrative";
        $pagina = "richieste-amministrative";
		$bladeView="web.".$pagina;		

		$metatag = array();
		$metatag['title'] = "Richieste Amministrative - Contatti | ".config('app.name');
		$metatag['description'] = "Richieste Amministrative - Contatti | ".config('app.name');	
				
		if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
		if(isset($_POST['cognome'])) $cognome=$_POST['cognome']; else $cognome="";
		if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
		if(isset($_POST['messaggio'])) $messaggio=$_POST['messaggio']; else $messaggio="";
		
		
			
			$captcha=$_POST['cf-turnstile-response'];
			$secretKey = "0x4AAAAAAA5TkEShZcbKndtub8aGx7RCgPQ";
			$ip = $_SERVER['REMOTE_ADDR'];

		   $url_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
		   $data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);
			
			$options = array(
				'http' => array(
					'method' => 'POST',
					'header' => 'Content-type:application/x-www-form-urlencoded',
					'content' => http_build_query($data)
				)
			);
			
			$stream = stream_context_create($options);
			
			$result = file_get_contents($url_path, false, $stream);
			
			$response =  $result;
		   
			$responseKeys = json_decode($response,true);
			if(intval($responseKeys["success"]) == 1) {
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				include("resources/views/web/common/body_mail.css.php");
				
				$dati = "";
				$dati .= "<b>Nome:&nbsp;</b>$nome<br />";
				$dati .= "<b>Cognome:&nbsp;</b>$cognome<br />";
				$dati .= "<b>Email:&nbsp;</b>$email<br />";
				$dati .= "<b>Messaggio:<br/></b>$messaggio<br />";
				$nome_cliente = ucfirst($nome);
				$cognome_cliente = ucfirst($cognome);
				
				$testo_azi ="
					<br><br><br>
					Un utente (<b>$cognome_cliente $nome_cliente</b>) ha inviato una richiesta dal sito.
					<br><br>
					$dati
				";
				
				$testo_cli ="
					<br><br><br>
					Gentile <b>$cognome_cliente $nome_cliente</b> 
					<br><br>
					grazie per aver inviato una richiesta di informazioni.
					<br><br>
					Di seguito i dati forniti:
					<br><br>
					$dati
					<br/><br/>
					Cordiali saluti,
				";
				
				$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
				$oggetto_azi = "Nuova richiesta da sito web";
				
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
				$oggetto_cli = "Vianini Lavori - Richiesta inviata";
				
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,$mail_sito,$nome_del_sito, $oggetto_azi, $body_azi); 
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli); 
				
				if($invioMail_azi=="OK"){
					$alert_type = "success";
					$message = "Email inviata con successo";				
				}else{
					$alert_type = "danger";
					$message = "Errore! $invioMail_azi";
				}
			}else{
				$alert_type = "danger";
				$message = "Error!";				
			}
		
				
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		if(isset($nome) && $nome!="") $view = $view->with('nome', $nome);
		if(isset($cognome) && $cognome!="") $view = $view->with('cognome', $cognome);
		if(isset($email) && $email!="") $view = $view->with('email', $email);
		if(isset($messaggio) && $messaggio!="") $view = $view->with('messaggio', $messaggio);
		$view = $view->with('alert_type', $alert_type);
		$view = $view->withErrors($message);
        return $view;
	}
	
	public function lavoraConNoi(Request $request)
    {   
		$result = array();
		
		$CustomController = new CustomController();
		
        $cmd = "lavora-con-noi";
        $pagina = "lavora-con-noi";
		$bladeView="web.".$pagina;		

		$metatag = array();
		$metatag['title'] = "Lavora con noi - Contatti | ".config('app.name');
		$metatag['description'] = "Lavora con noi - Contatti | ".config('app.name');	
				
		if(isset($_POST['posizione'])) $posizione=$_POST['posizione']; else $posizione="";
		if(isset($_POST['nome'])) $nome=$_POST['nome']; else $nome="";
		if(isset($_POST['cognome'])) $cognome=$_POST['cognome']; else $cognome="";
		if(isset($_POST['email'])) $email=$_POST['email']; else $email="";
		if(isset($_POST['messaggio'])) $messaggio=$_POST['messaggio']; else $messaggio="";
		if(isset($_POST['attachment'])) $attachment=$_POST['attachment']; else $attachment="";
		
		
			
			$captcha=$_POST['cf-turnstile-response'];
			$secretKey = "0x4AAAAAAA5TkEShZcbKndtub8aGx7RCgPQ";
			$ip = $_SERVER['REMOTE_ADDR'];

		   $url_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
		   $data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);
			
			$options = array(
				'http' => array(
					'method' => 'POST',
					'header' => 'Content-type:application/x-www-form-urlencoded',
					'content' => http_build_query($data)
				)
			);
			
			$stream = stream_context_create($options);
			
			$result = file_get_contents($url_path, false, $stream);
			
			$response =  $result;
		   
			$responseKeys = json_decode($response,true);
			if(intval($responseKeys["success"]) == 1) {
				
				$mail_sito = env('APP_EMAIL');
				$ind_sito = env('APP_URL');
				$nome_del_sito = env('APP_NAME');
				$logo_sito = $ind_sito."/".env('APP_LOGO');
				
				$filePath = null;
				if ($request->hasFile('attachment')) {
					$file = $request->file('attachment');
					$filePath = $file->getRealPath(); // Percorso temporaneo del file
				}
				
				include("resources/views/web/common/body_mail.css.php");
				
				$dati = "";
				$dati .= "<b>Posizione:&nbsp;</b>$posizione<br />";
				$dati .= "<b>Nome:&nbsp;</b>$nome<br />";
				$dati .= "<b>Cognome:&nbsp;</b>$cognome<br />";
				$dati .= "<b>Email:&nbsp;</b>$email<br />";
				$dati .= "<b>Messaggio:<br/></b>$messaggio<br />";
				$nome_cliente = ucfirst($nome);
				$cognome_cliente = ucfirst($cognome);
				
				$testo_azi ="
					<br><br><br>
					Un utente (<b>$cognome_cliente $nome_cliente</b>) ha inviato una candidatura spontanea.
					<br><br>
					$dati
				";
				
				$testo_cli ="
					<br><br><br>
					Gentile <b>$cognome_cliente $nome_cliente</b> 
					<br><br>
					grazie per aver inviato una candidatura spontanea.
					<br><br>
					Di seguito i dati forniti:
					<br><br>
					$dati
					<br/><br/>
					Cordiali saluti,
				";
				
				$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
				$oggetto_azi = "Nuova candidatura da sito web";
				
				$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);			
				$oggetto_cli = "Vianini Lavori - Candidatura inviata";
				
				$MailController = new MailController();
				//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
				$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,$mail_sito,$nome_del_sito, $oggetto_azi, $body_azi, $filePath, "attachment", $request); 
				$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_cli, $body_cli, $filePath, "attachment", $request); 
				
				if($invioMail_azi=="OK"){
					$alert_type = "success";
					$message = "Email inviata con successo";				
				}else{
					$alert_type = "danger";
					$message = "Errore! $invioMail_azi";
				}
			}else{
				$alert_type = "danger";
				$message = "Error!";				
			}
		
				
		$view = view($bladeView);
		$view = $view->with('result', $result);
		$view = $view->with('metatag', $metatag);
		$view = $view->with('cmd', $cmd);
		$view = $view->with('pagina', $pagina);
		if(isset($nome) && $nome!="") $view = $view->with('nome', $nome);
		if(isset($cognome) && $cognome!="") $view = $view->with('cognome', $cognome);
		if(isset($email) && $email!="") $view = $view->with('email', $email);
		if(isset($messaggio) && $messaggio!="") $view = $view->with('messaggio', $messaggio);
		if(isset($posizione) && $posizione!="") $view = $view->with('posizione', $posizione);
		$view = $view->with('alert_type', $alert_type);
		$view = $view->withErrors($message);
        return $view;
	}
	
	public function getProjectCard(Request $request)
    {
        $id = $request->input('id');

        // Recupera i dati del progetto
        $project = DB::table('punti_mappa')->where('id', $id)->first();
        if (!$project) {
            return response()->json(['error' => 'Progetto non trovato'], 404);
        }

        $categoria = DB::table('categorie')->where('id', $project->categoria)->first();

        return view('web.ajax.project_card', [
			'project' => $project,
			'categoria' => $categoria,
			'project_id' => $id
		])->render();
    }
	
    public function maintance()
    {
        return view('errors.maintance');
    }

    public function error()
    {
        return view('errors.general_error', ['msg' => $msg]);
    }

    
    //setcookie
    public function setcookie(Request $request)
    {
        Cookie::queue('cookies_data', 1, 4000);
        return json_encode(array('accept'=>'yes'));
    }

    //setsession
    public function setSession(Request $request){
        session(['device_id'=>$request->device_id]);
        
    }
    

}
 