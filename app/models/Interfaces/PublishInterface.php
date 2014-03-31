<?php
/**
 * PublishInterface.php
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * Date: 2014/04/01 1:06
 */
namespace Models\Interfaces;

interface PublishInterface {

	/**
	 * @param array $array
	 * @return mixed
	 */
	public function publish(array $array);
}