<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {


        $user = Auth::user();


        if ($user->type_user_id == 1) {

            return redirect()->route('estudiante');
        } else {

            return redirect()->route('empresa');
        }

    }

    public function user()
    {
        // Pasa el usuario registrado a la vista de Inertia
        return Inertia::render('Dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
