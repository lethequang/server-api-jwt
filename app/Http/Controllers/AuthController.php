<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\ResponseAPI;
use OwenIt\Auditing\Facades\Auditor;

class AuthController extends Controller
{

	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct( )
	{

	}

	/**
	 * Get a JWT via given credentials.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request)
	{
		$validation = Validator::make($request->all(),[
			'email' => 'required|email',
			'password' => 'required'
		]);
		if ($validation->fails()) {
			return ResponseAPI::error(422, trans('messages.unprocessable_entity'), $validation->errors());
		}

		$credentials = request(['email', 'password']);

		if (! $token = auth('api')->attempt($credentials)) {
			return ResponseAPI::error(401, trans('messages.unauthorized'));
		}

		return $this->respondWithToken($token);
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		return ResponseAPI::success(200, trans('messages.success'), auth()->user());
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth('api')->logout();

		return ResponseAPI::success(200, trans('messages.success'));
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		return $this->respondWithToken(auth('api')->refresh());
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken($token)
	{
		$data = [
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth('api')->factory()->getTTL() * 60
		];

		return ResponseAPI::success(200, trans('messages.success'), $data);
	}
}
