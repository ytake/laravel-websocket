<?php
namespace App\Reactive;

/**
 * Interface DataStoreInterface
 * @package Models\Interfaces
 */
interface DataStoreInterface
{
	/**
	 * @param array $array
	 * @return mixed
	 */
	public function publish(array $array);

	/**
	 * @param array $array
	 * @return mixed
	 */
	public function set(array $array);

	/**
	 * @return array
	 */
	public function get();
}