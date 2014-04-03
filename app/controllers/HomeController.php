<?php
/**
 * Class HomeController
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class HomeController extends \BaseController
{

	public function getIndex()
	{

		return View::make('index');
	}

}