<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\ResponseAPI;

class UserController extends Controller
{
	private $_model;

    public function __construct()
	{
		$this->_model = new User();

	}

	public function showAll(Request $request) {

		$filters = [
			'offset' => $request->input('offset', 0),
			'limit' => $request->input('limit', 10),
			'sort' => $request->input('sort','id'),
			'order' => $request->input('order','desc'),
			'email' => $request->input('email', ''),
			'phone' => $request->input('phone', ''),
			'full_name' => $request->input('full_name', ''),
			'from' => $request->input('from',''),
			'to' => $request->input('to','')
		];

		$data = $this->_model->showAllUser($filters);

		return ResponseAPI::success(200, 'Success', $data);
	}
}
