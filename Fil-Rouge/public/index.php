<?php
$page = !empty($_GET['page']) ? $_GET['page'] : 'index';
$path = '../src/pages/' . $page . '.php';

if (file_exists($path)) {
    require $path;

    require '../templates/layout.html.php';
} else {
    http_response_code(404);
    require '../templates/404.html.php';
}
