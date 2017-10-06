<?php

use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class UserRolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create user objects
        $user1 = new User;
        $user2 = new User;
        $user3 = new User;
        $user4 = new User;
        
        // // Get user ids
        $user1 = User::where('name','=','kostas1')->first();
        $user2 = User::where('name','=','kostas2')->first();
        $user3 = User::where('name','=','kostas3')->first();
        $user4 = User::where('name','=','kostas4')->first();
        //dd($user1);

        // Create role objects
        $roleOwner = new App\Role;
        $roleAdmin = new App\Role;
        $roleUser = new App\Role;  

        // Get role ids
        $roleOwner = Role::where('name', '=', 'owner')->first();
        $roleAdmin = Role::where('name', '=', 'admin')->first();
        $roleUser = Role::where('name', '=', 'user')->first();
        //dd($roleAdmin);
        
        // Attach roles to users
        // parameter can be an Role object, array, or id
        $user1->attachRole($roleOwner); 
        $user2->attachRole($roleAdmin);
        $user3->attachRole($roleUser);
        $user4->attachRole($roleUser);

        $permCreate = new App\Permission;
        $permEdit = new App\Permission;
        $permUpdate = new App\Permission;
        $permDelete = new App\Permission;

        $permCreate = Permission::where('name', '=', 'create')->first();
        $permEdit = Permission::where('name', '=', 'edit')->first();
        $permUpdate = Permission::where('name', '=', 'update')->first();
        $permDelete = Permission::where('name', '=', 'delete')->first();
        
        $roleOwner->perms()->sync(array($permCreate->id, $permDelete->id));
        $roleAdmin->perms()->sync(array($permCreate->id, $permEdit->id, $permUpdate->id, $permDelete->id));
        $roleUser->perms()->sync(array($permCreate->id, $permEdit->id, $permDelete->id));
        

    }
}
