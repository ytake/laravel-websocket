laravel-websocket
=================

websocket, socket.io sample  
**require Redis**
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
