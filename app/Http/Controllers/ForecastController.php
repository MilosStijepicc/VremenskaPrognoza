<?php

namespace App\Http\Controllers;

use App\Models\City;

class ForecastController extends Controller
{
    public function index(City $city)
    {
        $forecasts = $city->forecasts()->
        orderBy('date')->get();

        return view('forecast', compact('city', 'forecasts'));
    }
}
