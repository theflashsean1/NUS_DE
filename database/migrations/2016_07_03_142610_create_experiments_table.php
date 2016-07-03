<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('name');
            $table->char('dea_deg_other');
            $table->text('purpose');
            $table->longText('procedure');
            $table->integer('dea_id')->unsigned()->nullable()->index();
            $table->foreign('dea_id')->references('id')->on('deas')->onDelete('set null');


            $table->float('value1');
            $table->float('value2');
            $table->float('value3');
            $table->float('value4');
            $table->float('value5');
            $table->float('value6');
            $table->float('value7');
            $table->float('value8');
            $table->float('value9');
            $table->float('value10');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experiments',function ($table){
            $table->dropForeign(['dea_id']);
            $table->dropIndex(['dea_id']);
        });
        Schema::drop('experiments');
    }
}
