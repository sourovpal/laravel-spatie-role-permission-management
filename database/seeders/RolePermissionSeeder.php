<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$supperadmin = Role::create(['name' => 'superadmin', 'guard_name'=>'admin']);
        $permission_group = [

        	[
        		'group_name' => 'Dashboard',
        		'permissions' => [
        			'dashboard.view',
        			'dashboard.edit',
        		]
        	],
        	[
        		'group_name' => 'Blog',
        		'permissions' => [
        			'blog.view',
        			'blog.create',
        			'blog.edit',
        			'blog.delete',
        			'blog.approve',
        		]
        	],
        	[
        		'group_name' => 'Role',
        		'permissions' => [
        			'role.view',
        			'role.create',
        			'role.edit',
        			'role.delete',
        			'role.approve',
        		]
        	],
        	[
        		'group_name' => 'Admin',
        		'permissions' => [
        			'admin.view',
        			'admin.create',
        			'admin.edit',
        			'admin.delete',
        			'admin.approve',
        		]
        	],
        	[
        		'group_name' => 'Post',
        		'permissions' => [
        			'post.view',
        			'post.create',
        			'post.edit',
        			'post.delete',
        			'post.approve',
        		]
        	]
        ];


        for ($i=0; $i < count($permission_group); $i++)
        { 
        	$group_name = $permission_group[$i]['group_name'];
        		for ($j=0; $j < count($permission_group[$i]['permissions']); $j++)
        		{
        			$permission = Permission::create(['name' => $permission_group[$i]['permissions'][$j], 'guard_name' => 'admin', 'group_name' => $group_name]);
        			$supperadmin->givePermissionTo($permission);
        		}
        }
    }
}
