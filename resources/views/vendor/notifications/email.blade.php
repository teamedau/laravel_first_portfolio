<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: system-ui, sans-serif; background: #f8f8f8; margin: 0; padding: 0; }
        .wrap { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; }
        .header { background: #0d0d0d; padding: 28px 32px; }
        .header h1 { color: #fff; font-size: 18px; margin: 0; }
        .body { padding: 32px; }
        .body h2 { font-size: 22px; font-weight: 700; color: #0d0d0d; margin: 0 0 16px; }
        .body p { font-size: 15px; color: #444; line-height: 1.7; margin: 0 0 16px; }
        .cta { display: block; margin: 28px 0; background: #0d0d0d; color: #fff !important; text-decoration: none; padding: 14px 24px; border-radius: 6px; text-align: center; font-size: 14px; font-weight: 600; }
        .subcopy { padding: 20px 32px; background: #f8f8f8; border-top: 1px solid #eee; font-size: 12px; color: #999; word-break: break-all; }
        .subcopy a { color: #888; }
        .footer { padding: 20px 32px; background: #f8f8f8; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="header">
            <h1>Vica Projects</h1>
        </div>
        <div class="body">
            @if (! empty($greeting))
                <h2>{{ $greeting }}</h2>
            @else
                <h2>{{ $level === 'error' ? 'Whoops!' : 'Hello!' }}</h2>
            @endif

            @foreach ($introLines as $line)
                <p>{{ $line }}</p>
            @endforeach

            @isset($actionText)
                <a href="{{ $actionUrl }}" class="cta">{{ $actionText }}</a>
            @endisset

            @foreach ($outroLines as $line)
                <p>{{ $line }}</p>
            @endforeach

            <p style="margin-top:24px;">
                @if (! empty($salutation))
                    {{ $salutation }}
                @else
                    Regards,<br><strong>{{ config('app.name') }}</strong>
                @endif
            </p>
        </div>

        @isset($actionText)
        <div class="subcopy">
            If you're having trouble with the "{{ $actionText }}" button, copy and paste this URL into your browser:<br>
            <a href="{{ $actionUrl }}">{{ $displayableActionUrl }}</a>
        </div>
        @endisset
    </div>
</body>
</html>
