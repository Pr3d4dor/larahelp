<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_home_page()
    {
        $response = $this->get(route('home.index'));

        $response->assertStatus(200);
        $response->assertViewIs('index');
    }

    /** @test */
    public function it_displays_home_page_with_categories_ordered_by_article_count()
    {
        $categories = factory(Category::class, 2)->create();

        $article = new Article([
            'title' => 'Title',
            'slug' => 'slug',
            'summary' => 'summary',
            'content' => 'content',
            'category_id' => $categories->last()->getKey()
        ]);
        $article->save();

        $response = $this->get(route('home.index'));

        $response->assertStatus(200);
        $response->assertViewIs('index');

        $viewData = $response->getOriginalContent()->getData();
        $viewCategories = $viewData['categories']->pluck('name')->toArray();

        $this->assertEquals([$categories->last()->name, $categories->first()->name], $viewCategories);
    }
}
