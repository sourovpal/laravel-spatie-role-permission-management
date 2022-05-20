<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CustomData extends Model
{
    use HasFactory, HasRoles;


    public static function getPermissionGroupByName($group_name)
    {
    	return Permission::where('group_name', $group_name)->get();
    }

    public static function roleHsaPermission($role, $permissions)
    {
    	foreach ($permissions as $key => $permission)
        {
            if(!$role->hasPermissionTo($permission->name))
            {
                return false;
            }
        }
        return true;
    }
}
