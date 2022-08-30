<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_menus', function (Blueprint $table) {
            $table->integer('roleID')->unsigned();
            $table->integer('menuID')->unsigned();
            
            $table->foreign('roleID')->references('roleID')->on('roles');
            $table->foreign('menuID')->references('menuID')->on('menus');
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
        Schema::dropIfExists('detail_menus');
    }
}
