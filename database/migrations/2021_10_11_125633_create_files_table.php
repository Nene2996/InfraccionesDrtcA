<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            //$table->id();
            $table->string('url_path');
            $table->integer('size');

            $table->unsignedBigInteger('fileable_id');
            $table->string('fileable_type');

            $table->primary(['fileable_id', 'fileable_type']); //crear llave primaria compuesta
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
        Schema::dropIfExists('files');
    }
}
