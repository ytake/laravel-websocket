<?php
namespace Commands\Socket;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\Socket;

class PushCommand extends Command {

	/**
	 * @var string
	 */
	protected $name = 'websocket:push';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = "boot wamp server";

	/**
	 * @return void
	 */
	public function fire()
	{
		$loop   = \React\EventLoop\Factory::create();
		//$pusher = new Wamp\Pusher;

		$context = new \React\ZMQ\Context($loop);
		$pull = $context->getSocket(ZMQ::SOCKET_PULL);
		$pull->bind('tcp://127.0.0.1:5555');
		$pull->on('message', array($pusher, 'onBlogEntry'));

		$webSock = new \React\Socket\Server($loop);
		$webSock->listen(10000, '0.0.0.0');
		$webServer = new \Ratchet\Server\IoServer(
			new \Ratchet\Http\HttpServer(
				new \Ratchet\WebSocket\WsServer(
					new \Ratchet\Wamp\WampServer($pusher
					)
				)
			), $webSock);
		$this->info('wamp boot');
		$this->info('Listening on port ' . 10000);
		$loop->run();
	}
}