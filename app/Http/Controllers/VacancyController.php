<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class VacancyController extends Controller
{
    public function getAllVacancy()
    {
        // Obtener todas las vacantes e incluir las relaciones
        $vacancies = Vacancy::with(['province', 'area', 'position'])->get();

        // Devolver las vacantes con datos relacionados como respuesta JSON
        return response()->json($vacancies);
    }

    public function searchVacancy(Request $request)
    {
        // Obtener el término de búsqueda de la solicitud, utilizando 'buscar' como clave
        $searchTerm = $request->query('buscar', '');

        // Filtrar las vacantes por el término de búsqueda e incluir las relaciones
        $vacancies = Vacancy::where('vacancy_name', 'LIKE', "%{$searchTerm}%")
        ->with(['province', 'area', 'position'])
        ->get();

        // Devolver las vacantes filtradas como respuesta JSON
        // return Inertia::render('Search', [
        //     'vacancies' => $vacancies,
        //     'entrada' => $searchTerm
        // ]);

        return Inertia::render('Seach', [
            'vacancies' => $vacancies,
            'entrada' => $searchTerm
        ]);
    }


    

    public function postVacancy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vacancy_name' => 'required|max:255',
            'vacancy_description' => 'required',
            'salary' => 'required|integer',
            'company_name' => 'required|max:150',
            'company_id' => 'required|integer',
            'user_id' => 'required|integer',
            'province_id' => 'required|integer',
            'area_id' => 'required|integer',
            'position_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $vacancy = Vacancy::create([
            'vacancy_name' => $request->vacancy_name,
            'vacancy_description' => $request->vacancy_description,
            'salary' => $request->salary,
            'company_name' => $request->company_name,
            'company_id' => $request->company_id,
            'user_id' => $request->user_id,
            'province_id' => $request->province_id,
            'area_id' => $request->area_id,
            'position_id' => $request->position_id,
        ]);

        if (!$vacancy) {
            $data = [
                'message' => 'Error al crear la vacante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'vacante' => $vacancy,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function getVacancyById($id)
    {
        $vacancy = Vacancy::find($id);

        // Cargar relaciones para obtener los datos completos
        $vacancy->load(['users', 'areas', 'positions', 'favorites', 'provinces']);

        $data = [
            'vacante' => $vacancy,
        ];

        return response()->json($data);
    }

    public function getVacancyByArea($area_id) 
    {
        $vacancy = Vacancy::where('area_id', $area_id)->get();

        if (!$vacancy) {
            $data = [
                'message' => 'Vacante no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'vacante' => $vacancy,
            'status' => 200
        ];

        return response()->json($data, 200);
        
    }

    public function getVacancyByProvinceId($province_id) 
    {
        $vacancy = Vacancy::where('province_id', $province_id)->get();

        if (!$vacancy) {
            $data = [
                'message' => 'Vacante no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'vacante' => $vacancy,
            'status' => 200
        ];

        return response()->json($data, 200);
        
    }

    public function getVacancyByCompanyId($company_id) 
    {
        $vacancy = Vacancy::where('company_id', $company_id)->get();

        if (!$vacancy) {
            $data = [
                'message' => 'Vacante no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'vacante' => $vacancy,
            'status' => 200
        ];

        return response()->json($data, 200);
        
    }

    public function deleteVacanteById($id)
    {
        $vacancy = Vacancy::find($id);

        if (!$vacancy) {
            $data = [
                'message' => 'Vacante no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $vacancy->delete();

        $data = [
            'message' => 'Vacante eliminada con éxito!',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updateVacancy(Request $request, $id){

        $vacancy = Vacancy::find($id);

        if (!$vacancy) {
            $data = [
                'message' => 'Vacante no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'vacancy_name' => 'required|max:255',
            'vacancy_description' => 'required|required',
            'salary' => 'required|integer',
            'company_name' => 'required|max:150',
            'company_id' => 'required|integer',
            'province_id' => 'required|integer',
            'area_id' => 'required|integer',
            'position_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $vacancy->vacancy_name = $request->vacancy_name;
        $vacancy->vacancy_description = $request->vacancy_description;
        $vacancy->salary = $request->salary;
        $vacancy->company_name = $request->company_name;
        $vacancy->company_id = $request->company_id;
        $vacancy->province_id = $request->province_id;
        $vacancy->area_id = $request->area_id;
        $vacancy->position_id = $request->position_id;

        $vacancy->save();

        $data = [
            'message' => 'Vacante Actualizada con exito',
            'vacante' => $vacancy,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartialVacancy(Request $request, $id)
    {
        $vacancy = Vacancy::find($id);

        if (!$vacancy) {
            $data = [
                'message' => 'Vacante no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'vacancy_name' => 'required|max:255',
            'vacancy_description' => 'required',
            'salary' => 'required|integer',
            'company_name' => 'required|max:150',
            'company_id' => 'required|integer',
            'province_id' => 'required|integer',
            'area_id' => 'required|integer',
            'position_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('vacancy_name')) {
            $vacancy->vacancy_name = $request->vacancy_name;
        }

        if ($request->has('vacancy_description')) {
            $vacancy->vacancy_description = $request->vacancy_description;
        }

        if ($request->has('salary')) {
            $vacancy->salary = $request->salary;
        }

        if ($request->has('company_name')) {
            $vacancy->company_name = $request->company_name;
        }

        if ($request->has('company_id')) {
            $vacancy->company_id = $request->company_id;
        }

        if ($request->has('province_id')) {
            $vacancy->province_id = $request->province_id;
        }

        if ($request->has('area_id')) {
            $vacancy->area_id = $request->area_id;
        }
        
        if ($request->has('position_id')) {
            $vacancy->position_id = $request->position_id;
        }

        $vacancy->save();

        $data = [
            'message' => 'Vacante actualizada',
            'vacante' => $vacancy,
            'status' => 200
        ];

        return response()->json($data, 200);      

    }

    public function show($id)
    {
        $vacancy = Vacancy::with(['users', 'area', 'position', 'favorites', 'province'])->findOrFail($id);

        return Inertia::render('Vacante', [
            'vacancy' => $vacancy
        ]);
        
    }
}
