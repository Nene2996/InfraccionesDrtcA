<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidenceables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidenceable_id');
            $table->string('evidenceable_type');
            $table->unsignedBigInteger('evidence_id');
            $table->foreign('evidence_id')->references('id')->on('evidences')->onDelete('cascade');

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
        Schema::dropIfExists('evidenceables');
    }
}
