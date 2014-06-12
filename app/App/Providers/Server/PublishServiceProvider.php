<?php
namespace App\Providers\Server;

use App\Commands\PublishCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class PublishServiceProvider
 * @package App\Providers\Server
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PublishServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * register
     */
    public function register()
    {
        $this->app->bind("publish.server", function()
        {
            return new PublishCommand(
                $this->app->make("App\\Reactive\\DataStoreInterface")
            );
        });
        $this->commands("publish.server");
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ["publish.server"];
    }
}