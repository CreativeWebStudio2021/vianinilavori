<?php
/**
 * API filesystem per la sezione Archivio del backoffice.
 * Nessun database: opera solo sulla cartella public/resarea/archivio.
 */
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== 'si') {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Non autenticato']);
    exit;
}

if (!isset($_SESSION['acl_login']) || (int)$_SESSION['acl_login'] < 300) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Permessi insufficienti']);
    exit;
}

$ARCHIVIO_ROOT = realpath(__DIR__ . '/../archivio');
if ($ARCHIVIO_ROOT === false) {
    @mkdir(__DIR__ . '/../archivio', 0775, true);
    $ARCHIVIO_ROOT = realpath(__DIR__ . '/../archivio');
}

if ($ARCHIVIO_ROOT === false || !is_dir($ARCHIVIO_ROOT)) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Cartella archivio non disponibile']);
    exit;
}

$action = $_REQUEST['action'] ?? '';
$input = $_POST;
if (empty($input) && strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
    $raw = file_get_contents('php://input');
    $decoded = json_decode($raw, true);
    if (is_array($decoded)) {
        $input = $decoded;
        if (isset($decoded['action'])) {
            $action = $decoded['action'];
        }
    }
}

try {
    switch ($action) {
        case 'list':
            echo json_encode(api_list($ARCHIVIO_ROOT, $_GET['path'] ?? ($input['path'] ?? '')));
            break;
        case 'mkdir':
            echo json_encode(api_mkdir($ARCHIVIO_ROOT, $input['path'] ?? '', $input['name'] ?? ''));
            break;
        case 'upload':
            echo json_encode(api_upload($ARCHIVIO_ROOT, $_POST['path'] ?? '', $_FILES['files'] ?? null));
            break;
        case 'delete':
            echo json_encode(api_delete($ARCHIVIO_ROOT, $input['path'] ?? '', !empty($input['is_dir'])));
            break;
        case 'delete_many':
            echo json_encode(api_delete_many($ARCHIVIO_ROOT, $input['paths'] ?? []));
            break;
        case 'move':
            echo json_encode(api_move($ARCHIVIO_ROOT, $input['paths'] ?? [], $input['dest'] ?? ''));
            break;
        case 'tree':
            echo json_encode(api_tree($ARCHIVIO_ROOT));
            break;
        default:
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Azione non valida']);
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}

/* -------------------------------------------------------------------------- */

function normalize_rel(string $rel): string
{
    $rel = str_replace('\\', '/', $rel);
    $rel = trim($rel, '/');
    if ($rel === '' || $rel === '.') {
        return '';
    }
    $parts = [];
    foreach (explode('/', $rel) as $part) {
        if ($part === '' || $part === '.') {
            continue;
        }
        if ($part === '..') {
            throw new RuntimeException('Percorso non valido');
        }
        if (!preg_match('/^[\w\-\.\(\)\[\]àèéìòùÀÈÉÌÒÙ\s]+$/u', $part)) {
            // consente caratteri comuni nei nomi file italiani; blocca path pericolosi
            if (preg_match('/[\/\\\\:\*\?"<>\|]/', $part)) {
                throw new RuntimeException('Nome non consentito: ' . $part);
            }
        }
        $parts[] = $part;
    }
    return implode('/', $parts);
}

function resolve_path(string $root, string $rel, bool $mustExist = true): string
{
    $rel = normalize_rel($rel);
    $full = $rel === '' ? $root : $root . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
    if ($mustExist) {
        $real = realpath($full);
        if ($real === false) {
            throw new RuntimeException('Percorso non trovato');
        }
    } else {
        $parent = dirname($full);
        $realParent = realpath($parent);
        if ($realParent === false) {
            throw new RuntimeException('Cartella padre non trovata');
        }
        if (strpos($realParent, $root) !== 0) {
            throw new RuntimeException('Percorso fuori dall\'archivio');
        }
        return $full;
    }
    if (strpos($real, $root) !== 0) {
        throw new RuntimeException('Percorso fuori dall\'archivio');
    }
    return $real;
}

function rel_from_full(string $root, string $full): string
{
    $rel = substr($full, strlen($root));
    return ltrim(str_replace('\\', '/', $rel), '/');
}

function public_url(string $rel): string
{
    $rel = ltrim(str_replace('\\', '/', $rel), '/');
    $base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
        . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    // URL pubblico senza /resarea/ (symlink public/archivio → resarea/archivio)
    if ($rel === '') {
        return $base . '/archivio/';
    }
    $parts = array_map('rawurlencode', explode('/', $rel));
    return $base . '/archivio/' . implode('/', $parts);
}

function sanitize_filename(string $name): string
{
    $name = basename(str_replace(['\\', '/'], '', $name));
    $name = preg_replace('/[^\w\-\.\(\)\[\]àèéìòùÀÈÉÌÒÙ\s]/u', '_', $name);
    $name = trim($name);
    if ($name === '' || $name === '.' || $name === '..') {
        throw new RuntimeException('Nome file non valido');
    }
    // evita overwrite silenzioso di .htaccess ecc.
    if (strcasecmp($name, '.htaccess') === 0 || strcasecmp($name, '.gitkeep') === 0) {
        throw new RuntimeException('Nome file riservato');
    }
    return $name;
}

function unique_name(string $dir, string $name): string
{
    if (!file_exists($dir . DIRECTORY_SEPARATOR . $name)) {
        return $name;
    }
    $info = pathinfo($name);
    $base = $info['filename'] ?? 'file';
    $ext = isset($info['extension']) ? '.' . $info['extension'] : '';
    $i = 1;
    do {
        $candidate = $base . '_' . $i . $ext;
        $i++;
    } while (file_exists($dir . DIRECTORY_SEPARATOR . $candidate));
    return $candidate;
}

function format_size(int $bytes): string
{
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    $size = (float)$bytes;
    while ($size >= 1024 && $i < count($units) - 1) {
        $size /= 1024;
        $i++;
    }
    return round($size, $i === 0 ? 0 : 1) . ' ' . $units[$i];
}

function is_dir_empty(string $dir): bool
{
    $items = scandir($dir);
    if ($items === false) {
        return false;
    }
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        if ($item === '.htaccess' || $item === '.gitkeep') {
            continue;
        }
        return false;
    }
    return true;
}

