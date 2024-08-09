<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;
use Illuminate\Support\Facades\DB;

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
                'vacancy_name' => 'Desarrollador de Software',
                'vacancy_description' => 'Buscando desarrolladores de software con experiencia.',
                'salary' => 80000,
                'company_name' => 'Tech Solutions Inc.',
                'company_id' => 1,
                'user_id' => 1,
                'province_id' => 5,
                'area_id' => 1,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Gerente de Marketing',
                'vacancy_description' => 'Buscando un gerente de marketing con habilidades.',
                'salary' => 60000,
                'company_name' => 'Marketing Experts Ltd.',
                'company_id' => 2,
                'user_id' => 2,
                'province_id' => 2,
                'area_id' => 2,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Programador',
                'vacancy_description' => 'Buscando un programador full stack con habilidades.',
                'salary' => 70000,
                'company_name' => 'Facebook',
                'company_id' => 3,
                'user_id' => 3,
                'province_id' => 5,
                'area_id' => 1,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Pasante de Programación en Python',
                'vacancy_description' => 'Buscamos un pasante para el área de programación en Python. No se requiere experiencia previa, solo motivación y ganas de aprender.',
                'salary' => 15000,
                'company_name' => 'Tech Solutions Inc.',
                'company_id' => 4,
                'user_id' => 4,
                'province_id' => 29,
                'area_id' => 1,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Pasante de Medicina General',
                'vacancy_description' => 'Oportunidad para pasante de medicina general. Se requiere estar cursando la carrera de medicina y tener ganas de aprender en un entorno hospitalario.',
                'salary' => 20000,
                'company_name' => 'Hospital Central',
                'company_id' => 5,
                'user_id' => 5,
                'province_id' => 29,
                'area_id' => 3,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Pasante de Enfermería',
                'vacancy_description' => 'Buscamos un pasante para el área de enfermería. Ideal para estudiantes de enfermería que deseen adquirir experiencia práctica.',
                'salary' => 18000,
                'company_name' => 'Clínica San Juan',
                'company_id' => 6,
                'user_id' => 6,
                'province_id' => 3,
                'area_id' => 3,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Científico de Datos',
                'vacancy_description' => 'Buscando un científico de datos con conocimientos en big data.',
                'salary' => 90000,
                'company_name' => 'Data Analytics Corp.',
                'company_id' => 7,
                'user_id' => 7,
                'province_id' => 29,
                'area_id' => 1,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Diseñador Gráfico',
                'vacancy_description' => 'Necesitamos un diseñador gráfico creativo.',
                'salary' => 50000,
                'company_name' => 'Creative Studio',
                'company_id' => 8,
                'user_id' => 8,
                'province_id' => 28,
                'area_id' => 4,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Scrum Master',
                'vacancy_description' => 'Se requiere un Scrum Master con o sin experiencia.',
                'salary' => 85000,
                'company_name' => 'Enterprise Solutions',
                'company_id' => 9,
                'user_id' => 9,
                'province_id' => 5,
                'area_id' => 8,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Pasante en RRHH',
                'vacancy_description' => 'Pasante en RRHH con o sin experiencia previa',
                'salary' => 55000,
                'company_name' => 'Human Resources Inc.',
                'company_id' => 10,
                'user_id' => 10,
                'province_id' => 28,
                'area_id' => 5,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Contador',
                'vacancy_description' => 'Contador certificado necesario para la gestión financiera.',
                'salary' => 60000,
                'company_name' => 'Finance Corp.',
                'company_id' => 11,
                'user_id' => 11,
                'province_id' => 8,
                'area_id' => 6,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Representante de Ventas',
                'vacancy_description' => 'Aprendiz de Representante de ventas',
                'salary' => 45000,
                'company_name' => 'Sales Solutions Ltd.',
                'company_id' => 12,
                'user_id' => 12,
                'province_id' => 29,
                'area_id' => 7,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Soporte al Cliente',
                'vacancy_description' => 'Soporte al cliente para empresa de tecnología.',
                'salary' => 40000,
                'company_name' => 'Tech Support Inc.',
                'company_id' => 13,
                'user_id' => 13,
                'province_id' => 5,
                'area_id' => 12,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Ingeniero de Redes',
                'vacancy_description' => 'Ingeniero o tecnico de redes, con ganas de aprender',
                'salary' => 75000,
                'company_name' => 'Networking Solutions',
                'company_id' => 14,
                'user_id' => 14,
                'province_id' => 5,
                'area_id' => 1,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Redactor de Contenidos',
                'vacancy_description' => 'Redactor de contenidos creativo para campañas de marketing.',
                'salary' => 50000,
                'company_name' => 'Content Creators Ltd.',
                'company_id' => 15,
                'user_id' => 15,
                'province_id' => 28,
                'area_id' => 2,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Pasante de Marketing',
                'vacancy_description' => 'Oportunidad para pasante de marketing sin experiencia previa. Se requiere motivación y ganas de aprender.',
                'salary' => 15000,
                'company_name' => 'Marketing Experts Ltd.',
                'company_id' => 16,
                'user_id' => 16,
                'province_id' => 13,
                'area_id' => 2,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Pasante de Diseño Gráfico',
                'vacancy_description' => 'Oportunidad para pasante de diseño gráfico sin experiencia previa. Se requiere creatividad y disposición para aprender.',
                'salary' => 15000,
                'company_name' => 'Creative Studio',
                'company_id' => 17,
                'user_id' => 17,
                'province_id' => 4,
                'area_id' => 4,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Asistente de Logística',
                'vacancy_description' => 'Buscamos un asistente de logística para apoyar en la gestión de la cadena de suministro.',
                'salary' => 35000,
                'company_name' => 'Logistics Corp.',
                'company_id' => 18,
                'user_id' => 18,
                'province_id' => 6,
                'area_id' => 10,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Especialista en Ciberseguridad',
                'vacancy_description' => 'Buscando un especialista en ciberseguridad para proteger nuestros sistemas y datos.',
                'salary' => 95000,
                'company_name' => 'Cyber Solutions',
                'company_id' => 19,
                'user_id' => 19,
                'province_id' => 5,
                'area_id' => 1,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vacancy_name' => 'Técnico en Electrónica',
                'vacancy_description' => 'Buscamos un técnico en electrónica para mantenimiento de dispositivos electrónicos.',
                'salary' => 50000,
                'company_name' => 'Electronics Repair Ltd.',
                'company_id' => 20,
                'user_id' => 20,
                'province_id' => 29,
                'area_id' => 1,
                'position_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
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
