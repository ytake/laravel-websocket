@extends('layout.default')
@section('content')
<div class="starter-template">
	<h1>socket.io sample</h1>
	<form class="form-horizontal" role="form">
		<div class="form-group">
			{{Form::label('body', 'body', ['class' => 'col-sm-2 control-label'])}}
			<div class="col-sm-10">
				{{Form::text('body', null, ['id' => 'body', 'class' => 'form-control', 'placeholder' => 'body'])}}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{Form::button('publish', ['id' => 'emit', 'class' => 'btn btn-default'])}}
			</div>
		</div>
	</form>
	<div id="content"></div>
</div>
<script>
	"use strict";
	$(document).ready(function(){

		$("#emit").bind('keydown', function(e) {
			if (e.keyCode == 13) {
				e.preventDefault();
			}
		});
		var socket = io.connect('http://127.0.0.1:3000');

		socket.on("connect", function (){

			console.log("connection is opened.");
		});
		socket.on("disconnect", function (client){
			console.log(client);
			console.log("connection is closed.");
		});
		socket.on('error', function(event){
			console.log(event);
		});
		socket.on('message',function(data){
			$("#content").append(
				"<blockquote><p>" + data.body + "</p></blockquote>"
			);
		});

		$("#emit").click(function(event){
			socket.emit('message', {
				body: $("#body").val()
			});
		});
	});
</script>
@stop