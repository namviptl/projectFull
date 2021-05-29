<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Traits\DeleteModelTrait;
use App\Http\Requests\RoleRequest;
use DB;
use Log;

class RoleController extends Controller
{
    //
    use DeleteModelTrait;

    private $role,$permission;
    public function __construct(Role $role, Permission $permission)
    {
    	$this->role = $role;
    	$this->permission = $permission;
    }

    public function index()
    {
    	$roles = $this->role->paginate(10);
    	return view('admin.role.index', compact('roles'));
    }

    public function create()
    {

    	$permissions = $this->permission->where('parent_id', 0)->get();
    	return view('admin.role.add', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
    	try{
    		DB::beginTransaction();
    		$role = $this->role->create([
	    		'name' => $request->name,
	    		'display_name' => $request->display_name
	    	]);

	    	$role->permissions()->attach($request->permission_id);
	    	DB::commit();
	    	return redirect()->route('roles.index');
    	}catch(\Exception $exception){
    		DB::rollBack();
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    	}
    }

    public function edit($id)
    {

    	$permissions = $this->permission->where('parent_id', 0)->get();
    	$role = $this->role->find($id);
   
    	$permissionChecked = $role->permissions;
    	return view('admin.role.eidt', compact('permissions','role','permissionChecked'));
    }

    public function update(RoleRequest $request, $id)
    {
    	try{
    		DB::beginTransaction();
    		$role = $this->role->find($id);
    		$role->update([
	    		'name' => $request->name,
	    		'display_name' => $request->display_name
	    	]);

	    	$role->permissions()->sync($request->permission_id);
	    	DB::commit();
	    	return redirect()->route('roles.index');
    	}catch(\Exception $exception){
    		DB::rollBack();
    		Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
    	}
    }

    public function delete($id)
    {	
    	return $this->deleteModelTrait($id, $this->role);
    }

    


}
