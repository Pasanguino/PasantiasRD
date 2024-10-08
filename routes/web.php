<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MensajeController;

use Inertia\Inertia;

// Cargar rutas de autenticación
require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';



// api Chat
Route::get('/chat', function () {
    return Inertia::render('Chat/index');
});

Route::get('/messages', function () {
    return Inertia::render('Chat/MyChat');
})->name('mychat');

// Rutas para Mensajes

// Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
// Route::post('/chats', [ChatController::class, 'store'])->name('chat.store');
// Route::get('/chats', [ChatController::class, 'index'])->name('chat.index');






Route::middleware('auth')->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('/chats/{id}', [ChatController::class, 'show'])->name('chats.show');

    Route::get('/chats/{chatId}/mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::post('/chats/{chatId}/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');
});



// Página principal
Route::get('/', [DashboardController::class, 'Home']);

Route::get('/userr', [DashboardController::class, 'index']);
Route::get('/count', [DashboardController::class, 'count']);

Route::get('/auth/status', function () {
    return response()->json(['authenticated' => Auth::check()]);
});

Route::get('/vacancies_province/{province_id}', [ProvinceController::class, 'showProvinceVacancies'])->name('vacancies_province');

// Datos de provincias
Route::get('/province-data', [ProvinceController::class, 'getProvinceData']);
Route::get('/province', [ProvinceController::class,'index']);
//http://pasantiasrd.test/t/search/buscar?buscar=Software
Route::get('/vacante/search/buscar', [VacancyController::class, 'searchVacancy']) ->name('search');
Route::get('/vacante/{id}', [VacancyController::class, 'show']);

Route::get('/Area', [AreaController::class, 'index']);


Route::get('/support', function () {
    return Inertia::render('ContactUs');
})->name('support');


// Página de inicio con nombre 'home'
Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');

// Mostrar vacantes por provincia


// // Dashboard con middleware de autenticación
Route::get('/dashboard_prueva', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/favoritess', [FavoriteController::class, 'showFavorites'])->middleware(['auth', 'verified']);

Route::get('/estudiante', function () {
    return Inertia::render('Find_internship');
})->name('estudiante');
Route::get('/vacancies_data', [VacancyController::class, 'getAllVacancy']);
Route::get('/vacancies_area', [AreaController::class, 'index']);
Route::get('/areas/{id}/vacancies', [AreaController::class, 'searchVacancies']);
// Rutas para estudiantes con autenticación
Route::middleware(['estudiante', 'auth'])->group(function () {


  


    Route::post('/applications', [ApplicationController::class, 'store'])
    ->middleware('auth')
    ->name('applications.store');

    Route::get('/applications', [ApplicationController::class, 'index']);

    Route::get('/applicationss', [ApplicationController::class, 'misAplicaciones']);


    Route::post('/aplicar', [ApplicationController::class, 'store']);
});

// Rutas para empresas con autenticación
Route::middleware(['empresa', 'auth'])->group(function () {
    Route::get('/empresa', function () {
        return Inertia::render('VacanciesCompany');
    })->name('empresa');
});

Route::get('/companies', [CompanyController::class, 'index']);
Route::post('/companies', [CompanyController::class, 'store']);

// Rutas para autenticación de perfil
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile', function () {
        return Inertia::render('Profile');
    })->name('profile');

});



// Rutas públicas
Route::get('/test', function () {
    return Inertia::render('Test');
})->name('test');

Route::get('/settings', function () {
    return Inertia::render('Settings', [
        'user' => Auth::user()
    ]);
})->name('settings');



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

Route::get('/vacancies-company', function () {
    return Inertia::render('VacanciesCompany');
});


