<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SlugRule implements Rule
{
    public function passes($attribute, $value)
    {
        return $this->isSlug($value);
    }

    public function message()
    {
        return ':attribute precisa ser um slug válido';
    }

    private function isSlug($str)
    {
        return preg_match('/^[a-z0-9]+(-?[a-z0-9]+)*$/i', $str);
    }
}
