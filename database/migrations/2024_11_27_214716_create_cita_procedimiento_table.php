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
        Schema::create('cita_procedimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained()->cascadeOnDelete();
            $table->foreignId('procedimiento_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_procedimiento');
    }
};
