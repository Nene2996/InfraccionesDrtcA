<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlActResolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_act_resolution', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('control_act_id');
            $table->foreign('control_act_id')->references('id')->on('control_act')->onDelete('cascade');

            $table->unsignedBigInteger('resolution_id');
            $table->foreign('resolution_id')->references('id')->on('resolutions')->onDelete('cascade');
            
            $table->date('date_notification_driver')->nullable();
            $table->string('type_act')->default('ACTA DE CONTROL');
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
        Schema::dropIfExists('control_act_resolution');
    }
}
