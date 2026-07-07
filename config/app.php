<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Vianini Lavori'),
	
    'color1' => env('COLOR1', '#E40404'),
    'color1rgb' => env('COLOR1RGB', '288,4,4'),
    'color2' => env('COLOR2', '#353535'),
    'color2rgb' => env('COLOR2RGB', '54,54,54'),
    'rosso' => env('ROSSO', '#E30613'),
    'rossorgb' => env('ROSSO2RGB', '227,6,19'),
	
    'googleapikey' => env('GOOGLEAPIKEY', 'AIzaSyAMap-4lyIIPrOgmU4mQMKMOeX1XjJbubk'),
    'google_recaptcha_public_key' => env('GOOGLE_RECAPTCHA_PUBLIC_KEY', '6LcLozUqAAAAAPlnDQ59hsUJsMxQH8Czy9c_0T34'),
    'google_recaptcha_secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY', '6LcLozUqAAAAAM1bFRbbqvgYC-IXQjRhPs9y6vld'),
	
	'rag_sociale' => env('APP_RAG_SOCIALE', 'Vianini Lavori'),
	'logo_email' => env('APP_LOGO_EMAIL', 'web/images/vianini_bianco_trasparente.png'),
	'email_def' => env('APP_EMAIL_DEF', 'info@vianinilavori.it'),
	'pec' => env('APP_PEC', 'vianinilavori_societario@legalmail.it'),
	'indirizzo' => env('APP_INDIRIZZO', 'via Barberini, 11 - 00187 Roma (RM)'),
	'telefono' => env('APP_TELEFONO', '06.37.49.21'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://63.178.20.232'),
    'dir_up_prod' => env('APP_DIR_UP_PROD', 'http://63.178.20.232'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'it'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'it'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'it_IT'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),
    'google_api_key' => env('GOOGLE_API_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
