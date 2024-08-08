<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreProfessionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profession $profession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profession $profession)
    {
        //
    }
}
