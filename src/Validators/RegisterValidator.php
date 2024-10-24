<?php

namespace Yolva\Test\Validators;

use Yolva\Test\Base\Validator;

class RegisterValidator extends Validator
{
    public function validate(array $data): Validator
    {
        foreach ($data as $key => $value) {
            if (! $this->stringIsFilled($value)) {
                $this->errors[$key][] = 'Поле не заполнено';
            }
        }

        if (! $this->stringLengthBetween($data['login'], 5)) {
            $this->errors['login'][] = 'Логин должен быть не менее 5 символов.';
        }

        if (! $this->valueIsUnique('login', $data['login'])) {
            $this->errors['login'][] = 'Пользователь с таким логином уже существует';
        }

        if (! $this->stringLengthBetween($data['password'], 8)) {
            $this->errors['password'][] = 'Пароль должен быть не менее 8 символов';
        }

        return $this;
    }
}
