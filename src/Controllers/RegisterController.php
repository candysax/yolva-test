<?php

namespace Yolva\Test\Controllers;

use Yolva\Test\Base\Json;
use Yolva\Test\Base\View;
use Yolva\Test\Entities\User;
use Yolva\Test\Validators\RegisterValidator;

class RegisterController
{
    public function index(): View
    {
        return View::render('register', ['title' => 'Регистрация']);
    }

    public function register(array $query): Json
    {
        $errors = (new RegisterValidator)->validate($query)->errors();

        if (! empty($errors['errors'])) {
            return Json::render($errors, 422);
        }

        $user = new User([
            'login' => $query['login'],
            'password' => password_hash($query['password'], PASSWORD_DEFAULT),
        ]);

        return Json::render([
            'success' => true,
            'user' => $user,
        ], 201);
    }
}
