<?php
namespace Models\Interfaces;

interface DatastoreInterface {

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