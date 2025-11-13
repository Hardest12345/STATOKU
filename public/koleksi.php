<?php
require_once __DIR__ . '/../flipbook_model.php';
$res = get_all_flipbooks();
$flipbooks = $res['status'] === 200 ? $res['data'] : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koleksi Flipbook - Learn with Statoku</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/maskot stato.png') ?>"> <!-- Logo -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

  <!-- ===== NAVBAR ===== -->
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

  <!-- ===== HEADER ===== -->
  <div class="page-header">
    <h1>Koleksi Flipbook Statistika</h1>
    <p>Update Setiap Bulan!</p>
  </div>

  <!-- ===== SEARCH + CATEGORY ===== -->
  <div class="container-main-koleksi">
    <div class="topbar">
      <div class="left-controls">
        <div class="search" role="search">
          <input id="searchInput" type="search" placeholder="Cari flipbook..." aria-label="Cari buku berdasarkan judul">
        </div>
      </div>

      <div class="controls-right">
        <!-- <div class="category-select" id="categoryBtn" role="button" tabindex="0">
          <span id="categoryLabel">Semua Kategori</span> <span style="opacity:0.6">▾</span>
        </div> -->
      </div>
    </div>

    <!-- ===== GRID KOLEKSI ===== -->
    <main>
      <section class="books-grid" id="booksGrid">
        <?php if (count($flipbooks) > 0): ?>
          <?php foreach ($flipbooks as $fb): ?>
            <article class="book-card" 
              data-title="<?= htmlspecialchars($fb['title']) ?>" 
              data-category="<?= htmlspecialchars($fb['category']) ?>" 
              data-status="<?= htmlspecialchars($fb['status']) ?>">
              
              <div class="book-cover">
                <img src="<?= htmlspecialchars($fb['file_url'] ?? base_url('public/assets/media/book-cover.png')) ?>" 
                    alt="<?= htmlspecialchars($fb['title']) ?>">
              </div>

              <div class="book-body">
                <h3 class="book-title"><?= htmlspecialchars($fb['title']) ?></h3>
                <p class="book-desc"><?= htmlspecialchars($fb['description'] ?? '') ?></p>

                <div class="card-footer">
                  <a class="btn-read" href="?route=flipbook/<?= urlencode($fb['id']) ?>">Baca Sekarang</a>
                  <div class="status-pill <?= strtolower($fb['status']) ?>" title="Status: <?= htmlspecialchars($fb['status']) ?>">
                    <?= htmlspecialchars($fb['status']) ?>
                  </div>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="text-align:center">Belum ada flipbook tersedia.</p>
        <?php endif; ?>
      </section>

    </main>
  </div>

  <!-- ===== FOOTER ===== -->
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

  <script>
  function openViewer(url) {
    const w = window.open('', 'flipbook', 'width=900,height=700');
    w.document.write(`
      <html><head><title>Flipbook Viewer</title></head>
      <body style="margin:0"><iframe src="${url}" allowfullscreen style="width:100%;height:100%;border:none"></iframe></body></html>
    `);
  }
  </script>
  <script src="<?= base_url('public/assets/js/main.js') ?>"></script>
</body>
</html>
