<?php

namespace Yolva\Test\Base;

abstract class Validator
{
    public array $errors = [];

    public function errors(): array
    {
        return ['errors' => $this->errors];
    }

    public function stringIsFilled(string $value): bool
    {
        return strlen($value) !== 0;
    }

    public function stringLengthBetween(string $value, int $min = 1, int|float $max = INF): bool
    {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public function valueIsUnique(string $column, string $value, ?int $exceptId = null): bool
    {
        $params = ['value' => $value];
        $query = 'SELECT COUNT(*) FROM users WHERE `'.$column.'` = :value';

        if (! is_null($exceptId)) {
            $query .= ' AND `id` != :except';
            $params['except'] = $exceptId;
        }

        $count = DB::query($query, $params)->fetch();

        return $count[array_key_first($count)] === 0;
    }
}
