<?php
namespace Commands\Socket;
use Illuminate\Console\Command;
use PHPSocketIO\SocketIO;
use PHPSocketIO\Connection;
use PHPSocketIO\Response\Response;
use PHPSocketIO\Event;
use PHPSocketIO\Http\WebSocket\WebSocket;
use PHPSocketIO\Http\Http;
use Symfony\Component\Console\Input\InputOption;
/**
 * Class IoCommand
 * @package Commands\Socket
 */
class IoCommand extends Command {

	/**
	 * @var string
	 */
	protected $name = 'websocket:io';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = "boot socket.io server";

	/** @var \PHPSocketIO\SocketIO */
	protected $socketIo;
	/** @var \PHPSocketIO\Http\WebSocket\WebSocket */
	protected $websocket;
	/** @var \PHPSocketIO\Http\Http */
	protected $http;

	public function __construct()
	{
		parent::__construct();
		$this->socketIo = \App::make("PHPSocketIO\SocketIO");
		$this->websocket = \App::make("PHPSocketIO\Http\WebSocket\WebSocket");
		$this->http = \App::make("PHPSocketIO\Http\Http");
	}

	/**
	 * @return void
	 */
	public function fire()
	{
/*
		$chat = $this->socketIo->getSockets()
			->on('addme', function(Event\MessageEvent $messageEvent) use (&$chat) {
				$messageEvent->getConnection()->emit(
					'update',
					array('msg' => "Welcome {$messageEvent->getMessage()}")
				);
				$chat->emit('update', array('msg' => "{$messageEvent->getMessage()} is coming."));
			})
			->on('msg', function(Event\MessageEvent $messageEvent) use (&$chat) {
				$message = $messageEvent->getMessage();
				$chat->emit('update', $message);
			});
*/

		$this->socketIo->listen($this->option('port'))
		->onConnect(function(Connection $connection)
		{
			list($host, $port) = $connection->getRemote();
			$this->info("connected $host:$port");
		})
		->dispatch();
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
}