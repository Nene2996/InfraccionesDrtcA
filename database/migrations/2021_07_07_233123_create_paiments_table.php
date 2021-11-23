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
            $table->float('discount', 6, 2);
            $table->float('total_amount', 6, 2);
            $table->float('pending_amount', 6, 2);
            $table->integer('quota_number');
            $table->unsignedBigInteger('paimentable_id');
            $table->string('paimentable_type');

            $table->unsignedBigInteger('type_proof_id');
            $table->foreign('type_proof_id')->references('id')->on('type_proof');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
