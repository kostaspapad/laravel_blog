<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create category, sender, active columns to table posts
        Schema::table('posts', function(Blueprint $table) {
            $table->string('category')->nullable();
            $table->boolean('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete category, sender, active columns to table posts
        Schema::table('posts', function(Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('active');
        });
    }
}
