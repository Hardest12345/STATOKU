<?php
require_once __DIR__ . '/../auth_admin.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $r = admin_login($_POST['email'] ?? '', $_POST['password'] ?? '');
    if ($r['ok']) header('Location: dashboard.php');
    else $error = $r['msg'];
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Login</title></head>
<body>
  <h2>Admin Login</h2>
  <?php if(!empty($error)) echo "<p style='color:red'>{$error}</p>"; ?>
  <form method="post">
    <input name="email" type="email" placeholder="email" required /><br/>
    <input name="password" type="password" placeholder="password" required /><br/>
    <button>Login</button>
  </form>
</body>
</html>