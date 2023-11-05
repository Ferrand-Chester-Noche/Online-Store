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

use Illuminate\Auth\Events\Verified;


class UserController extends Controller
{
    /**
     * Display a listing of the resource. GAMITIN FOR PRODUCTS
     *     public function index()
     * {
     *   //
     *   $users = User::all();
     *   return view('users.index', compact('users'));
     *}
     */


    /**
     * Show the form for creating a new resource.
     */
    public function shapi()
    {
        $products = Product::all();
        return view('shapi', compact('products'));
    }
    public function registration()
    {
        return view('user.signup');
    }

    public function registerUser(Request $request){
        //echo 'Value posted';
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' =>'required|min:6',
            'roleid' => 'required',
        ]);
        $user = new User();
        $user -> name = $request-> name;
        $user -> email = $request-> email;
        $user -> password = Hash::make($request-> password);
        $user -> roleid = $request-> roleid;
        $res = $user -> save();
        // return redirect()->back()->withSuccess('User created successfully.');
        return redirect('/verification')->with('success', 'Please verify your email address.');
    }
    /**
     * Show the form for creating a new item.
     */
    public function add()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
        }
        return view('item.create', compact('data'));
    }

    public function registerItem(ProductStore $request){ 
        $user = User::where('id', '=', Session::get('loginId'))-> first();
        //$request-> session() ->put('loginId', $user -> id);
        $request -> validate([
            'prodid' => 'required|unique:products',
            'cost'=> 'required',
            'quantity'=> 'required',
            'name' => 'required|unique:products',
            'image' => 'required',
        ]);
        $product = new Product();
        $product -> prodid = $request -> prodid;
        $product -> cost = $request -> cost;
        $product -> quantity = $request -> quantity;
        $product -> name = $request -> name;
        $product -> sellerid = $user -> id;//Session::get('loginId');//'loginId';
        if($request -> hasfile('image')){
            $file = $request -> file('image');
            $extention = $file -> getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file -> move('uploads/',$filename);
            $product -> image = $filename;
        }
        $res = $product -> save();

        return redirect()->back()->withSuccess('Item added successfully.');
    }


    public function login(){
        return view('user.login');
    }
    public function loginUser(Request $request){
        //$input = $request -> all();
        $request->validate([
            'email' => 'required|email', 
            'password' =>'required|min:6',
        ]);

        $user = User::where('email', '=', $request -> email)-> first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request-> session() ->put('loginId', $user -> id);
                if($user->verified == 1){
                    $info = User::where('id', '=', Session::get('loginId'))-> first();
                    //$info -> roleid = $request-> roleid;
                    //
                    if($info -> roleid ==0){
                        return redirect('account/buyer');
                    }
                    else if($info-> roleid ==1){
                        return redirect('account/seller');
                    }   
                }
                else{
                    return redirect('/verification');
                }

            }
            else{
                return back()-> with('fail', 'Password DNM.');        
            }
        }else{
            return back()-> with('fail', 'Email DNE.');        
        }
    }

    public function account(){
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
        }
        return view('user.account', compact('data'));
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('loginhere');
        }
        return view('user.account', compact('data'));
    }

    /**
     * Display the specified item.
    */ 
    public function show(string $name)
    {
        //
        $product = User::where('name', '=', $name)-> first();
        return view('shapiShow', compact('product'));

        //return $data; //returns the data
    }

    public function destroy(string $prodid){
        $product = Product::find($prodid,);
        $destination = 'uploads/'.$product->image;
        $product->delete();
        if(File::exists($destination)){
            File::delete($destination);
        }
        // Product::where('prodid', '=', $prodid)->delete();
        return redirect()->back()->withSuccess('Item deleted successfully.');
    }

    public function remove(string $cartid){
        $product = Cart::find($cartid);
        $product-> delete();
        return redirect()->back()->withSuccess('Item removed successfully.');
    }
    
    public function buyerAccount()
    {
        $products = Product::all();
        //return view('shapi', compact('products'));
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
        }
        return view('user.buyerAccount', compact('data','products'));
    }

    public function sellerAccount()
    {
        $data = array();
        
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
            $products = Product::where('sellerid', '=', Session::get('loginId')) ->get(); 
        }
        return view('user.sellerAccount', compact('data', 'products'));
    }

    public function sellerMyStore()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first(); //salesid, qty
            $salez = Sale::join('users', 'users.id', '=', 'sales.userid')
                        ->join('products', 'products.prodid', '=', 'sales.prodid')
                        ->where('sellerid', '=', Session::get('loginId'))
                        ->get(['sales.saleid','products.image', 'products.name as pname','products.prodid','users.name', 'sales.quantity', 'products.cost']);
        }
        return view('seller.myShop', compact('data', 'salez'));
    }
    public function cart()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
            $carts = Cart::join('users', 'users.id', '=', 'carts.userid')
                        ->join('products', 'products.prodid', '=', 'carts.prodid')
                        ->where('userid', '=', Session::get('loginId'))
                        ->get(['carts.cartid', 'products.image', 'products.name as pname', 'products.prodid', 'carts.quantity', 'products.cost']);
        }
        return view('buyer.showcart', compact('data', 'carts'));
    }
    public function addcart(string $prodid)
    {
        $data = array();
        $product = Product::where('prodid', '=', $prodid)-> first();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
        }
        return view('buyer.addcart', compact('data', 'product'));
    }

    public function addToCart(Request $request, string $prodid)
    {
        //return view('shapi', compact('products'));
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
            $product = Product::where('prodid', '=', $prodid)-> first();

            $request -> validate([
                'quantity'=> 'required',
            ]);
            $cart = new Cart();
            $cart -> userid = $data -> id;

            $cart -> quantity = $request -> quantity;
            $cart -> prodid = $product -> prodid;
            if($product -> quantity >= $request -> quantity){
                $res = $cart -> save(); 
                return redirect()->back()->withSuccess('Item added to cart successfully.');
            }else
                return redirect()->back()->withFail('Quantity desired is greater than supply.');
        }
    }

    public function checkOut()
    {
        //return view('shapi', compact('products'));
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
            $carts = Cart::all();
            foreach ($carts as $cart){
            $sale = new Sale();
            $sale -> prodid = $cart -> prodid;
            $product = Product::where('prodid', '=', $cart->prodid)-> first();
            $sale -> quantity = $cart -> quantity;
            $sale -> userid = $data -> id;

            if($product -> quantity >= $sale -> quantity){
                $res = $sale -> save();                 
                $newquantity = $product -> quantity - $sale -> quantity;
                Product::where('prodid', '=', $cart ->prodid) -> update([
                     'quantity' => $newquantity, 
                ]);
                $this -> remove($cart -> cartid);    
            }else
                return redirect()->back()->withFail('Quantity desired is greater than supply.');
    
            }
            
        }
        return redirect()->back()->withSuccess('Items bought successfully.');
    }

    public function verification()
    {
        return view('verify.verification');
    }

    /**
     * Show the form for editing the specified item.
     */
    public function update(Request $request, string $prodid)
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
            $product = Product::where('prodid', '=', $prodid)-> first();

            $input = $request->validate(['name' => 'required|unique:products', 'quantity' => 'required', 'cost' =>'required']);

            $prodid = $request -> prodid;
            $name = $request -> name;
            $quantity = $request -> quantity;
            $cost = $request -> cost;

            Product::where('prodid', '=', $prodid) -> update([
                'name' => $name, 'quantity' => $quantity, 'cost' => $cost,
            ]);
            //return redirect()->back()->withSuccess('Item updated successfully.');
        }
        return redirect()->back()->withSuccess('Item updated successfully.');
        //return view('item.edit', compact('data','product'));
    }
    public function edit(string $prodid){
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id', '=', Session::get('loginId'))-> first();
            $product = Product::where('prodid', '=', $prodid)-> first();
        }
        return view('item.edit', compact('data','product'));
    }
    public function verify(Request $request){
        $user = User::where('id', '=',Session::get('loginId')) -> first();
        //event(new Verified($user));
        $input = $request->validate(['code' => 'required',]);

        if($user -> otp == $request -> code){
            User::where('id', '=', Session::get('loginId')) -> update([
                'verified' => '1',
            ]);
            return redirect('/account/seller')->withSuccess('Verified successfully.');
    
        }else
         return redirect()-> back()->withFail('OTP Mismatch.');

    }
    public function verifylink(Request $request){
        $user = User::where('id', '=',Session::get('loginId')) -> first();
        User::where('id', '=', Session::get('loginId')) -> update([
            'verified' => '1',
        ]);
        return redirect('/account/seller')->withSuccess('Verified successfully.');
    
    }
}
