<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Str;
use Storage;
use DB;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    use StorageImageTrait, DeleteModelTrait;

    private $product, $category, $productImage;

    public function __construct(Product $product, Category $category, ProductImage $productImage)
	{
	 	$this->product = $product;
	 	$this->category = $category;
	 	$this->productImage = $productImage;
	} 
    public function index()
    {
    	
    	$products = $this->product->latest()->paginate(4);
    	return view('admin.product.index', compact('products'));
    }

    public function detailImage($id)
    {
    	
    	$products = $this->productImage->where('product_id', $id)->get();
    	
    	return view('admin.product.detailImage', compact('products'));
    }

    public function create()
    {	
    	$categories = $this->category->all();
    	return view('admin.product.add', compact('categories'));
    }

    public function store(ProductRequest $request)
    {	
    	try{
    		DB::beginTransaction();
    		$dataProductCreate = [
	    		'name' => $request->name,
	    		'quantity' => $request->quantity,
	    		'price' => $request->price,
	    		'content' => $request->content,
	    		'discount' => $request->discount,
	    		'status' => $request->status,
	    		'user_id' => auth()->id(),
	    		'category_id' => $request->category_id
	    	];

	    	$dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

	    	if(!empty($dataUploadFeatureImage)){
	    		$dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
	    		$dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
	    	}
	    	$product = $this->product->create($dataProductCreate);

	    	//insert data to product_image
	    	if($request->hasFile('image_path')){
	    		foreach ($request->image_path as $key => $fileItem) {
	    			$dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');

	    			$product->images()->create([
	    				'image_path' => $dataProductImageDetail['file_path'],
	    				'image_name' => $dataProductImageDetail['file_name']
	     			]);
	    		}
	    	}
	    	DB::commit();
	    	return redirect()->route('product.index');
    	}catch(\Exception $exception){
    		DB::rollBack();
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    	}
    	

    }

    public function edit($id)
    {	
    	$product = $this->product->find($id);
    	$categories = $this->category->all();
    	return view('admin.product.edit', compact('categories', 'product'));
    }

    public function update(ProductRequest $request, $id)
    {	
    	try{
    		DB::beginTransaction();
    		$dataProductUpdae = [
	    		'name' => $request->name,
	    		'quantity' => $request->quantity,
	    		'price' => $request->price,
	    		'content' => $request->content,
	    		'discount' => $request->discount,
	    		'status' => $request->status,
	    		'user_id' => auth()->id(),
	    		'category_id' => $request->category_id
	    	];

	    	$dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

	    	if(!empty($dataUploadFeatureImage)){
	    		$dataProductUpdae['feature_image_name'] = $dataUploadFeatureImage['file_name'];
	    		$dataProductUpdae['feature_image_path'] = $dataUploadFeatureImage['file_path'];
	    	}

	    	$this->product->find($id)->update($dataProductUpdae);
	    	$product = $this->product->find($id);

	    	//insert data to product_image
	    	if($request->hasFile('image_path')){
	    		$this->productImage->where('product_id', $id)->delete();
	    		foreach ($request->image_path as $key => $fileItem) {
	    			$dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');

	    			$product->images()->create([
	    				'image_path' => $dataProductImageDetail['file_path'],
	    				'image_name' => $dataProductImageDetail['file_name']
	     			]);
	    		}
	    	}
	    	DB::commit();
	    	return redirect()->route('product.index');
    	}catch(\Exception $exception){
    		DB::rollBack();
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    	}
    	

    }

    public function delete($id)
    {
    	return $this->deleteModelTrait($id, $this->product);
    }
}
