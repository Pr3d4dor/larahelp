<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\FaqCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_faq_categories_list()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.faq_categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq_categories.index');
    }

    /** @test */
    public function it_displays_validation_errors_on_create()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.faq_categories.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_creates_a_category_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.faq_categories.store'), [
            'name' => 'Teste',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.faq_categories.index'));
        $this->assertDatabaseHas('faq_categories', [
            'name' => 'Teste',
        ]);
    }

    /** @test */
    public function it_displays_category_edit_form()
    {
        $user = factory(User::class)->create();

        $category = factory(FaqCategory::class)->create();

        $response = $this->actingAs($user)->get(route('admin.faq_categories.edit', [
            'faq_category' => $category->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq_categories.edit');
    }

    /** @test */
    public function it_displays_validation_errors_on_edit()
    {
        $user = factory(User::class)->create();

        $category = factory(FaqCategory::class)->create();

        $response = $this->actingAs($user)->put(route('admin.faq_categories.update', [
            'faq_category' => $category->getKey(),
        ]), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_updates_a_category_and_redirects()
    {
        $user = factory(User::class)->create();

        $category = factory(FaqCategory::class)->create();

        $response = $this->actingAs($user)->put(route('admin.faq_categories.update', [
            'faq_category' => $category->getKey(),
        ]), [
            'name' => 'New name',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.faq_categories.index'));
        $this->assertEquals('New name', $category->fresh()->name);
    }

    /** @test */
    public function it_can_deletes_a_category()
    {
        $user = factory(User::class)->create();

        $category = factory(FaqCategory::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.faq_categories.destroy', [
            'faq_category' => $category->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'name' => $category->name,
        ]);
        $this->assertDatabaseMissing('faq_categories', [
            'name' => $category->name,
        ]);
    }

    /** @test */
    public function it_cant_deletes_a_nonexistent_category()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.faq_categories.destroy', [
            'faq_category' => 2,
        ]));

        $response->assertStatus(404);
    }
}
