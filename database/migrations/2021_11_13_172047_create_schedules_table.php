<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('starting_point');
            $table->string('destination');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->float('fare_amount');


            $table->bigInteger('bus_id')->unsigned();
            $table->foreign('bus_id')
                ->references('id')
                ->on('buses')
                ->onDelete('cascade');


            $table->bigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('cascade');


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
        Schema::dropIfExists('schedules');
    }
}
