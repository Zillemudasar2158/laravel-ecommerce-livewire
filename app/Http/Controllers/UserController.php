<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
	public static function Middleware():array
	{
		return
		[
			new Middleware('permission:view users',only:['list']),
            new Middleware('permission:edit users',only:['edit']),
            new Middleware('permission:view about',only:['about']),
		];
	}
    public function about()
    {
        return view('user.about');
    }
    public function list()
    {
    	$user=User::paginate(20);
    	return view('user.list',compact('user'));
    }
    public function edit($id)
    {
    	$user=User::findOrFail($id);
    	$hasRoles=$user->roles->pluck('id');
    	$role=Role::all();
    	return view('user.edit',compact('user','role','hasRoles'));
    }
    public function update(Request $request,$id)
    {
    	$user=User::findOrFail($id);

    	$validator=Validator::make($request->all(),[
    		'name'=>'required|min:3'
    	]);

    	if ($validator->passes()) {
    		$user->update([
    			'name'=>$request->name
    		]);

    		if (!empty($request->role)) {
    			$user->syncRoles($request->role); 
    		}
    		else{
    			$user->syncRoles([]);
    		}
    		return redirect()->route('user.list')->with('success','User update Successfully');
    	}
    	else{
    		return redirect()->route('user.edit',$id)->withInput()->withErrors($validator);
    	}
    } 
}
