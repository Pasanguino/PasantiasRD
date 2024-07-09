<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('vacancy_name');
            $table->string('vacancy_description');
            $table->integer('salary');
            $table->string('company_name');
            $table->foreignId('company_id');
            $table->foreignId('user_id');
            $table->foreignId('province_id');
            $table->foreignId('area_id');
            $table->foreignId('position_id');
            $table->timestamps();
        });

        DB::table('vacancies')->insert([
            [
                'vacancy_name' => 'Software Developer',
                'vacancy_description' => 'Looking for experienced software developers.',
                'salary' => 80000,
                'company_name' => 'Tech Solutions Inc.',
                'company_id' => 1, 
                'user_id' => 1, 
                'province_id' => 1, 
                'area_id' => 1, 
                'position_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Marketing Manager',
                'vacancy_description' => 'Seeking a skilled marketing manager.',
                'salary' => 60000,
                'company_name' => 'Marketing Experts Ltd.',
                'company_id' => 2, 
                'user_id' => 1, 
                'province_id' => 2, 
                'area_id' => 2, 
                'position_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Programer',
                'vacancy_description' => 'Seeking a skilled programer full stack',
                'salary' => 70000,
                'company_name' => 'Facebook',
                'company_id' => 3, 
                'user_id' => 2, 
                'province_id' => 5, 
                'area_id' => 3, 
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
