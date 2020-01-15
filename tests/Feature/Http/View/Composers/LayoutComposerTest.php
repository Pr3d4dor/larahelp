<?php

namespace Tests\Feature\Http\View\Composers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutComposerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function view_that_uses_the_composer_has_all_the_items()
    {
        $this->get('/')
            ->assertViewHas('popularTags')
            ->assertViewHas('popularCategories')
            ->assertViewHas('popularArticles')
            ->assertViewHas('latestArticles');
    }

    /** @test */
    public function it_passes_popular_articles_in_correct_order_to_the_view()
    {
        [$articleOne, $articleTwo, $articleThree] = factory(Article::class, 3)->create();

        $articleOne->view_count = 0;
        $articleTwo->view_count = 1;
        $articleThree->view_count = 2;

        $articleOne->save();
        $articleTwo->save();
        $articleThree->save();

        $popularArticles = collect([$articleThree, $articleTwo, $articleOne]);

        $this->get('/')->assertViewHas('popularArticles', function ($articles) use ($popularArticles) {
            $ids = $articles->pluck('id')->toArray();
            $popularArticlesIds = $popularArticles->pluck('id')->toArray();

            return $ids === $popularArticlesIds;
        });
    }

    /** @test */
    public function it_passes_popular_tags_in_correct_order_to_the_view()
    {
        [$articleOne, $articleTwo, $articleThree] = factory(Article::class, 3)->create();
        [$tagOne, $tagTwo, $tagThree] = factory(Tag::class, 3)->create();

        $articleOne->view_count = 0;
        $articleTwo->view_count = 1;
        $articleThree->view_count = 2;

        $articleOne->save();
        $articleTwo->save();
        $articleThree->save();

        $articleOne->tags()->sync([$tagOne->getKey()]);
        $articleTwo->tags()->sync([$tagTwo->getKey()]);
        $articleThree->tags()->sync([$tagThree->getKey()]);

        $popularTags = collect([$tagThree, $tagTwo, $tagOne]);

        $this->get('/')->assertViewHas('popularTags', function ($tags) use ($popularTags) {
            $ids = $tags->pluck('id')->toArray();
            $popularTagsIds = $popularTags->pluck('id')->toArray();

            return $ids === $popularTagsIds;
        });
    }

    /** @test */
    public function it_passes_popular_categories_in_correct_order_to_the_view()
    {
        [$categoryOne, $categoryTwo, $categoryThree] = factory(Category::class, 3)->create();
        [$articleOne, $articleTwo, $articleThree] = [
            new Article([
                'title' => 'Title',
                'slug' => 'slug-one',
                'summary' => 'summary',
                'content' => 'content',
                'category_id' => $categoryOne->getKey(),
                'view_count' => 0,
            ]),
            new Article([
                'title' => 'Title',
                'slug' => 'slug-two',
                'summary' => 'summary',
                'content' => 'content',
                'category_id' => $categoryTwo->getKey(),
                'view_count' => 1,
            ]),
            new Article([
                'title' => 'Title',
                'slug' => 'slug-three',
                'summary' => 'summary',
                'content' => 'content',
                'category_id' => $categoryThree->getKey(),
                'view_count' => 2,
            ])
        ];

        $articleOne->save();
        $articleTwo->save();
        $articleThree->save();

        $popularCategories = collect([$categoryThree, $categoryTwo, $categoryOne]);

        $this->get('/')->assertViewHas('popularCategories', function ($categories) use ($popularCategories) {
            $ids = $categories->pluck('id')->toArray();
            $popularCategoriesIds = $popularCategories->pluck('id')->toArray();

            return $ids === $popularCategoriesIds;
        });
    }

    /** @test */
    public function it_passes_latest_articles_in_correct_order_to_the_view()
    {
        factory(Article::class, 3)->create();

        $this->get('/')->assertViewHas('latestArticles', function ($articles) {
            $ids = $articles->pluck('id')->toArray();

            return $ids === [3, 2, 1];
        });
    }
}
