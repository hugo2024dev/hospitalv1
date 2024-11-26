<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_orden')->unsigned();
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->foreignId('programacion_id')->constrained()->cascadeOnDelete();
            $table->string('estado', 100);
            $table->foreignId('paciente_id')->nullable()->constrained();
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
