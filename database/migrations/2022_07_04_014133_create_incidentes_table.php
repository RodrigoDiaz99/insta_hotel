<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidentes', function (Blueprint $table) {
            $table->id();
            $table->String('nivel');
            $table->String('mensaje');
            $table->String('lugar');
            $table->String('vsuites')->nullable();
            $table->String('lavanda')->nullable();
            $table->foreignId('user_id')->constrained('clientes');
            $table->foreignId('cliente_id')->constrained('clientes');
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
        Schema::dropIfExists('incidentes');
    }
}
