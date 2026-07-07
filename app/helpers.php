<?php

if (! function_exists('mostra_pdf_url')) {
    /**
     * Genera un URL sicuro per mostra_pdf.php con parametri codificati correttamente.
     */
    function mostra_pdf_url(string $file, ?string $title = null, string $cartella = 'certificazioni'): string
    {
        $params = [
            'file' => basename($file),
            'cartella' => preg_replace('/[^a-zA-Z0-9_-]/', '', $cartella) ?: 'certificazioni',
        ];

        if ($title !== null && $title !== '') {
            $params['title'] = $title;
        }

        return 'mostra_pdf.php?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }
}
