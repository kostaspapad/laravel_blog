<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create category, sender, active columns to table notification
        Schema::table('notifications', function(Blueprint $table) {
            $table->string('category')->nullable();
            $table->integer('sender')->nullable();
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
        // Delete category, sender, active columns to table notification
        Schema::table('notifications', function(Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('sender');
            $table->dropColumn('active');
        });
    }
}
