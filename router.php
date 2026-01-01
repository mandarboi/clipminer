<?php
// router.php for CodeIgniter 3
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// jika file fisik ada, biarkan PHP serve langsung
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// selain itu, lempar ke CI
require_once __DIR__ . '/index.php';
