<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

/**
 * Class PublishServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PublishServiceProvider extends ServiceProvider{

	//
	public function register()
	{
		$this->app->bind("Models\Interfaces\PublishInterface", "Models\Publish");
	}
} 