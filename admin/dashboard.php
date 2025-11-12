<?php
require_once __DIR__ . '/../auth_admin.php';
require_admin();
require_once __DIR__ . '/../flipbook_model.php';

// Ambil data flipbook dari database
$res = get_all_flipbooks();
$flipbooks = $res['status'] === 200 ? $res['data'] : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Learn with Stato</title>
  <link rel="icon" type="image/png" href="<?= base_url('public/assets/images/maskot stato.png') ?>"> <!-- Logo -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    /* === Ambil style dari dashboard.html === */
    .admin-layout { display: flex; min-height: 100vh; }
    .sidebar { width: 250px; background: var(--navy-blue); color: white; padding: 2rem 1rem; }
    .sidebar-logo { text-align: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.2); }
    .sidebar-menu { list-style: none; }
    .sidebar-menu li { margin-bottom: 0.5rem; }
    .sidebar-menu a { display: block; padding: 0.75rem 1rem; border-radius: 0.5rem; transition: background 0.3s ease; color: white; text-decoration: none; }
    .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.1); }
    .main-content { flex: 1; padding: 2rem; background: var(--gray-light); }
    .content-header { background: white; padding: 1.5rem 2rem; border-radius: 1rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .data-table { background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .data-table table { width: 100%; border-collapse: collapse; }
    .data-table th { background: var(--navy-blue); color: white; padding: 1rem; text-align: left; font-weight: 600; }
    .data-table td { padding: 1rem; border-bottom: 1px solid var(--gray-light); }
    .data-table tr:hover { background: rgba(93,191,184,0.05); }
    .btn-primary { background: var(--teal-primary); color: white; padding: 0.75rem 1.25rem; border-radius: 0.5rem; border: none; cursor: pointer; }
    .btn-primary:hover { background: var(--teal-dark); }
    .btn-danger { background: #e53e3e; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer; }
  </style>
</head>
<body>
  <div class="admin-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-logo">
        <img src="<?= base_url('public/assets/images/maskot stato.png') ?>" style="width: 100px;" alt="Maskot">
        <h2 style="margin-top: 0.5rem; font-size: 1.25rem;">Stato Admin</h2>
        <p style="font-size: 0.875rem; opacity: 0.8;"><?= htmlspecialchars($_SESSION['admin']['email']) ?></p>
      </div>
      <ul class="sidebar-menu">
        <li><a href="/?route=dashboard" class="active">Kelola Flipbook</a></li>
        <li style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
          <a href="/" target="_blank">← Lihat Website</a>
        </li>
        <li><a href="/?route=logout">Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="content-header">
        <h1 style="color: var(--navy-blue); margin: 0;">Dashboard Admin</h1>
        <div style="font-size: 0.875rem; color: var(--gray-medium);" id="currentTime"></div>
      </div>

      <div style="margin-bottom: 1.5rem;">
        <a href="/?route=create" class="btn-primary">+ Tambah Flipbook Baru</a>
      </div>

      <div class="data-table">
        <table>
          <thead>
            <tr>
              <th>Cover</th>
              <th>Judul</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($flipbooks)): ?>
              <tr><td colspan="4" style="text-align:center; color:gray;">Belum ada data flipbook</td></tr>
            <?php else: ?>
              <?php foreach ($flipbooks as $fb): ?>
                <tr>
                  <td>
                    <?php if (!empty($fb['file_url'])): ?>
                      <img src="<?= htmlspecialchars($fb['file_url']) ?>" alt="Cover" style="width: 60px; border-radius: 0.25rem;">
                    <?php else: ?>
                      <span style="color: gray;">-</span>
                    <?php endif; ?>
                  <td><?= htmlspecialchars($fb['title']) ?></td>
                  <td><?= htmlspecialchars($fb['category'] ?? '-') ?></td>
                  <td><?= htmlspecialchars($fb['status'] ?? '-') ?></td>
                  <td>
                    <a href="/?route=edit/<?= htmlspecialchars($fb['id']) ?>">✏️ Edit</a> |
                    <a href="/?route=edit/<?= htmlspecialchars($fb['id']) ?>&delete=1" onclick="return confirm('Hapus data ini?')">🗑️ Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <script>
    // Tampilkan jam real-time
    function updateTime() {
      const el = document.getElementById("currentTime");
      const now = new Date();
      el.textContent = now.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });
    }
    setInterval(updateTime, 1000);
    updateTime();
  </script>
</body>
</html>
