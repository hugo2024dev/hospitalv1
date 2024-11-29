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
        Schema::create('anamneses', function (Blueprint $table) {
            $table->id();
            $table->text('motivo_consulta')->nullable();
            $table->text('examen_clinico')->nullable();
            $table->text('antecedentes')->nullable();
            $table->text('quirurgicos')->nullable();
            $table->text('alergias')->nullable();
            $table->text('patologicos')->nullable();
            $table->text('familiares')->nullable();
            $table->text('obstetricos')->nullable();
            $table->text('otros')->nullable();
            $table->foreignId('cita_id')->unique()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamneses');
    }
};
