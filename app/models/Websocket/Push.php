<?php
namespace Models\Websocket;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

/**
 * Class Push
 * @package Models\Websocket
 * @author  yuuki.takezawa<yuuki.takezawa@excite.jp>
 */
class Push implements WampServerInterface
{
	protected $subscribedTopics = array();

	public function onSubscribe(ConnectionInterface $conn, $topic)
	{
		if (!array_key_exists($topic->getId(), $this->subscribedTopics))
		{
			$this->subscribedTopics[$topic->getId()] = $topic;
		}
	}

	public function onUnSubscribe(ConnectionInterface $conn, $topic)
	{

	}

	/**
	 * @param ConnectionInterface $conn
	 */
	public function onOpen(ConnectionInterface $conn){

	}

	public function onClose(ConnectionInterface $conn){

	}

	public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
		$conn->callError($id, $topic, 'You are not allowed to make calls')->close();
	}

	public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
	{
		$conn->close();
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
	}


	public function push($data)
	{
		$entryData = json_decode($data, true);
		//$topic = $this->subscribedTopics['news'];
		foreach($this->subscribedTopics as $topic)
		{
			$topic->broadcast($entryData);
		}
	}
}