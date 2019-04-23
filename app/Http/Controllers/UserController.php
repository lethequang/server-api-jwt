<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\User;
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
				return ResponseAPI::error(404, trans('messages.not_found_with_id', ['name' => 'user', 'id' => $id]));
			}
			if (! $this->_model->removeUser($user)) {
				return ResponseAPI::error(400, trans('messages.fail'));
			}
			return ResponseAPI::success(200, trans('messages.success'), $user);
		} catch (\Exception $e) {
    		return ResponseAPI::error(500, trans('messages.server_error', ['msg' => $e->getMessage()]));
		}
	}

	public function update(RequestUser $request, $id)
	{
		try {
			$user = $this->_model->find($id);
			if (!$user) {
				return ResponseAPI::error(404, trans('messages.not_found_with_id', ['name' => 'user', 'id' => $id]));
			}
			$errors = $request->validated();
			if (!empty($errors)) {
				return ResponseAPI::error(400, trans('messages.fail'), $errors);
			}
			if (! $this->_model->edit($user, $request->all())) {
				return ResponseAPI::error(400, trans('messages.fail'));
			}
			return ResponseAPI::success(200, trans('messages.success'), $user);
		} catch (\Exception $e) {
			return ResponseAPI::error(500, trans('messages.server_error', ['msg' => $e->getMessage()]));
		}
	}

	public function create(RequestUser $request) {
    	try {
    		$errors = $request->validated();
    		if (!empty($errors)) {
				return ResponseAPI::error(400, 'Validation error', $errors);
			}
			if (! $user = $this->_model->add($request->all())) {
				return ResponseAPI::error(400, 'Create fail');
			}
			return ResponseAPI::success(200, 'Success', $user);
		} catch (\Exception $e) {
    		return ResponseAPI::error(500, $e->getMessage());
		}
	}
}
