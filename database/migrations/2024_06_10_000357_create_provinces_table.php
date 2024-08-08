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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('province_name');
            $table->timestamps();
        });

        DB::table('provinces')->insert([
            ['province_name' => 'Azua'],
            ['province_name' => 'Baoruco'],
            ['province_name' => 'Barahona'],
            ['province_name' => 'Dajabón'],
            ['province_name' => 'Distrito Nacional'],
            ['province_name' => 'Duarte'],
            ['province_name' => 'Elías Piña'],
            ['province_name' => 'El Seibo'],
            ['province_name' => 'Espaillat'],
            ['province_name' => 'Hato Mayor'],
            ['province_name' => 'Independencia'],
            ['province_name' => 'La Altagracia'],
            ['province_name' => 'La Romana'],
            ['province_name' => 'La Vega'],
            ['province_name' => 'María Trinidad Sánchez'],
            ['province_name' => 'Monseñor Nouel'],
            ['province_name' => 'Monte Cristi'],
            ['province_name' => 'Monte Plata'],
            ['province_name' => 'Pedernales'],
            ['province_name' => 'Peravia'],
            ['province_name' => 'Puerto Plata'],
            ['province_name' => 'Salcedo'],
            ['province_name' => 'Samaná'],
            ['province_name' => 'Sánchez Ramírez'],
            ['province_name' => 'San Cristóbal'],
            ['province_name' => 'San José de Ocoa'],
            ['province_name' => 'San Juan'],
            ['province_name' => 'San Pedro de Macorís'],
            ['province_name' => 'Santiago de los Caballeros'],
            ['province_name' => 'Santiago Rodríguez'],
            ['province_name' => 'Santo Domingo'],
            ['province_name' => 'Valverde'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
