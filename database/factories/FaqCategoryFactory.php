<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FaqCategory;
use Faker\Generator as Faker;

$factory->define(FaqCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
