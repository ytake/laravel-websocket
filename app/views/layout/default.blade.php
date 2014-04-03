<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>@yield('title', 'websocket sample')</title>
	{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js")}}
	{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js")}}
	{{HTML::script("/dist/backbone-min.js")}}
	{{HTML::script("/dist/socket.io.min.js")}}
	{{HTML::script("/packages/bootstrap/js/bootstrap.min.js")}}
	{{HTML::script("/assets/js/docs.min.js")}}
	@yield('scripts')
	{{HTML::style("/packages/bootstrap/css/bootstrap.min.css")}}
	{{HTML::style("/assets/css/basic.css")}}
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	@yield('link')
</head>
<body>
	@include('elements.navigation')
	<div class="container">
	@yield('content')
	</div>
</body>
</html>