FROM alpine:3.7

RUN apk add --update --no-cache nginx \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

ADD nginx.conf /etc/nginx/
RUN rm /etc/nginx/conf.d/default.conf
RUN adduser -D -g '' -G www-data www-data
RUN chmod -R 777 /var/tmp/nginx

CMD ["nginx", "-g", "daemon off;"]

EXPOSE 80 443
