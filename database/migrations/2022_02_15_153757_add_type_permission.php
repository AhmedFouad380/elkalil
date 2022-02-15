<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Table('user_permission', function (Blueprint $table) {
            $table->integer('user_type')->default(0);
        });
        Schema::Table('user_chat_permissions', function (Blueprint $table) {
            $table->integer('user_type')->default(0);
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
