<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PronviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            ['id' => 1, 'province_name' => 'Santo Domingo'],
            ['id' => 2, 'province_name' => 'San Cristobal'],
            ['id' => 3, 'province_name' => 'Azúa'],
            ['id' => 4, 'province_name' => 'Baoruco'],
            ['id' => 5, 'province_name' => 'Barahona'],
            ['id' => 6, 'province_name' => 'Dajabón'],
            ['id' => 7, 'province_name' => 'Distrito Nacional'],
            ['id' => 8, 'province_name' => 'Duarte'],
            ['id' => 9, 'province_name' => 'Elías Piña'],
            ['id' => 10, 'province_name' => 'El Seibo'],
            ['id' => 11, 'province_name' => 'Espaillat'],
            ['id' => 12, 'province_name' => 'Hato Mayor'],
            ['id' => 13, 'province_name' => 'Independencia'],
            ['id' => 14, 'province_name' => 'La Altagracia'],
            ['id' => 15, 'province_name' => 'La Romana'],
            ['id' => 16, 'province_name' => 'La Vega'],
            ['id' => 17, 'province_name' => 'María Trinidad Sánchez'],
            ['id' => 18, 'province_name' => 'Monseñor Nouel'],
            ['id' => 19, 'province_name' => 'Monte Cristi'],
            ['id' => 20, 'province_name' => 'Monte Plata'],
            ['id' => 21, 'province_name' => 'Pedernales'],
            ['id' => 22, 'province_name' => 'Peravia'],
            ['id' => 23, 'province_name' => 'Puerto Plata'],
            ['id' => 24, 'province_name' => 'Salcedo'],
            ['id' => 25, 'province_name' => 'Samaná'],
            ['id' => 26, 'province_name' => 'Sánchez Ramírez'],
            ['id' => 27, 'province_name' => 'San José de Ocoa'],
            ['id' => 28, 'province_name' => 'San Juan'],
            ['id' => 29, 'province_name' => 'San Pedro de Macorís'],
            ['id' => 30, 'province_name' => 'Santiago de los Caballeros'],
            ['id' => 31, 'province_name' => 'Santiago Rodríguez'],
            ['id' => 32, 'province_name' => 'Valverde'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
