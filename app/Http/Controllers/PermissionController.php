<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function Middleware():array
    {
        return
        [
            new Middleware('permission:view permissions',only:['list']),
            new Middleware('permission:create permissions',only:['create']),
            new middleware('permission:edit permissions',only:['edit']),
            new Middleware('permission:delete permissions',only:['destory'])
        ];
    }
    public function list()
    {
    	$permission=Permission::paginate(20);
    	return view('permission.list',compact('permission'));
    }
    public function create()
    {
    	return view('permission.create');
    }
    public function store(request $request)
    {
    	$validator=$request->validate([
    		'name'=>'required|unique:permissions|min:3',
    	]);

    	if ($validator)
    	{
    		Permission::create([
    			'name' => $request->name,
    		]);
    		return redirect()->route('permission.list')->with('success','Permission Created Successfully');
    	}
    	else
    	{
    		return redirect()->route('permission.list')->withErrors($validator);
    	}
    }
    public function edit($id)
    {
    	$permission=Permission::findOrFail($id);
    	return view('permission.edit',compact('permission'));
    }
    public function update(Request $request,$id)
    {
    	$permission=Permission::findOrFail($id);

    	$validator=validator::make($request->all(),[
    		'name'=>'required|unique:permissions,name,'.$id.',id|min:3'
    	]);
    	if ($validator->passes()) 
    	{
    		$permission->name=$request->name;
    		$permission->save();

    		return redirect()->route('permission.list')->with('success','Permission successfully updated');
    	}
    	else{
    		return redirect()->route('permission.edit',$id)->withInput()->withErrors($validator);
    	}
    }
    public function destory(Request $request,$id)
    {
    	Permission::destroy(array('id',$id));
    	
    	return redirect()->back()->with('success','Permission deleted successfulluy');
    	
    }
}
