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
            $table->text('description', 3000);
            $table->string('type');
            $table->string('qualification');
            $table->string('code', 10)->unique();
            $table->string('infringement_agent');
            $table->string('uit_penalty', 30)->nullable();
            $table->double('uit_percentage', 4, 1);
            $table->double('pecuniary_sanction', 6, 2)->nullable();
            $table->string('administrative_sanction', 1000)->nullable();
            $table->string('preventive_measure', 2000)->nullable();
            $table->double('discount_five_days', 4, 1)->default(0.0);
            $table->double('discount_fifteen_days', 4, 1)->default(0.0);
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
