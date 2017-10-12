<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserInfoForProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add a  column to table posts
        Schema::table('users', function(Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('name_icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('avatar');
        $table->dropColumn('gender');
        $table->dropColumn('age');
        $table->dropColumn('birth_date');
        $table->dropColumn('name_icon');
    }
}
