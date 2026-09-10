<?php

return [

    'brand' => [
        'name' => 'Joy In Zoe Intercessory Ministries',
        'short' => 'Joy In Zoe',
        'tagline' => 'Raising an altar of prayer, intercession, and spiritual awakening.',
    ],

    'contact' => [
        'email' => 'joyinzoee@gmail.com',
        'phone' => '+234 802 280 5755',
        'phone_href' => '+2348022805755',
        'abuja' => 'Amina Court Estate, Gudu, Abuja, Nigeria.',
        'port_harcourt' => 'Tony Close, Akwaka Phase 2, Rumuodomaya, Port Harcourt.',
    ],

    'notify' => [
        'new_subscriber_email' => env('ADMIN_EMAIL', 'admin@joyinzoe.org'),
    ],

    'socials' => [
        'facebook' => 'https://www.facebook.com/JOYINZOE',
        'instagram' => 'https://www.instagram.com/JOY_IN_ZOE',
        'telegram' => 'https://www.youtube.com/@joyinzoe',
        'youtube' => env('YOUTUBE_CHANNEL_ID', '') !== ''
            ? 'https://www.youtube.com/channel/'.env('YOUTUBE_CHANNEL_ID')
            : 'https://www.youtube.com/',
    ],

    'youtube' => [
        'video_id' => env('YOUTUBE_VIDEO_ID', ''),
        'channel_id' => env('YOUTUBE_CHANNEL_ID', ''),
        'api_key' => env('YOUTUBE_API_KEY', ''),
        'cache_minutes' => 30,
    ],

    'joshuaproject_url' => 'https://joshuaproject.net/people_groups',

    'tinymce' => [
        'api_key' => env('TINYMCE_API_KEY', ''),
        'base_url' => env('TINYMCE_BASE_URL', 'https://cdn.tiny.cloud/1/'),
        'license_key' => env('TINYMCE_LICENSE_KEY', 'gpl'),
    ],

];
