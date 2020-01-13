<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_categories_list()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.index');
    }

    /** @test */
    public function it_displays_category_create_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.create');
    }

    /** @test */
    public function it_displays_validation_errors_on_create()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.categories.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'slug']);
    }

    /** @test */
    public function it_creates_a_category_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.categories.store'), [
            'name' => 'Teste',
            'slug' => 'teste',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'Teste',
            'slug' => 'teste',
        ]);
    }

    /** @test */
    public function it_cannot_create_a_category_with_a_existing_slug()
    {
        $user = factory(User::class)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->post(route('admin.categories.store'), [
            'name' => 'Example',
            'slug' => $category->slug,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('categories', [
            'name' =>'Example',
            'slug' => $category->slug,
        ]);
    }

    /** @test */
    public function it_displays_category_edit_form()
    {
        $user = factory(User::class)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->get(route('admin.categories.edit', [
            'category' => $category->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.edit');
    }

    /** @test */
    public function it_displays_validation_errors_on_edit()
    {
        $user = factory(User::class)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->put(route('admin.categories.update', [
            'category' => $category->getKey(),
        ]), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'slug']);
    }

    /** @test */
    public function it_updates_a_category_and_redirects()
    {
        $user = factory(User::class)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->put(route('admin.categories.update', [
            'category' => $category->getKey(),
        ]), [
            'name' => 'Category name',
            'slug' => 'category-name',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $this->assertEquals('Category name', $category->fresh()->name);
        $this->assertEquals('category-name', $category->fresh()->slug);
    }

    /** @test */
    public function it_can_deletes_a_category()
    {
        $user = factory(User::class)->create();

        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.categories.destroy', [
            'category' => $category->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'name' => $category->name,
            'slug' => $category->slug,
        ]);
        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
            'slug' => $category->slug,
        ]);
    }

    /** @test */
    public function it_cant_deletes_a_nonexistent_category()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.categories.destroy', [
            'category' => 2,
        ]));

        $response->assertStatus(404);
    }
}
