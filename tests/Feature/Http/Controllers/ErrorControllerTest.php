<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ErrorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_404_page()
    {
        $response = $this->get('/invalid-route');

        $response->assertStatus(200);
        $response->assertViewIs('errors.404');
    }

    /** @test */
    public function it_displays_admin_404_page_and_is_admin_route_when_logged()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/admin/invalid-route');

        $response->assertStatus(200);
        $response->assertViewIs('admin.errors.404');
    }

    /** @test */
    public function it_displays_default_404_page_and_is_not_admin_route_when_logged()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/invalid-route');

        $response->assertStatus(200);
        $response->assertViewIs('errors.404');
    }
}
