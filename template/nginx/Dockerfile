FROM nginx:alpine

ENV TZ="Asia/Jakarta"
ENV PS1="\u@\h:\w\\$ "

RUN apk add --no-cache bash
RUN apk add --no-cache tzdata

# Buat direktori SSL di dalam container
RUN mkdir -p /etc/nginx/ssl

