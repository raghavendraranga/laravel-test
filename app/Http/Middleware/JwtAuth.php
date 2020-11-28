<?php

namespace App\Http\Middleware;

use App\Library\Auth\JwtAuthentication;
use Closure;
use Illuminate\Http\Request;

class JwtAuth
{
    private $jwtAuth;

    public function __construct(JwtAuthentication $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * @param $request Request
     * @param Closure $next
     * @return mixed
     * @throws EmptyTokenException
     */
    public function handle($request, Closure $next)
    {
        if(!$request->hasHeader('Authorization')) {
            return response()->json(['error' => 'Token not present'], 401);
        }

        $this->jwtAuth->parseToken($request->header('Authorization'));

        return $next($request);
    }
}
