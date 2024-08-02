<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\UserProfileController;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// User
// Route::get('/user', [AuthController::class, 'viewUser'])->middleware(['auth', 'verified']);


// Route::post('register',[AuthController::class, 'register']);
// Route::post('login',[AuthController::class, 'login']);

// // Vacancy
// Route::get('/vacancies', [VacancyController::class, 'getAllVacancy']);
// Route::post('/vacancies', [VacancyController::class, 'postVacancy'])->middleware(['auth', 'verified']);
// Route::get('/vacancies/{id}', [VacancyController::class, 'getVacancyById']);
// Route::get('/vacancies/area/{area_id}', [VacancyController::class, 'getVacancyByArea']);
// Route::get('/vacancies/province/{province_id}', [VacancyController::class, 'getVacancyByProvinceId']);
// Route::get('/vacancies/company/{company_id}', [VacancyController::class, 'getVacancyByCompanyId']);
// Route::delete('/vacancies/{id}', [VacancyController::class, 'deleteVacanteById'])->middleware(['auth', 'verified']);
// Route::put('/vacancies/{id}', [VacancyController::class, 'updateVacancy'])->middleware(['auth', 'verified']);
// Route::patch('/vacancies/{id}', [VacancyController::class, 'updatePartialVacancy'])->middleware(['auth', 'verified']);


//Favoritos
// Route::get('/favorites', [FavoriteController::class, 'getFavorites'])->middleware(['auth', 'verified']);
Route::post('/favorites', [FavoriteController::class, 'createFavorites'])->middleware(['auth', 'verified']);
Route::delete('/favorites/{id}', [FavoriteController::class, 'deleteFavorites'])->middleware(['auth', 'verified']);

//User Profile
Route::get('/profile', [UserProfileController::class, 'getProfileData'])->middleware(['auth', 'verified']);
Route::get('/profile/{id}', [UserProfileController::class, 'getProfileDataById'])->middleware(['auth', 'verified']);
Route::post('/profile', [UserProfileController::class, 'postProfileData'])->middleware(['auth', 'verified']);
Route::put('/profile/{id}', [UserProfileController::class, 'updatePartialProfile'])->middleware(['auth', 'verified']);
