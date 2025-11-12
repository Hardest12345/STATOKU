<?php
require_once __DIR__ . '/../flipbook_model.php';

// pastikan ada id yang dikirim
$id = $_GET['id'] ?? null;
if (!$id) {
    http_response_code(404);
    echo "Flipbook tidak ditemukan.";
    exit;
}

$res = get_flipbook_by_id($id); // pastikan fungsi ini ada di flipbook_model.php
if ($res['status'] !== 200 || empty($res['data'])) {
    http_response_code(404);
    echo "Flipbook tidak ditemukan.";
    exit;
}

$fb = $res['data'];
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($fb['title']) ?> - Statoku</title>
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
</head>
<body>
  <header>
    <nav>
      <a href="/statoku/">Home</a> |
      <a href="/statoku/?route=koleksi">Koleksi Flipbook</a> |
      <a href="/statoku/?route=tentang">Tentang</a>
      <?php if (isset($_SESSION['admin'])): ?>
        | <a href="/statoku/?route=dashboard">Dashboard</a>
        | <a href="/statoku/?route=logout">Logout</a>
      <?php else: ?>
        | <a href="/statoku/?route=login">Login</a>
      <?php endif; ?>
    </nav>
  </header>
  <main style="max-width:900px;margin:auto;padding:20px">
    <h1><?= htmlspecialchars($fb['title']) ?></h1>

    <div style="margin:20px 0;">
      <iframe 
        src="<?= htmlspecialchars($fb['embed_url']) ?>" 
        allowfullscreen="allowfullscreen" 
        style="width:100%;height:500px;border:1px solid lightgray;">
      </iframe>
    </div>

    <p><?= nl2br(htmlspecialchars($fb['description'] ?? '')) ?></p>
  </main>

  <footer style="text-align:center;padding:10px;">
    <p>Statistika Jadi Cerita — Konten flipbook diperbarui setiap bulan.</p>
  </footer>
</body>
</html>
