<?php
namespace Models\Redis;
use Models\Interfaces\PublishInterface;

/**
 * Class Publish
 * @package Models
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Publish implements PublishInterface{

	const PUBLISH_CHANNEL = "channel:subscriber";

	/**
	 * @param array $array
	 * @return mixed|void
	 */
	public function publish(array $array)
	{
		return \Redis::connection('default')->publish(self::PUBLISH_CHANNEL, json_encode($array));
	}

}