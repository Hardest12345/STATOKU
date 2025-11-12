<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tentang - Learn with Statoku</title>
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
    <h1>Tentang Learn with Statoku</h1>
    <p>Learn with Statoku adalah portal interaktif untuk pembelajaran statistika yang menampilkan koleksi flipbook dan kuis edukatif. (Kuis: Coming Soon)</p>
    <section>
      <h2>Tim Pengembang</h2>
      <ul>
        <li>Nama Pengembang / Dosen Pembimbing</li>
      </ul>

      <h2>Timeline</h2>
      <p>Fase 1: MVP - Koleksi & Admin CRUD. Fase 2: Kuis Interaktif, dsb.</p>
    </section>
  </main>

  <footer>
    <p>Statistika Jadi Cerita — Konten flipbook diperbarui setiap bulan.</p>
  </footer>
</body>
</html>