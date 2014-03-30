<?php
namespace Commands;
use Illuminate\Console\Command;
use Predis\Async\Client as AsyncClient;
/**
 * Class SubscribeCommand
 */
class SubscribeCommand extends Command {

	/** @var string */
	protected $name = 'redis:subscribe';
	/** @var string */
	protected $description = "redis subscribe start";
	/** @var array */
	protected $connection;

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
			$redis = new AsyncClient($this->connection, $client->getEventLoop());

			// "subscriber" チャンネル登録
			$client->pubsub('subscriber', function ($event) use ($redis)
			{
				var_dump($event);
				// 受信したメッセージをlistにpush
				//$redis->rpush("{$event->channel}", $event->payload, function () use ($event) {
				//	echo "Stored message `{$event->payload}` from {$event->channel}.\n";
				//});
			});
		});
		$client->getEventLoop()->run();
	}

}