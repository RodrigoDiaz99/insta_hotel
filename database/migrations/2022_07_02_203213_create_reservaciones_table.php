<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('establishment_id')->constrained('establishments');
            $table->date('fecha_entrada');
            $table->time('hora_entrada');
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->string('codigo');
            $table->tinyInteger('tipo_habitacion');
            $table->tinyInteger('cancelado')->nullable();
            $table->string('comentario')->nullable();
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
        Schema::dropIfExists('reservaciones');
    }
}
