<?php

ini_set('max_execution_time', '300');
ini_set('max_input_time', '300');
ini_set('memory_limit', '512M');

$publicPath = __DIR__ . '/public';

if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = $publicPath . $path;

    if (is_file($file)) {
        return false;
    }
}

require $publicPath . '/index.php';
