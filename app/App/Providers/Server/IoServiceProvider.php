<?php
namespace App\Providers\Server;

use PHPSocketIO\SocketIO;
use PHPSocketIO\Http\Http;
use PHPSocketIO\Http\WebSocket\WebSocket;
use Illuminate\Support\ServiceProvider;

/**
 * PHP socket.io server
 * Class IoServiceProvider
 * @package App\Providers\Server
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class IoServiceProvider extends ServiceProvider
{


    protected $defer = true;

    /**
     * register
     */
    public function register()
    {
        $this->app->bind("PHPSocketIO\Response\ResponseInterface", "PHPSocketIO\Response\Response");

        $this->app->bind("socket.io.server", function() {
                return new \App\Commands\Socket\IoCommand(
                    new SocketIO(),
                    new WebSocket(),
                    new Http(),
                    $this->app->make("PHPSocketIO\Response\ResponseInterface")
                );
            });
        $this->commands("socket.io.server");
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ["socket.io.server"];
    }
}