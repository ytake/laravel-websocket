<?php
namespace App\Controllers;

use Illuminate\Routing\Controller;

/**
 * Class BaseController
 * @package App\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class BaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = \View::make($this->layout);
        }
    }

}