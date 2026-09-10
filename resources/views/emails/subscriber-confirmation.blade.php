<x-mail::message>
# Confirm your subscription

Thank you for subscribing to updates from {{ config('app.name') }}.

To start receiving new articles and ministry updates, please confirm your email address by clicking the button below.

<x-mail::button :url="route('blog.subscribe.confirm', $subscriber->confirmation_token)">
Confirm my subscription
</x-mail::button>

If you did not request this subscription, you can safely ignore this email — no further messages will be sent.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
