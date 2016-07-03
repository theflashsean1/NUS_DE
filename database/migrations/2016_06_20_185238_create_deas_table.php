<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('dimension_id');
            $table->integer('configuration_id');
            $table->integer('material_id');
            $table->float('prestretch');
            $table->integer('layer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deas');
    }
}
