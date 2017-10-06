<?php

use App\Rank;
use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ranks = [
            [
               'rank' => 'gold',
               'display_rank' => 'Gold',
               'description' => 'User did more than 3 posts'
            ],
            [
                'rank' => 'silver',
                'display_rank' => 'Silver',
                'description' => 'User did more than 2 posts'
            ],
            [
                'rank' => 'bronze',
                'display_rank' => 'Bronze',
                'description' => 'User did more than 1 posts'
            ],
            [
                'rank' => 'none',
                'display_rank' => 'None',
                'description' => 'User did 0 posts'
            ]
        ];

        foreach ($ranks as $key => $value) {
            Rank::create($value);
        }
    }
}
