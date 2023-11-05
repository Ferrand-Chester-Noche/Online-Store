<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MailController;


use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'verify' =>true
]);

/*
Route::middleware(['auth', 'user-role::0'])-> group(function(){
    Route::get('/account/buyer', [UserController::class, 'buyerAccount']) -> name('user.buyerAccount'); //-> middleware('isLoggedIn');
});

Route::middleware(['auth', 'user-role::1'])-> group(function(){
    Route::get('/account/seller', [UserController::class, 'sellerAccount']) -> name('user.sellerAccount'); //-> middleware('isLoggedIn');
});*/
///
Route::get('/shapi', [UserController::class, 'shapi'])-> middleware('AlreadyLoggedIn') -> name('shapi');
//Route::get('/shapi/{name}', [UserController::class, 'show'])-> middleware('AlreadyLoggedIn');

//shapishow
Route::any('/search',function(){
    $q = Request::get ( 'q' );
    //$product = Product::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    $product = Product::where('name','ILIKE','%'.$q.'%')->get();
    if(count($product) > 0)
        return view('shapiShow')->withDetails($product)->withQuery ( $q );
    else return view ('shapiShow')->withMessage('No Details found. Try to search again !');
});

//buyershow
Route::any('/buyer/search',function(){
    $q = Request::get ( 'q' );
    //$product = Product::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    $product = Product::where('name','ILIKE','%'.$q.'%')->get();
    if(count($product) > 0)
        return view('buyerShow')->withDetails($product)->withQuery ( $q );
    else return view ('buyerShow')->withMessage('No Details found. Try to search again !');
});


//Route::get('/signup', function(){return view('verify.signup');});
Route::get('/signup', [UserController::class, 'registration'])-> middleware('AlreadyLoggedIn');
Route::post('/signup-user', [UserController::class, 'registerUser']) -> name('register-user') -> middleware('AlreadyLoggedIn');

//LOGIN FUNCTION
Route::get('/loginhere', [UserController::class, 'login'])-> middleware('AlreadyLoggedIn') -> name('loginhere');
Route::post('/login-user', [UserController::class, 'loginUser']) -> name('login-user') -> middleware('AlreadyLoggedIn');

//LOGOUT FUNCTION
Route::get('/logout', [UserController::class, 'logout'])  -> middleware('isLoggedIn');

//Route::get('/account', [UserController::class, 'account']) -> middleware('isLoggedIn');
//ACCOUNTS USER-> BUYER/SELLER PAGE
Route::get('/account/seller', [UserController::class, 'sellerAccount']) -> middleware('isLoggedIn'); //-> middleware('isLoggedIn');
Route::get('/account/buyer', [UserController::class, 'buyerAccount']) -> middleware('isLoggedIn'); //-> middleware('isLoggedIn');
Route::post('/account/buyer', [UserController::class, 'addToCart']) -> middleware('isLoggedIn'); //-> middleware('isLoggedIn');

//SALES PAGE FOR SELLER
Route::get('/account/myShop', [UserController::class, 'sellerMyStore']) -> middleware('isLoggedIn'); //-> middleware('isLoggedIn');

//Route::get('/account', function(){return view('user.account');});
//ADD ITEM PAGE
//Route::get('/signup', function(){return view('verify.signup');});
//Route::get('/account/additem', function(){return view('item.create');})-> middleware('isLoggedIn');
//Route::get('/signup', [UserController::class, 'registration'])-> middleware('AlreadyLoggedIn');
//Route::post('/signup-user', [UserController::class, 'registerUser']) -> name('register-user');
Route::get('/account/additem', [UserController::class, 'add'])-> middleware(['isLoggedIn', 'isSeller']);
Route::post('/account/add-item', [UserController::class, 'registerItem']) -> middleware(['isLoggedIn', 'isSeller']) -> name('register-item');
//EDIT ITEM PAGE
Route::get('/account/edit/{prodid}', [UserController::class, 'edit'])-> middleware(['isLoggedIn', 'isSeller']);
Route::post('/account/update/{prodid}', [UserController::class, 'update'])-> middleware(['isLoggedIn', 'isSeller']);

//DELETE ITEM
Route::get('delete/{id}', [UserController::class, 'destroy']) -> middleware(['isLoggedIn', 'isSeller']);;

//SHOPPING CART
Route::get('/account/cart', [UserController::class, 'cart'])-> middleware(['isLoggedIn', 'isBuyer']);
Route::get('/account/cart/buy', [UserController::class, 'checkOut'])-> middleware(['isLoggedIn', 'isBuyer']);

//ADD TO CART
Route::get('/account/addcart/{prodid}', [UserController::class, 'addcart']) -> middleware(['isLoggedIn', 'isBuyer']);
Route::post('/account/addtocart/{prodid}', [UserController::class, 'addToCart']) -> middleware(['isLoggedIn', 'isBuyer']); //-> name('addcart-item');
Route::get('remove/{prodid}', [UserController::class, 'remove']) -> middleware(['isLoggedIn', 'isBuyer']);
//VERIFICATION
Route::get('verification', [UserController::class, 'verification']) ->name('verification')  -> middleware('isLoggedIn',);

Route::post('verification/code', [UserController::class, 'verify']) ->name('verifyCode')  -> middleware('isLoggedIn',);
Route::get('verification/link', [UserController::class, 'verifylink']) ->name('verifyLink')  -> middleware('isLoggedIn',);


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');



//Di ko alam kung gagana to
/*
Route::get('/account/buyer', function(){
    //return view('shapi');
    //return route('/account/buyer');
})->middleware(['auth'])->name('buyerAcc');*/
Route::get('/account/buyer', [UserController::class, 'buyerAccount']) -> middleware('isLoggedIn');//-> middleware(['isLoggedIn','verified']); //-> middleware('isLoggedIn');
//Auth::routes();
Route::get('/account/seller', [UserController::class, 'sellerAccount'] )-> middleware('isLoggedIn'); //-> middleware(['isLoggedIn','verified']); //-> middleware('isLoggedIn');
/*
Route::get('/account/seller', function(){
    //return view('/account/seller');
})->middleware(['auth'])->name('sellerAcc');*/

Route::get('/mail',[MailController::class, 'basic_email']);
//ßRoute::get('/mail','MailController@basic_email');


Route::get('/verify/{email}',[UserController::class, 'verifyManual']);
//require __DIR__.'/auth.php';
//comment out ko muna pre try ko lang ---- Okay na pre balik mo na lang 
//wait lang may dinedebug ako-h okie na kk
//okioki

// //try q lang ulit base sa isang documentation

// // Display email verification notification with a link to verify email
// Route::get('/verify-email', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// // Handle user-click event to verify email
// Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/dashboard')->with('success', 'Email verified successfully!');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// // Resend email verification link on user's request
// Route::post('/resend-verification-email', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('success', 'Email verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
