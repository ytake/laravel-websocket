<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>@yield('title', 'websocket sample')</title>
	{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js")}}
	{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js")}}
	{{HTML::script("/dist/backbone-min.js")}}
	{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/socket.io/0.9.10/socket.io.min.js")}}
	{{HTML::script("/packages/bootstrap/js/bootstrap.min.js")}}
	{{HTML::script("/assets/js/docs.min.js")}}
	@yield('scripts')
	{{HTML::style("/packages/bootstrap/css/bootstrap.min.css")}}
	@yield('link')
</head>
<body>
	<div>
	@yield('content')
	</div>
</body>
</html>