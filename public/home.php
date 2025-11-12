<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Learn with Statoku</title>
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
    <section class="hero">
      <h1>Learn with Statoku – Belajar Statistika Jadi Seru, Interaktif, dan Ringan!</h1>
      <p>
        <a class="btn" href="/statoku/?route=koleksi">Buka Koleksi Flipbook</a>
        <a class="btn muted" href="#">Kuis (Coming Soon)</a>
      </p>
    </section>

    <section class="cuplikan">
      <h2>Cuplikan Flipbook Terbaru</h2>
      <div class="grid">
        <?php
        $count = 0;
        foreach ($flipbooks as $fb) {
            if ($count++ >= 4) break;
            $title = htmlspecialchars($fb['title'] ?? 'Untitled');
            $cover = $fb['file_url'] ?? '/assets/img/placeholder.png';
            echo "<div class=\"card\">\n";
            echo "  <img src=\"$cover\" alt=\"$title\"/>\n";
            echo "  <h3>$title</h3>\n";
            echo "  <p><a href=\"/statoku/?route=koleksi\">Baca Sekarang</a></p>\n";
            echo "</div>\n";
        }
        ?>
      </div>
    </section>
  </main>

  <footer>
    <p>Statistika Jadi Cerita — Konten flipbook diperbarui setiap bulan.</p>
  </footer>
</body>
</html>
