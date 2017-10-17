<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(RanksTableSeeder::class);

        // Entrust permissions
        //$this->call(RolesTableSeeder::class);
        //$this->call(PermissionsTableSeeder::class);
        
        // Posts and users
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        
        
        
    }
}
