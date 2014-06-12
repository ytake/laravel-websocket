Laravel-websocket-server sample
=================
for Laravel 4.2(PSR-4)  

websocket-server, socket.io-server sample  
and push from websocket-server sample  
**require Redis pubsub**
##use packages
predis/predis-async  https://github.com/nrk/predis-async  
rickysu/phpsocket.io  https://github.com/RickySu/phpsocket.io  
cboden/Ratchet  https://github.com/cboden/Ratchet  
reactPHP/Zmq  https://github.com/reactphp/zmq  

#php extension dependencies
zeromq php extension http://zeromq.org/bindings:php  
event extension http://pecl.php.net/package/event  
phpiredis extension https://github.com/nrk/phpiredis  
#install
```bash
$ composer update
```
#artisan commands  
##websocket server boot.(use redis pubsub)
```bash
$ php artisan websocket:server
```
option --port (-p) port (default: 3000)  
##publish to websocket server from command line  
```bash
$ php artisan websocket:publish
```
option --body (-b) send message (default: "publish form server")  
##php socket.io server sample(basic socket.io)  
```bash
$ php artisan websocket:io
```
option --port (-p) port (default: 3000)  



Laravel-websocket-server 実装サンプル
=================
Laravel 4.2向け (PSR-4対応)  
このサンプルにはwebsocketサーバ, socket.ioサーバ
websocketサーバからのpush送信が含まれます
**Redisのpubsub機能を使用しているため、Redisを必ずインストールして下さい**

##利用パッケージ
predis/predis-async  https://github.com/nrk/predis-async  
rickysu/phpsocket.io  https://github.com/RickySu/phpsocket.io  
cboden/Ratchet  https://github.com/cboden/Ratchet  
reactPHP/Zmq  https://github.com/reactphp/zmq  

#動作させる上で必要なエクステンション
zeromq php extension http://zeromq.org/bindings:php  
event extension http://pecl.php.net/package/event  
phpiredis extension https://github.com/nrk/phpiredis  

#インストール
```bash
$ composer update
```
#実装したartisanコマンド  
##websocketサーバ起動(redis pubsub利用)
```bash
$ php artisan websocket:server
```
オプションで起動ポートが指定できます(デフォルト3000利用)  
option --port (-p) port (default: 3000)  
##コマンドラインサーバからクライアントへpush  
```bash
$ php artisan websocket:publish
```
オプションで送信文字列が指定できます("publish form server")  
option --body (-b) send message (default: "publish form server")  
##PHP製socket.ioサーバサンプル
node.jsのクライアントが含まれます
```bash
$ php artisan websocket:io
```
オプションで起動ポートが指定できます(デフォルト3000利用)  
option --port (-p) port (default: 3000)  
