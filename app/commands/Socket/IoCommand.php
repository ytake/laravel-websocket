<?php
namespace Commands\Socket;
use Illuminate\Console\Command;
use PHPSocketIO\Connection;
use PHPSocketIO\Response\Response;
use PHPSocketIO\Event;
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

	/**
	 *
	 */
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

		$this->info("port {$this->option('port')}. socket.io server boot");

		$this->socketIo->listen($this->option('port'))
			->onConnect(function(Connection $connection)
			{
				list($host, $port) = $connection->getRemote();
				$this->info("connected $host:$port");

			})
			->onRequest('/socket', function($connection, \EventHttpRequest $request) {

					$response = new Response($this->_dispatch('/socket', 'GET'));
					$response->setContentType('text/html', 'UTF-8');
					$connection->sendResponse($response);
				})
			->onRequest('/socket.io.min.js', function($connection, \EventHttpRequest $request) {
					$response = new Response(file_get_contents(base_path('public/dist/scoket.io.min.js')));
					$response->setContentType('text/html', 'UTF-8');
					$connection->sendResponse($response);
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

	/**
	 * @access private
	 * @param $uri
	 * @param $method
	 * @param array $data
	 * @return mixed
	 */
	private function _dispatch($uri, $method, array $data = array())
	{
		$request = \Request::create($uri, $method, $data);
		\Request::replace($request->input());
		return \Route::dispatch($request)->getContent();
	}
}