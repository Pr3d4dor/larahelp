<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_tags_list()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.tags.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.tags.index');
    }

    /** @test */
    public function it_displays_tag_create_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.tags.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.tags.create');
    }

    /** @test */
    public function it_displays_validation_errors_on_create()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.tags.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'slug']);
    }

    /** @test */
    public function it_creates_a_tag_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.tags.store'), [
            'name' => 'Teste',
            'slug' => 'teste',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.tags.index'));
        $this->assertDatabaseHas('tags', [
            'name' => 'Teste',
            'slug' => 'teste',
        ]);
    }

    /** @test */
    public function it_cannot_create_a_tag_with_a_existing_slug()
    {
        $user = factory(User::class)->create();

        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($user)->post(route('admin.tags.store'), [
            'name' => 'Example',
            'slug' => $tag->slug,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('tags', [
            'name' =>'Example',
            'slug' => $tag->slug,
        ]);
    }

    /** @test */
    public function it_displays_tag_edit_form()
    {
        $user = factory(User::class)->create();

        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($user)->get(route('admin.tags.edit', [
            'tag' => $tag->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.tags.edit');
    }

    /** @test */
    public function it_displays_validation_errors_on_edit()
    {
        $user = factory(User::class)->create();

        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($user)->put(route('admin.tags.update', [
            'tag' => $tag->getKey(),
        ]), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'slug']);
    }

    /** @test */
    public function it_updates_a_tag_and_redirects()
    {
        $user = factory(User::class)->create();

        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($user)->put(route('admin.tags.update', [
            'tag' => $tag->getKey(),
        ]), [
            'name' => 'Tag name',
            'slug' => 'tag_name',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.tags.index'));
        $this->assertEquals('Tag name', $tag->fresh()->name);
        $this->assertEquals('tag_name', $tag->fresh()->slug);
    }

    /** @test */
    public function it_can_deletes_a_tag()
    {
        $user = factory(User::class)->create();

        $tag = factory(Tag::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.tags.destroy', [
            'tag' => $tag->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'name' => $tag->name,
            'slug' => $tag->slug,
        ]);
        $this->assertDatabaseMissing('tags', [
            'name' => $tag->name,
            'slug' => $tag->slug,
        ]);
    }

    /** @test */
    public function it_cant_deletes_a_nonexistent_tag()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.tags.destroy', [
            'tag' => 2,
        ]));

        $response->assertStatus(404);
    }
}
