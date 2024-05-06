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
        Schema::create('ordenpagos', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 10, 2)->default(0.00);
            $table->decimal('cuenta', 10, 2)->default(0.00)->nullable();
            $table->decimal('saldo', 10, 2)->default(0.00)->nullable();
            $table->decimal('pago', 10, 2)->default(0.00)->nullable();

            $table->unsignedBigInteger('trabajo_id');
            $table->foreign('trabajo_id')->references('id')->on('trabajos');
            $table->date('fechpago');

            $table->unsignedBigInteger('estadopago_id')->default(1);
            $table->foreign('estadopago_id')->references('id')->on('estadopagos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenpagos');
    }
};
