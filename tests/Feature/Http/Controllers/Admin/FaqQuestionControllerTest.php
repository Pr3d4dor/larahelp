<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqQuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_faq_questions_list()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.faq_questions.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq_questions.index');
    }

    /** @test */
    public function it_displays_a_specific_faq_question()
    {
        $user = factory(User::class)->create();

        $faqQuestion = factory(FaqQuestion::class)->create();

        $response = $this->actingAs($user)->get(route('admin.faq_questions.show', $faqQuestion->getKey()));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq_questions.show');
        $response->assertViewHas('faqQuestion', function ($loadedFaqQuestion) use ($faqQuestion) {
            return $loadedFaqQuestion->getKey() === $faqQuestion->getKey();
        });
    }

    /** @test */
    public function it_displays_faq_question_create_form()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.faq_questions.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq_questions.create');
    }

    /** @test */
    public function it_displays_validation_errors_on_create()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('admin.faq_questions.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['content', 'answer', 'faq_category_id']);
    }

    /** @test */
    public function it_creates_a_faq_question_and_redirects()
    {
        $user = factory(User::class)->create();

        $faqCategory = factory(FaqCategory::class)->create();

        $response = $this->actingAs($user)->post(route('admin.faq_questions.store'), [
            'content' => 'Teste',
            'answer' => 'teste',
            'faq_category_id' => $faqCategory->getKey(),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.faq_questions.index'));
        $this->assertDatabaseHas('faq_questions', [
            'content' => 'Teste',
            'answer' => 'teste',
            'faq_category_id' => $faqCategory->getKey(),
        ]);
    }

    /** @test */
    public function it_displays_category_edit_form()
    {
        $user = factory(User::class)->create();

        $faqQuestion = factory(FaqQuestion::class)->create();

        $response = $this->actingAs($user)->get(route('admin.faq_questions.edit', [
            'faq_question' => $faqQuestion->getKey(),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq_questions.edit');
    }

    /** @test */
    public function it_displays_validation_errors_on_edit()
    {
        $user = factory(User::class)->create();

        $faqQuestion = factory(FaqQuestion::class)->create();

        $response = $this->actingAs($user)->put(route('admin.faq_questions.update', [
            'faq_question' => $faqQuestion->getKey(),
        ]), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['content', 'answer', 'faq_category_id']);
    }

    /** @test */
    public function it_updates_a_faq_question_and_redirects()
    {
        $user = factory(User::class)->create();

        $faqQuestion = factory(FaqQuestion::class)->create();

        $faqCategory = factory(FaqCategory::class)->create();

        $response = $this->actingAs($user)->put(route('admin.faq_questions.update', [
            'faq_question' => $faqQuestion->getKey(),
        ]), [
            'content' => 'Question',
            'answer' => 'Answer',
            'faq_category_id' => $faqCategory->getKey(),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.faq_questions.index'));
        $this->assertEquals('Question', $faqQuestion->fresh()->content);
        $this->assertEquals('Answer', $faqQuestion->fresh()->answer);
        $this->assertEquals($faqCategory->getKey(), $faqQuestion->fresh()->faqCategory->getKey());
    }

    /** @test */
    public function it_can_deletes_a_category()
    {
        $user = factory(User::class)->create();

        $faqQuestion = factory(FaqQuestion::class)->create();

        $response = $this->actingAs($user)->delete(route('admin.faq_questions.destroy', [
            'faq_question' => $faqQuestion->getKey()
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'content' => $faqQuestion->content,
            'answer' => $faqQuestion->answer,
            'faq_category_id' => $faqQuestion->faqCategory->getKey(),
        ]);
        $this->assertDatabaseMissing('faq_questions', [
            'content' => $faqQuestion->content,
            'answer' => $faqQuestion->answer,
            'faq_category_id' => $faqQuestion->faqCategory->getKey(),
        ]);
    }
}
