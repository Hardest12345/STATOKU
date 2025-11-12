<?php
require_once __DIR__ . '/../auth_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $r = admin_login($email, $password);
    if ($r['ok']) {
        header('Location: /?route=dashboard');
        exit;
    } else {
        $error = $r['msg'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Learn with StatoKu</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/maskot stato.png') ?>"> <!-- Logo -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <div class="login-header">
        <img src="<?= base_url('public/assets/images/maskot stato.png') ?>" class="logo-login" alt="Stato"
             onerror="this.innerHTML='<div style=&quot;font-size: 60px;&quot;>🦉</div>'" />
        <h1>Admin Panel</h1>
        <p style="color: var(--gray-medium);">Learn with StatoKu</p>
      </div>

      <?php if (!empty($error)): ?>
        <p style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required autocomplete="username" />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required autocomplete="current-password" />
        </div>

        <button type="submit" class="login-btn">Login</button>
      </form>

      <div style="text-align: center; margin-top: 2rem; font-size: 0.875rem; color: var(--gray-medium);">
        <a href="/" style="color: var(--teal-primary); margin-top: 1rem; display: inline-block;">← Kembali ke Website</a>
      </div>
    </div>
  </div>

  <script src="./js/main.js"></script>
</body>
</html>
