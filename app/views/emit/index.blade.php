@extends('layout.default')
@section('scripts')
<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
@stop
@section('content')
<div class="starter-template">
	<h1>publish / subscribe sample</h1>
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
	<div id="content">
		@if(count($list))
		@foreach($list as $row)
		<blockquote>
			<p>{{$row->body}}</p>
			<footer>{{$row->created_at}}</footer>
		</blockquote>
		@endforeach
		@endif
	</div>
</div>
<script>
"use strict";
$(document).ready(function(){

	$("#emit").bind('keydown', function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
		}
	});
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
		'ws://127.0.0.1:3000' , function(){
			conn.subscribe('news', function(topic, data) {
				if(data.body != '')
				{
					console.log(data);
					$("#content").append(
						"<blockquote><p>" + data.body + "</p><footer>" + data.created_at +"</footer></blockquote>"
					);
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
@stop