<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UserStore;
use App\Http\Requests\ProductStore;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Cart;
use Hash;
use Session;
use Mail;
//use Integer;

use App\Http\Controllers\Controller;


use Illuminate\Auth\Events\Verified;


class MailController extends Controller
{
    public function basic_email() {
         $user = User::where('id', '=', Session::get('loginId'))-> first();
         $verificationCode = random_int(1000,9999); 
         User::where('id', '=', Session::get('loginId')) -> update([
            'otp' => $verificationCode,
        ]);
        $data = array('name'=>"Sample", 'verificationCode'=> $verificationCode, 'mail' => $user -> email );
         Mail::send('verify.mail', $data, function($message) {
            $user = User::where('id', '=', Session::get('loginId'))-> first();
            $userMail = $user -> email;
           $message->to($userMail, 'Demo')->subject
              ('Demo Mail');
           $message->from('daBois2223@gmail.com','Dabois123!');
        });
        return redirect()->back()->withSuccess('Mail has been sent to your inbox please check.');
     }
}
