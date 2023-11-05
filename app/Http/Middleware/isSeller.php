<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use Session;

class isSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Session()->has('loginId')){
            return redirect('loginhere')->with('fail', 'You have to login first.');
        }else {
            $info = User::where('id', '=', Session::get('loginId'))-> first();
            if ($info->roleid != "1") {
            return redirect('account/buyer')->with('fail', 'You have to login first.');

            //abort(Response::HTTP_UNAUTHORIZED);
            }
            return $next($request);
        }
    }
    
}
