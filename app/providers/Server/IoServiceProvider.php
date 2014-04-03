<?php
namespace App\Providers\Server;

use PHPSocketIO\SocketIO;
use PHPSocketIO\Http\Http;
use PHPSocketIO\Http\WebSocket\WebSocket;
use Illuminate\Support\ServiceProvider;

class IoServiceProvider extends ServiceProvider{

	protected $defer = true;

	public function register()
	{
		$this->app->bind("PHPSocketIO\Response\ResponseInterface", "PHPSocketIO\Response\Response");

		$this->app->bind("socket.io.server", function()
			{
				return new \App\Commands\Socket\IoCommand(
					new SocketIO(),
					new WebSocket(),
					new Http(),
					$this->app->make("PHPSocketIO\Response\ResponseInterface")
				);
			});
		$this->commands("socket.io.server");
	}

	public function provides()
	{
		return ["socket.io.server"];
	}
}