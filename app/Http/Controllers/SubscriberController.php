<?php

namespace App\Http\Controllers;

use App\Mail\NewSubscriberMail;
use App\Mail\SubscriberConfirmationMail;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class SubscriberController extends Controller
{
    /**
     * Record a new subscription request and send a confirmation email.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = $validated['email'];
        $subscriber = Subscriber::where('email', $email)->first();

        if ($subscriber && $subscriber->is_confirmed) {
            $subscriber->update([
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return back()->with('status', 'Thank you! You are already subscribed to our ministry updates.');
        }

        if (! $subscriber) {
            $subscriber = Subscriber::create([
                'email' => $email,
                'is_active' => false,
                'subscribed_at' => now(),
            ]);
        } else {
            $subscriber->update([
                'is_active' => false,
            ]);
        }

        $this->sendConfirmation($subscriber);

        return back()->with('status', 'Almost there! Please check your inbox and click the confirmation link to complete your subscription.');
    }

    /**
     * Confirm a subscription using a token from the confirmation email.
     */
    public function confirm(string $token): View
    {
        $subscriber = Subscriber::where('confirmation_token', $token)
            ->where('is_confirmed', false)
            ->first();

        if (! $subscriber) {
            abort(404);
        }

        $subscriber->forceFill([
            'is_confirmed' => true,
            'is_active' => true,
            'confirmed_at' => now(),
        ])->save();

        $notifyEmail = config('ministry.notify.new_subscriber_email');

        if ($notifyEmail && $notifyEmail !== $subscriber->email) {
            try {
                Mail::to($notifyEmail)->queue(new NewSubscriberMail($subscriber));
            } catch (\Throwable) {
                // Notification is best-effort; never block the confirmation.
            }
        }

        return view('subscription.confirmed');
    }

    /**
     * (Re)send the confirmation email synchronously so sign-up never silently
     * fails if the queue worker is unavailable.
     */
    protected function sendConfirmation(Subscriber $subscriber): void
    {
        try {
            Mail::to($subscriber->email)->send(new SubscriberConfirmationMail($subscriber));
        } catch (\Throwable) {
            report('Failed to send subscriber confirmation email to '.$subscriber->email);
        }
    }
}
