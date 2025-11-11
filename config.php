<?php
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;


$env = Dotenv::createImmutable(__DIR__);
$env->safeLoad();


if (!isset($_ENV['SUPABASE_URL']) || !isset($_ENV['SUPABASE_API_KEY'])) {
    throw new \Exception('Please set SUPABASE_URL and SUPABASE_API_KEY in .env');
}


define('SUPABASE_URL', rtrim($_ENV['SUPABASE_URL'], '/'));
define('SUPABASE_KEY', $_ENV['SUPABASE_API_KEY']);