<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_act', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_acta');
            $table->string('ruc_dni', 11);
            $table->string('nro_dni_conductor', 8);
            $table->string('razon_social_nombre');
            $table->string('nro_habilitacion')->nullable();
            $table->string('placa_vehiculo', 7);
            $table->string('lugar_intervencion');
            $table->string('origen');
            $table->string('destino');
            $table->string('apellidos_nombres_conductor');
            //$table->string('direccion_infractor');
            $table->string('nro_licencia');
            $table->date('fecha_infraccion');
            $table->time('hora_infraccion');
            $table->string('clase_categoria_licencia', 45);
            $table->string('descripcion_infraccion', 3000);
            $table->string('manifestacion_usuario', 3000)->nullable();
            
            $table->string('tipo_servicio', 45);
            $table->string('estado_actual', 300);
            $table->float('monto_pagado', 6, 2)->nullable();
            $table->string('nro_boleta_pago')->nullable();
            $table->date('fecha_pago_infraccion')->nullable();
            $table->date('fecha_registro_infraccion');

            $table->unsignedBigInteger('infraction_id');
            $table->foreign('infraction_id')->references('id')->on('infractions');

            $table->unsignedBigInteger('inspector_id');
            $table->foreign('inspector_id')->references('id')->on('inspectors');

            $table->unsignedBigInteger('campus_id');
            $table->foreign('campus_id')->references('id')->on('campus');

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
        Schema::dropIfExists('control_act');
    }
}
