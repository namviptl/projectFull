<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Http\Requests\CheckOut;
use Str;
use Auth;
use Hash;
use Mail;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    //
    public function index()
    {

    	$slug='';
        $user = Auth::user();
    	$cates = Category::with('products')->limit(3)->get();
    	$cart = Session::get('cart');
        if($cart == null){
           return redirect()->route('home');
        }

    	return view('checkouts.checkout', compact('slug', 'cates', 'cart', 'user'));
    }
    public function thank()
    {
        $slug='';
        $user = Auth::user();
        $cates = Category::with('products')->limit(3)->get();
        if (Session::has('thank')){
          Session::forget('thank');
        }else{
            return redirect()->route('home');
        }
        return view('checkouts.thank', compact('slug', 'cates', 'user'));
    }


    public function checkout(CheckOut $request){
        $user = Auth::user();
    	$cart = Session::get('cart');
        if($cart == null){
           return redirect()->route('home');
        }
        $sumTotal = Session::get('sumTotal');
        if(Session::has('discount')){
            $discount = Session::get('discount');
        }else{
            $discount = 0;
        }
        
        $notes = $request->notes;

    	if ($user == null) {
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $address = $request->address;
        }else{
            $name = $user->name;
            $email = $user->email;
            $phone = $user->phone;
            $address = $user->address;
        }
        

        if($user == null){
            $createUser =  User::create([
                'email' => $email,
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'password' => Hash::make('ntnshop.com')
            ]);
            $createUser->roles()->attach('3');
            $user_id = User::latest('created_at')->first();
            $user_id = $user_id->id;
        }else{
            $user_id = $user->id;
        }

        $createOrder = Order::create([
            'user_id' => $user_id,
            'notes' => $notes,
            'discount' => $discount,
            'price_total' => $sumTotal,
            'status' => 'Đang xử lý',
        ]);

        $order_id = Order::latest('created_at')->first();
        $order_id = $order_id->id;
  

        foreach ($cart as $size) {
            foreach ($size as  $value) {

                if ($value['discount'] < 1) {
                    $total = $value['quantity_order'] * $value['price'];
                }else{
                    $total = ($value['price'] * (1-1/$value['discount'])) * ($value['quantity_order']);
                }
                $createOrderDetail = DetailOrder::create([
                    'order_id' => $order_id,
                    'product_id' => $value['id'],
                    'quantity' => $value['quantity_order'],
                    'size' => $value['size'],
                    'price' => $value['price'],
                    'price_total' => $total,
                ]);
            }
        }
        if($user == null){
            $user_data = [
                'user_id' => '',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
            ];
        }else{
             $user_data = [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
            ];
        }
        $data = [
                    'cart' => $cart,
                    'user' => $user_data,
                    'discount' => $discount,
                    'sumTotal' => $sumTotal
                ];

        Mail::send('checkouts.sendMail', $data, function ($message) use( $email , $name ) {
            $message->from('namviptl2@gmail.com', 'NTN Store');
            $message->sender('namviptl2@gmail.com', 'NTN Store');
            $message->to($email, $name);
            $message->subject("Mail đơn hàng!");
        });
        Session::forget('discount');
        Session::forget('cart');
        Session::put('thank', '1');
        return redirect()->route('checkouts.thank');
    }
}
