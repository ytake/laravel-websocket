@extends('layout.default')
@section('scripts')
<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
@stop
@section('content')
<h2>emit sample</h2>
{{Form::text('body', null, ['id' => 'body'])}}
{{Form::button('publish', ['id' => 'emit'])}}
<script>
"use strict";
$(document).ready(function(){
	$("#emit").click(function(event){
		$.ajax({
			type: "POST",
			url: "/emit",
			dataType: "json",
			data: {
				"body": $("#body").val()
			},
			success: function(response){

			}
		});
	});

	var conn = new ab.Session(
		'ws://127.0.0.1:3000' , function() {
			conn.subscribe('news', function(topic, data) {
				if(data.body != '')
				{
					$("#content").append("<p>" + data.body + "</p>" );
				}
			});
		}, function() {
			console.warn('WebSocket connection closed');
		}, {
			'skipSubprotocolCheck': true
		}
	);
});
</script>
<div id="content"></div>
@stop