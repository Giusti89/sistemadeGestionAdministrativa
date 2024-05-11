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
        Schema::create('pago', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('pago', 10, 2)->default(0.00)->nullable();

            $table->unsignedBigInteger('ordenpago_id')->nullable();
            $table->foreign('ordenpago_id')->references('id')->on('ordenpagos')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago');
    }
};
