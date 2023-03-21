<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->nullable();
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->foreignId('user_id')->constrained('users')->comment('ID del usuario que realizó la compra');
            $table->double('total_compra');
            $table->integer('cancelado')->comment('0: false, 1: true');
            $table->string('comentarios_cancelacion')->nullable();
            $table->string('path_xml')->nullable();
            $table->string('path_pdf')->nullable();
            $table->string('path_ticket')->nullable();
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
        Schema::dropIfExists('compras');
    }
}
