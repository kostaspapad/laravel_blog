<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::where('name','=','kostas1')->first()->id;
        $user2 = User::where('name','=','kostas2')->first()->id;
        $user3 = User::where('name','=','kostas3')->first()->id;
        $user4 = User::where('name','=','kostas4')->first()->id;

        $posts = [
            [
                'title' => 'post1',
                'body' => 'post111111',
                'cover_image' => 'noimage.jpg',
                'user_id' => $user1
            ],
            [
                'title' => 'post2',
                'body' => 'post222222',
                'cover_image' => 'noimage.jpg',
                'user_id' => $user1
            ],
            [
                'title' => 'post3',
                'body' => 'post3333333',
                'cover_image' => 'noimage.jpg',
                'user_id' => $user1
            ],
            [
                'title' => 'post4',
                'body' => 'post44444',
                'cover_image' => 'noimage.jpg',
                'user_id' => $user2
            ],
            [
                'title' => 'post5',
                'body' => 'post555555',
                'cover_image' => 'noimage.jpg',
                'user_id' => $user3
            ],
            [
                'title' => 'post6',
                'body' => 'post666666',
                'cover_image' => 'noimage.jpg',
                'user_id' => $user4
            ]
        ];

        foreach ($posts as $key => $value) {
            Post::create($value);
        }
    }
}
