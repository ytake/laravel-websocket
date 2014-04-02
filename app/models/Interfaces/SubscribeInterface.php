<?php
/**
 * PublishInterface.php
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * Date: 2014/04/01 1:06
 */
namespace Models\Interfaces;

interface SubscribeInterface {

	/**
	 * @param string $channel
	 * @return mixed
	 */
	public function subscribe($channel = null);
}