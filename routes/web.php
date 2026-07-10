<?php

use App\Http\Controllers\AdminWeatherController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\AdminForecastController;

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/dashboard', [WeatherController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::get('/forecast/{city:name}', [ForecastController::class, 'index'])
    ->name('forecast');


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

    Route::get('/weather', [AdminWeatherController::class, 'index'])
        ->name('weather-index');

    Route::post("/weather/update", [AdminWeatherController::class, 'update'])
    ->name('admin-weather-update');

    Route::get('/forecasts', [AdminForecastController::class,'index']
    )->name('admin-forecasts');


    Route::post('/forecasts', [AdminForecastController::class,'save']
    )->name('admin-forecast-store');

});


require __DIR__.'/auth.php';
