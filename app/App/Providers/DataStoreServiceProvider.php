<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class DataStoreServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class DataStoreServiceProvider extends ServiceProvider
{

    /**
     * register
     */
    public function register()
    {
        $this->app->bind("App\\Reactive\\DataStoreInterface", "App\\Reactive\\DataStore");
    }
}