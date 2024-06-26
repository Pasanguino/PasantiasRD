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
        Schema::create('application_details', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('photo_path');
            $table->string('identification_path');
            $table->string('cv_path');
            $table->string('description');
            $table->string('ability');
            $table->int('experience');
            $table->int('year_month');
            $table->foreignId('area_id');
            $table->foreignId('position_id');
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_details');
    }
};
