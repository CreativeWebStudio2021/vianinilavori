<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CspReportController extends Controller
{
    /** Limite payload grezzo (byte) per contenere rumore / abusi. */
    private const MAX_PAYLOAD_BYTES = 16384;

    public function __invoke(Request $request): Response
    {
        $contentLength = (int) $request->header('Content-Length', 0);
        if ($contentLength > self::MAX_PAYLOAD_BYTES) {
            return response('', 413);
        }

        $raw = $request->getContent();
        if (strlen($raw) > self::MAX_PAYLOAD_BYTES) {
            return response('', 413);
        }

        if ($raw === '') {
            return response('', 204);
        }

        $payload = json_decode($raw, true);
        if (! is_array($payload)) {
            return response('', 204);
        }

        Log::channel('csp')->info('csp-violation', [
            'ip' => $request->ip(),
            'ua' => mb_substr((string) $request->userAgent(), 0, 250),
            'payload' => $payload,
        ]);

        return response('', 204);
    }
}
