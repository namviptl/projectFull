<?php 
	
namespace App\Traits;

use Illuminate\Support\Str;
use Storage;

trait StorageImageTrait{
	public function storageTraitUpload($request, $fieldName , $foderName){
		if($request->hasFile($fieldName)) {
			$file = $request->$fieldName;
	    	$fileNameOrigin = $file->getClientOriginalName();
	    	$fileNameHash = Str::random(10).'.'.$file->getClientOriginalExtension();
	    	$file_path = $request->file($fieldName)->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);

	    	$dataUploadTrait = [
	    		'file_name' => $fileNameOrigin,
	    		'file_path' => Storage::url($file_path)
	    	];

	    	return $dataUploadTrait;

		}

		return null;
		
	}

	public function storageTraitUploadMutiple($file, $foderName){
		
    	$fileNameOrigin = $file->getClientOriginalName();
    	$fileNameHash = Str::random(10).'.'.$file->getClientOriginalExtension();
    	$file_path = $file->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);

    	$dataUploadTrait = [
    		'file_name' => $fileNameOrigin,
    		'file_path' => Storage::url($file_path)
    	];

    	return $dataUploadTrait;
		
	}
}