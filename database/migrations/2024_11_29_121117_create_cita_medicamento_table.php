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
        Schema::create('cita_medicamento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medicamento_id')->constrained();
            $table->integer('cantidad')->unsigned();
            $table->foreignId('dosis_id')->constrained();
            $table->foreignId('unidad_id')->constrained();
            $table->foreignId('frecuencia_id')->constrained();
            $table->foreignId('via_id')->constrained();
            $table->integer('dias')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_medicamento');
    }
};
