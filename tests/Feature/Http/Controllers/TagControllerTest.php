<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_display_tag_articles_list_page_with_articles_paginated()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $tag = factory(Tag::class)->create();

        $articleOne->tags()->sync([$tag->getKey()]);

        $response = $this->get(route('tags.show', [
            'tag' => $tag->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('tags.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_a_tag_articles_by_title()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $tag = factory(Tag::class)->create();

        $articleOne->tags()->sync([$tag->getKey()]);
        $articleTwo->tags()->sync([$tag->getKey()]);

        $response = $this->get(route('tags.show', [
            'tag' => $tag->getKey(),
            'search' => $articleOne->title
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('tags.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_a_tag_articles_by_summary()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $tag = factory(Tag::class)->create();

        $articleOne->tags()->sync([$tag->getKey()]);
        $articleTwo->tags()->sync([$tag->getKey()]);

        $response = $this->get(route('tags.show', [
            'tag' => $tag->getKey(),
            'search' => $articleOne->summary
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('tags.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_a_tag_articles_by_content()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $tag = factory(Tag::class)->create();

        $articleOne->tags()->sync([$tag->getKey()]);
        $articleTwo->tags()->sync([$tag->getKey()]);

        $response = $this->get(route('tags.show', [
            'tag' => $tag->getKey(),
            'search' => $articleOne->content
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('tags.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }

    /** @test */
    public function it_can_search_a_tag_articles_by_category()
    {
        [$articleOne, $articleTwo] = factory(Article::class, 2)->create();

        $tag = factory(Tag::class)->create();

        $articleOne->tags()->sync([$tag->getKey()]);
        $articleTwo->tags()->sync([$tag->getKey()]);

        $response = $this->get(route('tags.show', [
            'tag' => $tag->getKey(),
            'category_id' => $articleOne->category->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('tags.show');
        $response->assertViewHas('articles', function ($articles) use ($articleOne, $articleTwo) {
            $articleIds = $articles->pluck('id')->toArray();

            return in_array($articleOne->getKey(), $articleIds) &&
                !in_array($articleTwo->getKey(), $articleIds);
        });
    }
}
