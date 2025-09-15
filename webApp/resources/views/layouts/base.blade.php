<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Laravel Starter' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')
    @yield('head')
    @if (session('status'))
        <meta name="x-flash" content="{{ session('status') }}">
    @endif
    <script>
        addEventListener('DOMContentLoaded', () => {
            const msg = document.querySelector('meta[name="x-flash"]')?.content;
            if (msg) {
                const box = document.createElement('div');
                box.className = 'mx-auto max-w-5xl mb-3 rounded-md border border-cyan-200 bg-cyan-50 text-cyan-900 px-3 py-2';
                box.textContent = msg;
                document.body.prepend(box);
                setTimeout(()=> box.remove(), 4000);
            }
        });
    </script>
    @stack('scripts-head')
    @yield('scripts-head')
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="max-w-5xl mx-auto p-4">
        <nav class="flex items-center gap-4 py-3">
            <a class="font-bold text-blue-600 hover:underline" href="{{ url('/') }}">ダッシュボード</a>
            <a class="font-bold text-blue-600 hover:underline" href="{{ route('articles.index') }}">記事</a>
        </nav>
        <div class="bg-white ring-1 ring-slate-200 rounded-lg p-6 shadow-sm">
            <h1 class="text-2xl font-semibold mb-2">{{ $title ?? '' }}</h1>
            @yield('content')
        </div>
        <div class="text-sm text-slate-500 mt-2">ルート: <code>webApp/routes/web.php</code></div>
    </div>
    @stack('body')
    @yield('body')
</body>
</html>
