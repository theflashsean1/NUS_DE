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
            $table->integer('equipment_id')->unsigned()->index();
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');

            $table->integer('experiment_id')->unsigned()->index();
            $table->foreign('experiment_id')->references('id')->on('experiments')->onDelete('cascade');


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
        Schema::table('equipment_experiment',function ($table){
            $table->dropForeign(['equipment_id']);
            $table->dropIndex(['equipment_id']);
            $table->dropForeign(['experiment_id']);
            $table->dropIndex(['experiment_id']);
        });
        Schema::drop('equipment_experiment');
    }
}
