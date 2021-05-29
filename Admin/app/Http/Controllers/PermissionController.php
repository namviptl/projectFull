<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Str;

class PermissionController extends Controller
{
    //

    public function create()
    {
        return view('admin.permission.add');
    }

    public function store(Request $request)
    {
       	$permission = Permission::create([
       		'name' => $request->module_parent,
       		'display_name' => $request->module_parent,
       		'parent_id' => 0,
          'key_code' => 0,
       	]);
       	foreach ($request->module_chilrent as $key => $moduleChilrentItem) {

       		Permission::create([
	       		'name' => $moduleChilrentItem.' '.$permission->name,
	       		'display_name' => $moduleChilrentItem.' '.$permission->name,
	       		'parent_id' => $permission->id,
	       		'key_code' => Str::slug($moduleChilrentItem) . '-' . Str::slug($request->module_parent)
	       	]);
       	}
    }
}
