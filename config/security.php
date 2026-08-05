<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP Strict Transport Security (HSTS)
    |--------------------------------------------------------------------------
    |
    | Predefinito disattivato: va abilitato esplicitamente in produzione.
    | Mai usare includeSubDomains / preload (test.vianinilavori.it è un
    | sottodominio di vianinilavori.it).
    |
    */
    'hsts' => [
        'enabled' => filter_var(env('SECURITY_HSTS_ENABLED', false), FILTER_VALIDATE_BOOLEAN),

        // Partenza conservativa (5 minuti). Alzare solo su conferma esplicita.
        'max_age' => (int) env('SECURITY_HSTS_MAX_AGE', 300),
    ],

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy
    |--------------------------------------------------------------------------
    |
    | mode: 'report-only' | 'enforce' | 'off'
    | Predefinito 'report-only': segnala senza mai bloccare.
    |
    */
    'csp' => [
        'mode' => env('SECURITY_CSP_MODE', 'report-only'),

        // Endpoint di raccolta violazioni (FASE 6). Null = nessuna report-uri.
        'report_uri' => env('SECURITY_CSP_REPORT_URI', null),

        // Solo ambiente di test: consente risorse referenziate verso www/apex.
        'allow_production_origins' => filter_var(
            env('SECURITY_CSP_ALLOW_PRODUCTION_ORIGINS', false),
            FILTER_VALIDATE_BOOLEAN
        ),

        'production_origins' => [
            'https://vianinilavori.it',
            'https://www.vianinilavori.it',
        ],

        /*
        | Origini per direttiva — inventario FASE 2 (sorgente views/asset).
        | Domini "da runtime" (GTM/Maps) vanno aggiunti dopo raccolta violazioni.
        */
        'sources' => [

            'default-src' => ["'self'"],

            // 67 <script> inline in 47 Blade + GTM/iubenda: 'unsafe-inline' necessario.
            // Approccio nonce non realistico in questa fase (segnalato in FASE 2).
            'script-src' => [
                "'self'",
                "'unsafe-inline'",
                'https://code.jquery.com',
                'https://cdnjs.cloudflare.com',
                'https://cdn.jsdelivr.net',
                'https://unpkg.com',
                'https://maps.googleapis.com',
                'https://www.google.com',
                'https://www.gstatic.com',
                'https://www.googletagmanager.com',
                'https://cs.iubenda.com',
                'https://cdn.iubenda.com',
                'https://elfsightcdn.com',
                'https://static.elfsight.com',
                'https://consent.cookiebot.com',
            ],

            // 92 <style> + 747 style=: 'unsafe-inline' necessario.
            // fonts.googleapis: CSS font caricati da Maps (FASE 5).
            'style-src' => [
                "'self'",
                "'unsafe-inline'",
                'https://cdnjs.cloudflare.com',
                'https://cdn.jsdelivr.net',
                'https://fonts.googleapis.com',
            ],

            // Font Awesome da cdnjs; fonts.gstatic da Maps (FASE 5); data: per data-URI.
            'font-src' => [
                "'self'",
                'data:',
                'https://cdnjs.cloudflare.com',
                'https://fonts.gstatic.com',
            ],

            // Self + data + thumb YouTube + icone Wikimedia (contatti/news).
            'img-src' => [
                "'self'",
                'data:',
                'https://i.ytimg.com',
                'https://upload.wikimedia.org',
                'https://maps.gstatic.com',
                'https://maps.googleapis.com',
                'https://www.gstatic.com',
            ],

            // Video home/progetti da asset locali; blob: tipico per PDF.js/player.
            'media-src' => [
                "'self'",
                'blob:',
            ],

            // Embed YouTube + noscript GTM + iframe reCAPTCHA (FASE 5).
            'frame-src' => [
                'https://www.youtube.com',
                'https://www.youtube-nocookie.com',
                'https://www.googletagmanager.com',
                'https://www.google.com',
            ],

            // fetch/$.ajax same-origin + Maps/reCAPTCHA/GTM/iubenda/Elfsight.
            'connect-src' => [
                "'self'",
                'https://maps.googleapis.com',
                'https://www.google.com',
                'https://www.gstatic.com',
                'https://www.googletagmanager.com',
                'https://cs.iubenda.com',
                'https://cdn.iubenda.com',
                'https://elfsightcdn.com',
                'https://static.elfsight.com',
            ],

            // PDF.js / Maps workers (blob); da confermare in FASE 5.
            'worker-src' => [
                "'self'",
                'blob:',
            ],
        ],
    ],

];
