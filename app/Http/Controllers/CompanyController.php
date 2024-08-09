<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();

        return response()->json($companies);
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
        // Define las reglas de validación
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'confirmation_password' => 'required|string'
        ]);

        // Validar los datos
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Verifica la contraseña de confirmación
        $confirmationPassword = $request->input('confirmation_password');
        if ($confirmationPassword !== '123') {
            return response()->json([
                'error' => 'Contraseña de confirmación incorrecta.'
            ], 403);
        }

        // Crear la compañía
        $company = new Company();
        $company->company_name = $request->input('company_name');
        $company->province_id = $request->input('province_id');
        $company->save();

        // Retornar respuesta exitosa
        return response()->json([
            'message' => 'Compañía creada exitosamente.',
            'company' => $company
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
