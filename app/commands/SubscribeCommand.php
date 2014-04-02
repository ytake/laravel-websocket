<?php
namespace Commands;
use Illuminate\Console\Command;
use Models\Websocket;
use Predis\Async\Client as AsyncClient;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class SubscribeCommand
 * @package Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class SubscribeCommand extends Command {

	/** @var string */
	protected $name = 'redis:subscribe';
	/** @var string */
	protected $description = "redis subscribe start";
	/** @var array */
	protected $connection;

	protected $subscribe;

	public function __construct()
	{
		parent::__construct();
		$this->connection = \Config::get('database.redis.default');

	}

	/**
	 * @return void
	 */
	public function fire()
	{
		// connect to redis
		$client = new AsyncClient($this->connection);
		$client->connect(function ($client)
		{
			$this->info('redis subscribe start');
			// 非同期
			$redis = new AsyncClient($this->connection, $client->getEventLoop());
			// "subscriber" チャンネル登録
			$client->pubsub('channel:subscriber', function ($event) use ($redis)
			{
				$context = new \ZMQContext();
				$socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'push1');
				$socket->connect("tcp://localhost:5555");
				$socket->send($event->payload);
			});
		});
		$loop = $client->getEventLoop();

		$push = new \Models\Websocket\Push();
		$recontext = new \React\ZMQ\Context($loop);
		$pull = $recontext->getSocket(\ZMQ::SOCKET_PULL);
		$pull->bind("tcp://127.0.0.1:5555");
		$pull->on('message', array($push, 'push'));
		$webSock = new \React\Socket\Server($loop);
		$webSock->listen($this->option('port'), '0.0.0.0');
		$webServer = new \Ratchet\Server\IoServer(
			new \Ratchet\Http\HttpServer(
				new \Ratchet\WebSocket\WsServer(
					new \Ratchet\Wamp\WampServer($push)
			)
		), $webSock);

		$this->info('websocket server boot');
		$this->info('Listening on port ' . $this->option('port'));
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
}