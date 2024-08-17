<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\Application_detail;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Position;
use App\Models\Vacancy;
use App\Models\Province;

use Inertia\Inertia;


use Illuminate\Support\Facades\Auth;
use PDO;

class ApplicationController extends Controller
{
    private User $User_id = auth()->id();
    private User $User = auth()->user();

    public function ShowMyAplications()
    {
        $applications = Application::where('user_id', $this->User_id)
            ->get(); // Filtrar las aplicaciones por el ID del usuario

        return response()->json($applications); // Devolver las aplicaciones en formato JSON
    }

    /**
     * Display a listing of the resource.
     */ public function index()
    {
        // Obtener todas las postulaciones del usuario autenticado con las relaciones necesarias
        $applications = Application::with('vacancy.area', 'vacancy.position', 'vacancy.province', 'user')
            ->where('user_id', $this->User_id)  // Filtrar por el ID del usuario
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
                        'province_id' => $application->user->province_id
                    ],
                ],
            ];
        });

        return Inertia::render('VacancyDetail', [
            'applications' => $response,
        ]);
    }


    private function ApplicationValidator(Request $request)
    {

        $validatedVacancy = $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
        ]);

        $vacancyId = $validatedVacancy['vacancy_id'];

        // Verificar si el usuario ya ha aplicado a esta vacante
        $existingApplication = Application::where('user_id', $this->User_id)->where('vacancy_id', $vacancyId)->exists();


        if (!$validatedVacancy) {
            return response()->json(['message' => 'Esta vacante no existe'], 401);
        }

        if ($this->User->type_user_id != 1) {
            return response()->json(['message' => 'Este no es un usuario estudiante'], 402);
        }

        if ($existingApplication) {
            // Retornar un error en JSON si ya se ha aplicado
            return response()->json(['message' => 'Ya has aplicado a esta vacante.'], 422);
        }
    }

    public function CreateAplicationVacancy(Request $request)
    {

        $ApplicationValidator = $this->ApplicationValidator($request);

        if ($ApplicationValidator) {
            // Crear la aplicación si no existe una anterior y el type_user_id es 1
            $Aplication = Application::create([
                'user_id' => auth()->id(),
                'vacancy_id' => $request->vacancy_id,
            ]);

            Application_detail::create([
                'area_name' => $request->application_detail->area_name,
                'first_name' => $request->application_detail->first_name,
                'last_name' => $request->application_detail->area_name,
                'age' => $request->application_detail->age,
                'photo_path' => $request->application_detail->photo_path,
                'identification_path' => $request->application_detail->identification_path,
                'cv_path' => $request->application_detail->cv_path,
                'description' => $request->application_detail->description,
                'ability' => $request->application_detail->ability,
                'experience' => $request->application_detail->experience,
                'year_month' => $request->application_detail->year_month,
                'area_id' => $request->application_detail->area_id,
                'position_id' => $request->application_detail->position_id,
                'aplicaction_id' => $Aplication->id
            ]);

            return response()->json(['message' => 'Aplicación creada exitosamente.'], 201);
        } else {
            // Retornar un error en JSON si el type_user_id no es igual a 1
            return redirect('/');
        }
    }
}
