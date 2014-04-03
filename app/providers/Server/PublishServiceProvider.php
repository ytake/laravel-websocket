<?php
namespace App\Providers\Server;
use Illuminate\Support\ServiceProvider;
/**
 * Class PublishServiceProvider
 * @package App\Providers\Server
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PublishServiceProvider extends ServiceProvider{

	protected $defer = true;

	public function register()
	{
		$this->app->bind("publish.server", function()
		{
			return new \App\Commands\PublishCommand(
				$this->app->make("Models\Interfaces\DatastoreInterface")
			);
		});
		$this->commands("publish.server");
	}

	public function provides()
	{
		return ["publish.server"];
	}
}