<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FaqCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_faq_page()
    {
        $response = $this->get(route('faq_category.index'));

        $response->assertStatus(200);
        $response->assertViewIs('faq_categories.index');
    }
}
