<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VacancyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);

// Vacancy
Route::get('/vacancies', [VacancyController::class, 'getAllVacancy']);
Route::post('/vacancies', [VacancyController::class, 'postVacancy']);
Route::get('/vacancies/{id}', [VacancyController::class, 'getVacancyById']);
Route::get('/vacancies/area/{area_id}', [VacancyController::class, 'getVacancyByArea']);
Route::get('/vacancies/province/{province_id}', [VacancyController::class, 'getVacancyByProvinceId']);
Route::delete('/vacancies/{id}', [VacancyController::class, 'deleteVacanteById']);
Route::put('/vacancies/{id}', [VacancyController::class, 'updateVacancy']);
Route::patch('/vacancies/{id}', [VacancyController::class, 'updatePartialVacancy']);
