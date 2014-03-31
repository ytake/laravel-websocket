@extends('layout.default')
@section('content')
<script>
	var socket = io.connect('http://localhost:4000');
	socket.on('connect', function(msg)
	{
		console.log("connect");
		console.log(socket.socket);
	});
</script>
@stop