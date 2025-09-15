@php($title = '記事')
@extends('layouts.base')

@section('content')
    <div class="mt-2">
        <a class="inline-flex items-center rounded-md bg-blue-600 text-white px-3 py-2 text-sm font-medium hover:bg-blue-700" href="{{ route('articles.create') }}">+ 記事を作成</a>
    </div>

    <div class="mt-3">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600">ID</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600">タイトル</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600">公開</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600">公開日時</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-slate-600">操作</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                @forelse ($articles as $article)
                    <tr>
                        <td class="px-3 py-2 text-sm text-slate-700">{{ $article->id }}</td>
                        <td class="px-3 py-2 text-sm text-blue-700"><a class="hover:underline" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></td>
                        <td class="px-3 py-2">
                            @if($article->is_published)
                                <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-0.5 text-xs font-semibold">公開</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-rose-100 text-rose-700 px-2.5 py-0.5 text-xs font-semibold">非公開</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-sm text-slate-700">{{ optional($article->published_at)->format('Y-m-d H:i') }}</td>
                        <td class="px-3 py-2 text-sm text-slate-700">
                            <a class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50" href="{{ route('articles.edit', $article) }}">編集</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="post" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="inline-flex items-center rounded-md bg-rose-600 text-white px-3 py-1.5 text-sm font-medium hover:bg-rose-700" onclick="return confirm('この記事を削除しますか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-6 text-sm text-slate-500">記事がありません</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $articles->links() }}</div>
    </div>
@endsection
