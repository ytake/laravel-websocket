<?php
namespace App\Commands;

use Illuminate\Console\Command;
use App\Reactive\AsyncInterface;
use Ratchet\Wamp\WampServerInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * pubsub serverコマンド実装
 * Class PubSubCommand
 * require ZMQ extension / 動作させるのには、ZMQが必要です
 * @package App\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PubSubCommand extends Command
{

    /** @var string */
    protected $name = 'websocket:server';
    /** @var string */
    protected $description = "webscoket subscribe server";
    /** @var AsyncInterface */
    protected $loop;
    /** @var WampServerInterface */
    protected $wamp;

    /**
     * @param AsyncInterface $loop
     * @param WampServerInterface $wamp
     */
    public function __construct(AsyncInterface $loop, WampServerInterface $wamp)
    {
        parent::__construct();
        $this->loop = $loop;
        $this->wamp = $wamp;
    }

    /**
     * @return void
     */
    public function fire()
    {
        $loop = $this->loop->async();
        $this->info('redis subscribe start');

        $this->pull($loop, $this->wamp);
        // reactPHP socket server
        $webSock = new \React\Socket\Server($loop);
        $webSock->listen($this->option('port'), '0.0.0.0');
        //
        new \Ratchet\Server\IoServer(
            new \Ratchet\Http\HttpServer(
                new \Ratchet\WebSocket\WsServer(
                    new \Ratchet\Wamp\WampServer($this->wamp)
            )
        ), $webSock);

        $this->info('websocket server boot');
        $this->comment('Listening on port ' . $this->option('port'));
        $loop->run();
    }

    /**
     * port option
     * default port "3000" / 指定が無ければport 3000を利用します
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['port', 'p', InputOption::VALUE_OPTIONAL, 'port specified.', 3000]
        ];
    }

    /**
     * @param $loop \React\EventLoop\LoopInterface
     * @param $wamp \Ratchet\Wamp\WampServerInterface
     * @return void
     */
    protected function pull($loop, $wamp)
    {
        $context = new \React\ZMQ\Context($loop);
        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind(\Config::get('app.socket_connection'));
        $pull->on('message', array($wamp, 'push'));
    }
}