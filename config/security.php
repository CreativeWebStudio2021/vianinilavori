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
                'https://cs.iubenda.com',
                'https://cdn.iubenda.com',
                'https://elfsightcdn.com',
                'https://static.elfsight.com',
                'https://universe-static.elfsightcdn.com',  // widget accessibilità Elfsight
                'https://consent.cookiebot.com',
                'https://consentcdn.cookiebot.com',         // state.js di Cookiebot
            ],

            'style-src' => [
                "'self'",
                "'unsafe-inline'",
                'https://cdnjs.cloudflare.com',
                'https://cdn.jsdelivr.net',
                'https://fonts.googleapis.com',
            ],

            'font-src' => [
                "'self'",
                'data:',
                'https://cdnjs.cloudflare.com',
                'https://fonts.gstatic.com',
            ],

            'img-src' => [
                "'self'",
                'data:',
                'https://i.ytimg.com',
                'https://upload.wikimedia.org',
                'https://maps.gstatic.com',
                'https://maps.googleapis.com',
                'https://www.gstatic.com',
                'https://www.google-analytics.com',         // prudenziale, GA4
                'https://www.google.it',                    // prudenziale, Google Ads
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
                'https://consentcdn.cookiebot.com',         // iframe del banner consensi
            ],

            'connect-src' => [
                "'self'",
                'https://maps.googleapis.com',
                'https://www.google.com',
                'https://www.google.it',                    // Google Ads ga-audiences
                'https://www.gstatic.com',
                'https://www.googletagmanager.com',
                'https://region1.analytics.google.com',     // GA4, rilevato
                'https://www.google-analytics.com',         // prudenziale
                'https://analytics.google.com',             // prudenziale
                'https://stats.g.doubleclick.net',          // prudenziale
                'https://cs.iubenda.com',
                'https://cdn.iubenda.com',
                'https://idb.iubenda.com',                  // telemetria iubenda
                'https://elfsightcdn.com',
                'https://static.elfsight.com',
                'https://universe-static.elfsightcdn.com',  // traduzioni widget
                'https://core.service.elfsight.com',        // boot widget
                'https://consent.cookiebot.com',
                'https://consentcdn.cookiebot.com',         // settings.json
            ],

            'worker-src' => [
                "'self'",
                'blob:',
            ],
        ],
    ],

];
