server {

    root /var/www/html;

    server_name store.agentquote.com;
    client_max_body_size 100M;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
       # deny all;
    }    



    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/store.agentquote.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/store.agentquote.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

}

server {
    if ($host = store.agentquote.com) {
        return 301 https://store.agentquote.com$request_uri;
    } # managed by Certbot



    server_name store.agentquote.com;
    listen 80;
    return 404; # managed by Certbot


}
