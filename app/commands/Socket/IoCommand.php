<?php
namespace Commands\Socket;
use Illuminate\Console\Command;
use PHPSocketIO\SocketIO;
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

	protected $socketIo;

	public function __construct()
	{
		parent::__construct();
		$this->socketIo = \App::make("PHPSocketIO\SocketIO", ["baseEvent" => null]);
	}

	/**
	 * @return void
	 */
	public function fire()
	{
		$this->socketIo->listen($this->option('port'))->onConnect(function(Connection $connection)
		{
			list($host, $port) = $connection->getRemote();
			echo "connected $host:$port\n";
		})->dispatch();

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