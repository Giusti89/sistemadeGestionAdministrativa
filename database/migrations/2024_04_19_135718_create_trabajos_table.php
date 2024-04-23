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
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('trabajo');
            $table->text('descripcion');
            $table->integer('cantidad');
            $table->boolean('estado')->default(false);

            $table->decimal('ganancia', 10, 2)->default(0.00)->nullable();
            $table->decimal('Costoproduccion', 10, 2)->default(0.00)->nullable();
            $table->decimal('Costofinal', 10, 2)->default(0.00)->nullable();
            

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
