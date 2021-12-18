<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->text('plate_number');
            $table->string('type');
            $table->integer('capacity');
//            $table->unsignedBigInteger('company_id');
//            $table->foreign('company_id')
//                ->references('id')
//                ->on('companies')
//                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

        });
//        Schema::table('buses', function (Blueprint $table) {
//            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');;
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
