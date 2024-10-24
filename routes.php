<?php

use Yolva\Test\Controllers\RegisterController;

$router->get('/', RegisterController::class, 'index');
$router->post('/register', RegisterController::class, 'register');
