<?php
/**
 * Class HomeController
 * @author yuuki.takezawa<yuuki.takezawa@excite.jp>
 */
class HomeController extends BaseController {

	public function getIndex()
	{

		return View::make('index');
	}

}