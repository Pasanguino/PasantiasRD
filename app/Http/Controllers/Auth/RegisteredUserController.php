<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación del formulario
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type_user_id' => 'required|integer',
            'province_id' => 'nullable|integer',
            'company_id' => 'nullable|integer',
        ]);

        // Inicializar el nombre de la compañía
        $company_name = 'Sin empresa';

        // Si se proporciona un company_id diferente de 0, obtener el nombre de la compañía
        if ($request->filled('company_id') && $request->company_id != 0) {
            $company = Company::findOrFail($request->company_id);
            $company_name = $company->company_name;
        }

        // Crear el usuario con los datos del formulario
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_user_id' => $request->type_user_id,
            'province_id' => $request->province_id, // Esto puede ser null
            'company_id' => $request->company_id != 0 ? $request->company_id : null, // Convertir 0 a null
            'company_name' => $company_name, // Asignar el nombre de la compañía
        ]);

        // Crear el perfil de usuario asociado
        UserProfile::create([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => '', // Dejar vacío
            'description' => '', // Dejar vacío
            'age' => null, // Dejar null
            'photo_path' => '', // Dejar vacío
            'identification_path' => '', // Dejar vacío
            'cv_path' => '', // Dejar vacío
            'profession_id' => null, // Dejar null
            'province_id' => $user->province_id, // Reutilizar la provincia del usuario
            'user_id' => $user->id, // Asignar el ID del usuario recién creado
        ]);

        // Disparar evento de registro
        // Disparar evento de registro
        event(new Registered($user));

        // Autenticar al usuario
        Auth::login($user);

        // Redireccionar al dashboard
        return redirect()->route('dashboard');
    }
}
