<?php
namespace Models\Redis;
use Models\Interfaces\SubscribeInterface;

/**
 * Class Publish
 * @package Models
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Subscribe implements SubscribeInterface{

	const PUBLISH_CHANNEL = "channel:subscriber";

	/**
	 * @param null $channel
	 * @return mixed|void
	 */
	public function subscribe($channel = null)
	{
		if(is_null($channel))
		{
			$channel = self::PUBLISH_CHANNEL;
		}
		return \Redis::connection('default')->subscribe($channel);
	}
}