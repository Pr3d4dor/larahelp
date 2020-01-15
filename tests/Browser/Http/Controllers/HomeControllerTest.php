<?php

namespace Tests\Browser;

use App\Models\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeControllerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_search_on_home_page_and_redirects_to_articles()
    {
        $article = factory(Article::class)->create();

        $this->browse(function (Browser $browser) use ($article) {
            $browser->visit('/')
                ->type('search', $article->title)
                ->press('execute_search')
                ->assertSee('Artigos')
                ->assertSee($article->title)
                ->assertSee($article->summary)
                ->assertInputValue('search', $article->title);
        });
    }
}
