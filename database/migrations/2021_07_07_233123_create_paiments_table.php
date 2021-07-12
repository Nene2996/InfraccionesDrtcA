<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiments', function (Blueprint $table) {
            $table->id();
            $table->date('date_payment');
            $table->string('proof_number');
            $table->integer('total_amount');

            $table->unsignedBigInteger('type_proof_id');
            $table->foreign('type_proof_id')->references('id')->on('type_proof');

            $table->unsignedBigInteger('inspection_act_id');
            $table->foreign('inspection_act_id')->references('id')->on('inspection_act');

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
        Schema::dropIfExists('paiments');
    }
}
