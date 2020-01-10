<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->unique()->slug,
        'content' => $faker->paragraph(5),
        'summary' => $faker->paragraph(1),
        'category_id' => factory(Category::class)->create()->getKey(),
        'view_count' => rand(0, 5000),
    ];
});
