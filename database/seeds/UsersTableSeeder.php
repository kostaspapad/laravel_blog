<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name' => 'kostas1',
               'rank_id' => '1',
               'email' => 'kostas1@gmail.com',
               'password' => '123456',
               'remember_token' => '123456'
            ],
            [
                'name' => 'kostas2',
                'rank_id' => '2',
                'email' => 'kostas2@gmail.com',
                'password' => '123456',
                'remember_token' => '123456'
            ],
            [
                'name' => 'kostas3',
                'rank_id' => '3',
                'email' => 'kostas3@gmail.com',
                'password' => '123456',
                'remember_token' => '123456'
            ],
            [
                'name' => 'kostas4',
                'rank_id' => '4',
                'email' => 'kostas4@gmail.com',
                'password' => '123456',
                'remember_token' => '123456'
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
