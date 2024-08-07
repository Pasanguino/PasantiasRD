<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Vacancy;
use App\Models\Application;


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

    public function count()
    {
        // Contar reclutadores (usuarios con type_user_id igual a 2)
        $reclutadoresCount = User::where('type_user_id', 2)->count();

        // Contar vacantes
        $vacantesCount = Vacancy::count();

        // Contar postulantes (todos los objetos del modelo Application)
        $postulantesCount = Application::count();

        // Contar estudiantes (usuarios con type_user_id igual a 1)
        $estudiantesCount = User::where('type_user_id', 1)->count();

        // Crear el array de datos con los conteos
        $data = [
            'reclutadores' => $reclutadoresCount,
            'vacantes' => $vacantesCount,
            'postulantes' => $postulantesCount,
            'estudiantes' => $estudiantesCount,
        ];

        // Devolver la respuesta JSON con un código de estado 200 (OK)
        return response()->json($data);
    }
}
