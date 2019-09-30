<?php

use Illuminate\Database\Seeder;
use \Modules\Admin\Entities\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [];
        $permissions = Permission::all()->each(function($p) use (&$permission){
            $permission[$p->slug] = true;
        });


        $admin= Sentinel::getRoleRepository()->createModel()->create([
            'name'          => 'Admin',
            'slug'          => 'admin',
            'permissions'   => $permission
        ]);

        $user = Sentinel::findByCredentials(['email'=>'admin@admin.com']);
        $admin->users()->attach($user);


    }
}
