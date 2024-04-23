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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->decimal('ingreso', 10, 2)->default(0.00);
            $table->decimal('egreso', 10, 2)->default(0.00);
            $table->date('fecha')->nullable();

            $table->unsignedBigInteger('trabajo_id')->nullable();
            $table->foreign('trabajo_id')->references('id')->on('trabajos');

            $table->unsignedBigInteger('gasto_id')->nullable();
            $table->foreign('gasto_id')->references('id')->on('gastos');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
