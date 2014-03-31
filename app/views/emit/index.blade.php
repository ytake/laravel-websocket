@extends('layout.default')
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
				alert( "Data Saved: " + response);
			}
		});
	});
});
</script>
@stop