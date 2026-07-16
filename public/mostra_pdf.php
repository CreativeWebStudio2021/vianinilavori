<?php
$host = $_SERVER['HTTP_HOST'] ?? 'www.vianinilavori.it';
// Usa sempre l'host corrente: su test i PDF stanno in locale e su www spesso non ci sono ancora
$ind_sito = $host;
$http = 'https';

$file = basename($_GET['file'] ?? '');
$title = $_GET['title'] ?? $file;
$cartella = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['cartella'] ?? 'certificazioni') ?: 'certificazioni';

if ($file === '') {
    http_response_code(400);
    exit('File non specificato.');
}

$path = $http . '://' . $ind_sito . '/resarea/files/' . $cartella . '/' . $file;
$viewerUrl = 'web/vendor/pdfjs/web/viewer.html?file=' . rawurlencode($path);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body style="width:100vw; height:100vh; border:none; margin:0; padding:0; overflow:hidden">
    <iframe src="<?php echo htmlspecialchars($viewerUrl, ENT_QUOTES, 'UTF-8'); ?>" style="width:100%; height:100%; border:none; margin:0; padding:0;"></iframe>
</body>
</html>
