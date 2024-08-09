<!-- 
/*
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\TypeUserController;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// User



// Route::post('register',[AuthController::class, 'register']);
// Route::post('login',[AuthController::class, 'login']);

// Rutas de vacantes
Route::get('/vacancies', [VacancyController::class, 'getAllVacancy']);
Route::post('/vacancies', [VacancyController::class, 'postVacancy'])->middleware(['auth:sanctum', 'verified']);
Route::get('/vacancies/{id}', [VacancyController::class, 'getVacancyById']);
Route::get('/vacancies/area/{area_id}', [VacancyController::class, 'getVacancyByArea']);
Route::get('/vacancies/province/{province_id}', [VacancyController::class, 'getVacancyByProvinceId']);
Route::get('/vacancies/company/{company_id}', [VacancyController::class, 'getVacancyByCompanyId']);
Route::delete('/vacancies/{id}', [VacancyController::class, 'deleteVacanteById'])->middleware(['auth:sanctum', 'verified']);
Route::put('/vacancies/{id}', [VacancyController::class, 'updateVacancy'])->middleware(['auth:sanctum', 'verified']);
Route::patch('/vacancies/{id}', [VacancyController::class, 'updatePartialVacancy'])->middleware(['auth:sanctum', 'verified']);
Route::get('/vacancies/applications/{vacancy_id}', [VacancyController::class, 'getApplicants']);
Route::put('/vacancies/applications/{application_id}', [VacancyController::class, 'updateApplicationStatus'])->middleware(['auth', 'verified']);
Route::get('/vacancies/student/{vacancy_id}', [VacancyController::class, 'getStudentsByVacancy']);

//Favoritos
Route::get('/favorites', [FavoriteController::class, 'getFavorites'])->middleware(['auth', 'verified']);
Route::post('/favorites', [FavoriteController::class, 'create'])->middleware(['auth', 'verified']);
Route::delete('/favorites/{id}', [FavoriteController::class, 'deleteFavorites'])->middleware(['auth', 'verified']);

//User Profile


// Route::get('/profile', [UserProfileController::class, 'getProfileData']);
Route::get('/profile/{user_id}', [UserProfileController::class, 'getProfileDataByUserId']);
Route::post('/profile', [UserProfileController::class, 'postProfileData']);
Route::put('/profile/{id}', [UserProfileController::class, 'updatePartialProfile']);


Route::get('/IsCompanie', [TypeUserController::class, 'IsCompanie']);
*/

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



// Route::post('register',[AuthController::class, 'register']);
// Route::post('login',[AuthController::class, 'login']);

// Rutas de vacantes
Route::get('/vacancies', [VacancyController::class, 'getAllVacancy']);
Route::post('/vacancies', [VacancyController::class, 'postVacancy'])->middleware(['auth:sanctum', 'verified']);
Route::get('/vacancies/{id}', [VacancyController::class, 'getVacancyById']);
Route::get('/vacancies/area/{area_id}', [VacancyController::class, 'getVacancyByArea']);
Route::get('/vacancies/province/{province_id}', [VacancyController::class, 'getVacancyByProvinceId']);
Route::get('/vacancies/company/{company_id}', [VacancyController::class, 'getVacancyByCompanyId']);
Route::delete('/vacancies/{id}', [VacancyController::class, 'deleteVacanteById'])->middleware(['auth:sanctum', 'verified']);
Route::put('/vacancies/{id}', [VacancyController::class, 'updateVacancy'])->middleware(['auth:sanctum', 'verified']);
Route::patch('/vacancies/{id}', [VacancyController::class, 'updatePartialVacancy'])->middleware(['auth:sanctum', 'verified']);
Route::get('/vacancies/applications/{vacancy_id}', [VacancyController::class, 'getApplicants']);
Route::put('/vacancies/applications/{application_id}', [VacancyController::class, 'updateApplicationStatus'])->middleware(['auth', 'verified']);
Route::get('/vacancies/student/{vacancy_id}', [VacancyController::class, 'getStudentsByVacancy']);

//Favoritos
Route::get('/favorites', [FavoriteController::class, 'getFavorites'])->middleware(['auth', 'verified']);
Route::post('/favorites', [FavoriteController::class, 'create'])->middleware(['auth', 'verified']);
Route::delete('/favorites/{id}', [FavoriteController::class, 'deleteFavorites'])->middleware(['auth', 'verified']);

//User Profile


// Route::get('/profile', [UserProfileController::class, 'getProfileData']);
Route::get('/profile/{user_id}', [UserProfileController::class, 'getProfileDataByUserId']);
Route::post('/profile', [UserProfileController::class, 'postProfileData']);
Route::put('/profile/{id}', [UserProfileController::class, 'updatePartialProfile']);