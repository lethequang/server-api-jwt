<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class JWTAuthenticate
{
	/**
	 * @var JWTAuth
	 */
	private $jwtAuth;


	/**
	 * JWTAuthenticate constructor.
	 * @param JWTAuth $JWTAuth
	 */
	public function __construct(JWTAuth $JWTAuth)
	{
		$this->jwtAuth = $JWTAuth;
	}


	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

    	if (! $this->getToken()) {
    		return response()->json([
    			'code' => 401,
				'msg' => 'Token is empty'
			]);
		}
		try {
			if (! $this->getUser()) {
				return response()->json([
					'code' => 401,
					'msg' => 'User not found'
				]);
			}
		} catch (TokenBlacklistedException $e) {
			return response()->json([
				'code' => 401,
				'msg' => $e->getMessage()
			]);
		} catch (TokenExpiredException $e) {
			return response()->json([
				'code' => 401,
				'msg' => $e->getMessage()
			]);
		} catch (TokenInvalidException $e) {
			return response()->json([
				'code' => 401,
				'msg' => $e->getMessage()
			]);
		} catch (JWTException $e) {
			return response()->json([
				'code' => 401,
				'msg' => $e->getMessage()
			]);
		}

		return $next($request);
    }

	/**
	 * @return null|string
	 */
    public function getToken() {
    	return $this->jwtAuth->parser()->parseToken();
	}

	/**
	 * @return false|\Tymon\JWTAuth\Contracts\JWTSubject
	 * @throws JWTException
	 */
	public function getUser() {
    	return $this->jwtAuth->parseToken()->authenticate();
	}
}
