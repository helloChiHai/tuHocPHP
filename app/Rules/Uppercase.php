<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    public function passes($attribute, $value)
    {
        if ($value === mb_strtoupper($value, 'UTF-8')) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return ':attribute không hợp lệ';
    }
}
