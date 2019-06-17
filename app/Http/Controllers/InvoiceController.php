<?php

namespace App\Http\Controllers;

use App\Http\Model\Invoice;
use Illuminate\Http\Request;
use App\Http\Model\User;
use App\Helpers\ResponseAPI;
use App\Http\Requests\User as RequestUser;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
	private $_model;

    public function __construct()
	{
		$this->_model = new Invoice();

	}

	/*
	 * Show list user
	 */
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

	/*
	 * Show detail a user
	 */
	public function detail($id) {
		$invoice = $this->_model->find($id);
		if (!$invoice) {
			return ResponseAPI::error(404, trans('messages.not_found'));
		}
		return ResponseAPI::success(200, trans('messages.success'), $invoice);
    }

    /*
     * Delete user
     */
	public function remove($id) {
    	try {
    		$invoice = $this->_model->find($id);
    		if (!$invoice) {
				return ResponseAPI::error(404, trans('messages.not_found'));
			}
			if (! $invoice->delete()) {
				return ResponseAPI::error(400, trans('messages.fail'));
			}
			return ResponseAPI::success(200, trans('messages.success'), $invoice);
		} catch (\Exception $e) {
    		return ResponseAPI::error(500, trans('messages.server_error', ['msg' => $e->getMessage()]));
		}
	}

	/*
	 * Edit user
	 */
	public function update(RequestUser $request, $id)
	{
		try {
			$invoice = $this->_model->find($id);
			if (!$invoice) {
				return ResponseAPI::error(404, trans('messages.not_found'));
			}
			$errors = $request->validated();
			if (!empty($errors)) {
				return ResponseAPI::error(422, trans('messages.unprocessable_entity'), $errors);
			}
			if (! $this->_model->edit($invoice, $request->all())) {
				return ResponseAPI::error(400, trans('messages.fail'));
			}
			return ResponseAPI::success(200, trans('messages.success'), $invoice);
		} catch (\Exception $e) {
			return ResponseAPI::error(500, trans('messages.server_error', ['msg' => $e->getMessage()]));
		}
	}

	/*
	 * Create user
	 */
	public function create(Request $request) {
    	try {
			if (! $invoice = $this->_model->create($request->all())) {
				return ResponseAPI::error(400, trans('messages.fail'));
			}
			return ResponseAPI::success(200, trans('messages.success'), $invoice);
		} catch (\Exception $e) {
			return ResponseAPI::error(500, trans('messages.server_error', ['msg' => $e->getMessage()]));
		}
	}
}
