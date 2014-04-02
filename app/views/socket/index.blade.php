@extends('layout.default')
@section('link')
<style>
	#content {
		width: 400px;
		height: 280px;
		border: 1px solid;
		overflow: auto;
		float: left;
	}
	#content >div{
		border-bottom: 1px solid;
	}
	#content >div >label {
		color: green;
	}
	#content >div >span {
		color: blue;
		display: inline-block;
		width: 50px;
	}
</style>
@stop
@section('content')
<div id='content'></div>
<form>
	<input type='text' value='' /><input type='submit' value='send' />
</form>
<script>
	$(function(){
		var myname = null;
		var socket = io.connect('http://127.0.0.1:3000/');
		socket.on("connect", function (){

			console.log("connection is opened.");
		})

		socket.on("disconnect", function (client){
			console.log(client);
			console.log("connection is closed.");
		});
		socket.on('update',function(data) {
			if(data.msg == '/clear') {
				$('#content').empty();
				return;
			}
			if(data.user) {
				$('#content').append('<div><span>'+data.user+':</span>'+data.msg+'</div>');
			}
			else {
				$('#content').append('<div><label>'+data.msg+'</label></div>');
			}
		});
		$('form').submit(function() {
			if(myname == null) {
				myname = prompt("yourname");
				socket.emit('addme', myname);
			}
			socket.emit('msg', {
				msg: $('input[type=text]').val(),
				user: myname
			});
			$('input[type=text]').val('');
			return false;
		});
	});
</script>
@stop