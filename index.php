<?php

use Crypto\api\router;

require_once 'vendor/autoload.php';

const ROOT = __DIR__;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

/**
 * $uri[0] is empty because the url starts with '/' and that will explode
 */
if ((isset($uri[1]) && $uri[1] != 'api')) {
    header('HTTP/1.1 404 Not Found');
    exit();
} else {
    if ((isset($uri[2]) && $uri[2] != 'v1')) {
        header('HTTP/1.1 410 Gone');
        exit();
    } else {
        new Router(array_slice($uri, 3), $_SERVER['REQUEST_METHOD']);
    }
}