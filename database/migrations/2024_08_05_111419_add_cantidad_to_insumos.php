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
        Schema::table('insumos', function (Blueprint $table) {
            $table->decimal('cantidad', 10, 2)->after('costo')->default(0.00)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insumos', function (Blueprint $table) {
            $table->dropColumn('cantidad');
        });
    }
};
