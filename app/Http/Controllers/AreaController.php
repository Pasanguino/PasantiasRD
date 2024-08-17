<?php

namespace App\Http\Controllers;

use App\Models\Area;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\User;
use Inertia\Inertia;


class AreaController extends Controller
{

    private User $user_id = auth()->id();
    private User $user = auth()->user();

    public function index()
    {
        $areas = Area::withCount('vacancies')->get();

        // Retornar en formato JSON
        return response()->json($areas);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function searchVacancies($id)
    {
        // Buscar el área por ID
        $area = Area::find($id);

        if (!$area) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }

        // Obtener las vacantes asociadas al área
        $vacancies = $area->vacancies;

        // Cargar las relaciones deseadas
        $vacancies->load(['users', 'area', 'position', 'favorites', 'province']);

        // Retornar las vacantes en formato JSON
        // return response()->json($vacancies);

        return Inertia::render('Seach', [
            'vacancies' => $vacancies,
            'entrada' => $area["area_name"]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}
