<?php

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all()->modelKeys();

        $articles = factory(Article::class, 20)->create();

        $articles->each(function (Article $article) use ($tags) {
            $article->tags()->sync(array_slice($tags, rand(0, count($tags))));
        });
    }
}
