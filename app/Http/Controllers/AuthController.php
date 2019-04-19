<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\ResponseAPI;

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
			return ResponseAPI::error(400, 'Validation error', $validation->errors());
		}

		$credentials = request(['email', 'password']);

		if (! $token = auth('api')->attempt($credentials)) {
			return ResponseAPI::error(401, 'Unauthorized');
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
		return ResponseAPI::success(200, 'Success', auth()->user());
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth('api')->logout();

		return ResponseAPI::success(200, 'Successfully logged out');
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

		return ResponseAPI::success(200, 'Success', $data);
	}
}
