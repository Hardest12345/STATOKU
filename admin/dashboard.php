<?php
require_once __DIR__ . '/../auth_admin.php';
require_admin();
require_once __DIR__ . '/../flipbook_model.php';
$res = get_all_flipbooks();
$flipbooks = $res['status'] === 200 ? $res['data'] : [];
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Dashboard</title></head>
<body>
  <h1>Dashboard Admin</h1>
  <p>Welcome, <?= htmlspecialchars($_SESSION['admin']['email']) ?></p>
  <p><a href="/?route=create">Tambah Flipbook</a> | <a href="/?route=logout">Logout</a></p>

  <table border="1" cellpadding="6">
    <tr><th>Title</th><th>Category</th><th>Status</th><th>Action</th></tr>
    <?php foreach ($flipbooks as $fb): ?>
      <tr>
        <td><?= htmlspecialchars($fb['title']) ?></td>
        <td><?= htmlspecialchars($fb['category'] ?? '-') ?></td>
        <td><?= htmlspecialchars($fb['status'] ?? '-') ?></td>
        <td>
          <a href="/?route=edit/<?= htmlspecialchars($fb['id']) ?>">Edit</a> |
          <a href="/?route=edit/<?= htmlspecialchars($fb['id']) ?>&delete=1" onclick="return confirm('Hapus data ini?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
