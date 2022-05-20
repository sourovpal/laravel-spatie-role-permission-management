<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class RolesController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('role.view'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $roles = Role::all();
            return view('backend.pages.roles.index', compact('roles'));        
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('role.create'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $permissions_group = Permission::select('group_name')->groupBy('group_name')->get();
            return view('backend.pages.roles.create', compact('permissions_group'));  
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   if(is_null($this->user) || !$this->user->can('role.create'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $request->validate([
                'name' => 'required|unique:roles|max:100',
            ]);
            $permissions = $request->permissions;
            $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
            if(!is_null($permissions))
            {
                $role->syncPermissions($permissions);
            }
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('role.edit'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $permissions_group = Permission::select('group_name')->groupBy('group_name')->get();
            $role = Role::find($id);
            return view('backend.pages.roles.edit', compact('role', 'permissions_group'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        if(is_null($this->user) || !$this->user->can('role.edit'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $request->validate([
                'name' => 'required|max:100|unique:roles,name,'.$id,
            ]);
            $permissions = $request->permissions;
            $role = Role::find($id);
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('role.delete'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $role = Role::find($id);
            $role->delete();
            return back();
        }
    }
}
