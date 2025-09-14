# Laravel + Nginx + PHP-FPM + PostgreSQL (Docker)

最小構成の Laravel 開発環境テンプレートです。Welcome 画面で PostgreSQL への接続状態を表示します。

## 前提
- Docker Desktop（WSL2 バックエンド推奨）: https://www.docker.com/products/docker-desktop/
- 任意: Git for Windows / Visual Studio Code

## クイックスタート（PowerShell / 端末）
```sh
docker compose up -d --build
docker compose exec web composer install
docker compose exec web php artisan migrate:fresh --force
```

## 動作確認
- ブラウザで `http://localhost:8888` を開く
- Welcome 画面に「Database connection: CONNECTED」と表示されることを確認

## 接続情報
- App: `http://localhost:8888`
- PostgreSQL: `host=localhost port=54320 db=main user=postgres pass=postgres`

## よく使うコマンド
- コンテナ起動/停止: `docker compose up -d` / `docker compose down`
- Artisan: `docker compose exec web php artisan migrate` / `docker compose exec web php artisan migrate:fresh --force`
- Composer: `docker compose exec web composer install`

## ディレクトリ
- `webApp/` … Laravel アプリ（`routes/web.php`, `resources/views/welcome.blade.php` など最小構成）
- `docker-config/` … PHP-FPM, Nginx, Postgres の設定

## 備考
- `webApp/.env` は Docker 用に設定済み（例: `DB_HOST=postgres`）
- DB を完全初期化したい場合は `docker-config/postgres/data` を削除してから再起動

## 構成と重要ファイル
- `docker-compose.yml`: 3サービス（`web`=PHP-FPM, `nginx`, `postgres`）。`8888:80` と `54320:5432` をポートマッピングし、コード/設定をボリューム共有
- `docker-config/php/Dockerfile`: PHP 8.1-FPM ベース。`pdo_pgsql`/`pgsql` 有効化、Composer/Node 同梱。`docker-config/php/php.ini` 使用
- `docker-config/nginx/Dockerfile`: `nginx:alpine` ベース。`docker-config/nginx/default.conf` で `root /var/www/public`、`fastcgi_pass web:9000`
- `docker-config/postgres/data` / `docker-config/postgres/logs`: DB の永続ボリューム（削除で初期化）
- `webApp/routes/web.php`: ルート定義。トップで DB 接続を試行しビューに状態を渡す
- `webApp/resources/views/welcome.blade.php`: Welcome 画面（DB 接続結果をバッジ表示）
- `webApp/config/database.php`: DB 接続。`.env` の値を参照し `pgsql` を使用
- `webApp/public/index.php`: エントリーポイント（Nginx のドキュメントルート）
- `webApp/artisan`: Laravel CLI（`migrate`, `cache:clear` など）
- `webApp/database/migrations/*.php`: 初期テーブルのマイグレーション（`migrate:fresh` で張り直し）
- `webApp/storage/`, `webApp/bootstrap/cache/`: キャッシュ/ログ/セッションの保存先（書き込み権限が必要）

## トラブルシュート
- Docker 起動に失敗する場合は、BIOS で仮想化支援機能（Intel VT-x/AMD-V）を有効化
- 権限エラー時はコンテナ再作成やボリューム権限の確認を実施
