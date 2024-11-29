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
        Schema::create('triajes', function (Blueprint $table) {
            $table->id();
            $table->float('peso');
            $table->float('talla');
            $table->float('presion_arterial');
            $table->foreignId('cita_id')->unique()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triajes');
    }
};
