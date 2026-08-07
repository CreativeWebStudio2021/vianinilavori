<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Genera public/sitemap.xml con tutte le pagine statiche e dinamiche (progetti e gallery)';

    /**
     * Pagine statiche raggiungibili via rotta catch-all /{cmd}.html e rotte dedicate.
     * '' corrisponde alla home (/).
     */
    private array $paginePercorsi = [
        '', 'home.html', 'il-gruppo.html', 'vianini-lavori-oggi.html', 'mission-e-vision.html',
        'un-viaggio-lungo-oltre-un-secolo.html', 'itc.html', 'certificazioni-e-attestazioni.html',
        'modello-231.html', 'codice-etico-e-di-condotta.html', 'rating-di-legalita.html',
        'rating-di-sostenibilita.html', 'strategia-di-sostenibilita.html',
        'rendicontazione-di-sostenibilita.html', 'global-compact.html', 'politiche.html',
        'whistleblowing.html', 'etica-compliance-whistleblowing.html', 'segnalazioni.html',
        'sicurezza-sul-lavoro.html', 'bilanci-di-esercizio.html', 'rassegna-stampa.html',
        'news.html', 'foto_video_gallery.html', 'mappa-interattiva.html', 'lavora-con-noi.html',
        'contatti.html', 'privacy-policy.html', 'cookie-policy.html', 'informativa-fornitori.html',
        'informativa-candidati.html', 'sitemap.html', 'progetti.html',
        // Governance (rotta cariche)
        'consiglio-di-amministrazione.html', 'collegio-sindacale.html', 'organismo-di-vigilanza.html',
    ];

    /**
     * Categorie progetti valide (routes/web.php).
     */
    private array $categorieProgetti = [
        'ferrovie', 'ciclo_idrico_integrato', 'edilizia_civile_industriale_e_sportiva',
        'metropolitane', 'opere_marittime', 'strade', 'tutti_i_progetti', 'lavori_in_corso',
    ];

    public function handle(): int
    {
        $base = rtrim(config('app.url'), '/');
        $urls = [];

        // --- Pagine statiche + governance ---
        foreach ($this->paginePercorsi as $p) {
            $urls[] = $base . '/' . $p;
        }

        // --- Categorie progetti ---
        foreach ($this->categorieProgetti as $c) {
            $urls[] = $base . '/progetti/' . $c . '.html';
        }

        // --- Dettaglio progetti: solo quelli con pagina di dettaglio raggiungibile
        //     (stato = 'Lavoro in corso' OPPURE visibile_scheda = '1'), come da rotta dettaglio-progetto.
        $progetti = DB::table('punti_mappa')
            ->where(function ($q) {
                $q->where('stato', 'Lavoro in corso')->orWhere('visibile_scheda', '1');
            })
            ->get();
        foreach ($progetti as $p) {
            $slug = $this->toHtaccessUrl(($p->titolo ?? '') . ' ' . ($p->titolo_bold ?? ''));
            $urls[] = $base . '/dettaglio-progetto/' . $slug . '-' . $p->id . '.html';
        }

        // --- Dettaglio gallery: tutte (categorie_media non ha colonna 'visibile',
        //     galleryDett non filtra realmente). Slug come in IndexController::galleryDett.
        $gallery = DB::table('categorie_media')->get();
        foreach ($gallery as $g) {
            $nome = (string) ($g->nome ?? '');
            $slug = Str::slug($nome !== '' ? $nome : 'gallery', '-', 'it') ?: 'gallery';
            $urls[] = $base . '/foto_video_gallery/' . $slug . '-' . $g->id . '.html';
        }

        // --- Scrittura XML ---
        $urls = array_values(array_unique($urls));
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($u, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>' . "\n";
            $xml .= '  </url>' . "\n";
        }
        $xml .= '</urlset>' . "\n";

        file_put_contents(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap generata: ' . count($urls) . ' URL in ' . public_path('sitemap.xml'));

        return self::SUCCESS;
    }

    /**
     * Replica di to_htaccess_url (resources/views/web/common/functions.blade.php):
     * usata dalle view per costruire lo slug del dettaglio progetto.
     */
    private function toHtaccessUrl(string $str): string
    {
        $permessi = ['_', '(', ')'];
        $s = strtolower(trim($str));
        $s = str_replace(' ', '_', $s);
        $s = strtr($s, [
            'è' => 'e', 'é' => 'e', 'à' => 'a', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u',
        ]);

        $out = '';
        $len = strlen($s);
        for ($i = 0; $i < $len; $i++) {
            $ch = $s[$i];
            if (ctype_alnum($ch) || in_array($ch, $permessi, true)) {
                $out .= $ch;
            }
        }

        return $out;
    }
}
