<?php
require_once __DIR__ . '/../auth_admin.php';
require_admin();
require_once __DIR__ . '/../flipbook_model.php';
require_once __DIR__ . '/../upload_helper.php';

$id = $_GET['id'] ?? null;

// Jika admin memilih hapus
if (isset($_GET['delete']) && $id) {
    delete_flipbook($id);
    header('Location: /?route=dashboard');
    exit;
}

// Ambil data flipbook
$fb = null;
if ($id) {
    $get = get_flipbook($id);
    $fb = ($get['status'] === 200 && !empty($get['data'])) ? $get['data'][0] : null;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
    $fileUrl = $fb['file_url'] ?? null;
    if (!empty($_FILES['file']['name'])) {
        $upload = upload_to_supabase($_FILES['file']);
        if ($upload['ok']) $fileUrl = $upload['url'];
    }

    $payload = [
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'file_url' => $fileUrl,
        'embed_url' => $_POST['embed_url'] ?? '',
        'category' => $_POST['category'] ?? 'Dasar',
        'status' => $_POST['status'] ?? 'Aktif'
    ];

    update_flipbook($id, $payload);
    header('Location: /?route=dashboard');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Flipbook - Admin</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/maskot stato.png') ?>"> <!-- Logo -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <style>
    body { font-family: 'Inter', sans-serif; margin: 0; }
    .admin-layout { display: flex; min-height: 100vh; background: var(--gray-light); }
    .sidebar { width: 250px; background: var(--navy-blue); color: white; padding: 2rem 1rem; }
    .sidebar-logo { text-align: center; margin-bottom: 2rem; }
    .sidebar-logo img { width: 90px; border-radius: 50%; }
    .sidebar-menu { list-style: none; padding: 0; }
    .sidebar-menu a { display: block; color: white; text-decoration: none; padding: 0.75rem 1rem; border-radius: 0.5rem; }
    .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.1); }
    .main-content { flex: 1; padding: 2rem; }
    .content-header { background: white; padding: 1.25rem 2rem; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
    .form-card { background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); max-width: 700px; margin: 0 auto; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 0.5rem; }
    .form-group input[type="text"],
    .form-group textarea,
    .form-group select { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 1rem; }
    textarea { resize: vertical; min-height: 100px; }
    .btn-primary { background: var(--teal-primary); color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 0.5rem; cursor: pointer; font-weight: 600; }
    .btn-primary:hover { background: var(--teal-dark); }
    .btn-back { color: var(--navy-blue); text-decoration: none; font-weight: 600; }
    .current-cover { text-align: center; margin-bottom: 1rem; }
    .current-cover img { width: 200px; border-radius: 0.5rem; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
  </style>
</head>
<body>
  <div class="admin-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-logo">
        <img src="<?= base_url('public/assets/images/maskot stato.png') ?>" alt="Maskot">
        <h2>Stato Admin</h2>
        <p style="font-size: 0.875rem; opacity: 0.8;"><?= htmlspecialchars($_SESSION['admin']['email']) ?></p>
      </div>
      <ul class="sidebar-menu">
        <li><a href="/?route=dashboard">← Kembali ke Dashboard</a></li>
        <li><a href="/?route=logout">Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="content-header">
        <h1>Edit Flipbook</h1>
        <a href="/?route=dashboard" class="btn-back">← Kembali</a>
      </div>

      <div class="form-card">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Judul Flipbook</label>
            <input type="text" name="title" value="<?= htmlspecialchars($fb['title'] ?? '') ?>" required>
          </div>

          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description"><?= htmlspecialchars($fb['description'] ?? '') ?></textarea>
          </div>

          <div class="form-group">
            <label>Cover Saat Ini</label>
            <div class="current-cover">
              <?php if (!empty($fb['file_url'])): ?>
                <img src="<?= htmlspecialchars($fb['file_url']) ?>" alt="Cover">
              <?php else: ?>
                <p style="color:gray;">Belum ada cover</p>
              <?php endif; ?>
            </div>
            <input type="file" name="file" accept="image/*">
          </div>

          <div class="form-group">
            <label>Embed URL</label>
            <input type="text" name="embed_url" value="<?= htmlspecialchars($fb['embed_url'] ?? '') ?>" required>
          </div>

          <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="category" value="<?= htmlspecialchars($fb['category'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label>Status</label>
            <select name="status">
              <option value="Aktif" <?= ($fb['status'] === 'Aktif') ? 'selected' : '' ?>>Aktif</option>
              <option value="Coming Soon" <?= ($fb['status'] === 'Coming Soon') ? 'selected' : '' ?>>Coming Soon</option>
            </select>
          </div>

          <div style="text-align: right;">
            <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
