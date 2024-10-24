<?php

use Yolva\Test\Base\Router;

const BASE_PATH = __DIR__.'/../';
const VIEW_PATH = BASE_PATH.'views/';

include_once BASE_PATH.'vendor/autoload.php';
include_once BASE_PATH.'src/error-handling.php';
include_once BASE_PATH.'src/helpers.php';

$router = new Router;

include_once BASE_PATH.'routes.php';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$query = ! empty(file_get_contents('php://input'))
    ? json_decode(file_get_contents('php://input'), true)
    : ($method === 'GET' ? $_GET : $_POST);

array_map('htmlspecialchars', $query);

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$path = ($path !== '/') ? rtrim($path, '/') : $path;

$router->resolve($method, $path, $query);
