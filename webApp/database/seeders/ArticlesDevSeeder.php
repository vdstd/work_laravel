<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticlesDevSeeder extends Seeder
{
    public function run(): void
    {
        // 既にデータがあればスキップ（開発用の初期投入）
        if (Article::query()->exists()) {
            return;
        }

        $now = Carbon::now();
        $samples = [
            [
                'title' => '小型言語モデル（SLM）の実運用戦略: エッジ推論とコスト最適化',
                'body' => "LLM一辺倒ではなく、SLMをタスク特化で使い分ける動きが加速。\nエッジ/社内での低レイテンシ推論と、難問のみ大モデルへフォールバックする二段構成が有効です。",
                'days' => 2,
            ],
            [
                'title' => 'マルチモーダルAIの最新動向: 画像・音声・テキストの統合',
                'body' => "画像・音声・テキストを横断する体験が一般化。UIは入力起点を増やし、評価は自動指標と人手評価の併用が鍵。",
                'days' => 4,
            ],
            [
                'title' => 'RAG再設計の勘所: チャンク・検索・再ランキング',
                'body' => "チャンク設計、hybrid検索、段階的検索、再ランキングを組み合わせて精度と速度の最適化を行います。",
                'days' => 6,
            ],
            [
                'title' => 'AIエージェント導入チェックリスト',
                'body' => "権限分離、サンドボックス、実行前レビュー、ロールバック、観測性とアラートを先に用意。段階的に権限を解放。",
                'days' => 8,
            ],
            [
                'title' => 'コスト可視化と最適化: トークン/レイテンシ/キャッシュ',
                'body' => "入力圧縮、出力制限、キャッシュ活用、SLO設計。月次レポートを自動化して継続改善。",
                'days' => 10,
            ],
        ];

        foreach ($samples as $s) {
            Article::create([
                'title' => $s['title'],
                'body' => $s['body'],
                'is_published' => true,
                'published_at' => $now->copy()->subDays($s['days']),
            ]);
        }
    }
}

