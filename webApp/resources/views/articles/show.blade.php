@php($title = '記事 #'.$article->id)
@extends('layouts.base')

@section('content')
    <div class="mt-2 space-y-1 text-sm text-slate-600">
        <div>ID: {{ $article->id }}</div>
        <div>作成日時: {{ $article->created_at }}</div>
        <div>更新日時: {{ $article->updated_at }}</div>
    </div>
    <h2 class="mt-2 text-xl font-semibold text-slate-900">{{ $article->title }}</h2>
    <div class="text-sm text-slate-600">公開:
        @if($article->is_published)
            <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-0.5 text-xs font-semibold">公開</span>
        @else
            <span class="inline-flex items-center rounded-full bg-rose-100 text-rose-700 px-2.5 py-0.5 text-xs font-semibold">非公開</span>
        @endif
        @if($article->published_at)
            （{{ $article->published_at }}）
        @endif
    </div>
    <div class="mt-3 whitespace-pre-line">{!! nl2br(e($article->body)) !!}</div>
    <div class="mt-4 flex gap-2">
        <a class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50" href="{{ route('articles.edit', $article) }}">編集</a>
        <a class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50" href="{{ route('articles.index') }}">一覧へ戻る</a>
    </div>
@endsection
