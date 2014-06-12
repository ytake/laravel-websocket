<?php
namespace App\Reactive\Socket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/**
 * Class Server
 * @package App\Reactive\Socket
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Server implements MessageComponentInterface
{

    /** @var \SplObjectStorage  */
    protected $clients;


    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    /**
     * 接続開始
     * @param \Ratchet\ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        // 接続したクライアントを割当
        $this->clients->attach($conn);
        $conn->send(json_encode(['message' => 'connect']));
    }

    /**
     * メッセージ受信時の処理
     * onMessage
     * @param \Ratchet\ConnectionInterface $from
     * @param type $msg
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {

    }

    /**
     * 切断
     * @param \Ratchet\ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn) {

        $this->clients->detach($conn);
    }

    /**
     * socket Error
     * @param \Ratchet\ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

}