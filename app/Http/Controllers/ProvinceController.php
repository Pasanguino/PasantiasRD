<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Vacancy;
use Inertia\Inertia;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }
    public function getProvinceData()
    {
        $provinces = Province::withCount('vacancies')->get();

        $result = $provinces->map(function ($province) {
            $companyCount = $province->vacancies()->distinct('company_id')->count('company_id');

            return [
                'province_id' => $province->id,
                'province_name' => $province->province_name,
                'vacancy_count' => $province->vacancies_count,
                'company_count' => $companyCount
            ];
        });

        return response()->json($result);
    }

    public function showProvinceVacancies($province_id)
    {
        // Obtener las vacantes asociadas a la provincia
        $vacancies = Vacancy::where('province_id', $province_id)->get();

        // Cargar las relaciones deseadas
        $vacancies->load(['users', 'area', 'position', 'favorites', 'province']);

        // Obtener la provincia
        $province = Province::find($province_id);

        if (!$province) {
            return response()->json(['message' => 'Provincia no encontrada'], 404);
        }

        // Renderizar la vista con Inertia
        return Inertia::render('Seach', [
            'vacancies' => $vacancies,
            'entrada' => $province["province_name"]
        ]);
    }

}
