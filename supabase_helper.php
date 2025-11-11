<?php
require_once __DIR__ . '/config.php';
use GuzzleHttp\Client;

function sb_request($method, $path, $data = null, $query = null) {
    $client = new Client(['base_uri' => SUPABASE_URL]);
    $headers = [
        'apikey' => SUPABASE_KEY,
        'Authorization' => 'Bearer ' . SUPABASE_KEY,
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];
    $options = ['headers' => $headers];
    if ($data !== null) $options['body'] = json_encode($data);
    if ($query !== null) $options['query'] = $query;

    try {
        $res = $client->request($method, '/rest/v1' . $path, $options);
        $body = (string) $res->getBody();
        $json = json_decode($body, true);
        return ['status' => $res->getStatusCode(), 'data' => $json];
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        $resp = $e->getResponse();
        $code = $resp ? $resp->getStatusCode() : 500;
        $body = $resp ? (string)$resp->getBody() : $e->getMessage();
        return ['status' => $code, 'error' => $body];
    } catch (\Exception $e) {
        return ['status' => 500, 'error' => $e->getMessage()];
    }
}
