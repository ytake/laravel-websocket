<?php
namespace App\Controllers;

use App\Reactive\DataStoreInterface;

/**
 * Class SocketIoController
 * @package App\Controllers
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class SocketIoController extends BaseController
{

    /** @var DataStoreInterface */
    protected $publish;

    /**
     * @param DataStoreInterface $publish
     */
    public function __construct(DataStoreInterface $publish)
    {
        $this->publish = $publish;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //
        return \View::make('socket.index');
    }
}