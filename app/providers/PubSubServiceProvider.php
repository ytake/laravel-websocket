<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
/**
 * Class PublishServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PubSubServiceProvider extends ServiceProvider{

	protected $defer = true;

	public function register()
	{

		$this->app->bind("Model\Interfaces\AsyncInterface", function(){
			return new \Models\Redis\Async(new \ZMQContext());
		});

		$this->app->bind("Ratchet\Wamp\WampServerInterface", "Models\Websocket\Push");

		$this->app->bind("pubsub.server", function()
		{
			return new \App\Commands\PubSubCommand(
				$this->app->make("Model\Interfaces\AsyncInterface"),
				$this->app->make("Ratchet\Wamp\WampServerInterface")
			);
		});
		$this->commands("pubsub.server");
	}

	public function provides()
	{
		return ["pubsub.server"];
	}
}