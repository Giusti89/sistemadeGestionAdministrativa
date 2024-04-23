<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedBigInteger('tipousuario_id')->default(2);
            $table->foreign('tipousuario_id')->references('id')->on('tipousuario');
            $table->boolean('suscripcion')->default(false);
            $table->date('inicio')->nullable();
            $table->date('final')->nullable();
        });
        DB::table('users')->insert([
            [
                'name' => 'Giusti',
                'email' => 'giusti.17@hotmail.com',
                'lastname' => 'Villarroel',
                'password' => Hash::make('17041989'),
                'tipousuario_id' => '1',
                'suscripcion'=>true,
                'inicio'=>now(),
                'final' => '2033-03-21',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
