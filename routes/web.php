<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

// Página principal
Route::get('/', function () {
    return Inertia::render('Home');
});


//http://pasantiasrd.test/t/search/buscar?buscar=Software
Route::get('/vacante/search/buscar', [VacancyController::class, 'searchVacancy']) ->name('search');
Route::get('/vacante/{id}', [VacancyController::class, 'getVacancyById']);



// Página de inicio con nombre 'home'
Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');

// Mostrar vacantes por provincia
Route::get('/vacancies_province/{province_id}', [ProvinceController::class, 'showProvinceVacancies'])->name('vacancies_province');

// Datos de provincias
Route::get('/province-data', [ProvinceController::class, 'getProvinceData']);

// // Dashboard con middleware de autenticación
Route::get('/dashboard_prueva', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


// Rutas para estudiantes con autenticación
Route::middleware(['estudiante', 'auth'])->group(function () {
    Route::get('/estudiante', function () {
        return Inertia::render('Find_internship');
    })->name('estudiante');

    Route::get('/vacancies_data', [VacancyController::class, 'getAllVacancy']);
    Route::get('/vacancies_area', [AreaController::class, 'index']);
    Route::get('/areas/{id}/vacancies', [AreaController::class, 'searchVacancies']);




    Route::post('/aplicar', [ApplicationController::class, 'store']);
});

// Rutas para empresas con autenticación
Route::middleware(['empresa', 'auth'])->group(function () {
    Route::get('/empresa', function () {
        return Inertia::render('Find_interns');
    })->name('empresa');
});

// Rutas para autenticación de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas públicas
Route::get('/test', function () {
    return Inertia::render('Test');
})->name('test');

Route::get('/settings', function () {
    return Inertia::render('Settings');
})->name('settings');

Route::get('/profile', function () {
    return Inertia::render('Profile');
})->name('profile');

Route::get('/company-profile', function () {
    return Inertia::render('Company-Profile');
})->name('company-profile');

Route::get('/company-settings', function () {
    return Inertia::render('Company-Settings');
})->name('company-Settings');

Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
});

Route::get('/contact-us', function () {
    return Inertia::render('ContactUs');
});

Route::get('/faq', function () {
    return Inertia::render('FAQ');
});

Route::get('/help', function () {
    return Inertia::render('Help');
});

Route::get('/privacy', function () {
    return Inertia::render('Privacy');
});

Route::get('/terms', function () {
    return Inertia::render('TermsAndConditions');
});

// Cargar rutas de autenticación
require __DIR__ . '/auth.php';
