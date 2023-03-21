<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establishment_id')->constrained('establishments');
            $table->string('descripcion_corta');
            $table->string('descripcion_larga');
            $table->dateTime('date_inicio');
            $table->dateTime('date_fin');
            $table->string('importe');
            $table->string('suplemento');
            $table->time('time_limpieza');
            $table->time('time_lunes')->nullable();
            $table->time('time_martes')->nullable();
            $table->time('time_miercoles')->nullable();
            $table->time('time_jueves')->nullable();
            $table->time('time_viernes')->nullable();
            $table->time('time_sabado')->nullable();
            $table->time('time_domingo')->nullable();
            $table->boolean('permitir_lunes');
            $table->boolean('permitir_martes');
            $table->boolean('permitir_miercoles');
            $table->boolean('permitir_jueves');
            $table->boolean('permitir_viernes');
            $table->boolean('permitir_sabado');
            $table->boolean('permitir_domingo');
            $table->boolean('veinticuatro_horas');
            $table->boolean('estatus');
            $table->boolean('forzar_salida');
            $table->boolean('incremental');
            $table->foreignId('user_created_at')->nullable()->constrained('users');
            $table->foreignId('user_updated_at')->nullable()->constrained('users');
           // $table->foreignId('rooms_id')->nullable()->constrained();
           $table->foreignId('room_types_id')->constrained('room_types');
           $table->foreignId('tramos_id')->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifas');
    }
}
