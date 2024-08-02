<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;


use Illuminate\Support\Facades\Auth;
class ApplicationController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $applications = Application::where('user_id', $userId)->get();

        $vacancies = $applications->map(function ($application) {
            return $application->vacancy; // Aquí, 'vacancy' debería ser un modelo o array con los detalles de la vacante
        });

        return Inertia::render('VacancyDetail', [
            'vacancies' => $vacancies
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

        // Verificar si el usuario ya ha aplicado a esta vacante
        $existingApplication = Application::where('user_id', $userId)
            ->where('vacancy_id', $vacancyId)
            ->exists();

        if ($existingApplication) {
            // Retornar un error en JSON si ya se ha aplicado
            return response()->json(['message' => 'Ya has aplicado a esta vacante.'], 422);
        }

        // Crear la aplicación si no existe una anterior
        Application::create([
            'user_id' => $userId,
            'vacancy_id' => $vacancyId,
        ]);

        // Retornar un éxito en JSON
        return response()->json(['message' => 'Aplicación creada exitosamente.']);
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
