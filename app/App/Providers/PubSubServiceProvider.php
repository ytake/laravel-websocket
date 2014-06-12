<?php
namespace App\Providers;

use App\Reactive\Async;
use Illuminate\Support\ServiceProvider;
use App\Commands\PubSubCommand;

/**
 * Class PublishServiceProvider
 * @package App\Providers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PubSubServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * register
     * dependency Injection
     * @return void
     */
    public function register()
    {
        // async Interface
        $this->app->bind("App\\Reactive\\AsyncInterface", function() {
            return new Async(new \ZMQContext());
        });
        // webSocket Server
        $this->app->bind("Ratchet\\Wamp\\WampServerInterface", "App\\Reactive\\Socket\\Push");

        // register commands
        $this->app->bind("pubsub.server", function() {
            return new PubSubCommand(
                $this->app->make("App\\Reactive\\AsyncInterface"),
                $this->app->make("Ratchet\\Wamp\\WampServerInterface")
            );
        });
        $this->commands("pubsub.server");
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ["pubsub.server"];
    }
}