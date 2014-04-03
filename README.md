laravel-websocket
=================

websocket, socket.io sample  


php extension dependencies

zeromq php extension http://zeromq.org/bindings:php   
event extension http://pecl.php.net/package/event  
phpiredis extension https://github.com/nrk/phpiredis  
#install
```bash
$ composer update
```
#artisan commands  
##websocket server boot.
```bash
$ php artisan websocket:server
```
--port (-p) port (default: 3000)  
##publish to websocket server from command line  
```bash
$ php artisan websocket:publish
```
--body (-b) send message (default: "publish form server")  
##php socket.io server sample  
```bash
$ php artisan websocket:io
```
--port (-p) port (default: 3000)  
