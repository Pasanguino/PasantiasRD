<?php

namespace App\Http\Controllers;

use App\Models\TypeUser;
use App\Http\Requests\StoreTypeUserRequest;
use App\Http\Requests\UpdateTypeUserRequest;
use Illuminate\Support\Facades\Auth;


class TypeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function IsCompanie()
    {
        $user = Auth::user(); // Obtén el usuario actualmente autenticado

        if (!$user) {
            return response()->json(['error' => 'No authenticated user'], 401); // Manejo de usuarios no autenticados
        }

        // Verifica el valor de `type_user_id`
        if ($user->type_user_id == 1) {
            return response()->json(['result' => false]);
        } elseif ($user->type_user_id == 2) {
            return response()->json(['result' => true]);
        }

        // Manejo de otros posibles valores de `type_user_id`
        return response()->json(['result' => false]); // O según sea necesario
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
    public function store(StoreTypeUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeUser $typeUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeUser $typeUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeUserRequest $request, TypeUser $typeUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeUser $typeUser)
    {
        //
    }
}
