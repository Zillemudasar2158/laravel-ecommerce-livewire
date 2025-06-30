<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
Use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function Middleware():array
    {
        return
        [
            new Middleware('permission:view roles',only:['list']),
            new Middleware('permission:create roles',only:['create']),
            new Middleware('permission:edit roles',only:['edit']),
            new Middleware('permission:delete roles',only:['destory'])
        ];
    }
    public function list()
    {
    	$role=Role::paginate(10);
    	return view('role.list',compact('role'));
    }
    public function create()
    {
    	$role=Permission::all();
    	return view('role.create',compact('role'));
    }
    public function store(Request $request)
    {
    	$Validator=Validator::make($request->all(),[
    		'name'=>'required|min:3|unique:roles'
    	]);

    	if ($Validator->passes()) {
    		$role=Role::create([
    			'name'=>$request->name
    		]);
    		if (!empty($request->permission)) {
    			foreach($request->permission as $assigned)
    			{
    				$role->givepermissionTo($assigned);
    			}
    		}
    		return redirect()->route('role.list')->with('success','Role added Successfully');
    	}
    	else{
    		return redirect()->route('role.list')->with('errors','Roles added Failed');
    	}
    }
    public function edit($id)
    {
    	$role=Role::findOrFail($id);
    	$haspermission=$role->permissions->pluck('name');
    	$permission=Permission::all();
    	return view('role.edit',compact(['role','permission','haspermission']));
    }
    public function update(Request $request,$id)
    {
    	$role=Role::findOrFail($id);

    	$Validator=Validator::make($request->all(),[
    		'name'=>'required|unique:roles,name,'.$id.'id|min:3'
    	]);

    	if ($Validator->passes()) 
        {
    		$role->update([
    			'name'=>$request->name
    		]);
    		if(!empty($request->permission))
    		{
    			$role->syncpermissions($request->permission);
    		}
    		else{
    			$role->syncpermissions([]);
    		}
    		return redirect()->route('role.list')->with('success','Role updated successfully');
    	}
    	else{
    		return redirect()->route('role.edit',$id)->withInput()->withErrors($Validator);
    	}
    }
    public function destory(Request $request,$id)
    {
    	Role::destroy(array('id',$id));

    	return redirect()->back()->with('success','Role deleted successfully');
    }
}
