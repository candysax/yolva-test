<?php

use Yolva\Test\Base\View;

function abort(int $code = 404): void
{
    http_response_code($code);
    View::render("errors/{$code}");
    exit();
}

function base_path(string $path): string
{
    return BASE_PATH.$path;
}

function view_path(string $path): string
{
    return VIEW_PATH.$path;
}

function asset_path(string $path): string
{
    return '/assets/'.$path;
}
