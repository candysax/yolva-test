<?php

namespace Yolva\Test\Base;

class View
{
    public static function render(string $view, array $params = []): View
    {
        extract($params);

        include view_path("{$view}.php");

        return new static;
    }
}
