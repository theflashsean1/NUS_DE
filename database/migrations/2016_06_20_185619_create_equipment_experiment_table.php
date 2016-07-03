<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentExperimentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_experiment', function (Blueprint $table) {
            $table->integer('equipment')->unsigned()->index();
            $table->foreign('equipment')->references('id')->on('equipments')->onDelete('cascade');

            $table->integer('experiment')->unsigned()->index();
            $table->foreign('experiment')->references('id')->on('experiments')->onDelete('cascade');

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
        Schema::drop('equipment_experiment');
    }
}
