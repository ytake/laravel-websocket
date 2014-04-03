<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">laravel websocket sample</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="{{(\Request::is('/') == true) ? 'active' : '' }}"><a href="/">index</a></li>
				<li class="{{(\Request::is('emit') == true) ? 'active' : '' }}"><a href="/emit">publish / subscribe</a></li>
				<li class="{{(\Request::is('socket') == true) ? 'active' : '' }}"><a href="/socket">socket.io</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>