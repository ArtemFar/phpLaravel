<?php

namespace App\Traits;

trait TModelGetOneByField
{
    public static function getOneByField($field_name, $field_value, $operator = '='){
        return static::query()->select('*')->where($field_name, $operator ,$field_value)->first();
    }
}
