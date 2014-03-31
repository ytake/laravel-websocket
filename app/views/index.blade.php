@extends('layout.default')
@section('content')
<script>
	var socket = io.connect('http://localhost:3000/');
	/*
	socket.on('connect', function(msg)
	{
		console.log("connect");
		//console.log(socket.socket);
	});
	*/
</script>
@stop