<?php
require_once __DIR__ . '/config.php';
use GuzzleHttp\Client;

function upload_to_supabase($file) {
    if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['ok'=>false, 'msg'=>'Invalid file upload'];
    }

    $filename = uniqid() . '-' . basename($file['name']);
    $client = new Client(['base_uri' => SUPABASE_URL]);
    $path = "/storage/v1/object/flipbook-covers/$filename";

    try {
        $res = $client->request('POST', $path, [
            'headers' => [
                'Authorization' => 'Bearer ' . SUPABASE_KEY,
                'apikey' => SUPABASE_KEY,
                'Content-Type' => $file['type']
            ],
            'body' => file_get_contents($file['tmp_name'])
        ]);

        if ($res->getStatusCode() >= 200 && $res->getStatusCode() < 300) {
            $publicUrl = SUPABASE_URL . "/storage/v1/object/public/flipbook-covers/$filename";
            return ['ok'=>true, 'url'=>$publicUrl];
        }

        return ['ok'=>false, 'msg'=>'Upload failed'];
    } catch (Exception $e) {
        return ['ok'=>false, 'msg'=>$e->getMessage()];
    }
}
