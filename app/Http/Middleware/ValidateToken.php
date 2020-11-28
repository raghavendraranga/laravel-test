<?php

namespace App\Http\Middleware;
use App\Library\Auth\JwtAuthentication;
use Closure;
use App\User;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $jwtauth;
    private $user;

    public function __construct(JwtAuthentication $jwtauth,User $user){
        $this->jwtauth = $jwtauth;
        $this->user = $user;
    }

    public function handle($request, Closure $next)
    {

        $token = $request->header('Authorization');
        if (!empty($token)) {

            // Decrypt access token
            try {
                $payload = $this->jwtauth->parseToken($token);
                $data['uid']= $uid = $payload->uid;
                $userObject = $this->user->find($uid);
                if(!$userObject->is_logged_in){
                    abort(401, "Authorization token is not valid");
                }
                config(["api.current_user"=>$data]);
            } catch (\Exception $e) {
                abort(401, "Authorization token is not valid");
            }
        }
        return $next($request);
    }
}
