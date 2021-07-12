<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_act', function (Blueprint $table) {
            $table->id();
            $table->integer('act_number');
            $table->string('names_business_name');
            $table->string('address');
            $table->string('document_number', 11);
            $table->char('licence_number', 9);
            $table->string('qualification', 15);
            $table->date('date_infraction');
            $table->time('hour_infraction');
            $table->string('additional_Information')->nullable();
            $table->string('place');
            $table->string('reference')->nullable();
            $table->string('observation', 500)->nullable();
            $table->text('description');
            $table->string('status', 45)->default('PENDIENTE DE PAGO');

            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');

            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');

            $table->unsignedBigInteger('evidence_id');
            $table->foreign('evidence_id')->references('id')->on('evidences');

            $table->unsignedBigInteger('inspector_id');
            $table->foreign('inspector_id')->references('id')->on('inspectors');

            $table->unsignedBigInteger('campus_id');
            $table->foreign('campus_id')->references('id')->on('campus');

            $table->unsignedBigInteger('infraction_id');
            $table->foreign('infraction_id')->references('id')->on('infractions');

            $table->unsignedBigInteger('typeNames_id');
            $table->foreign('typeNames_id')->references('id')->on('type_names');

            $table->unsignedBigInteger('typeDocument_id');
            $table->foreign('typeDocument_id')->references('id')->on('type_documents');

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
        Schema::dropIfExists('inspection_act');
    }
}
