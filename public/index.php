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
  <title>Learn with Statoku</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <header>
    <nav>
      <a href="/">Home</a> |
      <a href="/koleksi.php">Koleksi Flipbook</a> |
      <a href="/about.php">Tentang</a>
    </nav>
  </header>

  <main>
    <section class="hero">
      <h1>Learn with Statoku – Belajar Statistika Jadi Seru, Interaktif, dan Ringan!</h1>
      <p>
        <a class="btn" href="/koleksi.php">Buka Koleksi Flipbook</a>
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
            $embed = $fb['embed_url'] ?? '#';
            echo "<div class=\"card\">\n";
            echo "  <img src=\"$cover\" alt=\"$title\"/>\n";
            echo "  <h3>$title</h3>\n";
            echo "  <p><a href=\"/koleksi.php\">Baca Sekarang</a></p>\n";
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