function api_list(string $root, string $path): array
{
    $full = resolve_path($root, $path, true);
    if (!is_dir($full)) {
        throw new RuntimeException('Non è una cartella');
    }

    $rel = rel_from_full($root, $full);
    $folders = [];
    $files = [];

    $items = scandir($full);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..' || $item === '.htaccess' || $item === '.gitkeep') {
            continue;
        }
        $itemPath = $full . DIRECTORY_SEPARATOR . $item;
        $itemRel = ($rel === '' ? '' : $rel . '/') . $item;
        if (is_dir($itemPath)) {
            $count = 0;
            $sub = @scandir($itemPath);
            if ($sub) {
                foreach ($sub as $s) {
                    if ($s !== '.' && $s !== '..' && $s !== '.htaccess' && $s !== '.gitkeep') {
                        $count++;
                    }
                }
            }
            $folders[] = [
                'name' => $item,
                'path' => $itemRel,
                'type' => 'dir',
                'empty' => $count === 0,
                'items' => $count,
                'mtime' => filemtime($itemPath),
            ];
        } elseif (is_file($itemPath)) {
            $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
            $files[] = [
                'name' => $item,
                'path' => $itemRel,
                'type' => 'file',
                'ext' => $ext,
                'size' => filesize($itemPath),
                'size_label' => format_size((int)filesize($itemPath)),
                'mtime' => filemtime($itemPath),
                'url' => public_url($itemRel),
                'previewable' => in_array($ext, ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'txt', 'mp4', 'webm'], true),
            ];
        }
    }

    usort($folders, fn($a, $b) => strcasecmp($a['name'], $b['name']));
    usort($files, fn($a, $b) => strcasecmp($a['name'], $b['name']));

    $crumbs = [];
    if ($rel !== '') {
        $acc = '';
        foreach (explode('/', $rel) as $part) {
            $acc = $acc === '' ? $part : $acc . '/' . $part;
            $crumbs[] = ['name' => $part, 'path' => $acc];
        }
    }

    return [
        'ok' => true,
        'path' => $rel,
        'crumbs' => $crumbs,
        'folders' => $folders,
        'files' => $files,
        'base_url' => public_url(''),
    ];
}

