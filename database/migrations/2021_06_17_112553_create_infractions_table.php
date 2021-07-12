<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infractions', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('code', 10)->unique();
            $table->string('infringement_agent');
            $table->string('uit_penalty', 30)->nullable();
            $table->integer('pecuniary_sanction')->nullable();
            $table->string('administrative_sanction')->nullable();
            $table->integer('discount_five_days')->default(0);
            $table->integer('discount_fifteen_days')->default(0);
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
        Schema::dropIfExists('infractions');
    }
}
