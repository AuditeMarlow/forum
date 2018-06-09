FROM alpine:3.7

RUN apk --no-cache --update add nginx \
    && mkdir -p /application /run/nginx /var/lib/nginx \
    && chown -R nginx:nginx /application /run/nginx /var/lib/nginx

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
