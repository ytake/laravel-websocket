<?php
namespace App\Commands;

use Models\Websocket;
use Illuminate\Console\Command;
use Models\Interfaces\AsyncInterface;
use Ratchet\Wamp\WampServerInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class PubSubCommand
 * @package App\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PubSubCommand extends Command {

	/** @var string */
	protected $name = 'websocket:server';
	/** @var string */
	protected $description = "webscoket subscribe server";
	/** @var \Models\Interfaces\AsyncInterface */
	protected $loop;
	/** @var \Ratchet\Wamp\WampServerInterface */
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

		$webSock = new \React\Socket\Server($loop);
		$webSock->listen($this->option('port'), '0.0.0.0');

		$webServer = new \Ratchet\Server\IoServer(
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