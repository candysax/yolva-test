<?php

namespace Yolva\Test\Base;

abstract class Entity
{
    protected string $table;

    public function __construct(array $data)
    {
        $dbFieldList = implode(', ', array_keys($data));
        $dbMaskList = ':'.implode(', :', array_keys($data));

        DB::query(
            'INSERT INTO '.$this->table.' ('.$dbFieldList.') VALUES ('.$dbMaskList.')',
            $data
        );
    }
}
