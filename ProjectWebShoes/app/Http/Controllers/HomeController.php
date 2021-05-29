<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Session;

class HomeController extends Controller
{
    //
    public function index()
    {
        
    	$slug = '';
        $user = Auth::user();
    	$cates = Category::query()->paginate(3);
    	$prod_new = Product::where('status', 'new')->latest()->paginate(6);

    	$prod_sale = Product::where('status', 'sale')->latest()->paginate(6);
    	return view('homes.home', compact('cates', 'prod_new', 'prod_sale', 'slug', 'user'));
    }
}
