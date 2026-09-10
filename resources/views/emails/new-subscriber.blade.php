<x-mail::message>
# A new subscriber just joined

Someone has subscribed to receive ministry updates.

**Email:** {{ $subscriber->email }}

**Subscribed at:** {{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('F j, Y g:i A') : now()->format('F j, Y g:i A') }}

You can view and manage all subscribers from the [admin dashboard]({{ route('admin.subscribers.index') }}).

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
