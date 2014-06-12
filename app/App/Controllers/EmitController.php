<?php
namespace App\Controllers;

use App\Reactive\DataStoreInterface;

/**
 * Class EmitController
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class EmitController extends BaseController
{

    /** @var DataStoreInterface */
    protected $store;

    /**
     * @param DataStoreInterface $store
     */
    public function __construct(DataStoreInterface $store)
    {
        $this->store = $store;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view = \View::make('emit.index');
        $view->with('list', $this->store->get());
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store()
    {
        if($this->store->publish(['body' => \Input::get('body', null)])) {
            return \Response::json(['result' => true] ,200);
        }
    }
}