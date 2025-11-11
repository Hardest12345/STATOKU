<?php
require_once __DIR__ . '/../auth_admin.php';
require_admin();
require_once __DIR__ . '/../flipbook_model.php';

$id = $_GET['id'] ?? null;
if (isset($_GET['delete'])) {
    $d = delete_flipbook($_GET['delete']);
    header('Location: dashboard.php'); exit;
}

if ($id) {
    $get = get_flipbook($id);
    $fb = ($get['status']===200 && !empty($get['data'])) ? $get['data'][0] : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
    $payload = [
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'file_url' => $_POST['file_url'] ?? '',
        'embed_url' => $_POST['embed_url'] ?? '',
        'category' => $_POST['category'] ?? 'Dasar',
        'status' => $_POST['status'] ?? 'Aktif'
    ];
    $r = update_flipbook($id, $payload);
    header('Location: dashboard.php'); exit;
}

require_once __DIR__ . '/../upload_helper.php';
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
    $r = update_flipbook($id, $payload);
    header('Location: dashboard.php'); exit;
}

?>
<!doctype html>
<html><body>
  <h2>Edit Flipbook</h2>
  <form method="post" enctype="multipart/form-data">
    <input name="title" value="<?= htmlspecialchars($fb['title'] ?? '') ?>" required><br>
    <textarea name="description"><?= htmlspecialchars($fb['description'] ?? '') ?></textarea><br>
    <p>Cover saat ini:</p>
    <img src="<?= htmlspecialchars($fb['file_url'] ?? '') ?>" width="200"><br>
    <input type="file" name="file" accept="image/*"><br>
    <input name="embed_url" value="<?= htmlspecialchars($fb['embed_url'] ?? '') ?>" required><br>
    <input name="category" value="<?= htmlspecialchars($fb['category'] ?? '') ?>"><br>
    <select name="status">
      <option <?= ($fb['status']==='Aktif')?'selected':'' ?>>Aktif</option>
      <option <?= ($fb['status']==='Coming Soon')?'selected':'' ?>>Coming Soon</option>
    </select><br>
    <button>Update</button>
  </form>

</body></html>