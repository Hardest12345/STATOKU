<?php
// Pastikan sesi aktif
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learn with StatoKu - Belajar Statistika Jadi Seru</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/maskot stato.png') ?>"> <!-- Logo -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
  <!-- Navigation -->
    <nav class="navbar">
    <div class="container">
      <ul>
        <li><a href="/statoku/" class="active">Home</a></li>
        <li><a href="/statoku/?route=koleksi">Koleksi Flipbook</a></li>
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

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-background">
      <img src="<?= base_url('public/assets/images/bg beranda full2.png') ?>" alt="Background">
    </div>

    <div class="hero-content">
      <div class="hero-text">
        <h1>LEARN WITH STATOKU</h1>
        <p>Platform pembelajaran statistika berbasis ilustrasi dan flipbook interaktif untuk membantu siswa memahami konsep secara sederhana, terarah, dan relevan.</p>
        <div class="hero-buttons">
          <a class="btn btn-outline" href="#flip-section">NEXT</a>
        </div>
      </div>

      <div class="hero-mascot">
        <div class="mascot-float">
          <img src="<?= base_url('public/assets/images/maskot stato2.png') ?>" alt="Stato Mascot" />
        </div>
      </div>
    </div>
  </section>

  <!-- Flipbook Section -->
  <section id="flip-section" class="section section-flipbooks">
    <div class="container">
      <div class="flip-kiri">
        <img src="<?= base_url('public/assets/images/book.png') ?>" alt="Ilustrasi Flipbook" />
      </div>
      <div class="flip-kanan">
        <div class="section-header">
          <h2>Koleksi Flipbook Terbaru</h2>
          <p>Jelajahi materi statistika interaktif kami yang dirancang untuk membuat belajar jadi lebih menyenangkan</p>
        </div>

        <!-- Grid Flipbook -->
        

        <div class="text-center button-flip mt-3">
          <a href="<?= base_url('?route=koleksi') ?>" class="btn btn-primary">
            Lihat Semua Koleksi
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Kuis Section -->
  <section id="kuis-section" class="section section-kuis">
    <div class="container">
      <div class="notify-box">
        <div class="section-header section-header-kuis">
          <h2 class="h2-kuis">Kuis Interaktif</h2>
          <p>Uji pemahaman Anda tentang statistika dengan kuis seru yang akan segera hadir!</p>
        </div>
        <div class="text-center mt-3">
          <a href="<?= base_url('?route=kuis') ?>" class="btn btn-primary">Coming Soon</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Tentang Section -->
  <section id="tentang-section" class="section section-tentang">
    <div class="container">
      <div class="section-header">
        <h2>Tentang Learn with StatoKu</h2>
        <p>Pelajari lebih lanjut tentang misi kami dalam membuat pembelajaran statistika menjadi menyenangkan dan mudah dipahami</p>
      </div>

      <div class="text-center mt-3">
        <a href="<?= base_url('?route=tentang') ?>" class="btn btn-primary">Pelajari Lebih Lanjut</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-content">
      <div>
        <div class="footer-logo">
          <img src="<?= base_url('public/assets/images/maskot stato.png') ?>" alt="Stato" />
          <div>
            <h3>Learn with StatoKu</h3>
            <p class="footer-tagline">Statistika Jadi Cerita</p>
          </div>
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
      <p>© 2025 Learn with StatoKu. Konten flipbook diperbarui secara berkala setiap bulan.</p>
    </div>
  </footer>

  <script src="<?= base_url('public/assets/js/main.js') ?>"></script>
</body>
</html>
