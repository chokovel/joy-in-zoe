<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$request = Request::create('/', 'GET');

// Mimic a real HTTP request: bind the Request into the container before
// booting, so production's URL::forceScheme('https') finds a request.
$app->instance('request', $request);

$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

echo '[selftest] APP_ENV='.config('app.env')
    .' APP_DEBUG='.var_export(config('app.debug'), true)
    .' APP_KEY='.(config('app.key') ? 'set' : 'EMPTY')
    .' DB='.config('database.default')
    .PHP_EOL;

try {
    echo '[selftest] Event::count = '.App\Models\Event::count().PHP_EOL;
} catch (Throwable $e) {
    echo '[selftest] Event query FAIL '.get_class($e).': '.$e->getMessage().PHP_EOL;
}

try {
    echo '[selftest] Post::count = '.App\Models\Post::count().PHP_EOL;
} catch (Throwable $e) {
    echo '[selftest] Post query FAIL '.get_class($e).': '.$e->getMessage().PHP_EOL;
}

echo '[selftest] manifest='.(file_exists(public_path('build/manifest.json')) ? 'present' : 'MISSING').PHP_EOL;

try {
    $response = $kernel->handle($request);
    echo '[selftest] home status='.$response->getStatusCode().PHP_EOL;

    if ($response->getStatusCode() >= 500) {
        $log = storage_path('logs/laravel.log');
        if (is_file($log)) {
            $lines = file($log);
            echo '[selftest] >>> exception from laravel.log:'.PHP_EOL
                .implode('', array_slice($lines, max(0, count($lines) - 20))).PHP_EOL;
        } else {
            echo '[selftest] >>> laravel.log missing'.PHP_EOL;
        }
    }
} catch (Throwable $e) {
    echo '[selftest] EXCEPTION '.get_class($e).': '.$e->getMessage().PHP_EOL;
    echo '[selftest]     at '.$e->getFile().':'.$e->getLine().PHP_EOL;
    echo '[selftest]     '.str_replace(PHP_EOL, ' | ', substr($e->getTraceAsString(), 0, 1600)).PHP_EOL;
}