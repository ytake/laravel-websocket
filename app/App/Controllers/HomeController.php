<?php
namespace App\Controllers;

use App\Controllers\BaseController;

/**
 * Class HomeController
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class HomeController extends BaseController
{

    /**
     * @return \Illuminate\View\View
     */
    public function getIndex()
	{
		return \View::make('index');
	}

}