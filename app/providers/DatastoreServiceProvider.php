<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

/**
 * Class DatastoreServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class DatastoreServiceProvider extends ServiceProvider{
	//
	public function register()
	{
		$this->app->bind("Models\Interfaces\DatastoreInterface", "Models\Redis\Datastore");
	}
}