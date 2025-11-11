<?php
require_once __DIR__ . '/../flipbook_model.php';

// Test create
$payload = [
    'title' => 'Test Flipbook ' . time(),
    'description' => 'Deskripsi test',
    'file_url' => 'https://via.placeholder.com/300x200',
    'embed_url' => 'https://example.com/embed/sample',
    'category' => 'Dasar',
    'status' => 'Aktif'
];
$r = create_flipbook($payload);
echo "Create status: " . ($r['status'] ?? 'no-status') . "\n";
print_r($r);

// Test get all
$s = get_all_flipbooks();
echo "Get all status: " . ($s['status'] ?? 'no-status') . "\n";
print_r(array_slice($s['data'] ?? [], 0, 3));
