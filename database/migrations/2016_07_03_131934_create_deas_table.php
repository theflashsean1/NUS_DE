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
            $table->integer('dimension_id')-> unsigned()->nullable()->index();
            $table->integer('configuration_id')->unsigned()->nullable()->index();
            $table->integer('material_id')->unsigned()->nullable()->index();

            $table->foreign('dimension_id')->references('id')->on('dimensions')->onDelete('set null');
            $table->foreign('configuration_id')->references('id')->on('configurations')->onDelete('set null');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('set null');


            $table->float('prestretch');
            $table->integer('layer');

            $table->boolean('visible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deas',function ($table){
            $table->dropForeign(['dimension_id']);
            $table->dropForeign(['configuration_id']);
            $table->dropForeign(['material_id']);
            $table->dropIndex(['dimension_id']);
            $table->dropIndex(['configuration_id']);
            $table->dropIndex(['material_id']);

        });
        Schema::drop('deas');
    }
}
