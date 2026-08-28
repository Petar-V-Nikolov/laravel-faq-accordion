<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_accordion_sees_seeded_questions(): void
    {
        $this->seed();

        $this->get('/')
            ->assertOk()
            ->assertSee('What is Laravel FAQ Accordion?')
            ->assertSee('How do I run this project locally?')
            ->assertSee('Who can add or edit FAQ items?')
            ->assertSee('Is this a CMS or Filament admin?');
    }

    public function test_guest_cannot_post_a_new_item(): void
    {
        $this->post('/faqs', [
            'question' => 'Should not persist?',
            'answer' => 'Guests cannot create FAQ items.',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseCount('faqs', 0);
    }

    public function test_authenticated_user_can_create_and_delete(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/faqs', [
                'question' => 'Can I add an item?',
                'answer' => 'Yes, signed-in users can create FAQ rows.',
                'sort_order' => 10,
                'published' => '1',
            ])
            ->assertRedirect(route('faqs.manage'));

        $faq = Faq::query()->first();

        $this->assertNotNull($faq);
        $this->assertSame('Can I add an item?', $faq->question);
        $this->assertSame($user->id, $faq->user_id);
        $this->assertTrue($faq->published);

        $this->get('/')->assertOk()->assertSee('Can I add an item?');

        $this->actingAs($user)
            ->delete(route('faqs.destroy', $faq))
            ->assertRedirect(route('faqs.manage'));

        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);
        $this->get('/')->assertOk()->assertDontSee('Can I add an item?');
    }
}
