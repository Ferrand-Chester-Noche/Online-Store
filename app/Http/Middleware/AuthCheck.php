<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//
use Session;
use App\Models\User;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if(!Session()->has('loginId')){
    //         return redirect('loginhere')->with('fail', 'You have to login first.');
    //     }
    //     else if(Session()->has('loginId')){
    //         $info = User::where('id', '=', Session::get('loginId'))-> first();
            
    //         if(url('account/buyer') == $request -> url() && $info -> roleid == 1){
    //             //return back();
    //             return redirect('account/seller');
    //         } else if(url('account/seller') == $request -> url() && $info -> roleid == 0){
    //             //return back();
    //             return redirect('account/buyer');
    //         } 
            
    //     }
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next): Response
    {
        if(!Session()->has('loginId')){
            return redirect('loginhere')->with('fail', 'You have to login first.');
        }
        else if(Session()->has('loginId')){
            $info = User::where('id', '=', Session::get('loginId'))-> first();
            
            if(url('account/buyer') == $request -> url() && $info -> roleid == 1){
                //return back();
                return redirect('account/seller');
            } else if(url('account/seller') == $request -> url() && $info -> roleid == 0){
                //return back();
                return redirect('account/buyer');
            } 

            //
            else if(url('delete/{id}') == $request -> url() && $info -> roleid == 0){
                return redirect('account/buyer')->with('fail', 'Access Denied.');
            } else if(url('/remove/{prodid}') == $request -> url() && $info -> roleid == 1){
                return back();
            } 
            
            else if(url('/account/addcart/{prodid}') == $request -> url() && $info -> roleid == 1){
                return back();
                //return redirect() -> route('account/buyer');
            } else if(url('/account/addtocart/{prodid}') == $request -> url() && $info -> roleid == 1){
                return back()->with('fail', 'Access Denied.');
                //return redirect() -> route('account/seller');
            } 
            
            else if(url('account/edit/{prodid}') == $request -> url() && $info -> roleid == 0){
                return back();
                //return redirect() -> route('account/buyer');
            }
            
        }
        return $next($request);
    }
}
