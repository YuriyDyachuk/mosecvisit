FROM nginx:alpine

RUN apk add  openssl;
RUN openssl req -x509 -nodes -days 365 -subj "/C=UA/ST=QC/O=Company, Inc./CN=localhost" -addext "subjectAltName=DNS:localhost" -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt;
