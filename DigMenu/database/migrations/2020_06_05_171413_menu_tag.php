<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag', function($table)
        {
            $table->id();
            $table->string('user_id');
            $table->string('name');
            $table->string('color');
            $table->timestamps();
        });
        Schema::create('memu_tag', function($table)
        {
            $table->id();
            $table->string('menu_id');
            $table->string('tag_id');
            $table->timestamps();
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
