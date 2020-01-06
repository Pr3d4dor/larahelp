<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_dashboard()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /** @test */
    public function it_cannot_display_the_dashboard_unauthenticated_and_redirects_to_login_form()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
