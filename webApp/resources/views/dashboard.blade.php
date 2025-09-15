@php($title = 'ダッシュボード')
@extends('layouts.base')

@section('content')
    <div class="mt-3">
        <div class="font-semibold">アプリケーション</div>
        <div class="mt-1 space-y-1">
            <div class="text-sm text-slate-600 flex items-baseline">
                <div class="w-28 shrink-0 text-slate-500">Laravel</div>
                <code>{{ $info['laravel'] }}</code>
            </div>
            <div class="text-sm text-slate-600 flex items-baseline">
                <div class="w-28 shrink-0 text-slate-500">PHP</div>
                <code>{{ $info['php'] }}</code>
            </div>
            <div class="text-sm text-slate-600 flex items-baseline">
                <div class="w-28 shrink-0 text-slate-500">環境 / デバッグ</div>
                <div>
                    <code>{{ $info['env'] }}</code>
                    <span class="mx-1">/</span>
                    <code>{{ $info['debug'] }}</code>
                </div>
            </div>
            <div class="text-sm text-slate-600 flex items-baseline">
                <div class="w-28 shrink-0 text-slate-500">URL</div>
                <code>{{ $info['app_url'] }}</code>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="font-semibold">データベース</div>
        @if ($dbStatus === 'connected')
            <div class="mt-1">
                <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-0.5 text-xs font-semibold">接続済み</span>
            </div>
            <div class="mt-2 space-y-1">
                <div class="text-sm text-slate-600 flex items-baseline">
                    <div class="w-28 shrink-0 text-slate-500">Driver</div>
                    <code>{{ $driver }}</code>
                </div>
                <div class="text-sm text-slate-600 flex items-baseline">
                    <div class="w-28 shrink-0 text-slate-500">Database</div>
                    <code>{{ $dbName }}</code>
                </div>
                @if ($serverVersion)
                    <div class="text-sm text-slate-600 flex items-baseline">
                        <div class="w-28 shrink-0 text-slate-500">Server</div>
                        <code>{{ $serverVersion }}</code>
                    </div>
                @endif
                @if (!empty($tables))
                    <div class="text-sm text-slate-600 flex items-baseline">
                        <div class="w-28 shrink-0 text-slate-500">Tables ({{ count($tables) }})</div>
                        <code class="break-all">{{ implode(', ', $tables) }}</code>
                    </div>
                @endif
            </div>
        @else
            <div class="mt-1">
                <span class="inline-flex items-center rounded-full bg-rose-100 text-rose-700 px-2.5 py-0.5 text-xs font-semibold">エラー</span>
            </div>
            @if ($dbError)
                <div class="text-sm text-rose-700 mt-1">{{ $dbError }}</div>
            @endif
        @endif
    </div>

    <div class="mt-4">
        <div class="font-semibold">データ概要</div>
        <div class="mt-1 space-y-1">
            <div class="text-sm text-slate-600 flex items-baseline">
                <div class="w-28 shrink-0 text-slate-500">記事</div>
                <div>
                    <code>{{ $counts['articles'] }}</code> 件
                    @if($counts['articles'] === 0)
                        <a class="ml-2 text-blue-600 hover:underline" href="{{ route('articles.index') }}">作成する</a>
                    @else
                        <a class="ml-2 text-blue-600 hover:underline" href="{{ route('articles.index') }}">一覧を見る</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

