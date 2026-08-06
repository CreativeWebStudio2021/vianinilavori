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

        // Endpoint di raccolta violazioni. Null = nessuna report-uri.
        'report_uri' => env('SECURITY_CSP_REPORT_URI', null),

        // Origini del sito stesso. Servono perché i template usano URL assoluti
        // e apex e www sono origini distinte per il browser.
        'site_origins' => [
            'https://vianinilavori.it',
            'https://www.vianinilavori.it',
        ],

        // Elfsight fornisce tre widget: accessibilità, carosello LinkedIn e chat IA.
        // Il servizio introduce continuamente nuovi sottodomini (widget-data, phosphor.utils,
        // universe-static, core.service, centrifugo...), quindi si usano i caratteri jolly.
        // Il jolly non copre il dominio nudo: 'https://elfsightcdn.com' va elencato a parte.
        'elfsight_origins' => [
            'https://elfsightcdn.com',
            'https://*.elfsightcdn.com',
            'https://*.elfsight.com',
        ],

        /*
        | Origini per direttiva — inventario views/asset + report CSP.
        | Domini "da runtime" (GTM/Maps) vanno aggiunti dopo raccolta violazioni.
        */
        'sources' => [

            'default-src' => ["'self'"],

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
                'https://www.youtube.com',                  // script del player, oltre all'iframe
                'https://cs.iubenda.com',
                'https://cdn.iubenda.com',
                'https://consent.cookiebot.com',
                'https://consentcdn.cookiebot.com',
            ],

            'style-src' => [
                "'self'",
                "'unsafe-inline'",
                'https://cdnjs.cloudflare.com',
                'https://cdn.jsdelivr.net',
                'https://fonts.googleapis.com',             // Maps (runtime)
            ],

            'font-src' => [
                "'self'",
                'data:',
                'https://cdnjs.cloudflare.com',
                'https://fonts.gstatic.com',                // Maps (runtime)
                'https://unpkg.com',                        // font richiamato da CSS servito dal CDN
                'https://cdn.jsdelivr.net',                 // font richiamato da CSS servito dal CDN
            ],

            'img-src' => [
                "'self'",
                'data:',
                'https://i.ytimg.com',
                'https://upload.wikimedia.org',
                'https://maps.gstatic.com',
                'https://maps.googleapis.com',
                'https://www.gstatic.com',
                'https://www.google-analytics.com',
                // Domini Google per paese: il pixel ga-audiences si attiva sul dominio nazionale
                // del visitatore. Non è possibile usare caratteri jolly sul TLD, quindi si coprono
                // solo i paesi con traffico reale (fonte: Analytics + report CSP). I visitatori da
                // altri paesi non verranno aggiunti alle liste di remarketing: scelta consapevole.
                'https://www.google.com',                   // Stati Uniti
                'https://www.google.it',                    // Italia
                'https://www.google.ch',                    // Svizzera
                'https://www.google.ro',                    // Romania
                'https://www.google.co.uk',                 // Regno Unito
                'https://www.google.co.in',                 // India
                'https://www.google.com.eg',                // Egitto, rilevato nei log
                'https://www.google.de',                    // Germania
                'https://www.googletagmanager.com',         // pixel GTM
                'https://media.licdn.com',                  // prudenziale, carosello LinkedIn
                'https://*.licdn.com',                      // prudenziale, carosello LinkedIn
            ],

            'media-src' => [
                "'self'",
                'blob:',
            ],

            'frame-src' => [
                'https://www.youtube.com',
                'https://www.youtube-nocookie.com',
                'https://www.googletagmanager.com',
                'https://www.google.com',
                'https://consentcdn.cookiebot.com',
            ],

            'connect-src' => [
                "'self'",
                'https://maps.googleapis.com',
                // Domini Google per paese: il pixel ga-audiences si attiva sul dominio nazionale
                // del visitatore. Non è possibile usare caratteri jolly sul TLD, quindi si coprono
                // solo i paesi con traffico reale (fonte: Analytics + report CSP). I visitatori da
                // altri paesi non verranno aggiunti alle liste di remarketing: scelta consapevole.
                'https://www.google.com',                   // Stati Uniti
                'https://www.google.it',                    // Italia
                'https://www.google.ch',                    // Svizzera
                'https://www.google.ro',                    // Romania
                'https://www.google.co.uk',                 // Regno Unito
                'https://www.google.co.in',                 // India
                'https://www.google.com.eg',                // Egitto, rilevato nei log
                'https://www.google.de',                    // Germania
                'https://www.gstatic.com',
                'https://www.googletagmanager.com',
                'https://region1.analytics.google.com',
                'https://region1.google-analytics.com',     // dominio distinto dal precedente
                'https://www.google-analytics.com',
                'https://analytics.google.com',
                'https://stats.g.doubleclick.net',
                'https://cs.iubenda.com',
                'https://cdn.iubenda.com',
                'https://idb.iubenda.com',
                'https://consent.cookiebot.com',
                'https://consentcdn.cookiebot.com',
                'wss://*.elfsight.com',                     // WebSocket della chat IA (Centrifugo)
            ],

            'worker-src' => [
                "'self'",
                'blob:',
            ],
        ],
    ],

];
