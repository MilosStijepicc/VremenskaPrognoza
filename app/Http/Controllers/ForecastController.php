<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index(City $city)
    {
        $forecasts = $city->forecasts()->
        orderBy('date')->get();

        return view('forecast', compact('city', 'forecasts'));
    }

    public function search(Request $request)
    {
        $cityName = trim($request->city);

        if ($cityName === '') {
            $cities = City::all();

            return view('search-results', compact('cities'));
        }

        $cities = City::with('todaysForecast')
            ->where('name', 'LIKE', "%{$cityName}%")
            ->get();

        if ($cities->isEmpty()) {
            return redirect()->route('dashboard')->withErrors([
                'city' => 'Grad nije pronađen.'
            ]);
        }

        return view('search-results', compact('cities'));
    }
}
