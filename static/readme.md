> **Файловый репозиторий** - эта папка служит для хранения 
заливки и отображения статических файлов например картинки, видео и тп.
Ниже приведен пример настройки nginx на отдельный домен, можно вынести
на отдельный сервер если есть необходимость в масштабировании проекта.
Такая настройка не даст выполнять файлы php и это дополнительно дает
приимущество в безопасности

```
server {
   charset utf-8;
   client_max_body_size 128M;
   sendfile off;

   listen 80; ## listen for ipv4
   #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

   server_name static.shop.dev;
   root        /app/static/;

   error_log   /app/vagrant/nginx/log/static-error.log;

   location ~ /\.(ht|svn|git) {
       deny all;
   }
}
```