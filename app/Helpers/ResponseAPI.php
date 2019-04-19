<?php
/**
 * Created by PhpStorm.
 * User: TheQuang
 * Date: 4/19/2019
 * Time: 4:32 PM
 */

namespace App\Helpers;

class ResponseAPI
{

	public static function success($code = 200, $msg = '', $data = false) {
		return response()->json([
			'code' => $code,
			'msg' => $msg,
			'data' => $data
		], $code);
	}

	public static function error($code = 400, $msg = '', $errors = false) {
		return response()->json([
			'code' => $code,
			'msg' => $msg,
			'errors' => $errors
		], $code);
	}
}