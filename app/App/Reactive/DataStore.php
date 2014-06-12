<?php
namespace App\Reactive;

use Carbon\Carbon;

/**
 * Class DataStore
 * @package App\Reactive
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class DataStore implements DataStoreInterface
{

    // redis key / list
    const KEY = "socket.timeLine:";

    /**
     * Redis publish/subscribe
     * Redis pub/subを利用 Redisにpublishします
     * @param array $array
     * @return mixed|void
     */
    public function publish(array $array)
    {
        $array['created_at'] = Carbon::now()->toDateTimeString();
        $result = \Redis::connection('default')
            ->publish(\Config::get('pubsub.basic_channel'), json_encode($array));

        if($result) {
            $this->set($array);
        }
        return $result;
    }

    /**
     *
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
}