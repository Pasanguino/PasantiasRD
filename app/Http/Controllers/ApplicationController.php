<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Position;
use App\Models\Vacancy;
use App\Models\Province;

use Inertia\Inertia;


use Illuminate\Support\Facades\Auth;
class ApplicationController extends Controller
{


    public function misAplicaciones()
    {
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        $applications = Application::where('user_id', $userId)->get(); // Filtrar las aplicaciones por el ID del usuario
        return response()->json($applications); // Devolver las aplicaciones en formato JSON
    }

    /**
     * Display a listing of the resource.
     */ public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // Obtener todas las postulaciones del usuario autenticado con las relaciones necesarias
        $applications = Application::with('vacancy.area', 'vacancy.position', 'vacancy.province', 'user')
            ->where('user_id', $userId)  // Filtrar por el ID del usuario
            ->get();

        // Formatear la respuesta
        $response = $applications->map(function ($application) {
            return [
                'application' => [
                    'id' => $application->id,
                    'user_id' => $application->user_id,
                    'vacancy_id' => $application->vacancy_id,
                    'status' => $application->status,
                    'vacancy' => [
                        'id' => $application->vacancy->id,
                        'vacancy_name' => $application->vacancy->vacancy_name,
                        'vacancy_description' => $application->vacancy->vacancy_description,
                        'salary' => $application->vacancy->salary,
                        'company_name' => $application->vacancy->company_name,
                        'company_id' => $application->vacancy->company_id,
                        'area_name' => optional($application->vacancy->area)->area_name ?? 'Área no especificada',
                        'position_name' => optional($application->vacancy->position)->position_name ?? 'Puesto no especificado',
                        'province_name' => optional($application->vacancy->province)->province_name ?? 'Provincia no definida',
                    ],
                    'user' => [
                        'id' => $application->user->id,
                        'first_name' => $application->user->first_name,
                        'last_name' => $application->user->last_name,
                        'email' => $application->user->email,
                        'type_user_id' => $application->user->type_user_id,
                        'province_id' => $application->user->province_id,
                        'company_id' => $application->user->company_id,
                        'company_name' => $application->user->company_name,
                    ],
                ],
            ];
        });

        return Inertia::render('VacancyDetail', [
            'applications' => $response,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = auth()->id();
        $vacancyId = $validatedData['vacancy_id'];

        // Obtener el usuario autenticado
        $user = auth()->user();

        // Verificar si el usuario ya ha aplicado a esta vacante
        $existingApplication = Application::where('user_id', $userId)
            ->where('vacancy_id', $vacancyId)
            ->exists();

        if ($existingApplication) {
            // Retornar un error en JSON si ya se ha aplicado
            return response()->json(['message' => 'Ya has aplicado a esta vacante.'], 422);
        }

        // Verificar si el type_user_id es igual a 1
        if ($user->type_user_id == 1) {
            // Crear la aplicación si no existe una anterior y el type_user_id es 1
            Application::create([
                'user_id' => $userId,
                'vacancy_id' => $vacancyId,
            ]);
        } else {
            // Retornar un error en JSON si el type_user_id no es igual a 1
            return redirect('/');
        }

        // Retornar una respuesta de éxito
        return response()->json(['message' => 'Aplicación creada exitosamente.'], 201);
    }






    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
