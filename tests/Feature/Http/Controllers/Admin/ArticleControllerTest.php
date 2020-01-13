<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_articles_list()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.articles.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.articles.index');
    }

    /** @test */
    public function it_displays_article_create_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.articles.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.articles.create');
    }

    /** @test */
    public function it_displays_validation_errors_on_create()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.articles.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'slug', 'summary', 'content', 'category_id']);
    }

    /** @test */
    public function it_creates_a_article_and_redirects()
    {
        $user = factory(User::class)->create();

        $tags = factory(Tag::class, 5)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->post(route('admin.articles.store'), [
            'title' => 'Teste',
            'slug' => 'teste',
            'summary' => 'Summary',
            'content' => 'Content',
            'category_id' => $category->getKey(),
            'tags' => $tags->modelKeys(),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.articles.index'));
        $this->assertDatabaseHas('articles', [
            'title' => 'Teste',
            'slug' => 'teste',
            'summary' => 'Summary',
            'content' => 'Content',
            'category_id' => $category->getKey(),
        ]);

        $article = Article::all()->first();
        foreach ($tags->modelKeys() as $tagId) {
            $this->assertDatabaseHas('article_tag', [
                'article_id' => $article->getKey(),
                'tag_id' => $tagId,
            ]);
        }
    }

    /** @test */
    public function it_cannot_create_a_article_with_a_existing_slug()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->post(route('admin.articles.store'), [
            'title' => 'Teste',
            'slug' => $article->slug,
            'summary' => 'Summary',
            'content' => 'Content',
            'category_id' => $category->getKey(),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('articles', [
            'title' => 'Teste',
            'slug' => $article->slug,
            'summary' => 'Summary',
            'content' => 'Content',
            'category_id' => $category->getKey(),
        ]);
    }

    /** @test */
    public function it_displays_article_edit_form()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create();

        $response = $this->actingAs($user)->get(route('admin.articles.edit', [
            'article' => $article->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.articles.edit');
    }

    /** @test */
    public function it_displays_validation_errors_on_edit()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create();

        $response = $this->actingAs($user)->put(route('admin.articles.update', [
            'article' => $article->getKey(),
        ]), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'slug', 'summary', 'content', 'category_id']);
    }

    /** @test */
    public function it_updates_a_article_and_redirects()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->put(route('admin.articles.update', [
            'article' => $article->getKey(),
        ]), [
            'title' => 'Teste',
            'slug' => 'teste',
            'summary' => 'Summary',
            'content' => 'Content',
            'category_id' => $category->getKey(),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.articles.index'));
        $this->assertEquals('Teste', $article->fresh()->title);
        $this->assertEquals('teste', $article->fresh()->slug);
        $this->assertEquals('Summary', $article->fresh()->summary);
        $this->assertEquals('Content', $article->fresh()->content);
        $this->assertEquals($category->getKey(), $article->fresh()->category->getKey());
    }

    /** @test */
    public function it_can_deletes_a_article()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.articles.destroy', [
            'article' => $article->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'title' => $article->title,
            'slug' => $article->slug,
            'summary' => $article->summary,
            'content' => $article->content,
            'category_id' => $article->category->getKey(),
        ]);
        $this->assertDatabaseMissing('articles', [
            'title' => $article->title,
            'slug' => $article->slug,
            'summary' => $article->summary,
            'content' => $article->content,
            'category_id' => $article->category,
        ]);
    }

    /** @test */
    public function it_cant_deletes_a_nonexistent_article()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.articles.destroy', [
            'article' => 2,
        ]));

        $response->assertStatus(404);
    }
}
