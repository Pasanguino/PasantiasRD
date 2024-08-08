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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable(); // Permitir null
            $table->string('description')->nullable(); // Permitir null
            $table->integer('age')->nullable(); // Permitir null
            $table->string('photo_path')->nullable(); // Permitir null
            $table->string('identification_path')->nullable(); // Permitir null
            $table->string('cv_path')->nullable(); // Permitir null
            $table->foreignId('profession_id')->nullable(); // Permitir null
            $table->foreignId('province_id')->nullable(); // Permitir null
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuarios
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
