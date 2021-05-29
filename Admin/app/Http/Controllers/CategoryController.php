<?php

namespace App\Http\Controllers;

use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use DB;
use Log;
class CategoryController extends Controller
{
    use  StorageImageTrait, DeleteModelTrait;
	private $category;

	public function __construct(Category $category){
		$this->category = $category;
	}

	public function index()
    {
    	$categories = $this->category->latest()->get();
    	return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
    	$data = $this->category->all();
    	return view('admin.category.add');
    }

    

    public function store(Request $request)
    {	
        try{
            DB::beginTransaction();
            $dataCategoryCrate = [
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'category');


            if(!empty($dataUploadFeatureImage)){
                $dataCategoryCrate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataCategoryCrate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $cate = $this->category->create($dataCategoryCrate);

            DB::commit();
        	return redirect()->route('categories.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
        }
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        try{
            DB::beginTransaction();
            $dataCategoryUpdate = [
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'category');

            if(!empty($dataUploadFeatureImage)){
                $dataCategoryUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataCategoryUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            //dd($dataUploadFeatureImage);
            $this->category->find($id)->update($dataCategoryUpdate);
            DB::commit();
            return redirect()->route('categories.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
        }
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->category);

    }
}
