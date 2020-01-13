<?php

namespace App\Models;

trait SlugTrait
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
