<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            html, body { height: 100%; }
            body { margin:0; font-family: 'Nunito', sans-serif; background:#f7fafc; color:#1a202c; }
            .wrap { display:flex; align-items:center; justify-content:center; height:100%; }
            .card { background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:24px 28px; box-shadow:0 6px 16px rgba(0,0,0,.06); width: min(720px, 92vw); }
            .title { margin:0 0 8px; font-size:28px; }
            .muted { color:#4a5568; }
            .badge { display:inline-block; padding:4px 10px; border-radius:999px; font-size:12px; font-weight:700; }
            .ok { background:#def7ec; color:#03543f; }
            .ng { background:#fde8e8; color:#9b1c1c; }
            .row { margin-top:12px; }
            code { background:#f1f5f9; padding:2px 6px; border-radius:4px; }
            .small { font-size:12px; color:#718096; margin-top:14px; }
        </style>
    </head>
    <body>
        <div class="wrap">
            <div class="card">
                <h1 class="title">Laravel Welcome</h1>
                <div class="muted">Nginx + PHP-FPM + PostgreSQL (Docker)</div>

                <div class="row">
                    <strong>Database connection:</strong>
                    @if ($status === 'connected')
                        <span class="badge ok">CONNECTED</span>
                        <div class="small">Database: <code>{{ $dbName }}</code></div>
                    @else
                        <span class="badge ng">ERROR</span>
                        @if ($error)
                            <div class="small">{{ $error }}</div>
                        @endif
                    @endif
                </div>

                <div class="row muted">
                    Edit route: <code>webApp/routes/web.php</code><br>
                    Edit view: <code>webApp/resources/views/welcome.blade.php</code>
                </div>
            </div>
        </div>
    </body>
</html>

