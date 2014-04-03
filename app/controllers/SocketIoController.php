<?php
use \Models\Interfaces\DatastoreInterface;
/**
 * Class EmitController
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 */
class SocketIoController extends \BaseController {

	/** @var \Models\Interfaces\DatastoreInterface  */
	protected $publish;


	public function __construct(DatastoreInterface $publish)
	{
		$this->publish = $publish;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return \View::make('socket.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if($this->publish->publish(['body' => \Input::get('body', null)]))
		{
			return \Response::json(json_encode(['result' => true]) ,200);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}