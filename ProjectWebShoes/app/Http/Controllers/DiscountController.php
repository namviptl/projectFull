<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Support\Facades\Session;

class DiscountController extends Controller
{
    //

    public function discount()
    {
    	$code = $_GET['discount'];
    	$rsDiscount = Discount::where('code', $code)->get();
    	$rsDiscount = $rsDiscount[0];
    	$discount = $rsDiscount->discount;
    	Session::put('discount', $discount);

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
