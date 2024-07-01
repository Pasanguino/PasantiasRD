<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use Illuminate\Support\Facades\Validator;

class VacancyController extends Controller
{
    public function getAllVacancy()
    {
        $vacancies = Vacancy::all();

        $data = [
            'vacancies' => $vacancies,
            'status' => 200
        ];

        return response()->json($data, 200);
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
            'pronvice_id' => 'required|integer',
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
            'pronvice_id' => $request->pronvice_id,
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
            'pronvice_id' => 'required|integer',
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
        $vacancy->pronvice_id = $request->pronvice_id;
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
            'pronvice_id' => 'required|integer',
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

        if ($request->has('pronvice_id')) {
            $vacancy->pronvice_id = $request->pronvice_id;
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
    
}
