<?php
require_once __DIR__ . '/../flipbook_model.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    http_response_code(404);
    echo "Flipbook tidak ditemukan.";
    exit;
}

$res = get_flipbook_by_id($id);
if ($res['status'] !== 200 || empty($res['data'])) {
    http_response_code(404);
    echo "Flipbook tidak ditemukan.";
    exit;
}

$fb = $res['data'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($fb['title']) ?> - Learn with Statoku</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/maskot stato.png') ?>"> <!-- Logo -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background: #fafafa; }
    .flipbook-viewer { padding: 2rem; text-align: center; }
    .viewer-container { max-width: 900px; margin: 0 auto; background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .flipbook-header h3 { margin-bottom: 1rem; color: #007b83; }
    iframe { width: 100%; height: 500px; border: 1px solid #ccc; border-radius: 8px; }
    .flipbook-controls { margin-top: 2rem; display: flex; justify-content: center; gap: 1rem; }
    .btn { display: inline-block; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; }
    .btn-primary { background-color: #007b83; color: white; }
    .btn-outline { border: 2px solid #007b83; color: #007b83; background: transparent; }
    .btn-outline:hover { background: #007b83; color: white; transition: 0.3s; }
    footer { margin-top: 3rem; background: #f0f0f0; padding: 1rem; text-align: center; color: #555; font-size: 0.9rem; }
  </style>
</head>
<body>

<header>
  <nav class="navbar">
    <div class="container">
      <ul>
        <li><a href="/statoku/">Home</a></li>
        <li><a href="/statoku/?route=koleksi" class="active">Koleksi Flipbook</a></li>
        <li><a href="/statoku/?route=kuis">Kuis Interaktif</a></li>
        <li><a href="/statoku/?route=tentang">Tentang</a></li>
        <?php if (isset($_SESSION['admin'])): ?>
          <li><a href="/statoku/?route=dashboard">Dashboard</a></li>
          <li><a href="/statoku/?route=logout">Logout</a></li>
        <?php else: ?>
          <li><a href="/statoku/?route=login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>

<main class="flipbook-viewer">
  <div class="viewer-container">
    <div id="flipbookHeader" class="flipbook-header">
      <h3><?= htmlspecialchars($fb['title']) ?></h3>
    </div>

    <div class="flipbook-display">
      <iframe 
        src="<?= htmlspecialchars($fb['embed_url']) ?>" 
        allowfullscreen="allowfullscreen" 
        scrolling="no"
      ></iframe>
    </div>

    <p style="margin-top: 1.5rem; text-align:left;"><?= nl2br(htmlspecialchars($fb['description'] ?? '')) ?></p>

    <div class="flipbook-controls">
      <button class="btn btn-outline" onclick="history.back()">Kembali</button>
      <a href="/statoku/?route=koleksi" class="btn btn-primary">Lihat Koleksi Lainnya</a>
    </div>
  </div>
</main>

  <footer class="footer">
    <div class="footer-content">
      <div class="footer-logo">
        <img src="<?= base_url('public/assets/images/maskot stato.png') ?>" alt="Stato" />
        <div>
          <h3>Learn with Statoku</h3>
          <p class="footer-tagline">Statistika Jadi Cerita</p>
        </div>
      </div>

      <div>
        <h3>Halaman</h3>
        <ul>
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li><a href="<?= base_url('?route=koleksi') ?>">Koleksi Flipbook</a></li>
          <li><a href="<?= base_url('?route=kuis') ?>">Kuis Interaktif</a></li>
          <li><a href="<?= base_url('?route=tentang') ?>">Tentang</a></li>
        </ul>
      </div>

  <div>
        <h3>Kontak</h3>
        <ul>
          <li>
            <a href="mailto:learnwithstato@gmail.com" target="_blank">
              Gmail learnwithstato@gmail.com
            </a>
          </li>
          <li>
            <a href="https://wa.me/6283131314170" target="_blank" rel="noopener noreferrer">
              WhatsApp +62 812-3456-7890
            </a>
          </li>
          <li style="margin-top: 1rem;">
            <a href="https://www.instagram.com/learnwithstato" target="_blank" rel="noopener noreferrer">
              Instagram @learnwithstato
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2025 Learn with Statoku. Konten flipbook diperbarui secara berkala setiap bulan.</p>
    </div>
  </footer>
</body>
</html>
