<?php

namespace Yolva\Test\Base;

abstract class Validator
{
    protected array $errors = [];

    public function errors(): array
    {
        return ['errors' => $this->errors];
    }

    protected function stringIsFilled(string $value): bool
    {
        return strlen($value) !== 0;
    }

    protected function stringLengthBetween(string $value, int $min = 1, int|float $max = INF): bool
    {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    protected function valueIsUnique(string $column, string $value, ?int $exceptId = null): bool
    {
        $params = ['value' => $value];
        $query = 'SELECT COUNT(*) FROM users WHERE `' . $column . '` = :value';

        if (! is_null($exceptId)) {
            $query .= ' AND `id` != :except';
            $params['except'] = $exceptId;
        }

        $count = DB::query($query, $params)->fetch();

        return $count[array_key_first($count)] === 0;
    }
}
