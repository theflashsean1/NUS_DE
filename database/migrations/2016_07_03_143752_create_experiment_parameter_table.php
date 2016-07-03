<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiment_parameter', function (Blueprint $table) {
            $table->integer('parameter_id')->unsigned()->index();
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');

            $table->integer('experiment_id')->unsigned()->index();
            $table->foreign('experiment_id')->references('id')->on('experiments')->onDelete('cascade');

            $table->integer('type_value_index');

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
        Schema::table('experiment_parameter',function ($table){
            $table->dropForeign(['experiment_id']);
            $table->dropIndex(['experiment_id']);
            $table->dropForeign(['parameter_id']);
            $table->dropIndex(['parameter_id']);
        });
        Schema::drop('experiment_parameter');
    }
}
