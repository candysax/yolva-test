<?php

use Yolva\Test\Base\Json;

error_reporting(E_ALL);
ini_set('display_errors', 1);

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    Json::render(
        ['message' => "Internal Server Error: $errstr in $errfile on line $errline"],
        500
    );
    exit;
});

set_exception_handler(function ($exception) {
    Json::render(
        ['message' => 'Internal Server Error: '.$exception->getMessage()],
        500
    );
    exit;
});
