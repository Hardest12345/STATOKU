<?php
require_once __DIR__ . '/../auth_admin.php';
require_admin();
require_once __DIR__ . '/../flipbook_model.php';
require_once __DIR__ . '/../upload_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload = upload_to_supabase($_FILES['file'] ?? []);
    if (!$upload['ok']) {
        $error = "Upload gagal: " . $upload['msg'];
    } else {
        $payload = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'file_url' => $upload['url'],
            'embed_url' => $_POST['embed_url'] ?? '',
            'category' => $_POST['category'] ?? 'Dasar',
            'status' => $_POST['status'] ?? 'Aktif'
        ];
        $r = create_flipbook($payload);
        if ($r['status'] >= 200 && $r['status'] < 300) {
            header('Location: /?route=dashboard'); // ✅ perbaikan redirect
            exit;
        } else {
            $error = $r['error'] ?? 'Gagal menambah data';
        }
    }
}
?>
<!doctype html>
<html><body>
  <h2>Tambah Flipbook</h2>
  <?php if(!empty($error)) echo "<p style='color:red'>{$error}</p>"; ?>
  <form method="post" enctype="multipart/form-data">
    <input name="title" placeholder="Title" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="file" name="file" accept="image/*" required><br>
    <input name="embed_url" placeholder="Embed URL (iframe source)" required><br>
    <input name="category" placeholder="Category"><br>
    <select name="status"><option>Aktif</option><option>Coming Soon</option></select><br>
    <button>Save</button>
  </form>
</body></html>
