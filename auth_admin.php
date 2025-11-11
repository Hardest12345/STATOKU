<?php
require_once __DIR__ . '/supabase_helper.php';

function find_admin_by_email($email) {
    $res = sb_request('GET', "/admins?email=eq.$email", null);
    if ($res['status'] === 200 && !empty($res['data'])) return $res['data'][0];
    return null;
}

function admin_login($email, $password) {
    $admin = find_admin_by_email($email);
    if (!$admin) return ['ok'=>false, 'msg'=>'Admin not found'];
    if (isset($admin['password_hash']) && password_verify($password, $admin['password_hash'])) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['admin'] = ['id'=>$admin['id'], 'email'=>$admin['email'], 'name'=>$admin['name'] ?? 'Admin'];
        return ['ok'=>true];
    }
    return ['ok'=>false, 'msg'=>'Invalid password'];
}

function require_admin() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['admin'])) {
        header('Location: login.php');
        exit;
    }
}