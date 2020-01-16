<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_article_list_page_with_articles_paginated()
    {
        factory(Article::class, 15)->create()->pluck('id')->toArray();

        $response = $this->get(route('articles.index'));

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles', function ($articles) {
            return $articles->pluck('id')->toArray() === [1, 2, 3, 4, 5];
        });
    }

    /** @test */
    public function it_can_search_an_article_by_title()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('articles.index', [
            'search' => $articleOne->title
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_an_article_by_summary()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('articles.index', [
            'search' => $articleOne->summary
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_an_article_by_content()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('articles.index', [
            'search' => $articleOne->content
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_an_article_by_category()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $response = $this->get(route('articles.index', [
            'category_id' => $articleOne->category->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
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

        $response = $this->get(route('articles.index', [
            'tags' => [$tag->getKey()],
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_display_an_article()
    {
        $article = factory(Article::class)->create();

        $response = $this->get(route('articles.show', [
            'article' => $article->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('articles.show');
        $response->assertViewHas('article', function ($loadedArticle) use ($article) {
            return $loadedArticle->getKey() === $article->getKey();
        });
    }

    /** @test */
    public function it_increment_article_view_count_on_show()
    {
        $article = factory(Article::class)->create();

        $response = $this->get(route('articles.show', [
            'article' => $article->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('articles.show');
        $this->assertEquals($article->view_count + 1, $article->fresh()->view_count);
    }
}
