<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id')->constrained('products');
            $table->integer('cantidad');
            $table->string('estatus');
            $table->foreignId('user_created_at')->nullable()->constrained('users');
            $table->foreignId('user_updated_at')->nullable()->constrained('users');
            $table->foreignId('establishment_id')->constrained('establishments');
            $table->string('comentario')->nullable();
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
        Schema::dropIfExists('pedidos');
    }
}
