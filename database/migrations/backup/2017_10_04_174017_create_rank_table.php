<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create ranks table
        Schema::create('ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rank')->nullable();
            $table->string('display_rank')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });    
        
        // Add rank_id column to table users
        Schema::table('users', function(Blueprint $table) {
            $table->integer('rank_id')->nullable();
        });
        
        /**
        * Create table for associating users to ranks (Many-to-Many)
        *
        * @return void
        */
        // Schema::create('user_rank', function (Blueprint $table) {
        //     $table->integer('user_id')->unsigned();
        //     $table->integer('rank_id')->unsigned();

        //     $table->foreign('user_id')->references('id')->on('users')
        //         ->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('rank_id')->references('id')->on('ranks')
        //         ->onUpdate('cascade')->onDelete('cascade');

        //     $table->primary(['user_id', 'rank_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranks');
        Schema::dropIfExists('user_rank');
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('rank_id');
        });
    }
}
