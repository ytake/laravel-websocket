<?php
namespace App\Commands\Socket;

use PHPSocketIO\Event;
use PHPSocketIO\SocketIO;
use PHPSocketIO\Http\Http;
use PHPSocketIO\Connection;
use Illuminate\Console\Command;
use PHPSocketIO\Http\WebSocket\WebSocket;
use PHPSocketIO\Response\ResponseInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * socket.io server sample
 * Class IoCommand
 * @package Commands\Socket
 */
class IoCommand extends Command
{

    /** @var string  command name */
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
    /** @var \PHPSocketIO\Response\ResponseInterface */
    protected $response;

    /**
     * @param SocketIO $socketIo
     * @param WebSocket $websocket
     * @param Http $http
     * @param ResponseInterface $response
     */
    public function __construct(
        SocketIO $socketIo,
        WebSocket $websocket,
        Http $http,
        ResponseInterface $response
    ) {
        parent::__construct();
        $this->socketIo = $socketIo;
        $this->websocket = $websocket;
        $this->http = $http;
        $this->response = $response;
    }

    /**
     * @return void
     */
    public function fire()
    {
        $chat = $this->socketIo->getSockets()
            ->on('message', function(Event\MessageEvent $messageEvent) use (&$chat) {
                $message = $messageEvent->getMessage();
                $chat->emit('message', $message);
            });

        $this->info("port {$this->option('port')}. socket.io server boot");

        // node.js style
        $this->socketIo->listen($this->option('port'))
            ->onConnect(function(Connection $connection) {
                list($host, $port) = $connection->getRemote();
                $this->info("connected $host:$port");
            })->onRequest('/socket', function($connection, \EventHttpRequest $request) {
                    //$content
                    $response = $this->response->setContent($this->_dispatch('/socket', 'GET'));
                    $response->setContentType('text/html', 'UTF-8');
                    $connection->sendResponse($response);
                })->onRequest('/dist/socket.io.min.js', function($connection, \EventHttpRequest $request) {
                    $response = $this->response->setContent(file_get_contents(base_path('public/dist/socket.io.min.js')));
                    $response->setContentType('text/html', 'UTF-8');
                    $connection->sendResponse($response);
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