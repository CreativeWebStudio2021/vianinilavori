<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /** Direttive risorse a cui aggiungere sempre site_origins (apex + www). */
    private const SITE_ORIGIN_DIRECTIVES = [
        'script-src',
        'style-src',
        'font-src',
        'img-src',
        'media-src',
        'connect-src',
    ];

    /** Direttive a cui aggiungere sempre elfsight_origins (widget Elfsight). */
    private const ELFSIGHT_ORIGIN_DIRECTIVES = [
        'script-src',
        'style-src',
        'font-src',
        'img-src',
        'frame-src',
        'connect-src',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $this->applyBaseHeaders($response);
        $this->applyHsts($request, $response);
        $this->applyCsp($response);

        return $response;
    }

    private function applyBaseHeaders(Response $response): void
    {
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), camera=(), microphone=()');
    }

    private function applyHsts(Request $request, Response $response): void
    {
        if (! config('security.hsts.enabled')) {
            return;
        }

        if (! $request->isSecure()) {
            return;
        }

        $maxAge = (int) config('security.hsts.max_age', 300);
        // Mai includeSubDomains né preload (test è sottodominio di produzione).
        $response->headers->set('Strict-Transport-Security', 'max-age='.$maxAge);
    }

    private function applyCsp(Response $response): void
    {
        $mode = strtolower((string) config('security.csp.mode', 'report-only'));

        if ($mode === 'off') {
            return;
        }

        if (! in_array($mode, ['report-only', 'enforce'], true)) {
            Log::warning('SECURITY_CSP_MODE non riconosciuto, uso report-only', [
                'mode' => $mode,
            ]);
            $mode = 'report-only';
        }

        $policy = $this->buildCspPolicy();
        if ($policy === '') {
            return;
        }

        $headerName = $mode === 'enforce'
            ? 'Content-Security-Policy'
            : 'Content-Security-Policy-Report-Only';

        $response->headers->set($headerName, $policy);
    }

    private function buildCspPolicy(): string
    {
        $sources = config('security.csp.sources', []);
        if (! is_array($sources)) {
            return '';
        }

        $siteOrigins = config('security.csp.site_origins', []);
        if (! is_array($siteOrigins)) {
            $siteOrigins = [];
        }

        $elfsightOrigins = config('security.csp.elfsight_origins', []);
        if (! is_array($elfsightOrigins)) {
            $elfsightOrigins = [];
        }

        $parts = [];

        foreach ($sources as $directive => $values) {
            if (! is_array($values) || $values === []) {
                continue;
            }

            $list = array_values($values);

            if (in_array($directive, self::SITE_ORIGIN_DIRECTIVES, true)) {
                foreach ($siteOrigins as $origin) {
                    if (is_string($origin) && $origin !== '' && ! in_array($origin, $list, true)) {
                        $list[] = $origin;
                    }
                }
            }

            if (in_array($directive, self::ELFSIGHT_ORIGIN_DIRECTIVES, true)) {
                foreach ($elfsightOrigins as $origin) {
                    if (is_string($origin) && $origin !== '' && ! in_array($origin, $list, true)) {
                        $list[] = $origin;
                    }
                }
            }

            $parts[] = $directive.' '.implode(' ', $list);
        }

        // Sempre in coda.
        $parts[] = "frame-ancestors 'self'";
        $parts[] = 'upgrade-insecure-requests';

        $reportUri = config('security.csp.report_uri');
        if (is_string($reportUri) && $reportUri !== '') {
            $parts[] = 'report-uri '.$reportUri;
        }

        return implode('; ', $parts);
    }
}
