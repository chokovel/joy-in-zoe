<?php

namespace Tests\Feature;

use App\Mail\NewSubscriberMail;
use App\Mail\SubscriberConfirmationMail;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_subscriber_receives_confirmation_email_and_starts_unconfirmed(): void
    {
        Mail::fake();

        $email = 'reader@example.com';

        $this->post(route('blog.subscribe'), ['email' => $email])
            ->assertRedirect();

        $subscriber = Subscriber::where('email', $email)->first();

        $this->assertNotNull($subscriber);
        $this->assertFalse($subscriber->is_confirmed);
        $this->assertFalse($subscriber->is_active);
        $this->assertNotNull($subscriber->confirmation_token);

        Mail::assertSent(SubscriberConfirmationMail::class);
    }

    public function test_subscriber_cannot_be_activated_until_confirmed(): void
    {
        Mail::fake();

        $email = 'reader@example.com';

        $this->post(route('blog.subscribe'), ['email' => $email]);
        $this->assertDatabaseHas('subscribers', ['email' => $email, 'is_confirmed' => false]);
    }

    public function test_confirmation_link_activates_subscriber_and_notifies_admin(): void
    {
        Mail::fake();

        $subscriber = Subscriber::create([
            'email' => 'reader@example.com',
            'is_active' => false,
            'subscribed_at' => now(),
        ]);

        $this->get(route('blog.subscribe.confirm', $subscriber->confirmation_token))
            ->assertOk();

        $this->assertTrue($subscriber->fresh()->is_confirmed);
        $this->assertTrue($subscriber->fresh()->is_active);
        $this->assertNotNull($subscriber->fresh()->confirmed_at);

        Mail::assertQueued(NewSubscriberMail::class);
    }

    public function test_invalid_confirmation_token_returns_404(): void
    {
        $this->get(route('blog.subscribe.confirm', 'not-a-real-token'))
            ->assertNotFound();
    }
}
