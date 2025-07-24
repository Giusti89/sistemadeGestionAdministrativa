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
        Schema::table('trabajos', function (Blueprint $table) {
            $table->foreignId('estadotrabajo_id')
                ->nullable()
                ->default(1)
                ->constrained('estadotrabajos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trabajos', function (Blueprint $table) {
            $table->dropForeign(['estadotrabajo_id']);
            $table->dropColumn('estadotrabajo_id');
        });
    }
};