function api_mkdir(string $root, string $path, string $name): array
{
    $name = sanitize_filename(trim($name));
    if ($name === '') {
        throw new RuntimeException('Nome cartella obbligatorio');
    }
    $parent = resolve_path($root, $path, true);
    if (!is_dir($parent)) {
        throw new RuntimeException('Cartella padre non valida');
    }
    $dest = $parent . DIRECTORY_SEPARATOR . $name;
    if (file_exists($dest)) {
        throw new RuntimeException('Esiste già un elemento con questo nome');
    }
    if (!mkdir($dest, 0775, false)) {
        throw new RuntimeException('Impossibile creare la cartella');
    }
    return ['ok' => true, 'path' => rel_from_full($root, $dest)];
}

function api_upload(string $root, string $path, $files): array
{
    if ($files === null || !isset($files['name'])) {
        throw new RuntimeException('Nessun file ricevuto');
    }
    $dir = resolve_path($root, $path, true);
    if (!is_dir($dir)) {
        throw new RuntimeException('Cartella destinazione non valida');
    }

    $names = $files['name'];
    $tmps = $files['tmp_name'];
    $errors = $files['error'];
    $sizes = $files['size'];
    if (!is_array($names)) {
        $names = [$names];
        $tmps = [$tmps];
        $errors = [$errors];
        $sizes = [$sizes];
    }

    $saved = [];
    $failed = [];
    foreach ($names as $i => $original) {
        if (($errors[$i] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            $failed[] = ['name' => $original, 'error' => 'Errore upload #' . ($errors[$i] ?? '?')];
            continue;
        }
        try {
            $safe = sanitize_filename($original);
            $safe = unique_name($dir, $safe);
            $dest = $dir . DIRECTORY_SEPARATOR . $safe;
            if (!move_uploaded_file($tmps[$i], $dest)) {
                throw new RuntimeException('Salvataggio fallito');
            }
            @chmod($dest, 0664);
            $rel = rel_from_full($root, $dest);
            $saved[] = [
                'name' => $safe,
                'path' => $rel,
                'url' => public_url($rel),
                'size' => (int)$sizes[$i],
            ];
        } catch (Throwable $e) {
            $failed[] = ['name' => $original, 'error' => $e->getMessage()];
        }
    }

    return [
        'ok' => count($failed) === 0,
        'saved' => $saved,
        'failed' => $failed,
        'error' => count($failed) ? 'Alcuni file non sono stati caricati' : null,
    ];
}

function api_delete(string $root, string $path, bool $isDir): array
{
    $full = resolve_path($root, $path, true);
    $rel = rel_from_full($root, $full);
    if ($rel === '') {
        throw new RuntimeException('Non è possibile cancellare la cartella radice');
    }

    if ($isDir || is_dir($full)) {
        if (!is_dir($full)) {
            throw new RuntimeException('Non è una cartella');
        }
        if (!is_dir_empty($full)) {
            throw new RuntimeException('La cartella non è vuota');
        }
        // rimuovi eventuali file nascosti di sistema prima di rmdir
        foreach (['.htaccess', '.gitkeep'] as $hidden) {
            $h = $full . DIRECTORY_SEPARATOR . $hidden;
            if (is_file($h)) {
                @unlink($h);
            }
        }
        if (!rmdir($full)) {
            throw new RuntimeException('Impossibile eliminare la cartella');
        }
    } else {
        if (!is_file($full)) {
            throw new RuntimeException('File non trovato');
        }
        if (!unlink($full)) {
            throw new RuntimeException('Impossibile eliminare il file');
        }
    }

    return ['ok' => true];
}

function api_delete_many(string $root, array $paths): array
{
    if (!is_array($paths) || count($paths) === 0) {
        throw new RuntimeException('Nessun elemento selezionato');
    }
    $deleted = [];
    $failed = [];
    foreach ($paths as $p) {
        try {
            $full = resolve_path($root, (string)$p, true);
            if (is_dir($full)) {
                throw new RuntimeException('Usa l\'eliminazione cartella per le directory');
            }
            if (!is_file($full)) {
                throw new RuntimeException('Non è un file');
            }
            if (!unlink($full)) {
                throw new RuntimeException('Eliminazione fallita');
            }
            $deleted[] = $p;
        } catch (Throwable $e) {
            $failed[] = ['path' => $p, 'error' => $e->getMessage()];
        }
    }
    return [
        'ok' => count($failed) === 0,
        'deleted' => $deleted,
        'failed' => $failed,
        'error' => count($failed) ? 'Alcuni file non sono stati eliminati' : null,
    ];
}

function api_move(string $root, array $paths, string $destRel): array
{
    if (!is_array($paths) || count($paths) === 0) {
        throw new RuntimeException('Nessun file da spostare');
    }
    $destDir = resolve_path($root, $destRel, true);
    if (!is_dir($destDir)) {
        throw new RuntimeException('Destinazione non valida');
    }

    $moved = [];
    $failed = [];
    foreach ($paths as $p) {
        try {
            $src = resolve_path($root, (string)$p, true);
            if (!is_file($src)) {
                throw new RuntimeException('Si possono spostare solo file');
            }
            $name = basename($src);
            // non spostare nella stessa cartella
            if (dirname($src) === $destDir) {
                throw new RuntimeException('Il file è già in questa cartella');
            }
            $name = unique_name($destDir, $name);
            $dest = $destDir . DIRECTORY_SEPARATOR . $name;
            if (!rename($src, $dest)) {
                throw new RuntimeException('Spostamento fallito');
            }
            $moved[] = [
                'from' => $p,
                'to' => rel_from_full($root, $dest),
                'url' => public_url(rel_from_full($root, $dest)),
            ];
        } catch (Throwable $e) {
            $failed[] = ['path' => $p, 'error' => $e->getMessage()];
        }
    }

    return [
        'ok' => count($failed) === 0,
        'moved' => $moved,
        'failed' => $failed,
        'error' => count($failed) ? 'Alcuni file non sono stati spostati' : null,
    ];
}

function build_tree_node(string $root, string $rel = ''): array
{
    $full = resolve_path($root, $rel, true);
    $node = [
        'name' => $rel === '' ? 'Archivio' : basename($full),
        'path' => $rel,
        'children' => [],
    ];
    $items = scandir($full);
    if ($items) {
        $dirs = [];
        foreach ($items as $item) {
            if ($item === '.' || $item === '..' || $item === '.htaccess' || $item === '.gitkeep') {
                continue;
            }
            $p = $full . DIRECTORY_SEPARATOR . $item;
            if (is_dir($p)) {
                $dirs[] = $item;
            }
        }
        natcasesort($dirs);
        foreach ($dirs as $item) {
            $childRel = ($rel === '' ? '' : $rel . '/') . $item;
            $node['children'][] = build_tree_node($root, $childRel);
        }
    }
    return $node;
}

function api_tree(string $root): array
{
    return ['ok' => true, 'tree' => build_tree_node($root, '')];
}
