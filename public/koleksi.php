<?php
require_once __DIR__ . '/../flipbook_model.php';
$res = get_all_flipbooks();
$flipbooks = $res['status'] === 200 ? $res['data'] : [];
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Koleksi Flipbook - Statoku</title>
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

  <main>
    <h1>Koleksi Flipbook Statistika – Update Setiap Bulan!</h1>
    <div class="grid">
      <?php foreach ($flipbooks as $fb): ?>
        <div class="card">
          <img src="<?= htmlspecialchars($fb['file_url'] ?? '/assets/img/placeholder.png') ?>" alt="<?= htmlspecialchars($fb['title']) ?>" />
          <h3><?= htmlspecialchars($fb['title']) ?></h3>
          <p><?= htmlspecialchars($fb['description'] ?? '') ?></p>
          <p><a href="?route=flipbook/<?= urlencode($fb['id']) ?>">Baca Sekarang</a></p>
        </div>
      <?php endforeach; ?>
    </div>

    <script>
    function openViewer(url) {
        const w = window.open('', 'flipbook', 'width=900,height=700');
        w.document.write(`
        <html><head><title>Flipbook Viewer</title></head><body style="margin:0">
            <iframe src="${url}" allowfullscreen="allowfullscreen" style="width:100%;height:100%;border:none"></iframe>
        </body></html>
        `);
    }
    </script>

  </main>

  <footer>
    <p>Statistika Jadi Cerita — Konten flipbook diperbarui setiap bulan.</p>
  </footer>
</body>
</html>