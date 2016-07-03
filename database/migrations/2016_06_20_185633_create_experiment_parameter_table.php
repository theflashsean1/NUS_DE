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
            $table->integer('parameter')->unsigned()->index();
            $table->foreign('parameter')->references('id')->on('parameters')->onDelete('cascade');

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
        Schema::drop('experiment_parameter');
    }
}
