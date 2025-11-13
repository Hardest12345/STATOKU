<?php
// Aktifkan session jika belum
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kuis Interaktif - Learn with StatoKu</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/maskot stato.png') ?>"> <!-- Logo -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container">
      <ul>
        <li><a href="<?= base_url() ?>">Home</a></li>
        <li><a href="<?= base_url('?route=koleksi') ?>">Koleksi Flipbook</a></li>
        <li><a href="<?= base_url('?route=kuis') ?>" class="active">Kuis Interaktif</a></li>
        <li><a href="<?= base_url('?route=tentang') ?>">Tentang</a></li>
        <?php if (isset($_SESSION['admin'])): ?>
          <li><a href="<?= base_url('?route=dashboard') ?>">Dashboard</a></li>
          <li><a href="<?= base_url('?route=logout') ?>">Logout</a></li>
        <?php else: ?>
          <li><a href="<?= base_url('?route=login') ?>">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <!-- Coming Soon Section -->
  <section class="coming-soon">
    <div class="coming-soon-content">
      <div class="coming-soon-icon">🎯</div>
      <h1 style="font-size: 3rem; color: var(--navy-blue); margin-bottom: 1rem;">Kuis Interaktif</h1>
      <span class="badge badge-orange" style="font-size: 1.25rem; padding: 0.75rem 2rem;">Coming Soon!</span>

      <p style="font-size: 1.25rem; color: var(--gray-medium); margin: 2rem 0;">
        Fitur kuis interaktif sedang dalam tahap pengembangan.
        Segera hadir untuk menguji pemahaman Anda tentang statistika dengan cara yang menyenangkan!
      </p>
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
