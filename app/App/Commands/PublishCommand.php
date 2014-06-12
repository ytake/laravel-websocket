<?php
namespace App\Commands;

use Illuminate\Console\Command;
use App\Reactive\DataStoreInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class PubSubCommand
 * @package App\Commands
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class PublishCommand extends Command
{

    /** @var string */
    protected $name = 'websocket:publish';
    /** @var string */
    protected $description = "publish from server";
    /** @var DataStoreInterface */
    protected $store;

    /**
     * @param DataStoreInterface $store
     */
    public function __construct(DataStoreInterface $store)
    {
        parent::__construct();
        $this->store = $store;
    }

    /**
     * @return void
     */
    public function fire()
    {
        $this->store->publish(['body' => $this->option('body')]);
        $this->comment($this->option('body'));
        $this->info('done.');
    }

    /**
     * submit message / 送信する文字列を指定します
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