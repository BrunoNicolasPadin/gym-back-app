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
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('day_exercise_id')->constrained('days_exercises', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('position');
            $table->integer('repetitions');
            $table->float('rir', 3, 1)->nullable();
            $table->float('weight', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};
