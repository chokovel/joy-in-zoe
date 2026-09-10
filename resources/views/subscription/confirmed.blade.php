<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subscription confirmed · {{ config('app.name') }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: #09428F;
            color: #ffffff;
            padding: 24px;
        }
        .card {
            max-width: 480px;
            width: 100%;
            background: #ffffff;
            color: #1f2937;
            border-radius: 12px;
            padding: 40px 32px;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }
        .icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: #e6f0ff;
            color: #09428F;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }
        h1 { font-size: 22px; margin: 0 0 8px; }
        p { margin: 0 0 24px; color: #4b5563; line-height: 1.6; }
        a.button {
            display: inline-block;
            background: #09428F;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">&#10003;</div>
        <h1>Subscription confirmed</h1>
        <p>
            Thank you! You are now subscribed to updates from
            <strong>{{ config('app.name') }}</strong>.
            New articles and ministry updates will be delivered to your inbox.
        </p>
        <a class="button" href="{{ url('/') }}">Return to home</a>
    </div>
</body>
</html>
