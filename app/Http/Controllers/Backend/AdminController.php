<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{

    public $user;
    public function __construct()
    {
        // $this->middleware('auth:admin');
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
        if(is_null($this->user) || !$this->user->can('admin.view'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $users = Admin::all();
            return view('backend.pages.users.index', compact('users'));  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('admin.create'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $roles = Role::all();
            return view('backend.pages.users.create', compact('roles')); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('admin.create'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $request->validate([
                'name' => 'required|max:100',
                'username' => 'required|min:8|max:100|unique:admins,username',
                'email' => 'required|email|max:100|unique:admins,email',
                'password' => 'required|min:8',
            ]);
            $admin = new Admin;
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->save();
            if($request->roles)
            {
                $admin->assignRole($request->roles);
            }
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin, $id)
    {
        if(is_null($this->user) || !$this->user->can('admin.edit'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $roles = Role::all();
            $user = $admin->find($id);
            return view('backend.pages.users.edit', compact('roles', 'user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin, $id)
    {
        if(is_null($this->user) || !$this->user->can('admin.edit'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {
            $user = $admin->find($id);
            $request->validate([
                'name' => 'required|max:100',
                'username' => 'required|min:8|max:100|unique:admins,username,'.$id,
                'email' => 'required|email|max:100|unique:admins,email,'.$id,
            ]);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
            $user->roles()->detach();
            if($request->roles)
            {
                $user->assignRole($request->roles);
            }
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if(is_null($this->user) || !$this->user->can('admin.delete'))
        {
            abort('403', 'Unauthorise Access !');
        }
        else
        {

        }
    }
}
