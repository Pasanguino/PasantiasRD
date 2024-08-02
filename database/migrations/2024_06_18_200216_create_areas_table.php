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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('area_name');
            $table->timestamps();
        });

        // Insertar datos en la tabla `areas`
        DB::table('areas')->insert([
            ['area_name' => 'Tecnología de la Información (TI)', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Marketing', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Medicina', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Diseño', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Recursos Humanos', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Ventas', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Administración', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Legal', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Operaciones', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Investigación y Desarrollo', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Atención al Cliente', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Producción', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Logística', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Compras', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Ingeniería', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Comunicación', 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'Seguridad', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
