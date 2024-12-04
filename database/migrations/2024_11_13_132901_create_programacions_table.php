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
        Schema::create('programacions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('cantidad_citas')->unsigned();
            $table->tinyInteger('duracion_cita')->unsigned();
            $table->date('fecha');
            $table->string('turno', 20);

            $table->foreignId('empleado_id')->constrained();
            $table->foreignId('consultorio_id')->constrained();
            $table->foreignId('especialidad_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programacions');
    }
};
