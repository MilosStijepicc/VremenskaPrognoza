<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $userFavourites = [];

        if (Auth::check()) {
            $userFavourites = Auth::user()
                ->cityFavourites
                ->pluck('city_id')
                ->toArray();
        }

        if ($cityName === '') {
            $cities = City::with('todaysForecast')->get();

            return view('search-results', compact('cities', 'userFavourites'));
        }

        $cities = City::with('todaysForecast')
            ->where('name', 'LIKE', "%{$cityName}%")
            ->get();

        if ($cities->isEmpty()) {
            return redirect()->route('dashboard')->withErrors([
                'city' => 'Grad nije pronađen.'
            ]);
        }

        return view('search-results', compact('cities', 'userFavourites'));
    }

}
