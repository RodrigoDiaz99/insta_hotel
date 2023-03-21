<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->nullable();
            $table->string('comentarios')->nullable();
            $table->string('tipo_pago');
            $table->double('total_venta');
            $table->string('sitio_venta')->nullable();
            $table->integer('cancelado')->comment('0: false, 1: true');
            $table->foreignId('habitacion_id')->nullable()->constrained('rooms');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('establishment_id')->constrained('establishments');
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
        Schema::dropIfExists('ventas');
    }
}
