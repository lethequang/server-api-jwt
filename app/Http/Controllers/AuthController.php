<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

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
			return response()->json([
				'code' => 400,
				'msg' => 'validation error',
				'errors' => $validation->errors()
			]);
		}

		$credentials = request(['email', 'password']);

		if (! $token = auth('api')->attempt($credentials)) {
			return response()->json([
				'code' => 401,
				'msg' => 'Unauthorized'
			]);
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
		return response()->json([
			'code' => 200,
			'msg' => 'success',
			'data' => auth()->user()
		]);
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth('api')->logout();

		return response()->json([
			'code' => 200,
			'msg' => 'Successfully logged out'
		]);
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
		return response()->json([
			'code' => 200,
			'msg' => 'success',
			'data' => [
				'access_token' => $token,
				'token_type' => 'bearer',
				'expires_in' => auth('api')->factory()->getTTL() * 60
			]
		]);
	}
}
