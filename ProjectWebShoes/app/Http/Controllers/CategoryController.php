<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Str;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    public function index(Request $category, $slug)
    {	
        $user = Auth::user();
        $cates = Category::with('products')->limit(3)->get();
        if($slug == 'shop-all'){
            $products = Product::query()->latest()->paginate(9);
        }else{
            foreach ($cates as $cate) {
                if($slug == $cate->slug) {
                    $category_id = $cate->id;
                    break;
                }
            }
            if(!isset($category_id)){
                abort(404);
            }
            $products = Product::where('category_id', $category_id)->latest()->paginate(9);

        }	
        $arr = $products->toArray();
        if(empty($arr['data'])){
            return redirect()->to('/'.$slug);
        }
    	return view('categories.category', compact('cates','products','slug', 'user'));
    }

    public function price_asc(Request $category, $slug)
    {
        $user = Auth::user();
        $cates = Category::with('products')->limit(3)->get();
        if($slug == 'shop-all'){
            $products = Product::orderBy('price', 'ASC')->paginate(12);
        }else{
            foreach ($cates as $cate) {
                if($slug == $cate->slug) {
                    $category_id = $cate->id;
                    break;
                }
            }
            if(!isset($category_id)){
                abort(404);
            }
            $products = Product::where('category_id', $category_id)->orderBy('price', 'ASC')->paginate(12);

        }   
        $arr = $products->toArray();
        if(empty($arr['data'])){
            return redirect()->to('/'.$slug);
        }
        return view('categories.category', compact('cates','products','slug', 'user'));
    }

    public function price_desc(Request $category, $slug)
    {
        $user = Auth::user();
        $cates = Category::with('products')->limit(3)->get();
        if($slug == 'shop-all'){
            $products = Product::orderBy('price', 'DESC')->paginate(12);
        }else{
            foreach ($cates as $cate) {
                if($slug == $cate->slug) {
                    $category_id = $cate->id;
                    break;
                }
            }
            if(!isset($category_id)){
                abort(404);
            }
            $products = Product::where('category_id', $category_id)->orderBy('price', 'DESC')->paginate(12);

        }   
        $arr = $products->toArray();
        if(empty($arr['data'])){
            return redirect()->to('/'.$slug);
        }
        return view('categories.category', compact('cates','products','slug', 'user'));
    }
}
