FROM nginx:alpine

# タイムゾーンを Asia/Tokyo に設定
RUN apk --no-cache add tzdata \
    && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
    && echo "Asia/Tokyo" > /etc/timezone \
    && apk del tzdata

# Nginx 設定をコピー (本番環境用)
# COPY ./default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

# フォアグラウンドでnginx実行
CMD ["nginx", "-g", "daemon off;"]