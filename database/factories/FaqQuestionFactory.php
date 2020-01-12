<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Faker\Generator as Faker;

$factory->define(FaqQuestion::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence,
        'answer' => $faker->paragraph,
        'faq_category_id' => factory(FaqCategory::class)->create()->getKey(),
    ];
});
