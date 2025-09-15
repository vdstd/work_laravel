<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 開発環境のみ、日本語の初期データを投入
        if (app()->environment('local')) {
            $this->call([
                ArticlesDevSeeder::class,
            ]);
        }
    }
}

