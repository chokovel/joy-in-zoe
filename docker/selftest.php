<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

echo '[selftest] APP_ENV='.env('APP_ENV', '?')
    .' APP_DEBUG='.var_export(env('APP_DEBUG'), true)
    .' APP_KEY='.(config('app.key') ? 'set' : 'EMPTY')
    .' DB='.config('database.default')
    .' youtube_cfg='.(config('ministry.youtube.channel_id') !== null ? 'set' : 'null')
    .PHP_EOL;

try {
    echo '[selftest] Event::count = '.App\Models\Event::count().PHP_EOL;
    echo '[selftest] Post::count = '.App\Models\Post::count().PHP_EOL;
} catch (Throwable $e) {
    echo '[selftest] DB query FAIL '.get_class($e).': '.$e->getMessage().PHP_EOL;
}

echo '[selftest] manifest='.(file_exists(public_path('build/manifest.json')) ? 'present' : 'MISSING').PHP_EOL;

$kernel = $app->make(Kernel::class);
try {
    $response = $kernel->handle(Request::create('/', 'GET'));
    echo '[selftest] home status='.$response->getStatusCode().PHP_EOL;
} catch (Throwable $e) {
    echo '[selftest] EXCEPTION '.get_class($e).': '.$e->getMessage().PHP_EOL;
    echo '[selftest]     at '.$e->getFile().':'.$e->getLine().PHP_EOL;
    echo '[selftest]     '.str_replace(PHP_EOL, ' | ', substr($e->getTraceAsString(), 0, 1200)).PHP_EOL;
}