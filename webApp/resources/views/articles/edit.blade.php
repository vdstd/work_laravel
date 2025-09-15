@php($title = '記事編集 #'.$article->id)
@extends('layouts.base')

@section('content')
    <form action="{{ route('articles.update', $article) }}" method="post" class="space-y-3">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">タイトル</label>
            <input class="w-full rounded-md border border-slate-300 px-3 py-2" type="text" name="title" value="{{ old('title', $article->title) }}">
            @error('title') <div class="text-sm text-rose-700 mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">本文</label>
            <textarea class="w-full rounded-md border border-slate-300 px-3 py-2" name="body" rows="6">{{ old('body', $article->body) }}</textarea>
            @error('body') <div class="text-sm text-rose-700 mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">公開日時</label>
            <input class="w-full rounded-md border border-slate-300 px-3 py-2" type="datetime-local" name="published_at" value="{{ old('published_at', optional($article->published_at)->format('Y-m-d\TH:i')) }}">
            @error('published_at') <div class="text-sm text-rose-700 mt-1">{{ $message }}</div> @enderror
        </div>

        <label class="inline-flex items-center gap-2"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }}> <span>公開する</span></label>

        <div class="flex items-center gap-2 pt-1">
            <button class="inline-flex items-center rounded-md bg-blue-600 text-white px-3 py-2 text-sm font-medium hover:bg-blue-700">更新</button>
            <a class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50" href="{{ route('articles.index') }}">キャンセル</a>
        </div>
    </form>
@endsection
