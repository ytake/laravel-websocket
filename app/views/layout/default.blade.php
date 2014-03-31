<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>@yield('title', 'websocket sample')</title>
	{{\HTML::script("//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js")}}
	{{\HTML::script("//cdnjs.cloudflare.com/ajax/libs/underscore.string/2.3.3/underscore.string.min.js")}}
	{{\HTML::script("/dist/backbone-min.js")}}
	{{\HTML::script("//cdnjs.cloudflare.com/ajax/libs/socket.io/0.9.10/socket.io.min.js")}}
	@yield('scripts')
</head>
<body>
	<div>
	@yield('content')
	</div>
</body>
</html>