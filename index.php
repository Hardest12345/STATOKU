<?php
session_start();
require_once __DIR__ . '/flipbook_model.php';
require_once __DIR__ . '/auth_admin.php';

// ambil data flipbook untuk halaman utama
$res = get_all_flipbooks();
$flipbooks = $res['status'] === 200 ? $res['data'] : [];

function base_url($path = '') {
    // Dapatkan base URL relatif ke server
    $script_name = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $base = rtrim($script_name, '/');
    return $base . '/' . ltrim($path, '/');
}

$route = $_GET['route'] ?? '';
$route = trim($route, '/');

// --- Routing sederhana ---
switch (true) {
    // ==== ROUTE PUBLIC ====
    case ($route === '' || $route === 'home'):
        include __DIR__ . '/public/home.php';
        break;

    case ($route === 'koleksi'):
        include __DIR__ . '/public/koleksi.php';
        break;

    case ($route === 'tentang' || $route === 'about'):
        include __DIR__ . '/public/about.php';
        break;

    case ($route === 'kuis' || $route === 'kuis'):
        include __DIR__ . '/public/kuis.php';
        break;

    case (preg_match('/^flipbook\/([a-zA-Z0-9\-]+)$/', $route, $m)):
        $_GET['id'] = $m[1];
        include __DIR__ . '/public/flipbook_detail.php';
        break;

    // ==== ROUTE ADMIN ====
    case ($route === 'login'):
        include __DIR__ . '/admin/login.php';
        exit;

    case ($route === 'logout'):
        include __DIR__ . '/admin/logout.php';
        exit;

    case ($route === 'dashboard'):
        require_admin();
        include __DIR__ . '/admin/dashboard.php';
        exit;

    case ($route === 'create'):
        require_admin();
        include __DIR__ . '/admin/create_flipbook.php';
        exit;

    case (preg_match('/^edit\/([a-zA-Z0-9\-]+)$/', $route, $m)):
        require_admin();
        $_GET['id'] = $m[1];
        include __DIR__ . '/admin/edit_flipbook.php';
        exit;

    default:
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        exit;
}
?>