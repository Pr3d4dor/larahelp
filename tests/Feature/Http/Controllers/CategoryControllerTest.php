<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_category_article_list_page_with_articles_paginated()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('categories.show', [
            'category' => $articleOne->category->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_an_category_article_by_title()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('categories.show', [
            'category' => $articleOne->category->getKey(),
            'search' => $articleOne->title,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_an_category_article_by_summary()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('categories.show', [
            'category' => $articleOne->category->getKey(),
            'search' => $articleOne->summary,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_an_category_article_by_content()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('categories.show', [
            'category' => $articleOne->category->getKey(),
            'search' => $articleOne->content,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_an_article_by_tag()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $tag = factory(Tag::class)->create();

        $articleOne->tags()->sync([$tag->getKey()]);

        $response = $this->get(route('categories.show', [
            'category' => $articleOne->category->getKey(),
            'tags' => [$tag->getKey()],
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_displays_category_list_with_categories_paginated()
    {
        factory(Category::class, 15)->create();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertViewHas('categories', function ($categories) {
            $categoryIds = collect($categories->items())->pluck('id')->toArray();

            return empty(array_diff([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $categoryIds));
        });

        $response = $this->get(route('categories.index', [
            'page' => 2
        ]));
        $response->assertViewHas('categories', function ($categories) {
            $categoryIds = collect($categories->items())->pluck('id')->toArray();

            return empty(array_diff([11, 12, 13, 14, 15], $categoryIds));
        });
    }
}
