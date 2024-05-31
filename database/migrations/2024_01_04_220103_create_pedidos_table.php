<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_total', 10, 2);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('direccion_id')->references('id')->on('direccion_usuarios');
            $table->foreignId('estado_pedido_id')->references('id')->on('estado_pedidos');
            $table->foreignId('pago_id')->references('id')->on('pagos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
