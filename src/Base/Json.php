<?php

namespace Yolva\Test\Base;

class Json
{
    public static function render(array $params = [], int $httpStatusCode = 200): Json
    {
        http_response_code($httpStatusCode);
        echo json_encode($params);

        return new static;
    }
}
