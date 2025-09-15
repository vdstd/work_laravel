<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App as AppFacade;
use App\Models\Article;

class InfoController extends Controller
{
    public function index()
    {
        $dbStatus = 'error';
        $dbError = null;
        $dbName = null;
        $driver = null;
        $serverVersion = null;
        $tables = [];

        try {
            $pdo = DB::connection()->getPdo();
            $dbStatus = 'connected';
            $dbName = DB::connection()->getDatabaseName();
            $driver = DB::getDriverName();

            if ($driver === 'pgsql') {
                $versionRow = DB::selectOne('select version() as v');
                $serverVersion = $versionRow ? $versionRow->v : null;
                $tables = collect(DB::select("select tablename as name from pg_tables where schemaname = 'public' order by tablename"))
                    ->pluck('name')->all();
            } elseif ($driver === 'mysql') {
                $versionRow = DB::selectOne('select version() as v');
                $serverVersion = $versionRow ? $versionRow->v : null;
                $tables = collect(DB::select('show tables'))
                    ->map(function ($row) { return array_values((array)$row)[0] ?? null; })
                    ->filter()->values()->all();
            } elseif ($driver === 'sqlite') {
                $versionRow = DB::selectOne('select sqlite_version() as v');
                $serverVersion = $versionRow ? $versionRow->v : null;
                $tables = collect(DB::select("select name from sqlite_master where type='table' order by name"))
                    ->pluck('name')->all();
            }
        } catch (\Throwable $e) {
            $dbError = $e->getMessage();
        }

        $info = [
            'laravel' => AppFacade::version(),
            'php' => PHP_VERSION,
            'env' => config('app.env'),
            'debug' => config('app.debug') ? 'true' : 'false',
            'app_url' => config('app.url'),
        ];

        $counts = [
            'articles' => Article::query()->count(),
        ];

        return view('dashboard', compact(
            'dbStatus', 'dbError', 'dbName', 'driver', 'serverVersion', 'tables', 'info', 'counts'
        ));
    }
}

