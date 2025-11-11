<?php
require_once __DIR__ . '/supabase_helper.php';

function get_all_flipbooks() {
    // Mengambil semua flipbook terurut terbaru
    return sb_request('GET', '/flipbooks', null, ['select' => '*', 'order' => 'created_at.desc']);
}

function get_flipbook($id) {
    return sb_request('GET', "/flipbooks?id=eq.$id", null);
}

function create_flipbook($payload) {
    // payload: associative array
    return sb_request('POST', '/flipbooks', [$payload]);
}

function update_flipbook($id, $payload) {
    return sb_request('PATCH', "/flipbooks?id=eq.$id", $payload);
}

function delete_flipbook($id) {
    return sb_request('DELETE', "/flipbooks?id=eq.$id", null);
}

function get_flipbook_by_id($id) {
    $res = sb_request('GET', "/flipbooks?id=eq.$id", null);
    if ($res['status'] === 200 && !empty($res['data'])) {
        return ['status' => 200, 'data' => $res['data'][0]];
    }
    return ['status' => $res['status'] ?? 500, 'error' => $res['error'] ?? 'Data tidak ditemukan'];
}

