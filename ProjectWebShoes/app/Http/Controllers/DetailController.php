<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\ProductImage;

class DetailController extends Controller
{
    //

    public function index($id, $name)
    {

    	$slug='';
        $user = Auth::user();
    	$cates = Category::with('products')->limit(3)->get();
    	$product = Product::where('id', $id)->get();
        if($product->toArray() == []){
            abort(404);
        }
		$product = $product[0];
        $productImage = ProductImage::where('product_id', $id)->get();
        $prod_new = Product::where('status', 'new')->latest()->paginate(6);
    	return view('categories.detail', compact('slug', 'cates', 'product', 'user', 'productImage','prod_new'));
    }

    public function cart()
    {
    	$slug='';
        $user = Auth::user();
    	$cates = Category::with('products')->limit(3)->get();

    	$cart = Session::get('cart');
    	return view('categories.cart', compact('slug', 'cates','cart', 'user'));
    }

    public function updateCart()
    {
    	$id = $_GET['id'];
    	$size = $_GET['size'];
    	$cart = Session::get('cart');
    	$quantity = $_GET['quantity'];

        if (isset($cart) && !empty($cart)) {
			$cart[$id][$size]['quantity_order'] = $quantity;
			Session::put('cart', $cart);
			if ($cart[$id][$size]['quantity_order'] < 1) {
				Session::forget('cart.'.$id.'.'.$size);
    			$cart = Session::get('cart');
    			if($cart[$id] == []){
		    		Session::forget('cart.'.$id);
		    	};	
			}
		}

		try{
	    	return response()->json([
    			'code' => 200,
    			'message' => 'success',
    		], 200);
    	}catch(Exception $exception){
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    		return response()->json([
    			'code' => 500,
    			'message' => 'fail',
    		], 500);
    	}

    }

    public function deleteCart()
    {

    	$id = $_GET['id'];
    	$size = $_GET['size'];
    	$cart = Session::get('cart');

        Session::forget('cart.'.$id.'.'.$size);
		$cart = Session::get('cart');
		if($cart[$id] == []){
    		Session::forget('cart.'.$id);
    	};

		try{
	    	return response()->json([
    			'code' => 200,
    			'message' => 'success',
    		], 200);
    	}catch(Exception $exception){
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    		return response()->json([
    			'code' => 500,
    			'message' => 'fail',
    		], 500);
    	}

    }
    public function addToCart(Request $request, $id)
    {
    	if(!isset($_GET['quantity'])){
    		abort(404);
    	}
    	$quantity = $_GET['quantity'];
    	$size = $_GET['size'];
    	$product = Product::where('id', $id)->get();
    	$product = $product[0];

    	$cart = Session::get('cart');

    	if(isset($cart[$id])){
    		if (isset($cart[$id][$size]['size']) && $size == $cart[$id][$size]['size']) {
    			$cart[$id][$size]['id'] = $id;
    			$cart[$id][$size]['quantity_order'] += $quantity;
    		}else{
    			$cart[$id][$size] = [
    				'id' => $id,
                    'feature_image_path' => $product->feature_image_path,
                    'discount' => $product->discount,
					'name' => $product->name,
					'price' => $product->price,
					'size' => $size,
					'quantity_order' => $quantity
				];
    		}

    	}else{
			$cart[$id][$size] = [
				'id' => $id,
                'feature_image_path' => $product->feature_image_path,
                'discount' => $product->discount,
				'name' => $product->name,
				'price' => $product->price,
				'size' => $size,
				'quantity_order' => $quantity
			];

    	}
    	Session::put('cart', $cart);
   		try{
	    	return response()->json([
    			'code' => 200,
    			'message' => 'success',
    		], 200);
    	}catch(Exception $exception){
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    		return response()->json([
    			'code' => 500,
    			'message' => 'fail',
    		], 500);
    	}
    }

    public function addCart(Request $request, $id)
    {
    	if(!isset($_GET['quantity'])){
    		abort(404);
    	}
    	$quantity = $_GET['quantity'];
    	$size = $_GET['size'];
    	$product = Product::where('id', $id)->get();
    	$product = $product[0];

    	$cart = Session::get('cart');

    	if(isset($cart[$id])){
    		if (isset($cart[$id][$size]['size']) && $size == $cart[$id][$size]['size']) {
    			$cart[$id][$size]['id'] = $id;
    			$cart[$id][$size]['quantity_order'] += $quantity;
    		}else{
    			$cart[$id][$size] = [
    				'id' => $id,
                    'feature_image_path' => $product->feature_image_path,
                    'discount' => $product->discount,
					'name' => $product->name,
					'price' => $product->price,
					'size' => $size,
					'quantity_order' => $quantity
				];
    		}

    	}else{
			$cart[$id][$size] = [
				'id' => $id,
                'feature_image_path' => $product->feature_image_path,
                'discount' => $product->discount,
				'name' => $product->name,
				'price' => $product->price,
				'size' => $size,
				'quantity_order' => $quantity
			];

    	}
    	Session::put('cart', $cart);
   		try{
	    	return response()->json([
    			'code' => 200,
    			'message' => 'success',
    		], 200);
    	}catch(Exception $exception){
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    		return response()->json([
    			'code' => 500,
    			'message' => 'fail',
    		], 500);
    	}

    }
}
