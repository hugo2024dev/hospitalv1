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
        Schema::create('cita_ecografia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ecografia_id')->constrained();
            $table->integer('cantidad')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_ecografia');
    }
};
