<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->bearerToken();

        $user = User::where('user_token',$token)->first();

        if(is_null($user)){
            return response()->json([
                "status"=>false,
                "message"=>"Access denied"
            ],401);
        }



        return $next($request);
    }
}
