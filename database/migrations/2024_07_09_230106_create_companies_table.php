<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade'); // Agregar foreign key constraint
            $table->timestamps();
        });

        // Insertar datos en la tabla 'companies'
        DB::table('companies')->insert([
            ['company_name' => 'Tech Solutions Inc.', 'province_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Marketing Experts Ltd.', 'province_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Facebook', 'province_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Hospital Central', 'province_id' => 29, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Clínica San Juan', 'province_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Data Analytics Corp.', 'province_id' => 29, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Creative Studio', 'province_id' => 28, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Enterprise Solutions', 'province_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Human Resources Inc.', 'province_id' => 28, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Finance Corp.', 'province_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Sales Solutions Ltd.', 'province_id' => 29, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Tech Support Inc.', 'province_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Networking Solutions', 'province_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Content Creators Ltd.', 'province_id' => 28, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Marketing Experts Ltd.', 'province_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'Creative Studio', 'province_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
