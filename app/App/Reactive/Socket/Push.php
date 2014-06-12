<?php
namespace App\Reactive\Socket;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

/**
 * Class Push
 * @package App\Reactive\Socket
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Push implements WampServerInterface
{
    /** @var array  */
    protected $subscribedTopics = array();

    /**
     * @param ConnectionInterface $conn
     * @param \Ratchet\Wamp\Topic|string $topic
     */
    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        if (!array_key_exists($topic->getId(), $this->subscribedTopics)) {
            $this->subscribedTopics[$topic->getId()] = $topic;
        }
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Ratchet\Wamp\Topic|string $topic
     */
    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {

    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {

    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {

    }

    /**
     * @param ConnectionInterface $conn
     * @param string $id
     * @param \Ratchet\Wamp\Topic|string $topic
     * @param array $params
     */
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Ratchet\Wamp\Topic|string $topic
     * @param string $event
     * @param array $exclude
     * @param array $eligible
     */
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $conn->close();
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {

    }

    /**
     * server push / broadcast
     * @param $data
     * @return void
     */
    public function push($data)
    {
        $entryData = json_decode($data, true);
        // webSocket / subscribe channel
        //$topic = $this->subscribedTopics['sample'];
        foreach($this->subscribedTopics as $topic) {
            $topic->broadcast($entryData);
        }
    }
}