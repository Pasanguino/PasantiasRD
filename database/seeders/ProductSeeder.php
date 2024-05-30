<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("products")->insert([
            'name'=> "Cell",
            'description'=> "Texto de ejemplo",
            'ammount' => 28.9
        ]);

        DB::table("products")->insert([
            'name'=> "Pixel",
            'description'=> "Texto de ejemplo",
            'ammount' => 28.9
        ]);


        DB::table("products")->insert([
            'name'=> "PC",
            'description'=> "Texto de ejemplo",
            'ammount' => 28.9
        ]);
    }
}
