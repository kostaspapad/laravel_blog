<?php

use App\Rank;
use App\User;
use Illuminate\Database\Seeder;

class UserRanksTableSeeder extends Seeder
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
        
        // Get user ids
        $user1 = User::where('name','=','kostas1')->first()->id;
        $user2 = User::where('name','=','kostas2')->first()->id;
        $user3 = User::where('name','=','kostas3')->first()->id;
        $user4 = User::where('name','=','kostas4')->first()->id;

        $rankGold = new Rank;
        $rankSilver = new Rank;
        $rankBronze = new Rank;
        $rankNone = new Rank;

        $rankGold = Rank::where('rank', '=', 'gold')->first()->id;
        $rankSilver = Rank::where('rank', '=', 'silver')->first()->id;
        $rankBronze = Rank::where('rank', '=', 'bronze')->first()->id;
        $rankNone = Rank::where('rank', '=', 'none')->first()->id;

        
    }
}
