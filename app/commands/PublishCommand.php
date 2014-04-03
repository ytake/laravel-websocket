<?php
namespace App\Commands;

use Illuminate\Console\Command;
use Models\Interfaces\DatastoreInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class PubSubCommand
 * @package App\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PublishCommand extends Command {

	/** @var string */
	protected $name = 'websocket:publish';
	/** @var string */
	protected $description = "publish from server";
	/** @var \Models\Interfaces\DatastoreInterface */
	protected $datastore;

	/**
	 * @param DatastoreInterface $datastore
	 */
	public function __construct(DatastoreInterface $datastore)
	{
		parent::__construct();
		$this->datastore = $datastore;
	}

	/**
	 * @return void
	 */
	public function fire()
	{
		$this->datastore->publish(['body' => $this->option('body')]);
		$this->comment($this->option('body'));
		$this->info('done.');
	}

	/**
	 * Get the console command options.
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['body', 'b', InputOption::VALUE_OPTIONAL, '.', 'publish form server']
		];
	}
}