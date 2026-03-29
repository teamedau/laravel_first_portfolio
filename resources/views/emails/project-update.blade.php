<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: system-ui, sans-serif; background: #f8f8f8; margin: 0; padding: 0; }
        .wrap { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; }
        .header { background: #0d0d0d; padding: 28px 32px; }
        .header h1 { color: #fff; font-size: 18px; margin: 0; }
        .badge { display: inline-block; background: rgba(255,255,255,0.12); color: #aaa; font-size: 11px; padding: 3px 8px; border-radius: 4px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
        .body { padding: 32px; }
        .project-name { font-size: 13px; color: #888; margin-bottom: 4px; }
        .update-title { font-size: 22px; font-weight: 700; color: #0d0d0d; margin: 0 0 16px; }
        .update-content { font-size: 15px; color: #444; line-height: 1.7; }
        .cta { display: block; margin: 28px 0 0; background: #0d0d0d; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 6px; text-align: center; font-size: 14px; font-weight: 600; }
        .footer { padding: 20px 32px; background: #f8f8f8; border-top: 1px solid #eee; font-size: 12px; color: #999; }
        .footer a { color: #888; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="header">
            <h1>Vica Projects</h1>
        </div>
        <div class="body">
            <p class="project-name">{{ $project->title }}</p>
            <span class="badge">{{ $update->type }}</span>
            <h2 class="update-title">{{ $update->title }}</h2>
            <div class="update-content">{{ $update->content }}</div>
            <a href="{{ route('projects.show', $project) }}" class="cta">View project →</a>
        </div>
        <div class="footer">
            <p>You're receiving this because you follow <strong>{{ $project->title }}</strong> on Vica Projects.</p>
            <p>Hi {{ $recipient->name }} · <a href="{{ route('projects.show', $project) }}">Unfollow this project</a></p>
        </div>
    </div>
</body>
</html>
