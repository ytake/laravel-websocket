@extends('layout.default')
@section('content')
<h1>websocket sample</h1>
<h3 class="bg-warning">
	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;require Redis
</h3>
<h3>php extension dependencies</h3>
<ol>
	<li>zeromq php extension&nbsp;<a href="http://zeromq.org/bindings:php" class="btn btn-primary btn-xs" target="_blank">url</a></li>
	<li>event extension&nbsp;<a href="http://pecl.php.net/package/event" class="btn btn-primary btn-xs" target="_blank">url</a></li>
	<li>phpiredis extension&nbsp;<a href="https://github.com/nrk/phpiredis" class="btn btn-primary btn-xs" target="_blank">url</a></li>
</ol>

<h3>artisan commands</h3>
<ol>
	<li><p class="btn btn-info btn-xs">$ php artisan websocket:server</p> websocket server boot.
		<p class="text-success">--port (-p) port (default: 3000)</p>
	</li>
	<li><p class="btn btn-info btn-xs">$ php artisan websocket:publish</p> publish to websocket server from command line
		<p class="text-success">--body (-b) send message (default: "publish form server")</p>
	</li>
	<li><p class="btn btn-info btn-xs">$ php artisan websocket:io</p> php socket.io server sample
		<p class="text-success">--port (-p) port (default: 3000)</p>
	</li>
</ol>
@stop