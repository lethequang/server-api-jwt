<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\ResponseAPI;
use App\Http\Requests\User as RequestUser;

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

	public function remove($id) {
    	try {
    		$user = $this->_model->find($id);
    		if (!$user) {
				return ResponseAPI::error(404, 'User not found');
			}
			if (! $this->_model->removeUser($user)) {
				return ResponseAPI::error(400, 'Remove fail');
			}
			return ResponseAPI::success(200, 'success', $user);
		} catch (\Exception $e) {
    		return ResponseAPI::error(500, $e->getMessage());
		}
	}

	public function update(RequestUser $request, $id)
	{
		try {
			$user = $this->_model->find($id);
			if (!$user) {
				return ResponseAPI::error(404, 'User not found');
			}
			$validation = $request->validated();
			if ($validation->fails()) {
				return ResponseAPI::error(400, 'Validation error', $validation->errors());
			}
			if (! $this->_model->edit($user, $request->all())) {
				return ResponseAPI::error(400, 'Update fail');
			}
			return ResponseAPI::success(200, 'success', $user);
		} catch (\Exception $e) {
			return ResponseAPI::error(500, $e->getMessage());
		}
	}
}
