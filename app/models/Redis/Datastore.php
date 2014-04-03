<?php
namespace Models\Redis;
use Models\Interfaces\DatastoreInterface;
use Carbon\Carbon;
/**
 * Class Publish
 * @package Models
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class Datastore implements DatastoreInterface{

	const KEY = "timeline:";

	/**
	 * @param array $array
	 * @return mixed|void
	 */
	public function publish(array $array)
	{
		$array['created_at'] = Carbon::now()->toDateTimeString();
		$result = \Redis::connection('default')->publish(\Config::get('pubsub.basic_channel'), json_encode($array));
		if($result)
		{
			$this->set($array);
		}
		return $result;
	}

	/**
	 * @param array $array
	 * @return mixed
	 */
	public function set(array $array)
	{
		return \Redis::connection()->rpush(self::KEY, json_encode($array));
	}

	/**
	 * @return \stdClass
	 */
	public function get()
	{
		$array = [];
		$result = \Redis::connection()->lrange(self::KEY, 0, -1);
		if(count($result))
		{
			array_walk($result, function($value) use(&$array){
					$array[] = json_decode($value);
			});
			return $array;
		}
		return $result;
	}

	public function extract($value, $key)
	{
		return json_encode($value);
	}
}