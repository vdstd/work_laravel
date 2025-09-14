# ベースイメージとして PHP 8.1 FPM を使用
FROM php:8.1-fpm

# 作業ディレクトリを設定
WORKDIR /var/www

# アプリケーションコードをコピー
ADD . /var/www

# -------------------------------
# パーミッション設定
# -------------------------------
# www-data ユーザーとグループに権限を付与
RUN chown -R www-data:www-data /var/www

# -------------------------------
# Composer インストール
# -------------------------------
RUN cd /usr/bin \
    && curl -s http://getcomposer.org/installer | php \
    && ln -s /usr/bin/composer.phar /usr/bin/composer

# -------------------------------
# 必要パッケージのインストール
# -------------------------------
RUN apt-get update \
    && apt-get install -y \
        gcc \
        make \
        git \
        unzip \
        vim \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libmcrypt-dev \
        libpq-dev \
        curl \
        gnupg \
        openssl \
    # PHP 拡張モジュールのインストール
    && docker-php-ext-install pdo_pgsql pgsql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    # キャッシュ削除でイメージサイズを削減
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# -------------------------------
# php.ini をコンテナにコピー
# -------------------------------
COPY php.ini /usr/local/etc/php/

# -------------------------------
# Node.js と npm のインストール
# -------------------------------
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash \
    && apt-get update \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# n（Node.js バージョン管理ツール）で最新安定版に切り替え
RUN npm install -g n \
    && n stable \
    && npm update -g npm