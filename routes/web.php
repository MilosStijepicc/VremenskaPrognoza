<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForecastController;

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/dashboard', [WeatherController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {

    Route::get('/add-weather', [WeatherController::class, 'create'])
        ->name('weather-create');

    Route::post('/add-weather', [WeatherController::class, 'store'])
        ->name('weather-store');

    Route::get('/change-weather', [WeatherController::class, 'editList'])
        ->name('weather-change');

    Route::get('/weather/edit/{id}', [WeatherController::class, 'edit'])
        ->name('weather-edit');

    Route::post('/weather/update/{id}', [WeatherController::class, 'update'])
        ->name('weather-update');

    Route::post('/weather/delete/{id}', [WeatherController::class, 'destroy'])
        ->name('weather-destroy');

    Route::get('/forecast/{city}', [ForecastController::class, 'index'])
        ->name('forecast');
});


require __DIR__.'/auth.php';
