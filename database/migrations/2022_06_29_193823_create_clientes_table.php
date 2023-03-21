<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->String('nombre');
            $table->String('apellido_p');
            $table->String('apellido_m')->nullable();
            $table->date('fecha_n')->nullable();
            $table->String('genero')->nullable();
            $table->String('origen')->nullable();
            $table->String('tipo_documento');
            $table->String('documento');
            $table->date('expedicion')->nullable();
            $table->String('pais_documento')->nullable();
            $table->String('email')->nullable();
            $table->String('direccion')->nullable();
            $table->String('codigo_postal')->nullable();
            $table->String('poblacion')->nullable();
            $table->String('provincia')->nullable();
            $table->String('telefono_1')->nullable();
            $table->String('telefono_2')->nullable();
            $table->String('observaciones')->nullable();
            $table->String('estado');
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
        Schema::dropIfExists('clientes');
    }
}
