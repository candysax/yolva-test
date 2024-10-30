<?php

namespace Yolva\Test\Base;

abstract class Entity
{
    protected static string $table;

    public function __construct(array $data)
    {
        $dbFieldList = implode(', ', array_keys($data));
        $dbMaskList = ':' . implode(', :', array_keys($data));

        DB::query(
            'INSERT INTO ' . static::$table . ' (' . $dbFieldList . ') VALUES (' . $dbMaskList . ')',
            $data
        );
    }

    public static function all(): array
    {
        return DB::query('SELECT * FROM ' . static::$table)->fetchAll();
    }
}
